<?php

use yii\db\Migration;

class m170130_181541_addExcelUploadRole extends Migration
{
    public function up()
    {
        $this->execute("INSERT INTO auth_item(name,type) VALUES
      ('/crud/drug/excel-download',2),('/crud/drug/excel-upload',2)");

        $this->execute("INSERT INTO auth_item_child(parent,child) VALUES

      ('Qppv Deputy','/crud/drug/excel-upload'),
      ('Qppv Deputy','/crud/drug/excel-download')
      ");
    }

    public function down()
    {
        $this->execute('DELETE FROM auth_item_child where parent = "Qppv Deputy" AND child = "/crud/drug/excel-upload" ');
        $this->execute('DELETE FROM auth_item_child where parent = "Qppv Deputy" AND child = "/crud/drug/excel-download" ');
        $this->execute('DELETE FROM auth_item where name = "/crud/drug/excel-download" AND type = 2 ');
        $this->execute('DELETE FROM auth_item where name = "/crud/drug/excel-upload" AND type = 2 ');

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
