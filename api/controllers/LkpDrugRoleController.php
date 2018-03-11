<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 3/11/18
 * Time: 4:29 PM
 */

namespace api\controllers;


use yii\filters\AccessControl;
use backend\modules\crud\models\LkpDrugRole;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

use Yii;

class LkpDrugRoleController extends RestController
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
        $model = LkpDrugRole::find()->all();
        Yii::$app->api->sendSuccessResponse($model);
    }
}