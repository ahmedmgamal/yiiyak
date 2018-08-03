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
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => Verbcheck::className(),
                'actions' => [
                    'create' => ['POST'],
                    'index' => ['GET']
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
    public function actionIndex($icsr_id){
        $model = IcsrNarritive::find()->where(['icsr_id'=>$icsr_id])->all();
        if($model){
            Yii::$app->api->sendSuccessResponse($model);
        }else{
            Yii::$app->api->sendFailedResponse(['error'=>$model->getErrors()]);
        }

    }
}