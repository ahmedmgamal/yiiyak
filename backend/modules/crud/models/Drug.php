<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\Drug as BaseDrug;
use \backend\modules\crud\traits;
use bedezign\yii2\audit\models\AuditTrail;
/**
 * This is the model class for table "drug".
 */
class Drug extends BaseDrug
{
    use traits\checkAccess;
    use traits\checkLimit,traits\checkSignal;

    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'id' => Yii::t('app', 'ID'),
            'generic_name' => Yii::t('app', 'Active substance'),
            'trade_name' => Yii::t('app', '	B.4.k.2 Drug identification'),
            'composition' => Yii::t('app', 'B.4.k.2.2 Dosage Form'),
            'company_id' => Yii::t('app', 'Company Id'),
            'manufacturer' => Yii::t('app', 'Manufacturer'),
            'strength' => Yii::t('app', 'Strength'),
            'route_lkp_id' => Yii::t('app', 'B.4.k.8 Route of administration'),
            ]);
    }



    public function getSignaledIcsrsAndIcsrEvenets ($signaledDrugs)
    {
        $meddra_pt_text = [];
        foreach ($signaledDrugs as $key => $row) {
            if ($row['drug_id'] == $this->id) {
                $meddra_pt_text [] = $row['meddra_pt_text'];
            }
        }

        return $this->getSignaledIcsrsQueryByMeddraPt($meddra_pt_text);

    }

    public function getSignaledIcsrsQueryByMeddraPt ($meddraPtText)
    {
        $meddraPtText = implode("','",$meddraPtText);
        $connection = Yii::$app->getDb();
        $command = $connection
            ->createCommand("SELECT `icsr_event`.`icsr_id` , `icsr_event`.`id` , `meddra_pt_text` from `icsr_event`
                                    join icsr on `icsr`.`id` = `icsr_event`.`icsr_id` 
                                    where meddra_pt_text IN ('{$meddraPtText}') AND `icsr`.`drug_id` = {$this->id}");


        $result = $command->queryAll();

        return $result;
    }



}
