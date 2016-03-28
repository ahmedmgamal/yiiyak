<?php

namespace backend\modules\crud\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\crud\models\LkpIcsrType]].
 *
 * @see \backend\modules\crud\models\LkpIcsrType
 */
class LkpIcsrTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\LkpIcsrType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\LkpIcsrType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
