<?php

namespace api\controllers;


use yii\filters\AccessControl;
use backend\modules\crud\models\IcsrNarritive;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;



class IcsrNarritiveController extends RestController
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
                        'actions' => ['update','delete'],
                        'verbs' => ['POST'],
                        'matchCallback' => function ($rule,$action){
                            $icsrNarritive_id = \Yii::$app->request->getQueryParam('id');
                            return IcsrNarritive::checkObjIcsrNullExported($icsrNarritive_id);

                        }
                    ],
                    [
                        'allow' => true,
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


    public  function actionCreate($icsr_id = null, $narritive = '')
    {
        $model = new IcsrNarritive;
        if($icsr_id){
            $model->icsr_id = $icsr_id;
            $model->narritive = $narritive;
        }else{
            $model->attributes = $this->request;
        }

        if ($model->save()) {

            return ['status'=> 'ok'];
        } else {
            Yii::$app->api->sendFailedResponse(['status'=> 'failed']);
        }

    }
}