<?php

namespace api\controllers;


use yii\filters\AccessControl;
use backend\modules\crud\models\LkpCountry;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;



class CountryController extends RestController
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
                    'index' => ['GET', 'POST']
                ],
            ],

        ];
    }

    public function actionIndex()
    {
        $response = LkpCountry::find()->all();
        Yii::$app->api->sendSuccessResponse($response);
    }
}