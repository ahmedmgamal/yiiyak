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
class PostController extends Controller
{
    /**
     * @inheritdoc
     */


    /**
     * @inheritdoc
     */

    public function actionTesting1(){

    }

}
