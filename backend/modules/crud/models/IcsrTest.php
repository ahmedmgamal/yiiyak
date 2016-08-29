<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\IcsrTest as BaseIcsrTest;
use \backend\modules\crud\traits;
/**
 * This is the model class for table "icsr_test".
 */
class IcsrTest extends BaseIcsrTest
{
    use traits\checkAccess;
    public function attributeHints()
    {
                  return array_merge(
            parent::attributeHints(), [
   
            'test_lkp_id' => Yii::t('app', 'B.3.1c Test'),
            'date' => Yii::t('app', 'B.3.1b testdate'),
            'result' => Yii::t('app', 'B.3.1d Result'),
            'result_unit' => Yii::t('app', ' B.3.1e Unit Result Unit'),
            'normal_low_range' => Yii::t('app', 'B.3.1.1 Normal low range'),
            'normal_high_range' => Yii::t('app', 'B.3.1.2 Normal high range '),
            'more_info' => Yii::t('app', 'B.3.2 Results of tests and procedures relevant to the investigation'),
        ]);
    }
}
