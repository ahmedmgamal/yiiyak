<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lkp_plan`.
 */
class m160920_131924_create_lkp_plan_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('lkp_plan', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $seeds = array('gold','silver','platinum');

        foreach ($seeds as $key => $value)
            $this->insert('lkp_plan',['name' => "{$value}"]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('lkp_plan');
    }
}
