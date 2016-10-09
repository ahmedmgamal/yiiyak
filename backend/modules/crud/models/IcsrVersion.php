<?php

namespace backend\modules\crud\models;

use Yii;
use \backend\modules\crud\models\base\IcsrVersion as BaseIcsrVersion;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "icsr_version".
 */
class IcsrVersion extends BaseIcsrVersion
{

    public function behaviors()
    {

        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'export_date',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
