<?php

use yii\db\Migration;

/**
 * Handles dropping plan from table `company`.
 */
class m160920_134726_drop_plan_column_from_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('company', 'plan');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('company', 'plan', $this->text());
    }
}
