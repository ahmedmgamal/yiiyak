<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\IcsrNarritive as BaseIcsrNarritive;

/**
 * This is the model class for table "icsr_narritive".
 */
class IcsrNarritive extends BaseIcsrNarritive
{

    public function behaviors()
    {
        return [
            'AuditTrailBehavior' => [
                'class' =>  'backend\modules\crud\overrides\TrailChild\AuditTrailBehaviorChild',
                'ignored' => ['id','icsr_id'],
            ]
            ];
    }
}
