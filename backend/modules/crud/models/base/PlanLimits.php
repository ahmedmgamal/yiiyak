<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;

/**
 * This is the base-model class for table "plan_limits".
 *
 * @property integer $id
 * @property integer $plan_id
 * @property integer $limit_id
 * @property integer $limit
 * @property string $aliasModel
 */
abstract class PlanLimits extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan_limits';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_id', 'limit_id', 'limit'], 'required'],
            [['plan_id', 'limit_id', 'limit'], 'integer'],
            [['limit_id'], 'exist', 'skipOnError' => true, 'targetClass' => LkpLimits::className(), 'targetAttribute' => ['limit_id' => 'id']],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => LkpPlan::className(), 'targetAttribute' => ['plan_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_id' => 'Plan ID',
            'limit_id' => 'Limit ID',
            'limit' => 'Limit',
        ];
    }



}