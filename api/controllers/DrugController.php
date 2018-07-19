<?php

namespace api\controllers;


use backend\modules\crud\models\Drug;
use yii\filters\AccessControl;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;
use yii\helpers\VarDumper;


class DrugController extends RestController
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
                            'index', 'check-limit', 'create'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => Verbcheck::className(),
                'actions' => [
                    'index' => ['GET', 'POST'],
                    'create' => ['POST'],
                    'update' => ['POST'],
                    'create' => ['POST'],
                    'view' => ['GET'],
                    'check-limit' => ['GET'],
                    'delete' => ['DELETE']
                ],
            ],

        ];
    }


    public function actionView($id)
    {

        $icsr = $this->findModel($id)->icsrs;
        return ['status'=>'success', 'icsrs'=>$icsr];
    }


    protected function findModel($id)
    {
        if (($model = Drug::findOne($id)) !== null) {
            return $model;
        } else {
            Yii::$app->api->sendFailedResponse("Invalid Record requested");
        }
    }
    public function actionCreate(){
        $model = $this->actionCheckLimit();
        if($model){
            $model->attributes = $this->request;
            if($model->save()){
                Yii::$app->api->sendSuccessResponse();
            }
        }
    }
    public function actionCheckLimit()
    {
        $model = new Drug;
        $model->company_id = Yii::$app->user->identity->company_id;
        if($model->isBeyondLimit()){
            return false;
        }else{
            return $model;
        }
    }
}