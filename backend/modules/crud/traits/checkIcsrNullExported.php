<?php
namespace backend\modules\crud\traits;



use backend\modules\crud\models\Icsr;

trait checkIcsrNullExported {


    public static function checkObjIcsrNullExported ($obj_id)
    {
        if (isset($obj_id) && !empty($obj_id))
        {
            $icsr = self::findOne($obj_id)->icsr;

            if ($icsr->isNullExported())
            {
                return true;
            }
            else
            {
                return false;
            }

        }

        return true;
    }


    public static function checkIcsrNullExported ($icsr_id)
    {

        if (isset($icsr_id) && !empty($icsr_id))
        {
          $icsr =  Icsr::findOne($icsr_id);

            if ($icsr->isNullExported())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return true;
    }
}