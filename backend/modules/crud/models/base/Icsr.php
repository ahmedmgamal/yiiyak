<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;

/**
 * This is the base-model class for table "icsr".
 *
 * @property integer $id
 * @property integer $drug_id
 * @property string $patient_identifier
 * @property string $patient_age
 * @property string $patient_age_unit
 * @property string $patient_birth_date
 * @property string $patient_weight
 * @property string $patient_weight_unit
 * @property string $extra_history
 *
 * @property \backend\modules\crud\models\DrugPrescription[] $drugPrescriptions
 * @property \backend\modules\crud\models\Drug $drug
 * @property \backend\modules\crud\models\IcsrConcomitantDrug[] $icsrConcomitantDrugs
 * @property \backend\modules\crud\models\IcsrEvent[] $icsrEvents
 * @property \backend\modules\crud\models\IcsrOutcome[] $icsrOutcomes
 * @property \backend\modules\crud\models\LkpIcsrOutcome[] $icsrOutcomeLkps
 * @property \backend\modules\crud\models\IcsrReporter[] $icsrReporters
 * @property \backend\modules\crud\models\IcsrTest[] $icsrTests
 * @property \backend\modules\crud\models\IcsrType[] $icsrTypes
 * @property \backend\modules\crud\models\LkpIcsrType[] $icsrTypeLkps
 * @property string $aliasModel
 */
abstract class Icsr extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const PATIENT_AGE_UNIT_DAY = 'day';
    const PATIENT_AGE_UNIT_WEEK = 'week';
    const PATIENT_AGE_UNIT_MONTH = 'month';
    const PATIENT_AGE_UNIT_YEAR = 'year';
    const PATIENT_WEIGHT_UNIT_LBS = 'lbs';
    const PATIENT_WEIGHT_UNIT_KGS = 'kgs';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'icsr';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'Icsrs');
        }else{
            return Yii::t('app', 'Icsr');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'drug_id'], 'required'],
            [['id', 'drug_id'], 'integer'],
            [['patient_age', 'patient_weight'], 'number'],
            [['patient_age_unit', 'patient_weight_unit'], 'string'],
            [['patient_birth_date'], 'safe'],
            [['patient_identifier', 'extra_history'], 'string', 'max' => 45],
            [['drug_id'], 'exist', 'skipOnError' => true, 'targetClass' => Drug::className(), 'targetAttribute' => ['drug_id' => 'id']],
            ['patient_age_unit', 'in', 'range' => [
                    self::PATIENT_AGE_UNIT_DAY,
                    self::PATIENT_AGE_UNIT_WEEK,
                    self::PATIENT_AGE_UNIT_MONTH,
                    self::PATIENT_AGE_UNIT_YEAR,
                ]
            ],
            ['patient_weight_unit', 'in', 'range' => [
                    self::PATIENT_WEIGHT_UNIT_LBS,
                    self::PATIENT_WEIGHT_UNIT_KGS,
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'drug_id' => Yii::t('app', 'Drug ID'),
            'patient_identifier' => Yii::t('app', 'Patient Identifier'),
            'patient_age' => Yii::t('app', 'Patient Age'),
            'patient_age_unit' => Yii::t('app', 'Patient Age Unit'),
            'patient_birth_date' => Yii::t('app', 'Patient Birth Date'),
            'patient_weight' => Yii::t('app', 'Patient Weight'),
            'patient_weight_unit' => Yii::t('app', 'Patient Weight Unit'),
            'extra_history' => Yii::t('app', 'Extra History'),
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
            'patient_identifier' => Yii::t('app', 'Patient Identifier'),
            'patient_age' => Yii::t('app', 'Patient Age'),
            'patient_age_unit' => Yii::t('app', 'Patient Age Unit'),
            'patient_birth_date' => Yii::t('app', 'Patient Birth Date'),
            'patient_weight' => Yii::t('app', 'Patient Weight'),
            'patient_weight_unit' => Yii::t('app', 'Patient Weight Unit'),
            'extra_history' => Yii::t('app', 'Extra History'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrugPrescriptions()
    {
        return $this->hasMany(\backend\modules\crud\models\DrugPrescription::className(), ['icsr_id' => 'id']);
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
    public function getIcsrConcomitantDrugs()
    {
        return $this->hasMany(\backend\modules\crud\models\IcsrConcomitantDrug::className(), ['icsr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsrEvents()
    {
        return $this->hasMany(\backend\modules\crud\models\IcsrEvent::className(), ['icsr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsrOutcomes()
    {
        return $this->hasMany(\backend\modules\crud\models\IcsrOutcome::className(), ['icsr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsrOutcomeLkps()
    {
        return $this->hasMany(\backend\modules\crud\models\LkpIcsrOutcome::className(), ['id' => 'icsr_outcome_lkp_id'])->viaTable('icsr_outcome', ['icsr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsrReporters()
    {
        return $this->hasMany(\backend\modules\crud\models\IcsrReporter::className(), ['icsr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsrTests()
    {
        return $this->hasMany(\backend\modules\crud\models\IcsrTest::className(), ['icsr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsrTypes()
    {
        return $this->hasMany(\backend\modules\crud\models\IcsrType::className(), ['icsr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsrTypeLkps()
    {
        return $this->hasMany(\backend\modules\crud\models\LkpIcsrType::className(), ['id' => 'icsr_type_lkp_id'])->viaTable('icsr_type', ['icsr_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\query\IcsrQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\crud\models\query\IcsrQuery(get_called_class());
    }


    /**
     * get column patient_age_unit enum value label
     * @param string $value
     * @return string
     */
    public static function getPatientAgeUnitValueLabel($value){
        $labels = self::optsPatientAgeUnit();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column patient_age_unit ENUM value labels
     * @return array
     */
    public static function optsPatientAgeUnit()
    {
        return [
            self::PATIENT_AGE_UNIT_DAY => Yii::t('app', self::PATIENT_AGE_UNIT_DAY),
            self::PATIENT_AGE_UNIT_WEEK => Yii::t('app', self::PATIENT_AGE_UNIT_WEEK),
            self::PATIENT_AGE_UNIT_MONTH => Yii::t('app', self::PATIENT_AGE_UNIT_MONTH),
            self::PATIENT_AGE_UNIT_YEAR => Yii::t('app', self::PATIENT_AGE_UNIT_YEAR),
        ];
    }

    /**
     * get column patient_weight_unit enum value label
     * @param string $value
     * @return string
     */
    public static function getPatientWeightUnitValueLabel($value){
        $labels = self::optsPatientWeightUnit();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column patient_weight_unit ENUM value labels
     * @return array
     */
    public static function optsPatientWeightUnit()
    {
        return [
            self::PATIENT_WEIGHT_UNIT_LBS => Yii::t('app', self::PATIENT_WEIGHT_UNIT_LBS),
            self::PATIENT_WEIGHT_UNIT_KGS => Yii::t('app', self::PATIENT_WEIGHT_UNIT_KGS),
        ];
    }

}
