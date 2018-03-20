<?php

namespace api\controllers;


use yii\filters\AccessControl;
use backend\modules\crud\models\IcsrTest;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;



class IcsrTestController extends RestController
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
                    'create' => ['POST']
                ],
            ],

        ];
    }


    public function actionCreate($icsr_id = null, $attributes = [])
    {

        $model = new IcsrTest;
        if($icsr_id){
            $model->icsr_id = $icsr_id;
            $model->attributes = $attributes;
        }else{
            $model->attributes = $this->request;
        }

        if ($model->save()) {
            Yii::$app->api->sendSuccessResponse(['status'=> 'ok']);
        } else {
            Yii::$app->api->sendFailedResponse(['status'=> 'failed']);
        }

    }
}