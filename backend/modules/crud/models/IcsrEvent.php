<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\IcsrEvent as BaseIcsrEvent;
use \backend\modules\crud\traits;
/**
 * This is the model class for table "icsr_event".
 */
class IcsrEvent extends BaseIcsrEvent
{
    use traits\checkAccess;

    public function behaviors()
    {
        return [
            'AuditTrailBehavior' => [
                'class' => 'bedezign\yii2\audit\AuditTrailBehavior',
                'ignored' => ['id','icsr_id'],

            ]
        ];
    }
}
