<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;

/**
 * This is the base-model class for table "icsr_type".
 *
 * @property integer $icsr_id
 * @property integer $icsr_type_lkp_id
 *
 * @property \backend\modules\crud\models\Icsr $icsr
 * @property \backend\modules\crud\models\LkpIcsrType $icsrTypeLkp
 * @property string $aliasModel
 */
abstract class IcsrType extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'icsr_type';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'IcsrTypes');
        }else{
            return Yii::t('app', 'IcsrType');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icsr_id', 'icsr_type_lkp_id'], 'required'],
            [['icsr_id', 'icsr_type_lkp_id'], 'integer'],
            [['icsr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Icsr::className(), 'targetAttribute' => ['icsr_id' => 'id']],
            [['icsr_type_lkp_id'], 'exist', 'skipOnError' => true, 'targetClass' => LkpIcsrType::className(), 'targetAttribute' => ['icsr_type_lkp_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'icsr_id' => Yii::t('app', 'Icsr ID'),
            'icsr_type_lkp_id' => Yii::t('app', 'Icsr Type Lkp ID'),
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
            'icsr_id' => Yii::t('app', 'Icsr Id'),
            'icsr_type_lkp_id' => Yii::t('app', 'Icsr Type Lkp Id'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getIcsrTypeLkp()
    {
        return $this->hasOne(\backend\modules\crud\models\LkpIcsrType::className(), ['id' => 'icsr_type_lkp_id']);
    }


    
    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\query\IcsrTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\crud\models\query\IcsrTypeQuery(get_called_class());
    }


}
