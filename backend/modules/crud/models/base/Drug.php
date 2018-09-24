<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;

/**
 * This is the base-model class for table "drug".
 *
 * @property integer $id
 * @property string $generic_name
 * @property string $trade_name
 * @property string $composition
 * @property integer $company_id
 * @property string $manufacturer
 * @property string $strength
 * @property integer $route_lkp_id
 * @property string $next_prsu_date
 *
 * @property \backend\modules\crud\models\Company $company
 * @property \backend\modules\crud\models\LkpRoute $routeLkp
 * @property \backend\modules\crud\models\DrugPrescription[] $drugPrescriptions
 * @property \backend\modules\crud\models\Icsr[] $icsrs
 * @property string $aliasModel
 */
abstract class Drug extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'drug';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'Products');
        }else{
            return Yii::t('app', 'Products');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'route_lkp_id'], 'required'],
            [['company_id', 'route_lkp_id'], 'integer'],
            [['next_pbrer_date','rmp_first_deadline'],'date','format' => 'php:Y-m-d'],
            ['rmp_first_deadline','compare','compareValue' => date('Y-m-d') ,'operator' => '>',
                'message' => '{attribute} Date must be in after today'],
            [['generic_name', 'trade_name', 'composition', 'manufacturer', 'strength'], 'string', 'max' => 45],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['route_lkp_id'], 'exist', 'skipOnError' => true, 'targetClass' => LkpRoute::className(), 'targetAttribute' => ['route_lkp_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'generic_name' => Yii::t('app', 'Generic Name'),
            'trade_name' => Yii::t('app', 'Trade Name'),
            'composition' => Yii::t('app', 'Dosage Form'),
            'company_id' => Yii::t('app', 'Company '),
            'manufacturer' => Yii::t('app', 'Manufacturer'),
            'strength' => Yii::t('app', 'Strength'),
            'route_lkp_id' => Yii::t('app', 'Route Of Administration'),
            'next_pbrer_date	' => Yii::t('app','Next Submission Date'),
            'rmp_first_deadline' => Yii::t('app','RMP First Deadline')
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
            'generic_name' => Yii::t('app', 'Generic Name'),
            'trade_name' => Yii::t('app', 'Trade Name'),
            'composition' => Yii::t('app', 'Composition'),
            'company_id' => Yii::t('app', 'Company Id'),
            'manufacturer' => Yii::t('app', 'Manufacturer'),
            'strength' => Yii::t('app', 'Strength'),
            'route_lkp_id' => Yii::t('app', 'Route Lkp Id'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(\backend\modules\crud\models\Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRouteLkp()
    {
        return $this->hasOne(\backend\modules\crud\models\LkpRoute::className(), ['id' => 'route_lkp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrugPrescriptions()
    {
        return $this->hasMany(\backend\modules\crud\models\DrugPrescription::className(), ['drug_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsrs()
    {
        return $this->hasMany(\backend\modules\crud\models\Icsr::className(), ['drug_id' => 'id']);
    }


    public function getRmps()
    {
        return $this->hasMany(\backend\modules\crud\models\Rmp::className(),['drug_id' => 'id']);
    }

    public function getPrsus()
    {
        return $this->hasMany(\backend\modules\crud\models\Prsu::className(),['drug_id' => 'id']);


    }

}
