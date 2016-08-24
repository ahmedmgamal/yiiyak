<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\helpers\Url;
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
                        'actions' => ['login', 'error','landing','send-mail'],
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
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect('@web/crud/drug/index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
          return  $this->redirect('@web/crud/drug/index');
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
}
