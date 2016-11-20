<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\IcsrReporter as BaseIcsrReporter;
use \backend\modules\crud\traits;

/**
 * This is the model class for table "icsr_reporter".
 */
class IcsrReporter extends BaseIcsrReporter
{
    use traits\checkAccess;
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'id' => Yii::t('app', 'ID'),
            'icsr_id' => Yii::t('app', 'Icsr Id'),
            'country_lkp_id' => Yii::t('app', 'A.2.1.3 Country'),
            'first_name' => Yii::t('app', 'A.2.1.1 Reporter identifier (name or initials)'),
            'last_name' => Yii::t('app', 'A.2.1.1 Reporter identifier (name or initials)'),
            'address_line_1' => Yii::t('app', 'A.2.1.2a Reporter Organization'),
            'address_line_2' => Yii::t('app', 'A.2.1.2b Reporter  Department'),
            'city' => Yii::t('app', 'A.2.1.2 Reporter’s address'),
            'state' => Yii::t('app', 'A.2.1.2 Reporter’s address'),
            'zip_code' => Yii::t('app', 'A.2.1.2 Reporter’s address'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'occupation_lkp_id' => Yii::t('app', 'A.2.1.4 Qualification:Physician, Pharmacist, Other health professional, Lawyer, Consumer or other nonhealth professional'),
            'health_professional' => Yii::t('app', 'Health Professional'),
            ]);
    }
    public function behaviors()
    {
        return [
            'AuditTrailBehavior' => [
                'class' => 'backend\modules\crud\overrides\TrailChild\AuditTrailBehaviorChild',
                'ignored' => ['id','icsr_id'],
                'overRide' => ['country_lkp_id' => ['table_name' => 'lkp_country' , 'search_field' => 'id' ,'return_field' => 'name'],
                    'occupation_lkp_id'=> ['table_name' => 'lkp_occupation','search_field' => 'id', 'return_field' => 'description'],
                ]

            ]
        ];
    }
}
