<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;


use backend\modules\crud\models\User;
use yii\filters\AccessControl;

/**
 * This is the class for controller "UserController".
 */
class UserController extends \backend\modules\crud\controllers\base\UserController
{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule,$action){
                            $user_id = \Yii::$app->user->id;
                            return User::checkUserCan($user_id);

                        }
                    ],


                ]
            ]
        ];
    }

}
