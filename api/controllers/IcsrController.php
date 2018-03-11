<?php

namespace api\controllers;


use backend\modules\crud\models\DrugPrescription;
use backend\modules\crud\models\Icsr;
use yii\filters\AccessControl;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;


class IcsrController extends RestController
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
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
                            'index'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => Verbcheck::className(),
                'actions' => [
                    'create' => ['POST'],
                    'save-storage-data' => ['POST'],
                    'update' => ['POST']
                ],
            ],

        ];
    }


    public function actionCreate($attributes = [])
    {
        $model = new Icsr;
        if(count($attributes) > 0){
            $model->attributes = $attributes;
        }else{

            $model->attributes = $this->request;
        }
        $model->created_by = Yii::$app->user->identity->id;

        if ($model->save()) {
            $pres = new DrugPrescription;
            $pres->drug_id =($model->getDrug()->one()->id);
            $pres->drug_role = '1';//value of suspect
            $pres->icsr_id = $model->id;
            if($pres->save()){
                Yii::$app->api->sendSuccessResponse(['status'=> 'ok','icsr_id'=>$model->id]);
            }else{
                Yii::$app->api->sendFailedResponse($pres->errors);
            }

        } else {
            Yii::$app->api->sendFailedResponse($model->errors);
        }

    }

    public function actionSaveStorageData(){
        $saveIcsr = $this->actionCreate($this->request['icsr']);
        if($saveIcsr['status'] == 'ok'){
            if(!empty($this->request['narritive'])){
                foreach ($this->request['narritive'] as $icsr_narritive){
                    $narrative =  new IcsrNarritiveController();
                    $narrative->actionCreate($saveIcsr['icsr_id'], $icsr_narritive);
                }
            }
            if (!empty($this->request['event'])){
                foreach ($this->request['event'] as $icsr_event){
                    $event =  new IcsrEventController();
                    $event->actionCreate($saveIcsr['icsr_id'], $icsr_event);
                }
            }

            if (!empty($this->request['test'])){
                foreach ($this->request['test'] as $icsr_test){
                    $test =  new IcsrTestController();
                    $test->actionCreate($saveIcsr['icsr_id'], $icsr_test);
                }
            }

            if (!empty($this->request['reporter'])){
                foreach ($this->request['reporter'] as $icsr_reporter){
                    $reporter =  new IcsrReporterController();
                    $reporter->actionCreate($saveIcsr['icsr_id'], $icsr_reporter);
                }
            }


            Yii::$app->api->sendSuccessResponse(['status'=> 'ok']);

        }
    }

    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $model->attributes = $this->request;
        if ($model->save()) {
            Yii::$app->api->sendSuccessResponse($model->attributes);
        } else {
            Yii::$app->api->sendFailedResponse($model->errors);
        }

    }

}