<?php

use yii\db\Migration;

class m161221_135717_create_company_admin_data_seed extends Migration
{
//    public function up()
//    {
//
//    }
//
//    public function down()
//    {
//        echo "m161221_135717_create_company_admin_data_seed cannot be reverted.\n";
//
//        return false;
//    }


    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->execute("INSERT INTO auth_item(name,type) VALUES('companyAdmin',1)");
        $this->execute("INSERT INTO auth_item(name,type) VALUES('/crud/company/admin',2)");
        $this->execute("INSERT INTO auth_item_child(parent,child) VALUES('companyAdmin','/crud/company/admin')");
    }

    public function safeDown()
    {
        $this->execute("DELETE FROM auth_item_child WHERE `parent` = 'companyAdmin' AND `child` = '/crud/company/admin';");
        $this->execute("DELETE FROM auth_item WHERE `name` = '/crud/company/admin' AND `type` = 2;");
        $this->execute("DELETE FROM auth_item WHERE `name` = 'companyAdmin' AND `type` = 1;");

    }

}
