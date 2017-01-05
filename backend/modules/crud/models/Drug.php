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

    public function get_signalDetectionArray(){
        $signalValues= [];
        foreach ($this->getIcsrEvents() as $event){
            $values = $this->getAbcd($event['EventName']);
            $A = isset($values['A']) ? $values['A'] : 0;
            $B = isset($values['B']) ? $values['B'] : 0;
            $C = isset($values['C']) ? $values['C'] : 0;
            $D = isset($values['D']) ? $values['D'] : 0;
            $AB = $A + $B;
            $CD = $C+ $D;
            $AC = $A+$C;
            $BD = $B+$D;
            $ABCD = $AC+$BD;
            if($C > 0){
                $PRR = ($A/ ($AB)) / ($C /($CD));
                $SE = (1/$A + 1/$C - 1/$AB - 1/$CD);
                $SE = sqrt($SE);
            }else{
                $PRR = 99.9;
                $SE = 0;
            }


            //95% confidence interval of the PRR : PRR / exp(1.96se)
            $confidence_1 = $PRR / (exp(1.96 * $SE));
            //95% confidence interval of the PRR : PRR * exp(1.96se)
            $confidence_2 = $PRR * (exp(1.96 * $SE));
            $lower = min($confidence_1,$confidence_2);
            $isSignal = $this->isSignal($lower,$A);


            $signalValues[] = [
                "event_description"=>$event['EventName'],
                "A"=> $A,
                "B"=> $B,
                "AB"=>$AB,
                "C"=> $C,
                "D"=> $D,
                "CD"=>$CD,
                "AC"=>$AC,
                "BD"=>$BD,
                "ABCD"=>$ABCD,
                "PRR"=>round($PRR , 6),
                "SE"=>round($SE , 6),
                'isSignal'=>$isSignal,
                "confidence_1"=>$confidence_1,
                "confidence_2" => $confidence_2
            ];
        }
        return $signalValues;
    }
    private function getAbcd($eventName){
        $sql = "SELECT
                  MAX(IF(`EventName` = 'A', COUNTS, NULL)) AS A,
                  MAX(IF(`EventName` = 'B', COUNTS, NULL)) AS B,
                  MAX(IF(`EventName` = 'C', COUNTS, NULL)) AS C,
                  MAX(IF(`EventName` = 'D', COUNTS, NULL)) AS D
                FROM(
                SELECT EventName,count(EventName) as COUNTS
                FROM(
                SELECT
                      CASE Events.meddra_llt_text
                    WHEN :eventName then 'A'
                      ELSE 'B'
                        END AS EventName
                FROM drug
                  INNER JOIN icsr
                    ON(icsr.drug_id = drug.id)
                  INNER JOIN icsr_event as Events
                    ON(Events.icsr_id = icsr.id)
                WHERE drug.id = :drugId) AS F
                GROUP BY EventName
                UNION
                SELECT EventName,count(EventName)
                FROM(
                      SELECT
                        CASE Events.meddra_llt_text
                        WHEN :eventName then 'C'
                        ELSE 'D'
                        END AS EventName
                      FROM drug
                        INNER JOIN icsr
                          ON(icsr.drug_id = drug.id)
                        INNER JOIN icsr_event as Events
                          ON(Events.icsr_id = icsr.id)
                      WHERE drug.id != :drugId) AS F
                GROUP BY EventName
                ORDER BY EventName ASC
                ) AS ABCD;";
        $A = Yii::$app->db->createCommand($sql,[":eventName"=>$eventName,"drugId"=>$this->id])->queryAll();
        return reset($A);
    }

    private function getIcsrEvents(){
        $sql = "SELECT Events.meddra_llt_text as EventName
                FROM drug
                  INNER JOIN icsr
                    ON(icsr.drug_id = drug.id)
                  INNER JOIN icsr_event as Events
                    ON(Events.icsr_id = icsr.id)
                WHERE drug.id = :drugId
                GROUP BY Events.meddra_llt_text;";
        $events = Yii::$app->db->createCommand($sql,["drugId"=>$this->id])->queryAll();
        return $events;
    }
    private function isSignal($lower,$a){
        if($lower >= 1 && $a >= 3){
            return true;
        }
        return false;
    }


}
