<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;

/**
 * This is the base-model class for table "icsr_reporter".
 *
 * @property integer $id
 * @property integer $icsr_id
 * @property integer $country_lkp_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $phone
 * @property string $email
 * @property integer $occupation_lkp_id
 * @property string $health_professional
 *
 * @property \backend\modules\crud\models\LkpCountry $countryLkp
 * @property \backend\modules\crud\models\Icsr $icsr
 * @property \backend\modules\crud\models\LkpOccupation $occupationLkp
 * @property string $aliasModel
 */
abstract class IcsrReporter extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const HEALTH_PROFESSIONAL_YES = 'yes';
    const HEALTH_PROFESSIONAL_NO = 'no';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'icsr_reporter';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'IcsrReporters');
        }else{
            return Yii::t('app', 'IcsrReporter');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'icsr_id', 'country_lkp_id', 'occupation_lkp_id'], 'required'],
            [['id', 'icsr_id', 'country_lkp_id', 'occupation_lkp_id'], 'integer'],
            [['health_professional'], 'string'],
            [['first_name', 'last_name', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'email'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 20],
            [['country_lkp_id'], 'exist', 'skipOnError' => true, 'targetClass' => LkpCountry::className(), 'targetAttribute' => ['country_lkp_id' => 'id']],
            [['icsr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Icsr::className(), 'targetAttribute' => ['icsr_id' => 'id']],
            [['occupation_lkp_id'], 'exist', 'skipOnError' => true, 'targetClass' => LkpOccupation::className(), 'targetAttribute' => ['occupation_lkp_id' => 'id']],
            ['health_professional', 'in', 'range' => [
                    self::HEALTH_PROFESSIONAL_YES,
                    self::HEALTH_PROFESSIONAL_NO,
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
            'icsr_id' => Yii::t('app', 'Icsr '),
            'country_lkp_id' => Yii::t('app', 'Country '),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'address_line_1' => Yii::t('app', 'Address Line 1'),
            'address_line_2' => Yii::t('app', 'Address Line 2'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'occupation_lkp_id' => Yii::t('app', 'Occupation '),
            'health_professional' => Yii::t('app', 'Health Professional'),
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
            'icsr_id' => Yii::t('app', 'Icsr Id'),
            'country_lkp_id' => Yii::t('app', 'Country Lkp Id'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'address_line_1' => Yii::t('app', 'Address Line 1'),
            'address_line_2' => Yii::t('app', 'Address Line 2'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'occupation_lkp_id' => Yii::t('app', 'Occupation Lkp Id'),
            'health_professional' => Yii::t('app', 'Health Professional'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryLkp()
    {
        return $this->hasOne(\backend\modules\crud\models\LkpCountry::className(), ['id' => 'country_lkp_id']);
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
    public function getOccupationLkp()
    {
        return $this->hasOne(\backend\modules\crud\models\LkpOccupation::className(), ['id' => 'occupation_lkp_id']);
    }


    
    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\query\IcsrReporterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\crud\models\query\IcsrReporterQuery(get_called_class());
    }


    /**
     * get column health_professional enum value label
     * @param string $value
     * @return string
     */
    public static function getHealthProfessionalValueLabel($value){
        $labels = self::optsHealthProfessional();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column health_professional ENUM value labels
     * @return array
     */
    public static function optsHealthProfessional()
    {
        return [
            self::HEALTH_PROFESSIONAL_YES => Yii::t('app', self::HEALTH_PROFESSIONAL_YES),
            self::HEALTH_PROFESSIONAL_NO => Yii::t('app', self::HEALTH_PROFESSIONAL_NO),
        ];
    }

    public function getCompany() {
        return $this->icsr->company;
    }
}
