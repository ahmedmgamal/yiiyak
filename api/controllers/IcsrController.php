<?php

namespace api\controllers;


use backend\components\ExportComponent;
use backend\modules\crud\models\DrugPrescription;
use backend\modules\crud\models\Icsr;
use yii\filters\AccessControl;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;
use bedezign\yii2\audit\models\AuditTrail;

use Yii;
use yii\helpers\VarDumper;


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
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
                            'approve', 'reject', 'export', 'create', 'save-storage-data', 'update'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => Verbcheck::className(),
                'actions' => [
                    'export' => ['GET'],
                    'reject' => ['GET'],
                    'create' => ['POST'],
                    'download' => ['POST'],
                    'approve' => ['POST'],
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

            $model->attributes = $this->request['icsr'];
        }
        $model->created_by = Yii::$app->user->identity->id;

        if ($model->save()) {
                return ['status'=> 'ok','icsr_id'=>$model->id, 'drug_id'=>$model->drug_id];

        } else {
            Yii::$app->api->sendFailedResponse($model->errors);
        }

    }

    public function actionSaveStorageData(){
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $saveIcsr = $this->actionCreate($this->request['icsr']);
            if($saveIcsr['status'] == 'ok') {
                if (!empty($this->request['narrative'])) {
                    foreach ($this->request['narrative'] as $icsr_narritive) {
                        Yii::$app->runAction('icsr-narritive/create', ['icsr_id' => $saveIcsr['icsr_id'], 'narritive' => $icsr_narritive['narritive']]);
                    }
                }
                if (!empty($this->request['event'])) {
                    foreach ($this->request['event'] as $icsr_event) {
                        Yii::$app->runAction('icsr-event/create', ['icsr_id' => $saveIcsr['icsr_id'], 'attributes' => json_encode($icsr_event)]);
                    }
                }

                if (!empty($this->request['test'])) {
                    foreach ($this->request['test'] as $icsr_test) {
                        Yii::$app->runAction('icsr-test/create', ['icsr_id' => $saveIcsr['icsr_id'], 'attributes' => json_encode($icsr_test)]);
                    }
                }
                if (!empty($this->request['reporter'])) {
                    foreach ($this->request['reporter'] as $icsr_reporter) {
                        Yii::$app->runAction('icsr-reporter/create', ['icsr_id' => $saveIcsr['icsr_id'], 'attributes' => json_encode($icsr_reporter)]);
                    }
                }
                if (!empty($this->request['prescription'])) {
                    foreach ($this->request['prescription'] as $icsr_prescription) {
                        Yii::$app->runAction('drug-prescription/create', ['icsr_id' => $saveIcsr['icsr_id'],'drug_id'=>$saveIcsr['drug_id'], 'attributes' => json_encode($icsr_prescription)]);

                    }
                }
            }
            $transaction->commit();
                Yii::$app->api->sendSuccessResponse(['status'=> 'ok']);


        }catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
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
    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $model->status = 'real';
        if ($model->update()) {
            return Yii::$app->api->sendSuccessResponse(true);
        }
        else {
            return Yii::$app->api->sendFailedResponse($model->errors);
        }
    }

    public function actionReject($id){
        $model = $this->findModel($id);
        if($model){
            $model->delete();
            return Yii::$app->api->sendSuccessResponse(true);
        }else{
            return Yii::$app->api->sendFailedResponse($model->errors);
        }
    }

    public function actionExport($id){
        $ex = new ExportComponent;
        $ex->export($id);
//        $module = Yii::$app->getModule('crud');
//        VarDumper::dump($module->id);
//        Yii::$app->runAction('crud/icsr/export', ['id'=>$id, 'case'=>'normal', 'api'=>1]);

    }
    protected function findModel($id)
    {
        if (($model = Icsr::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
        }
    }

}