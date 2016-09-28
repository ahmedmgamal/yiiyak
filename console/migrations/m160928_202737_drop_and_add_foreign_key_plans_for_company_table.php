<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `and_add_foreign_key_plans_for_company`.
 */
class m160928_202737_drop_and_add_foreign_key_plans_for_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropForeignKey('fk-lkp_plan_company','company');
        $this->addForeignKey('fk-lkp_plan_company','company','plan_id','lkp_plan','id');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {

    }
}
