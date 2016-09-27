<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use yii\filters\AccessControl;
use backend\modules\crud\models\IcsrReporter;

use backend\modules\crud\traits;

/**
 * This is the class for controller "IcsrReporterController".
 */
class IcsrReporterController extends \backend\modules\crud\controllers\base\IcsrReporterController
{
    use traits\checkIcsrExported;
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
                            $report_id = \Yii::$app->request->getQueryParam('id');
                            return IcsrReporter::checkAccess($user_id,$report_id);
                        },
                    ]
                ]
            ]
        ];
    }




}
