<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;

/**
 * This is the base-model class for table "migration".
 *
 * @property string $version
 * @property integer $apply_time
 * @property string $aliasModel
 */
abstract class Migration extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'migration';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'Migrations');
        }else{
            return Yii::t('app', 'Migration');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['version'], 'required'],
            [['apply_time'], 'integer'],
            [['version'], 'string', 'max' => 180]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'version' => Yii::t('app', 'Version'),
            'apply_time' => Yii::t('app', 'Apply Time'),
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
            'version' => Yii::t('app', 'Version'),
            'apply_time' => Yii::t('app', 'Apply Time'),
            ]);
    }


    
    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\query\MigrationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\crud\models\query\MigrationQuery(get_called_class());
    }


}
