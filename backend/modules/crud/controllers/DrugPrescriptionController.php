<?php
/**
 * /var/www/html/yiiyak/console/runtime/giiant/49eb2de82346bc30092f584268252ed2
 *
 * @package default
 */


namespace backend\modules\crud\controllers;
use backend\modules\crud\models\DrugPrescription;
use yii\filters\AccessControl;
use backend\modules\crud\traits;
/**
 * This is the class for controller "DrugPrescriptionController".
 */
class DrugPrescriptionController extends \backend\modules\crud\controllers\base\DrugPrescriptionController
{
    use traits\checkIcsrExported;
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            $user_id = \Yii::$app->user->id;
                            $prescription_id = \Yii::$app->request->getQueryParam('id');
                            return DrugPrescription::checkAccess($user_id,$prescription_id);
                        },
                    ]
                ]
            ]
        ];
    }

}
