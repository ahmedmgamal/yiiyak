<?php

namespace backend\modules\crud\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\crud\models\DrugPrescription]].
 *
 * @see \backend\modules\crud\models\DrugPrescription
 */
class DrugPrescriptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\DrugPrescription[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\DrugPrescription|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
