<?php

namespace api\controllers;


use yii\filters\AccessControl;
use backend\modules\crud\models\LkpMeddraPt;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;



class LkpMeddraPtController extends RestController
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
                    'index' => ['GET']
                ],
            ],

        ];
    }

    public function actionIndex()
    {
        $model = LkpMeddraPt::find()->all();
        return ['status'=>'success', 'data'=>$model];
    }

}