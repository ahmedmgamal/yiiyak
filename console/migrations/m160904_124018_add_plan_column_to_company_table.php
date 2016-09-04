<?php

use yii\db\Migration;

/**
 * Handles adding plan to table `company`.
 */
class m160904_124018_add_plan_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'plan', 'ENUM("silver","gold","platinum")');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'plan');
    }
}
