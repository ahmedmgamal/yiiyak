<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * This is the class for controller "CompanyController".
 */
class CompanyController extends \backend\modules\crud\controllers\base\CompanyController
{
    /**
     *
     * @inheritdoc
     * @return array
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['statistics'],
                        'roles' => ['normalUser'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],

                ]
            ]
        ];
    }

    public function actionStatistics ()
    {
        if (!isset(\Yii::$app->user->identity->id))
        {
            Yii::$app->session->setFlash('error',Yii::t('app','Login First To See Your Company Statistics'));

            return $this->redirect(Yii::$app->request->referrer);
        }

        $drugsWithIcsrs = [];
        $icsrsIds = [];
        $limitsArr = [];

        $currentUserCompany = \Yii::$app->user->identity->company;

        $companyDrugs = $currentUserCompany->getDrugs()->with(['icsrs' ])->all();

        foreach ($companyDrugs as $key => $obj)
        {

            ArrayHelper::getColumn($obj->icsrs, function ($element) use (&$icsrsIds){
                $icsrsIds [] = $element['id'];
            });

            $drugsWithIcsrs [] = ['name' => $obj->trade_name , 'y' => count($obj->icsrs)];
        }

        foreach ($currentUserCompany->plan->getAllLimitsWithAmount() as $key => $value)
        {
            $limitsArr [$value['name']] = $value;
        }


        $formattedMeddra = $this->formatLltAndPt($icsrsIds);


        return $this->render('statistics',
                            [
                                'drugsWithIcsrs' => $drugsWithIcsrs,
                                'meddraLltWithIcsrs' => $formattedMeddra['meddraLltWithIcsrs'],
                                'meddraPtWithIcsrs' => $formattedMeddra['meddraPtWithIcsrs'],
                                'icsrsPerMonth' => $this->icsrsPerMonthResult($icsrsIds),
                                'limitsArr' => $limitsArr,
                                'totalUsers' => count($currentUserCompany->users),
                                'totalDrugs' => count($companyDrugs),
                                'totalIcsrs' => count($icsrsIds)

                            ]);
    }




    private function formatLltAndPt ($icsrsIdsArr)
    {

        return [
                'meddraLltWithIcsrs' => $this->meddraQueryResult('meddra_llt_text',$icsrsIdsArr),
                'meddraPtWithIcsrs' => $this->meddraQueryResult('meddra_pt_text',$icsrsIdsArr)
               ];


    }

    private function meddraQueryResult ($groupBy,$icsrsIdsArr) {

        $query = new \yii\db\Query();

      $objects =  $query->select(['`icsr_event`.`meddra_llt_text` as name','count(DISTINCT `icsr`.id) as y'])
            ->from('icsr')
            ->where(['icsr.id' => $icsrsIdsArr])
            ->innerJoin('icsr_event','icsr.id = icsr_event.icsr_id')
            ->groupBy('icsr_event.'.$groupBy)
            ->all();

       return  array_map(function ($element){
           $element['y'] = (integer)$element['y'];
           return $element;
       } , $objects);

    }

    private function icsrsPerMonthResult ($icsrsIdsArr) {
        $query = new \yii\db\Query();

        $objects =  $query->select([' MONTHNAME(created_at) as monthName',' count(id) as icsrsNumbers'])
            ->from('icsr')
            ->where(['icsr.id' => $icsrsIdsArr])
            ->groupBy('monthName')
            ->orderBy('created_at ASC')
            ->all();

        $monthNames = [];
        $icsrsNumbers = [];

         array_map(function ($element) use (&$monthNames,&$icsrsNumbers){
            $monthNames [] = $element['monthName'];
            $icsrsNumbers [] = (integer)$element['icsrsNumbers'];

        } , $objects);

        return ['monthNames' => $monthNames ,'icsrsNumbers' => $icsrsNumbers] ;

    }



}
