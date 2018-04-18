<?php

namespace api\controllers;


use yii\filters\AccessControl;
use backend\modules\crud\models\IcsrReporter;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;



class IcsrReporterController extends RestController
{

    public function behaviors()
    {

        $behaviors = parent::behaviors();

        return $behaviors + [

           'apiauth' => [
               'class' => Apiauth::className(),
               'exclude' => [],
               'callback'=>[]
           ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [

                    [
                        'allow' => false,
                        'actions' => ['update','delete','create'],
                        'matchCallback' => function ($rule,$action){
                            $report_id = \Yii::$app->request->getQueryParam('id');
                            if (isset($report_id) && !empty($report_id)) {
                                return IcsrReporter::checkObjIcsrNullExported($report_id);
                            }

                            return IcsrReporter::checkIcsrNullExported(\Yii::$app->request->getQueryParam('IcsrReporter')['icsr_id']);

                        }
                    ],
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            $user_id = \Yii::$app->user->id;
                            $report_id = \Yii::$app->request->getQueryParam('id');
                            return IcsrReporter::checkAccess($user_id,$report_id);
                        },
                    ]
                ]
            ],
            'verbs' => [
                'class' => Verbcheck::className(),
                'actions' => [
                    'create' => ['POST']
                ],
            ],

        ];
    }


    public function actionCreate($icsr_id = null, $attributes = null)
    {

        $model = new IcsrReporter;
        if($icsr_id){
            $attributes = json_decode($attributes);
            $model->icsr_id = $icsr_id;
            $model->attributes = (array)$attributes;
        }else{
            $model->attributes = $this->request;
        }

        if ($model->save()) {
            return ['status'=> 'ok'];
        } else {
            Yii::$app->api->sendFailedResponse(['status'=> 'failed', 'error'=>$model->getErrors()]);
        }

    }
}