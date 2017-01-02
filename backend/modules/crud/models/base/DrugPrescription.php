<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;

/**
 * This is the base-model class for table "drug_prescription".
 *
 * @property integer $id
 * @property integer $drug_id
 * @property integer $icsr_id
 * @property string $dose
 * @property integer $frequency_lkp_id
 * @property string $expiration_date
 * @property string $lot_no
 * @property string $use_date_start
 * @property string $use_date_end
 * @property string $duration_of_use
 * @property string $duration_of_use_unit
 * @property string $reason_of_use
 * @property string $problem_returned_after_reuse
 * @property string $active_substance_names
 * @property string $drug_role
 * @property string $drug_addtional_info
 * @property boolean $drug_action_drug_withdrawn
 * @property boolean $drug_action_dose_reduced
 * @property boolean $drug_action_dose_increased
 * @property boolean $drug_action_dose_not_changed
 * @property boolean $drug_action_unknown
 *
 * @property \backend\modules\crud\models\Drug $drug
 * @property \backend\modules\crud\models\Icsr $icsr
 * @property \backend\modules\crud\models\LkpFrequency $frequencyLkp
 * @property \backend\modules\crud\models\LkpDrugRole $drugRole
 * @property string $aliasModel
 */
abstract class DrugPrescription extends \yii\db\ActiveRecord
{




    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'drug_prescription';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'DrugPrescriptions');
        }else{
            return Yii::t('app', 'DrugPrescription');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['drug_id', 'icsr_id', 'frequency_lkp_id','lkp_drug_action_id'], 'integer'],
            [['icsr_id'], 'required'],
            [['expiration_date', 'use_date_start', 'use_date_end'], 'safe'],
            [['duration_of_use'], 'number','max' => 99999],
            [['duration_of_use_unit', 'problem_returned_after_reuse', 'drug_role'], 'string'],
            [['drug_action_drug_withdrawn', 'drug_action_dose_reduced', 'drug_action_dose_increased', 'drug_action_dose_not_changed', 'drug_action_unknown'], 'boolean'],
            [[ 'lot_no'], 'string', 'max' => 35],
            [['reason_of_use'], 'string', 'max' => 250],
            [['active_substance_names', 'drug_addtional_info','dose'], 'string', 'max' => 100],
            [['drug_id'], 'exist', 'skipOnError' => true, 'targetClass' => Drug::className(), 'targetAttribute' => ['drug_id' => 'id']],
            [['icsr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Icsr::className(), 'targetAttribute' => ['icsr_id' => 'id']],
            [['frequency_lkp_id'], 'exist', 'skipOnError' => true, 'targetClass' => LkpFrequency::className(), 'targetAttribute' => ['frequency_lkp_id' => 'id']],
            [['drug_role'], 'exist', 'skipOnError' => true, 'targetClass' =>  \backend\modules\crud\models\LkpDrugRole::className(), 'targetAttribute' => ['drug_role' => 'id']],
            
         
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'drug_id' => Yii::t('app', 'Drug '),
            'icsr_id' => Yii::t('app', 'Icsr '),
            'dose' => Yii::t('app', 'Dose'),
            'frequency_lkp_id' => Yii::t('app', 'Frequency '),
            'expiration_date' => Yii::t('app', 'Expiration Date'),
            'lot_no' => Yii::t('app', 'Lot No'),
            'use_date_start' => Yii::t('app', 'Use Date Start'),
            'use_date_end' => Yii::t('app', 'Use Date End'),
            'duration_of_use' => Yii::t('app', 'Duration Of Use'),
            'duration_of_use_unit' => Yii::t('app', 'Duration Of Use Unit'),
            'reason_of_use' => Yii::t('app', 'Reason Of Use'),
            'problem_returned_after_reuse' => Yii::t('app', 'Problem Returned After Reuse'),
            'active_substance_names' => Yii::t('app', 'Active Substance Names'),
            'drug_role' => Yii::t('app', 'Drug Role'),
            'drug_addtional_info' => Yii::t('app', 'Drug Addtional Info'),
            'drug_action_drug_withdrawn' => Yii::t('app', 'Drug Action Drug Withdrawn'),
            'drug_action_dose_reduced' => Yii::t('app', 'Drug Action Dose Reduced'),
            'drug_action_dose_increased' => Yii::t('app', 'Drug Action Dose Increased'),
            'drug_action_dose_not_changed' => Yii::t('app', 'Drug Action Dose Not Changed'),
            'drug_action_unknown' => Yii::t('app', 'Drug Action Unknown'),
            'lkp_drug_action_id' => Yii::t('app','Drug Action'),
        ];
    }

    /**
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
            'dose' => Yii::t('app', '	B.4.k.6 Dosage text (e.g., 2 mg three times a day for five days)'),
            'frequency_lkp_id' => Yii::t('app', 'Frequency Lkp Id'),
            'expiration_date' => Yii::t('app', 'Expiration Date'),
            'lot_no' => Yii::t('app', '	B.4.k.3 Batch/lot number'),
            'use_date_start' => Yii::t('app', 'B.4.k.12 Date of start of drug'),
            'use_date_end' => Yii::t('app', '	B.4.k.14 Date of last administration'),
            'duration_of_use' => Yii::t('app', '	B.4.k.15 Duration of drug administration'),
            'duration_of_use_unit' => Yii::t('app', '	B.4.k.15 Duration of drug administration'),
            'reason_of_use' => Yii::t('app', '	B.4.k.11 Indication for use in the case'),
            'problem_returned_after_reuse' => Yii::t('app', '	B.4.k.17 Effect of rechallenge'),
            'active_substance_names' => Yii::t('app', 'B.4.k.2.2 Active substance name(s)'),
            'drug_role' => Yii::t('app', 'B.4.k.1 Characterization of drug role (Suspect/Concomitant/Interacting)'),
            'drug_addtional_info' => Yii::t('app', 'B.4.k.19 Additional information on drug'),
            'drug_action_drug_withdrawn' => Yii::t('app', 'B.4.k.16 Action(s) taken with drug'),
            'drug_action_dose_reduced' => Yii::t('app', 'B.4.k.16 Action(s) taken with drug'),
            'drug_action_dose_increased' => Yii::t('app', 'B.4.k.16 Action(s) taken with drug'),
            'drug_action_dose_not_changed' => Yii::t('app', 'B.4.k.16 Action(s) taken with drug'),
            'drug_action_unknown' => Yii::t('app', 'B.4.k.16 Action(s) taken with drug'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrug()
    {
        return $this->hasOne(\backend\modules\crud\models\Drug::className(), ['id' => 'drug_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsr()
    {
        return $this->hasOne(\backend\modules\crud\models\Icsr::className(), ['id' => 'icsr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrequencyLkp()
    {
        return $this->hasOne(\backend\modules\crud\models\LkpFrequency::className(), ['id' => 'frequency_lkp_id']);
    }
    public function getDrugRole()
        {
            return $this->hasOne(\backend\modules\crud\models\LkpDrugRole::className(), ['id' => 'drug_role']);
        }
    public function getDurationOfUseUnit()
        {
            return $this->hasOne(\backend\modules\crud\models\LkpTimeUnit::className(), ['id' => 'duration_of_use_unit']);
        }

    public function getLkpDrugAction()
    {
        return $this->hasOne(\backend\modules\crud\models\LkpDrugAction::className(),['id' => 'lkp_drug_action_id']);
    }

    public function getCompany() {
        return $this->icsr->company;
    }

}
