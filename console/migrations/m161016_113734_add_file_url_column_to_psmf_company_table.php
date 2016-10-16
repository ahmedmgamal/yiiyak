<?php

use yii\db\Migration;

/**
 * Handles adding file_url to table `psmf_company`.
 */
class m161016_113734_add_file_url_column_to_psmf_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('psmf_company', 'file_url', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('psmf_company', 'file_url');
    }
}
