<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use yii\filters\AccessControl;
use backend\modules\crud\models\IcsrTest;
/**
 * This is the class for controller "IcsrTestController".
 */
class IcsrTestController extends \backend\modules\crud\controllers\base\IcsrTestController
{

    /**
     *
     * @inheritdoc
     * @return array
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [

                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            $user_id = \Yii::$app->user->id;
                            $test_id = \Yii::$app->request->getQueryParam('id');
                            return IcsrTest::checkAccess($user_id,$test_id);
                        },

                    ]
                ]
            ]
        ];
    }

}
