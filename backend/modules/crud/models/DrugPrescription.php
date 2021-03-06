<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\DrugPrescription as BaseDrugPrescription;
use \backend\modules\crud\traits;
/**
 * This is the model class for table "drug_prescription".
 */
class DrugPrescription extends BaseDrugPrescription
{
    use traits\checkAccess;
    use traits\checkIcsrNullExported;
     public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [
                'ndc' => Yii::t('app', 'Additional information on drug Use'),
            ]);
     
    }/**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'id' => Yii::t('app', 'ID'),
            'drug_id' => Yii::t('app', 'Drug '),
            'icsr_id' => Yii::t('app', 'Icsr '),
            'frequency_lkp_id' => Yii::t('app', 'Frequency '),
            'expiration_date' => Yii::t('app', 'Expiration Date'),
            'lot_no' => Yii::t('app', 'B.4.k.3 Batch/lot number'),
            'ndc' => Yii::t('app', '	B.4.k.19 Additional information on drug'),
            'use_date_start' => Yii::t('app', 'B.4.k.12 Date of start of drug'),
            'use_date_end' => Yii::t('app', 'B.4.k.14 Date of last administration'),
            'duration_of_use' => Yii::t('app', 'B.4.k.15a Duration of drug administration'),
            'duration_of_use_unit' => Yii::t('app', 'B.4.k.15b Duration of drug administration (unit)'),
            'reason_of_use' => Yii::t('app', 'B.4.k.11 Indication for use in the case'),
            'problem_returned_after_reuse' => Yii::t('app', 'B.4.k.17 Effect of rechallenge (or re-exposure), for suspect drug(s) only'),
            'lkp_drug_action_id' =>   Yii::t('app', 'B.4.k.16 Action(s) taken with drug')
            ]);
    }

    public function behaviors()
    {
        return [
            'AuditTrailBehavior' => [
                'class' => 'backend\modules\crud\overrides\TrailChild\AuditTrailBehaviorChild',
                'ignored' => ['id','drug_id','icsr_id','drug_action_drug_withdrawn','drug_action_dose_reduced','drug_action_dose_increased','drug_action_dose_not_changed','drug_action_unknown'],
                'overRide' => [
                    'lkp_drug_action_id' => ['table_name' => 'lkp_drug_action' , 'search_field' => 'id' ,'return_field' => 'name'],
                    'drug_role'=> ['table_name' => 'lkp_drug_role','search_field' => 'id', 'return_field' => 'name'],
                    'duration_of_use_unit' => ['table_name' => 'lkp_time_unit','search_field' => 'id' , 'return_field' => 'name']
                ]

            ]
        ];
    }
}
