<?php

use yii\db\Migration;

/**
 * Handles adding subscribtion_end_date to table `company`.
 */
class m160904_123949_add_subscribtion_end_date_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'end_date', $this->date());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'end_date');
    }
}
