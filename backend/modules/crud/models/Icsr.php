<?php

namespace backend\modules\crud\models;

use backend\modules\crud\overrides\TrailChild\AuditTrailChild;
use bedezign\yii2\audit\models\AuditTrail;
use Yii;
use \backend\modules\crud\models\base\Icsr as BaseIcsr;
use \backend\modules\crud\traits;
use yii\behaviors\TimestampBehavior;

use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "icsr".
 */
class Icsr extends BaseIcsr
{
    use traits\checkAccess,traits\checkSignal;


    public function attributeLabels()
    {
        return array_merge(
            parent::attributeHints(),
        [
            'safetyReportId' => Yii::t('app', 'Safety Report ID')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'id' => Yii::t('app', 'A.1.0.1 Sender’s (case) safety report unique identifier safetyreport>   safetyreportid'),
            'drug_id' => Yii::t('app', 'Drug Id'),
            'patient_identifier' => Yii::t('app', 'B.1.1 Patient (name or initials)'),
            'patient_age' => Yii::t('app', 'B.1.2.2a Age at time of onset of reaction or event'),
            'patient_age_unit' => Yii::t('app', 'B.1.2.2b Age at time of onset of reaction / event unit'),
            'patient_birth_date' => Yii::t('app', 'B.1.2.1 Date of birth'),
            'patient_weight' => Yii::t('app', 'B.1.3 Weight '),
            'patient_weight_unit' => Yii::t('app', 'B.1.3b Weight  Unit'),
            'extra_history' => Yii::t('app', 'B.1.7.2 Text for relevant medical history and concurrent conditions (not including reaction/event)'),
            ]);
    }


    public function behaviors()
    {
        return [
            'AuditTrailBehavior' => [
                'class' => 'backend\modules\crud\overrides\TrailChild\AuditTrailBehaviorChild',
                'ignored' => ['id','icsr_id'],
                'overRide' => ['patient_age_unit' => ['table_name' => 'lkp_age_unit' , 'search_field' => 'id' ,'return_field' => 'name'],
                    'patient_weight_unit'=> ['table_name' => 'lkp_weight_unit','search_field' => 'id', 'return_field' => 'name'],
                    'reaction_country_id'=> ['table_name' => 'lkp_icsr_eventoutcome' , 'search_field' => 'id', 'return_field' => 'name'],
                    'report_type' => ['table_name' => 'lkp_icsr_type','search_field' => 'id' , 'return_field' => 'description']
                ],

            ],

            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],

        ];
    }
    public function getIcsrTrails()
    {
        return AuditTrailChild::find()->select('user_id,model_id,model,entry_id,created,action,GROUP_CONCAT(field) as field,
                                                GROUP_CONCAT(`old_value`) as old_value,
                                                 GROUP_CONCAT(`new_value`) as new_value')
            ->orOnCondition([
                'audit_trail.model_id' => $this->id,
                'audit_trail.model' => get_class($this),
            ])->orOnCondition([
                'audit_trail.model_id' => ArrayHelper::map($this->getIcsrReporters()->all(),'id','id'),
                'audit_trail.model' => \backend\modules\crud\models\IcsrReporter::className(),
            ])->orOnCondition([
                'audit_trail.model_id' =>$this->eventsToTrailJsonConverter(),
                'audit_trail.model' => \backend\modules\crud\models\IcsrEvent::className(),
            ]) ->orOnCondition([
                'audit_trail.model_id' => ArrayHelper::map($this->getDrugPrescriptions()->all(),'id','id'),
                'audit_trail.model' => \backend\modules\crud\models\DrugPrescription::className(),
            ])->orOnCondition([
                'audit_trail.model_id' => ArrayHelper::map($this->getIcsrTests()->all(),'id','id'),
                'audit_trail.model' => \backend\modules\crud\models\IcsrTest::className(),
            ])->orOnCondition([
                'audit_trail.model_id' => ArrayHelper::map($this->getNarrative()->all(),'id','id'),
                'audit_trail.model' => \backend\modules\crud\models\IcsrNarritive::className(),
            ])->groupBy('model , action , created')
            ->orderBy(['created' =>  SORT_DESC]);

    }




   public function eventsToTrailJsonConverter ()
    {
        $temp_arr = [];
        foreach ($this->getIcsrEvents()->all() as $key => $value)
        {
            $temp_arr[] = "{\"id\":$value->id,\"icsr_id\":\"$this->id\"}";


        }
        return $temp_arr;
    }


    public function  isIcsrExported($icsr_id)
    {
        return  AuditTrail::findOne(['model_id' => $icsr_id , 'action' => 'EXPORT' ]);
    }


    public function getVersion()
    {
        return count($this->icsrVersions)+1;
    }


    public function canExported ()
    {
        if (count($this->drugPrescriptions) < 1 || count($this->icsrEvents) <1 ||
            count($this->icsrReporters) <1)
        {
            return 0;
        }

        return 1;
    }


    public function getMeddraLltFromEvents ()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("select group_concat(meddra_llt_text SEPARATOR '|') as llt from icsr_event where icsr_id={$this->id};");
        $result = $command->queryAll();
        return $result;
    }






}
