<?php

namespace api\controllers;


use yii\filters\AccessControl;
use backend\modules\crud\models\DrugPrescription;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;



class DrugPrescriptionController extends RestController
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
                            $prescription_id = \Yii::$app->request->getQueryParam('id');
                            if (isset($prescription_id) && !empty($prescription_id)) {
                                return DrugPrescription::checkObjIcsrNullExported($prescription_id);
                            }

                            return DrugPrescription::checkIcsrNullExported(\Yii::$app->request->getQueryParam('DrugPrescription')['icsr_id']);

                        }
                    ],

                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            $user_id = \Yii::$app->user->id;
                            $prescription_id = \Yii::$app->request->getQueryParam('id');
                            return DrugPrescription::checkAccess($user_id,$prescription_id);
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


    public function actionCreate($icsr_id = null,$drug_id = null, $attributes = null)
    {
        $model = new DrugPrescription;
        if($icsr_id){
            $attributes = json_decode($attributes);
            $model->icsr_id = $icsr_id;
            $model->drug_id = $drug_id;
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