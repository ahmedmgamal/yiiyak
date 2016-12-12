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
                        'allow' => false,
                        'actions' => ['update','delete','create'],
                        'matchCallback' => function ($rule,$action){
                            $report_id = \Yii::$app->request->getQueryParam('id');
                            if (isset($report_id) && !empty($report_id)) {
                                return IcsrReporter::checkObjIcsrNullExported($report_id);
                            }

                            return IcsrReporter::checkIcsrNullExported(\Yii::$app->request->getQueryParam('IcsrReporter')['icsr_id']);

                        }
                    ],
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
