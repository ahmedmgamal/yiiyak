<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\LkpPlan as BaseLkpPlan;

/**
 * This is the model class for table "lkp_plan".
 */
class LkpPlan extends BaseLkpPlan
{

    public function getAllLimitsWithAmount ()
    {
        $query = new \yii\db\Query();

        return $query->select([ '`lkp_limits`.`name`' , '`plan_limits`.`limit`'])
              ->from('lkp_plan')
              ->leftJoin('plan_limits','lkp_plan.id = plan_limits.plan_id')
              ->leftJoin('lkp_limits','lkp_limits.id = plan_limits.limit_id')
              ->where(['lkp_plan.id' => $this->id])
              ->all();



    }
}
