<?php

namespace api\controllers;


use yii\filters\AccessControl;
use backend\modules\crud\models\IcsrEvent;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;



class IcsrEventController extends RestController
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
                            $icsrEvent_id = \Yii::$app->request->getQueryParam('id');
                            if (isset($icsrEvent_id) && !empty($icsrEvent_id)) {
                                return IcsrEvent::checkObjIcsrNullExported($icsrEvent_id);
                            }

                            return IcsrEvent::checkIcsrNullExported(\Yii::$app->request->getQueryParam('IcsrEvent')['icsr_id']);

                        }
                    ],
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            $user_id = \Yii::$app->user->id;
                            $event_id = \Yii::$app->request->getQueryParam('id');
                            return IcsrEvent::checkAccess($user_id,$event_id);
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


    public function actionCreate($icsr_id = null, $attributes = null)
    {

        $model = new IcsrEvent;
        if($icsr_id){
            $attributes = json_decode($attributes);

            $model->icsr_id = $icsr_id;
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