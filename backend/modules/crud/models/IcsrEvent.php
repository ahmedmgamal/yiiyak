<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\IcsrEvent as BaseIcsrEvent;

/**
 * This is the model class for table "icsr_event".
 */
class IcsrEvent extends BaseIcsrEvent
{    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'id' => Yii::t('app', 'ID'),
            'icsr_id' => Yii::t('app', 'Icsr Id'),
            'event_description' => Yii::t('app', 'B.2.i.0 Reaction or event as reported by the primary source'),
            'meddra_llt_id' => Yii::t('app', '    B.2.i.1 Reaction or event in MedDRA terminology (Lowest Level Term)'),
            'meddra_pt_id' => Yii::t('app', '    B.2.i.2 Reaction or event in MedDRA terminology (Preferred Term)'),
            'event_date' => Yii::t('app', '    B.2.i.4 Date of start of reaction or event'),
            'event_end_date' => Yii::t('app', 'B.2.i.5 Date of end of reaction or event'),
            'event_type' => Yii::t('app', 'B.2.i.8 Outcome of reaction or event at the time of last observation (Recovered/resolved,Recovering/resolving,Not recovered/not resolved,Recovered/resolved with sequelae,Fatal,Unknown'),

                
            ]);
    }
    
    
    public function attributeLabels()
    {
         return array_merge(
            parent::attributeLabels(),
        [
            'event_type' => Yii::t('app', 'Event Outcome'),

        ]);
    }
}
