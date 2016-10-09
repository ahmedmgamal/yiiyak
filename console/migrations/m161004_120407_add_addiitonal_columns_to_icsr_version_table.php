<?php

use yii\db\Migration;

/**
 * Handles adding addiitonal to table `icsr_version`.
 */
class m161004_120407_add_addiitonal_columns_to_icsr_version_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('icsr_version', 'export_date', $this->dateTime());
        $this->addColumn('icsr_version', 'version_no', $this->integer());
        $this->addColumn('icsr_version', 'exported_by', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('icsr_version', 'export_date');
        $this->dropColumn('icsr_version', 'version_no');
        $this->dropColumn('icsr_version', 'exported_by');
    }
}
