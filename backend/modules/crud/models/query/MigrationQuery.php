<?php

namespace backend\modules\crud\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\crud\models\Migration]].
 *
 * @see \backend\modules\crud\models\Migration
 */
class MigrationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\Migration[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\crud\models\Migration|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
