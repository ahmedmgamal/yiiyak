<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;

/**
 * This is the base-model class for table "icsr_test".
 *
 * @property integer $id
 * @property integer $icsr_id
 * @property integer $test_lkp_id
 * @property string $date
 * @property string $result
 * @property string $result_unit
 * @property string $normal_low_range
 * @property string $normal_high_range
 * @property string $more_info
 *
 * @property \backend\modules\crud\models\Icsr $icsr
 * @property \backend\modules\crud\models\LkpTest $testLkp
 * @property string $aliasModel
 */
abstract class IcsrTest extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'icsr_test';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'IcsrTests');
        }else{
            return Yii::t('app', 'IcsrTest');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'icsr_id', 'test_name'], 'required'],
            [['id', 'icsr_id'], 'integer'],
            [['date'], 'safe'],
            [['result'], 'string', 'max' => 512],
            [['result_unit', 'normal_low_range', 'normal_high_range', 'more_info','test_name'], 'string', 'max' => 45],
            [['icsr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Icsr::className(), 'targetAttribute' => ['icsr_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'icsr_id' => Yii::t('app', 'Icsr ID'),
            'test_name' => Yii::t('app', 'Test Name'),
            'date' => Yii::t('app', 'Date'),
            'result' => Yii::t('app', 'Result'),
            'result_unit' => Yii::t('app', 'Result Unit'),
            'normal_low_range' => Yii::t('app', 'Normal Low Range'),
            'normal_high_range' => Yii::t('app', 'Normal High Range'),
            'more_info' => Yii::t('app', 'More Info'),
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
            'test_name' => Yii::t('app', 'Test Name'),
            'date' => Yii::t('app', 'Date'),
            'result' => Yii::t('app', 'Result'),
            'result_unit' => Yii::t('app', 'Result Unit'),
            'normal_low_range' => Yii::t('app', 'Normal Low Range'),
            'normal_high_range' => Yii::t('app', 'Normal High Range'),
            'more_info' => Yii::t('app', 'More Info'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsr()
    {
        return $this->hasOne(\backend\modules\crud\models\Icsr::className(), ['id' => 'icsr_id']);
    }



    
    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\query\IcsrTestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\crud\models\query\IcsrTestQuery(get_called_class());
    }

    public function getCompany() {
        return $this->icsr->company;
    }

}
