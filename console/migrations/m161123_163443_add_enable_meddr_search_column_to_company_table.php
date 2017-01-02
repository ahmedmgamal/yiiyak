<?php

use yii\db\Migration;

/**
 * Handles adding enable_meddr_search to table `company`.
 */
class m161123_163443_add_enable_meddr_search_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'enable_meddra_search', $this->boolean()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'enable_meddra_search');
    }
}
