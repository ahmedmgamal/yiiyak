<?php
namespace backend\controllers;

use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use backend\modules\crud\models\User;
use Da\TwoFA\Service\TOTPSecretKeyUriGeneratorService;
use Da\TwoFA\Service\GoogleQrCodeUrlGeneratorService;
use Da\TwoFA\Manager;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','landing','send-mail','request-password-reset','reset-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
              //  'class' => 'yii2mod\cms\actions\PageAction',
                'class' => 'yii\web\ErrorAction',
            ],
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function genearteGoogleAuthToken()
    {
        $manager = new Manager();
        $secret = $manager->generateSecretKey();
        $user = \Yii::$app->user;
        $currentUser=User::findIdentity($user->id);
        if(empty($currentUser->twofa_secret)) {
            $currentUser->twofa_secret = $secret;
            $currentUser->save();
        }



    }
    public function qrcodeGooleAuth($alert=0){

        $user = \Yii::$app->user;
        $user = User::findIdentity($user->id);
        $secret = $user->twofa_secret;


        $totpUri = (new TOTPSecretKeyUriGeneratorService('PVRADAR', $user->username, $secret))->run();
        $googleUri = (new GoogleQrCodeUrlGeneratorService($totpUri))->run();

        return $this->render('qrcode', [
            'googleUri' => $googleUri,
            'secret' => $secret,
            'alert'=>$alert,
        ]);
    }

    public function actionLogin()
    {

        $user = \Yii::$app->user;
        $user = User::findIdentity($user->id);

        if(isset($_POST['qrcode']))
        {
            $manager = new Manager();
            $valid = $manager->verify($_POST['qrcode'], $user->twofa_secret);


            if($valid == false){
                //if entered invalid qrcode
                return $this->qrcodeGooleAuth('Your Verification Code is Wrong Please try again');
            }
            else{
                //if entered valid qrcode
                $user->auth = 1;
                $user->save();
                return $this->redirect('@web/crud/company/index');
            }
        }


        $userRole = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);

        if (isset($userRole['admin']))
        {
            if($user->auth == 1)
                return $this->redirect('@web/crud/company/index');
            else
                return $this->qrcodeGooleAuth();

        }
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect('@web/crud/drug/index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            //be careful
            // the returned user object is from common\models\user
            $logged_in_user_id = Yii::$app->user->identity->id;

            if (User::checkSubscription($logged_in_user_id)) {
                $userRole =\Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);

                if (isset($userRole['admin']))
                {
                    // for first time login must generate token
                    $this->genearteGoogleAuthToken();
                    return $this->redirect('@web/crud/company/index');
                }
                return $this->redirect('@web/crud/drug/index');

            }
            Yii::$app->user->logout();

            \Yii::$app->getSession()->setFlash('error', \Yii::t('app','Your company have expired please renew the quote'));

            return $this->redirect('@web/site/login');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        $user = \Yii::$app->user;
        $user = User::findIdentity($user->id);
        $user->auth = 0;
        $user->save();
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLanding () {
        $this->layout = 'landing';
        return $this->render('landing');
    }

    public function actionSendMail(){
        $request = Yii::$app->request;
        $emailBody = 'email is:- ' . $request->post('email').
                     ' and his number is:- ' .$request->post('number').
                     ' the requested package is:- '.$request->post('message');

        Yii::$app->mailer->compose()
            ->setFrom($request->post('email'))
            ->setTo('ahmedabdelftah95165@gmail.com')
            ->setSubject('Quotation Request')
            ->setTextBody($emailBody)
            ->send();
        $this->layout = 'landing';
        $this->redirect(Url::toRoute(['site/landing']));

    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }


    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
