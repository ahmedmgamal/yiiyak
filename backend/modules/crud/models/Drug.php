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
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'id' => Yii::t('app', 'ID'),
            'generic_name' => Yii::t('app', 'Generic Name'),
            'trade_name' => Yii::t('app', '	B.4.k.2 Drug identification'),
            'composition' => Yii::t('app', 'B.4.k.2.2 Active substance name(s)'),
            'company_id' => Yii::t('app', 'Company Id'),
            'manufacturer' => Yii::t('app', 'Manufacturer'),
            'strength' => Yii::t('app', 'Strength'),
            'route_lkp_id' => Yii::t('app', 'B.4.k.8 Route of administration'),
            ]);
    }


}
