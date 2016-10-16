<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\PsmfCompany as BasePsmfCompany;

/**
 * This is the model class for table "psmf_company".
 */
class PsmfCompany extends BasePsmfCompany
{

    public function getNewVersion ()
    {

        return 1+count(self::find()->where(['company_id' => $this->company_id])->all());
    }
}
