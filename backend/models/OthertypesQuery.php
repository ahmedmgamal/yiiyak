<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Othertypes]].
 *
 * @see Othertypes
 */
class OthertypesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Othertypes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Othertypes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
