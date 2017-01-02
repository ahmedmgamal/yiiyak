<?php

use yii\db\Migration;

class m161213_083124_reports_auth_data_seed extends Migration
{
    /*public function up()
    {

    }

    public function down()
    {

    }*/


    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->execute("INSERT INTO auth_item(name,type) VALUES('/crud/reports/summary-tabulation',2)");
        $this->execute("INSERT INTO auth_item_child(parent,child) VALUES('normalUser','/crud/reports/summary-tabulation')");
    }

    public function safeDown()
    {
        echo "m161213_083124_reports_auth_data_seed cannot be reverted.\n";

        $this->execute("DELETE FROM auth_item_child WHERE `parent` = 'normalUser' AND `child` = '/crud/reports/summary-tabulation';");
        $this->execute("DELETE FROM auth_item WHERE `name` = '/crud/reports/summary-tabulation' AND `type` = 2;");
    }

}
