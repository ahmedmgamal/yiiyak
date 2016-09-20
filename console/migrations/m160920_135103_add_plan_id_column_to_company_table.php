<?php

use yii\db\Migration;

/**
 * Handles adding plan_id to table `company`.
 */
class m160920_135103_add_plan_id_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'plan_id', $this->integer()->notNull()->defaultValue(1));
        $this->addForeignKey('fk-lkp_plan_company','company','plan_id','lkp_plan','id','CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'plan_id');
    }
}
