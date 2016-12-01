<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use backend\modules\crud\models\base\Icsr;
use Yii;
use yii\filters\AccessControl;
use backend\modules\crud\models\IcsrEvent;
use backend\modules\crud\traits;
use yii\web\Response;

/**
 * This is the class for controller "IcsrEventController".
 */
class IcsrEventController extends \backend\modules\crud\controllers\base\IcsrEventController
{


    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            $user_id = \Yii::$app->user->id;
                            $event_id = \Yii::$app->request->getQueryParam('id');
                            return IcsrEvent::checkAccess($user_id,$event_id);
                        },
                    ]
                ]
            ]
        ];
    }


    public function actionSearchPt ($term)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->user->identity->company->enable_meddra_search != 1)
        {
            return ['ptTerms' => []];
        }

        if (isset($term) && !empty($term))
        {

        $connection = Yii::$app->getDb();
           
        $term = '+' . $term . '*';
        
            $command = $connection->createCommand('
             SELECT term FROM meddra_pt WHERE MATCH (term) AGAINST (:term IN BOOLEAN MODE ) LIMIT 10 ')
             ->bindValue(':term',$term);
            
              
        $result = $command->queryAll();
        $response = [];
        foreach ($result as $key => $value)
        {
         $response [] = $value['term'];
        }
        return ['ptTerms' => $response];

    }

    return ['ptTerms' => []];
    }



    public function actionSearchLlt ($ptTerm,$searchTerm)
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->user->identity->company->enable_meddra_search != 1)
        {
            return ['lltTerms' => []];
        }
        $whereCondition = "";

        if (isset($ptTerm) && !empty($ptTerm))
        {
            $whereCondition = "AND `meddra_pt`.term='{$ptTerm}'";
        }

        if (isset($searchTerm) && !empty($searchTerm))
        {
            $connection = Yii::$app->getDb();
            
            $searchTerm = '+' . $searchTerm . '*';

            $command = $connection->createCommand("
             SELECT `meddra_llt`.term FROM meddra_llt 
             join meddra_pt on `meddra_llt`.pt_id = `meddra_pt`.id
             WHERE MATCH (`meddra_llt`.term) AGAINST (:searchTerm IN BOOLEAN MODE ) ".$whereCondition."  LIMIT 10 ")
             ->bindValue(':searchTerm',$searchTerm);

            $result = $command->queryAll();

            $response = [];
            foreach ($result as $key => $value)
            {
                $response [] = $value['term'];
            }

            return ['lltTerms' => $response];
        }

        return ['lltTerms' => []];
    }


    public function actionGetPtFromLt ($lltTerm)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (isset($lltTerm) && !empty($lltTerm))
        {
            $connection = Yii::$app->getDb();

            $command = $connection->createCommand("
            SELECT term FROM meddra_pt where id = (
            SELECT pt_id FROM meddra_llt WHERE term = :lltTerm
            )
            ")
            ->bindValue(':lltTerm',$lltTerm);

            $result = $command->queryAll();

            $ptTerm = isset($result[0]['term']) ? $result[0]['term'] : '';

            return ['ptTerm' => $ptTerm];
        }

        return ['ptTerm' => ''];
    }


    public function actionGetFirstLtFromPt ($ptTerm)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (isset($ptTerm) && !empty($ptTerm))
        {
            $connection = Yii::$app->getDb();

            $command = $connection->createCommand("
            SELECT term FROM meddra_llt where pt_id = (
            SELECT id FROM meddra_pt WHERE term = :ptTerm
            )
            ")
            ->bindValue("ptTerm",$ptTerm);

            $result = $command->queryAll();

            $ltTerm = isset($result[0]['term']) ? $result[0]['term'] : '';

            return ['ltTerm' => $ltTerm];
        }

        return ['ltTerm' => ''];
    }

}
