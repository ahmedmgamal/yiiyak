<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use Yii;
use yii\filters\AccessControl;

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

        $currentUserCompany = \Yii::$app->user->identity->company;

       $companyDrugs = $currentUserCompany->getDrugs()->with([

                    'icsrs' => function ($query) {
                        $query->with(['icsrEvents']);
                    }])->all();

        $drugsWithIcsrs = [];
        foreach ($companyDrugs as $key => $obj)
        {
            $formattedDrug = $this->formatDrug($obj);
            $drugsWithIcsrs [] = $formattedDrug['drugsWithIcsrs'];
        }


        return $this->render('statistics',['drugsWithIcsrs' => $drugsWithIcsrs]);
    }


    private function formatDrug ($drugObj)
    {

        $drugsWithIcsrs = ['name' => $drugObj->trade_name , 'y' => count($drugObj->icsrs)];

        // Ex ['Aglcouma' => ['name' => 'Aglcouma' , 'y' => 50]]
        $meddraLltWithIcsrs = [];
        //Ex ['Aglcouma' =>['icsr_id' => 5]]
        $tempLltArr = [];
        foreach ($drugObj->icsrs as $key1 => $icsrObj)
        {

            foreach ($icsrObj->icsrEvents as $key2 => $icsrEventObj)
            {
                if(isset($tempLltArr[$icsrEventObj->meddra_llt_text]['icsr_id'][$icsrObj->id]))
                {

                }
                else
                 {
                     $tempLltArr[] = [$icsrEventObj->meddra_llt_text => ['icsr_id' => $icsrObj->id]];
                    if (isset($meddraLltWithIcsrs[$icsrEventObj->meddra_llt_text]))
                    {
                        $meddraLltWithIcsrs[$icsrEventObj->meddra_llt_text]['y'] += 1;
                    }

                    else
                        {
                            $meddraLltWithIcsrs [$icsrEventObj->meddra_llt_text] = ['name' => $icsrEventObj->meddra_llt_text , 'y' => 1];
                        }
                 }


            }




        }

//        print_r($meddraLltWithIcsrs);
//        die();
        return ['drugsWithIcsrs' => $drugsWithIcsrs];

    }
}
