<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\Icsr as BaseIcsr;
use \backend\modules\crud\traits;
/**
 * This is the model class for table "icsr".
 */
class Icsr extends BaseIcsr
{
    use traits\checkAccess;
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'id' => Yii::t('app', 'A.1.0.1 Sender’s (case) safety report unique identifier safetyreport>   safetyreportid'),
            'drug_id' => Yii::t('app', 'Drug Id'),
                
    
            'patient_identifier' => Yii::t('app', 'B.1.1 Patient (name or initials)'),
            'patient_age' => Yii::t('app', 'B.1.2.2a Age at time of onset of reaction or event'),
            'patient_age_unit' => Yii::t('app', 'B.1.2.2b Age at time of onset of reaction / event unit'),
            'patient_birth_date' => Yii::t('app', 'B.1.2.1 Date of birth'),
            'patient_weight' => Yii::t('app', 'B.1.3 Weight '),
            'patient_weight_unit' => Yii::t('app', 'B.1.3b Weight  Unit'),
            'extra_history' => Yii::t('app', 'B.1.7.2 Text for relevant medical history and concurrent conditions (not including reaction/event)'),
            ]);
    }
}
