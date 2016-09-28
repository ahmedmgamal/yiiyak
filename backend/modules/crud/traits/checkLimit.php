<?php
namespace backend\modules\crud\traits;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

trait checkLimit {

    // you must define getCompany method before using the trait
    // you must define get{modelName} as pluralized before using the trait
    public function isBeyondLimit ()
    {
        $limitName = strtoLower(StringHelper::basename(get_class($this)));

        $limitAmount = $this->company->plan->getOneLimitAmount($limitName);

        $limitNamePluralized = Inflector::pluralize($limitName);

        if (count($this->company->$limitNamePluralized) > $limitAmount)
        {

            return 1;
        }

        return 0;
    }
}