<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use yii\filters\AccessControl;

/**
 * This is the class for controller "CompanyController".
 */
class CompanyController extends \backend\modules\crud\controllers\base\CompanyController
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
                        'roles' => ['admin'],
                    ],

                ]
            ]
        ];
    }
}
