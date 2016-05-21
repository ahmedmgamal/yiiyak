<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\DrugPrescription as BaseDrugPrescription;

/**
 * This is the model class for table "drug_prescription".
 */
class DrugPrescription extends BaseDrugPrescription
{
    
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
            'drug_id' => Yii::t('app', 'Drug Id'),
            'icsr_id' => Yii::t('app', 'Icsr Id'),
            'frequency_lkp_id' => Yii::t('app', 'Frequency Lkp Id'),
            'expiration_date' => Yii::t('app', 'Expiration Date'),
            'lot_no' => Yii::t('app', 'B.4.k.3 Batch/lot number'),
            'ndc' => Yii::t('app', '	B.4.k.19 Additional information on drug'),
            'use_date_start' => Yii::t('app', 'B.4.k.12 Date of start of drug'),
            'use_date_end' => Yii::t('app', 'B.4.k.14 Date of last administration'),
            'duration_of_use' => Yii::t('app', 'B.4.k.15a Duration of drug administration'),
            'duration_of_use_unit' => Yii::t('app', 'B.4.k.15b Duration of drug administration (unit)'),
            'reason_of_use' => Yii::t('app', 'B.4.k.11 Indication for use in the case'),
            'problem_went_after_stop' => Yii::t('app', 'Problem Went After Stop'),
            'problem_returned_after_reuse' => Yii::t('app', 'B.4.k.17 Effect of rechallenge (or re-exposure), for suspect drug(s) only'),
            'product_avilable' => Yii::t('app', 'Product Avilable'),
            ]);
    }
}
