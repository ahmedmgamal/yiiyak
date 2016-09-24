<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;
use yii\db\Query;

/**
 * This is the base-model class for table "lkp_plan".
 *
 * @property integer $id
 * @property string $name
 * @property string $aliasModel
 */
abstract class LkpPlan extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lkp_plan';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getCompanies ()
    {
        return $this->hasMany(\backend\modules\crud\models\Company::className(),['plan_id' => 'id']);
    }

    public function getLimits ()
    {
        return $this->hasMany(\backend\modules\crud\models\LkpLimits::className(),['id' => 'limit_id'])->viaTable('plan_limits',['plan_id' => 'id']);
    }

    public function getOneLimitAmount($limitName)
    {
       $limitObj = \backend\modules\crud\models\LkpLimits::findOne(['name' => $limitName]);

       $limitAmount = \backend\modules\crud\models\PlanLimits::findOne(['limit_id' => $limitObj->id  , 'plan_id' => $this->id]);

        return isset($limitAmount->limit) ? $limitAmount->limit : '';
    }



    public function saveLimits ($limitsArray)
    {

        foreach ($limitsArray as $limitId => $value)
        {
            $planLimitObj = new \backend\modules\crud\models\PlanLimits ;

            $planLimitObj->plan_id = $this->id;

            $planLimitObj->limit_id = $limitId;
             $planLimitObj->limit = $value;

              $similarObj = $planLimitObj->getSimilar();

                   if ($similarObj) {

                      (isset($value) && !empty($value)) ?  $similarObj->limit = $value : $similarObj->limit = 0;

                       $similarObj->update();
                   }

                   else
                   {
                       $planLimitObj->save();
                   }


        }
        return 1;
    }


}
