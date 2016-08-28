<?php
namespace backend\modules\crud\traits;

trait checkAccess {

    public static function checkAccess($user_id,$drug_id)
    {
        if (isset($drug_id) && !empty($drug_id))
        {
            $company = self::findOne($drug_id)->company;
            if (!$company->getUser($user_id))
            {
                return false;
            }
        }
        return true;
    }
}