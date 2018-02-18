<?php
namespace backend\modules\crud\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\modules\crud\models\User;

class ApiController extends Controller
{


    public function behaviors()
    {
        $this->enableCsrfValidation = false;
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['post'],
                ],
            ],
        ];
    }


    public function actionLogin(){
        $model = new LoginForm();
        $json = file_get_contents("php://input");
        $data  =Json::decode($json, true);
        foreach ($data as $key => $value){
            if(in_array($key, array_keys($model->attributes))){
                $model->$key = $value;
            }else{
                return Json::encode(['status'=>'key not found']);
            }
        }

        if($model->login()){
            $logged_in_user_id = Yii::$app->user->identity->id;

            if (User::checkSubscription($logged_in_user_id)) {
                //complete login code here
                $user = User::findIdentity($logged_in_user_id);
                return Json::encode([
                    'status'=>'success',
                    'id'=> $user->id,
                    'token'=> $user->auth_key,
                    'companyId'=> $user->company->id,
                    'companyName'=> $user->company->name,
                    'userRole'=> $user->getRole($logged_in_user_id),
                ]);

            }else{
                return Json::encode(['status'=>'your subscription has been ended']);
            }
        }else{
            return Json::encode(['status'=>'user not found']);
        }

    }
}