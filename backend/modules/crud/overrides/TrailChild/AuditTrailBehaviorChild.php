<?php

namespace backend\modules\crud\overrides\TrailChild;

use bedezign\yii2\audit\AuditTrailBehavior;
use yii\db\Query;

class AuditTrailBehaviorChild extends AuditTrailBehavior{

    public $overRide = [];


    protected function cleanAttributes($attributes)
    {

        $attributes = $this->cleanAttributesAllowed($attributes);
        $attributes = $this->cleanAttributesIgnored($attributes);
        $attributes = $this->cleanAttributesOverRide($attributes);

        return $attributes;
    }


    protected function cleanAttributesOverRide($attributes)
    {
        if (sizeof($this->overRide) > 0 && sizeof($attributes) >0) {
            foreach ($this->overRide as $field => $queryParams)
            {

                $newOverRideValues = $this->getNewOverRideValues( $attributes[$field],$queryParams);

                if(count($newOverRideValues) >1)
                {
                    $attributes[$field] =   $this->getCommaSeparatedString($newOverRideValues,$queryParams['return_field']);
                }
                elseif(count($newOverRideValues) == 1){

                    $attributes[$field] = $newOverRideValues[0][$queryParams['return_field']];
                }
            }

        }
        return $attributes;
    }

    private function getNewOverRideValues($searchFieldValue,$queryParams)
    {
        $query = new Query;
        $query->select($queryParams['return_field'])->from($queryParams['table_name'])->where([$queryParams['search_field'] => $searchFieldValue]);
        $rows = $query->all();
        return $rows;
    }

    private function getCommaSeparatedString($array,$return_field)
    {
        $tempArray = [];
        foreach ($array as $key => $value)
        {
            $tempArray[] = $value[$return_field];
        }


        return implode(',',$tempArray);
    }


}