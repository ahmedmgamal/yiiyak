<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\crud\models\base;

use Yii;

/**
 * This is the base-model class for table "icsr_event".
 *
 * @property integer $id
 * @property integer $icsr_id
 * @property string $event_description
 * @property integer $meddra_llt_id
 * @property integer $meddra_pt_id
 * @property string $event_date
 * @property string $event_end_date
 * @property string $event_outcome
 * @property string $meddra_llt_text
 * @property string $meddra_pt_text
 *
 * @property \backend\modules\crud\models\LkpMeddraLlt $meddraLlt
 * @property \backend\modules\crud\models\LkpMeddraPt $meddraPt
 * @property \backend\modules\crud\models\Icsr $icsr
 * @property string $aliasModel
 */
abstract class IcsrEvent extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const EVENT_OUTCOME_RECOVEREDRESOLVED = 'recovered/resolved';
    const EVENT_OUTCOME_RECOVERINGRESOLVING = 'recovering/resolving';
    const EVENT_OUTCOME_NOT_RECOVEREDNOT_RESOLVED = 'not recovered/not resolved';
    const EVENT_OUTCOME_RECOVEREDRESOLVED_WITH_SEQUELAE = 'recovered/resolved with sequelae';
    const EVENT_OUTCOME_FATAL = 'fatal';
    const EVENT_OUTCOME_UNKNOWN = 'unknown';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'icsr_event';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'IcsrEvents');
        }else{
            return Yii::t('app', 'IcsrEvent');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icsr_id','event_description','meddra_llt_text'], 'required'],
            [['icsr_id','lkp_icsr_eventoutcome_id', 'meddra_llt_id', 'meddra_pt_id'], 'integer'],
            [['event_date', 'event_end_date'], 'safe'],
            [['event_outcome'], 'string'],
            [['event_description'], 'string', 'max' => 512],
            [['meddra_llt_text', 'meddra_pt_text'], 'string', 'max' => 250],
             [['icsr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Icsr::className(), 'targetAttribute' => ['icsr_id' => 'id']],
            ['event_outcome', 'in', 'range' => [
                    self::EVENT_OUTCOME_RECOVEREDRESOLVED,
                    self::EVENT_OUTCOME_RECOVERINGRESOLVING,
                    self::EVENT_OUTCOME_NOT_RECOVEREDNOT_RESOLVED,
                    self::EVENT_OUTCOME_RECOVEREDRESOLVED_WITH_SEQUELAE,
                    self::EVENT_OUTCOME_FATAL,
                    self::EVENT_OUTCOME_UNKNOWN,
                ]
            ],
            ['event_date','compare','compareValue' => date('Y-m-d') ,'operator' => '<',
            'message' => 'Event Start Date must be in before today'],
            ['event_date','compare','compareAttribute' => 'event_end_date' ,'operator' => '<', 'enableClientValidation' => false]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'icsr_id' => Yii::t('app', 'Icsr '),
            'event_description' => Yii::t('app', 'Event Description'),
              'event_date' => Yii::t('app', 'Event Date'),
            'event_end_date' => Yii::t('app', 'Event End Date'),
            'event_outcome' => Yii::t('app', 'Event Outcome'),
            'meddra_llt_text' => Yii::t('app', 'Meddra Llt '),
            'meddra_pt_text' => Yii::t('app', 'Meddra Pt '),
            'lkp_icsr_eventoutcome_id' => Yii::t('app', 'Event OutCome'),
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
            'id' => Yii::t('app', 'ID'),
            'icsr_id' => Yii::t('app', 'Icsr '),
            'event_description' => Yii::t('app', '    B.2.i.0 Reaction or event as reported by the primary source
'),
                'event_date' => Yii::t('app', 'B.2.i.4 Date of start of reaction or event'),
            'event_end_date' => Yii::t('app', 'B.2.i.5 Date of end of reaction or event'),
            'event_outcome' => Yii::t('app', 'B.2.i.8 Outcome of reaction or event at the time of last observation'),
            'meddra_llt_text' => Yii::t('app', 'B.2.i.1 Reaction or event in MedDRA terminology (Lowest Level Term)'),
            'meddra_pt_text' => Yii::t('app', 'B.2.i.2 Reaction or event in MedDRA terminology (Preferred Term)'),
             'lkp_icsr_eventoutcome_id'  => Yii::t('app', 'B.2.i.8 Outcome of reaction or event at the time of last observation'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeddraLlt()
    {
        return $this->hasOne(\backend\modules\crud\models\MeddraLlt::className(), ['id' => 'meddra_llt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeddraPt()
    {
        return $this->hasOne(\backend\modules\crud\models\LkpMeddraPt::className(), ['id' => 'meddra_pt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcsr()
    {
        return $this->hasOne(\backend\modules\crud\models\Icsr::className(), ['id' => 'icsr_id']);
    }


    public function getLkpIcsrEventoutcome()
    {
        return $this->hasOne(\backend\modules\crud\models\LkpIcsrEventoutcome::className(),['id' => 'lkp_icsr_eventoutcome_id']);
    }


    /**
     * get column event_outcome enum value label
     * @param string $value
     * @return string
     */
    public static function getEventOutcomeValueLabel($value){
        $labels = self::optsEventOutcome();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column event_outcome ENUM value labels
     * @return array
     */
    public static function optsEventOutcome()
    {
        return [
            self::EVENT_OUTCOME_RECOVEREDRESOLVED => Yii::t('app', self::EVENT_OUTCOME_RECOVEREDRESOLVED),
            self::EVENT_OUTCOME_RECOVERINGRESOLVING => Yii::t('app', self::EVENT_OUTCOME_RECOVERINGRESOLVING),
            self::EVENT_OUTCOME_NOT_RECOVEREDNOT_RESOLVED => Yii::t('app', self::EVENT_OUTCOME_NOT_RECOVEREDNOT_RESOLVED),
            self::EVENT_OUTCOME_RECOVEREDRESOLVED_WITH_SEQUELAE => Yii::t('app', self::EVENT_OUTCOME_RECOVEREDRESOLVED_WITH_SEQUELAE),
            self::EVENT_OUTCOME_FATAL => Yii::t('app', self::EVENT_OUTCOME_FATAL),
            self::EVENT_OUTCOME_UNKNOWN => Yii::t('app', self::EVENT_OUTCOME_UNKNOWN),
        ];
    }

    public function getCompany() {
        return $this->icsr->company;
    }



}
