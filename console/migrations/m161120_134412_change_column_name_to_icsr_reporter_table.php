<?php

use yii\db\Migration;

class m161120_134412_change_column_name_to_icsr_reporter_table extends Migration
{
    public function up()
    {
        $this->renameColumn('icsr_reporter','address_line_1','reporter_organization');
        $this->renameColumn('icsr_reporter','address_line_2','reporter_department');
    }

    public function down()
    {
        echo "m161120_134412_change_column_name_to_icsr_reporter_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
