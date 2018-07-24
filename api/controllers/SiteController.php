<?php
namespace api\controllers;

use backend\modules\crud\models\LkpCountry;
use backend\modules\crud\models\LkpDrugAction;
use backend\modules\crud\models\LkpDrugRole;
use backend\modules\crud\models\LkpIcsrEventoutcome;
use backend\modules\crud\models\LkpIcsrType;
use backend\modules\crud\models\LkpOccupation;
use backend\modules\crud\models\LkpRoute;
use backend\modules\crud\models\User;
use Yii;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\AuthorizationCodes;
use common\models\AccessTokens;

use api\models\SignupForm;
use api\behaviours\Verbcheck;
use api\behaviours\Apiauth;

/**
 * Site controller
 */
class SiteController extends RestController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $behaviors = parent::behaviors();

        return $behaviors + [
            'apiauth' => [
                'class' => Apiauth::className(),
                'exclude' => ['authorize', 'register', 'accesstoken','index'],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'me', 'find-all-lkp'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['authorize', 'register', 'accesstoken'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => Verbcheck::className(),
                'actions' => [
                    'logout' => ['GET'],
                    'find-all-lkp' => ['GET'],
                    'authorize' => ['POST'],
                    'register' => ['POST'],
                    'accesstoken' => ['POST'],
                    'me' => ['GET'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->api->sendSuccessResponse(['Yii2 RESTful API with OAuth2']);
        //  return $this->render('index');
    }

    public function actionRegister()
    {

        $model = new SignupForm();
        $model->attributes = $this->request;

        if ($user = $model->signup()) {

            $data=$user->attributes;
            unset($data['auth_key']);
            unset($data['password_hash']);
            unset($data['password_reset_token']);

            Yii::$app->api->sendSuccessResponse($data);

        }

    }


    public function actionMe()
    {
        $data = Yii::$app->user->identity;
        $data = $data->attributes;
        unset($data['auth_key']);
        unset($data['password_hash']);
        unset($data['password_reset_token']);

        Yii::$app->api->sendSuccessResponse($data);
    }

    public function actionAccesstoken($authorization_code)
    {

        $authorization_code = $authorization_code;

        $auth_code = AuthorizationCodes::isValid($authorization_code);
        if (!$auth_code) {
            Yii::$app->api->sendFailedResponse("Invalid Authorization Code");
        }
        $accesstoken = Yii::$app->api->createAccesstoken($authorization_code);
        $logged_in_user_id = Yii::$app->user->identity->id;
        if (User::checkSubscription($logged_in_user_id)) {
            //complete login code here
            $user = User::findIdentity($logged_in_user_id);
             return $data = [
                'status' => 'success',
                'token' => $accesstoken->token,
                'companyId' => $user->company->id,
                 'username'=> $user->username,
                'companyName' => $user->company->name,
                'userRole' => $user->getRole($logged_in_user_id),
            ];

        }else{
            return Json::encode(['status'=>'your subscription has been ended']);
        }
    }

    public function actionAuthorize()
    {
        $model = new LoginForm();

        $model->attributes = $this->request;


        if ($model->validate() && $model->login()) {

            $auth_code = Yii::$app->api->createAuthorizationCode(Yii::$app->user->identity['id']);

            $data = [];
            $data['authorization_code'] = $auth_code->code;
            $data['expires_at'] = $auth_code->expires_at;

            return $this->actionAccesstoken($data['authorization_code']);
        } else {
            Yii::$app->api->sendFailedResponse($model->errors);
        }
    }


    public function actionLogout()
    {
        $headers = Yii::$app->getRequest()->getHeaders();
        $access_token = $headers->get('x-access-token');

        if(!$access_token){
            $access_token = Yii::$app->getRequest()->getQueryParam('access-token');
        }

        $model = AccessTokens::findOne(['token' => $access_token]);

        if ($model->delete()) {

            Yii::$app->api->sendSuccessResponse(["Logged Out Successfully"]);

        } else {
            Yii::$app->api->sendFailedResponse("Invalid Request");
        }


    }

    public function actionFindAllLkp(){
        $data = [];
        $data['LkpDrugAction'] = LkpDrugAction::find()->all();
        $data['LkpIcsrType'] = LkpIcsrType::find()->all();
        $data['LkpCountry'] = LkpCountry::find()->all();
        $data['LkpDrugRole'] = LkpDrugRole::find()->all();
        $data['LkpIcsrEventoutcome'] = LkpIcsrEventoutcome::find()->all();
        $data['LkpOccupation'] = LkpOccupation::find()->all();
        $data['LkpRoute'] = LkpRoute::find()->all();

       return ['status'=>1,'data'=>$data];
    }
}
