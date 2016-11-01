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


    public function actionSearchLlt ($term)
    {

        $connection = Yii::$app->getDb();

        $command = $connection->createCommand("
             SELECT term FROM meddra_pt WHERE MATCH (term) AGAINST ('+{$term}*'IN BOOLEAN MODE ) LIMIT 10 ");

        $result = $command->queryAll();
        $response = [];
        foreach ($result as $key => $value)
        {
         $response [] = $value['term'];
        }
        return json_encode($response);

    }
}
