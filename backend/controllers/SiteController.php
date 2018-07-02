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
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {

        $userRole = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);

        if (isset($userRole['admin']))
        {
            return $this->redirect('@web/crud/company/index');
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
