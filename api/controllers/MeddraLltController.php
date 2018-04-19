<?php

namespace api\controllers;


use yii\filters\AccessControl;
use backend\modules\crud\models\MeddraLlt;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;



class MeddraLltController extends RestController
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

    public function actionIndex($term)
    {

        $result = (new yii\db\query())
            ->select(['id', 'term'])
            ->from('meddra_llt')
            ->where(['like', 'term', $term])
            ->all();
        return ['status'=>'success', 'data'=>$result];
    }
    public function actionPtId($id){
        $result = (new yii\db\query())
            ->select(['id', 'term'])
            ->from('meddra_llt')
            ->Where(['pt_id'=>$id])
            ->all();
        return ['status'=>'success', 'data'=>$result];
    }

}