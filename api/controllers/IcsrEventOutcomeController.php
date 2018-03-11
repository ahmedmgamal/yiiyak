<?php

namespace api\controllers;


use yii\filters\AccessControl;
use backend\modules\crud\models\LkpIcsrEventoutcome;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;



class IcsrEventOutcomeController extends RestController
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
                    'view' => ['GET'],
                ],
            ],

        ];
    }


    public function actionView($id)
    {

        $model = LkpIcsrEventoutcome::find()->where(['icsr_id'=> $id])->all();
        Yii::$app->api->sendSuccessResponse($model);
    }


    protected function findModel($id)
    {
        if (($model = LkpIcsrEventoutcome::findOne($id)) !== null) {
            return $model;
        } else {
            Yii::$app->api->sendFailedResponse("Invalid Record requested");
        }
    }
}