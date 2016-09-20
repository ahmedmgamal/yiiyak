<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lkp_limits`.
 */
class m160920_132227_create_lkp_limits_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('lkp_limits', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $seeds = array('drug','icsr','user');

        foreach ($seeds as $key => $value)
            $this->insert('lkp_limits',['name' => "{$value}"]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('lkp_limits');
    }
}
