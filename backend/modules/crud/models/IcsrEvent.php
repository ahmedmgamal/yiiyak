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
    use traits\checkAccess,traits\checkSignal,traits\checkIcsrNullExported;
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'event_date' => Yii::t('app', 'Event Start Date'),
        ]);
    }

    public function behaviors()
    {
        return [
            'AuditTrailBehavior' => [
                'class' => 'backend\modules\crud\overrides\TrailChild\AuditTrailBehaviorChild',
                'ignored' => ['id','icsr_id'],
                'overRide' => ['meddra_llt_id' => ['table_name' => 'lkp_meddra_llt' , 'search_field' => 'id' ,'return_field' => 'description'],
                    'meddra_pt_id'=> ['table_name' => 'lkp_meddra_pt','search_field' => 'id', 'return_field' => 'description'],
                    'lkp_icsr_eventoutcome_id'=> ['table_name' => 'lkp_icsr_eventoutcome' , 'search_field' => 'id', 'return_field' => 'name']
                ]

            ]];
    }



}
