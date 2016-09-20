<?php

use yii\db\Migration;

/**
 * Handles the creation of table `plan_limits`.
 */
class m160920_132706_create_plan_limits_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('plan_limits', [
            'id' => $this->primaryKey(),
            'plan_id' => $this->integer()->notNull(),
            'limit_id' => $this->integer()->notNull(),
            'limit' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-lkp_plan_plan-limits','plan_limits','plan_id','lkp_plan','id','CASCADE');

        $this->addForeignKey('fk-lkp_limit_plan-limits','plan_limits','limit_id','lkp_limits','id','CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('plan_limits');
    }
}
