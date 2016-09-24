<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\PlanLimits as BasePlanLimits;

/**
 * This is the model class for table "plan_limits".
 */
class PlanLimits extends BasePlanLimits
{
    public function getSimilar ()
    {

        return PlanLimits::findOne(['plan_id' => $this->plan_id , 'limit_id' => $this->limit_id]);
    }
}
