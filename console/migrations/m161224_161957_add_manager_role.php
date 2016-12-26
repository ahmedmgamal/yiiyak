<?php

use yii\db\Migration;

class m161224_161957_add_manager_role extends Migration
{
    public function up()
    {
        $this->execute("INSERT INTO auth_item (name,type) VALUES 
        ('Manager',1),
        ('/crud/icsr/download-dtd',2);
        
        
        
        ");

        $this->execute("INSERT INTO auth_item_child(parent,child) VALUES

      ('Manager','/crud/drug-prescription/delete'),
      ('Manager','/crud/drug/delete'),
      ('Manager','/crud/icsr-event/delete'),
      ('Manager','/crud/icsr-reporter/delete'),
      ('Manager','/crud/icsr-test/delete'),
      ('Manager','/crud/icsr/delete'),
      ('Manager','/crud/icsr/download-dtd'),
      ('Manager','/crud/icsr/download-xml-file'),
      ('Manager','/crud/icsr/export'),
      ('Manager','/crud/icsr/export-null-case'),
      ('Manager','/crud/icsr/null-case-reason'),
      ('Manager','/crud/user/index'),
      ('Manager','/crud/user/view'),
      ('Manager','/crud/user/update'),
      ('Manager','/crud/user/create'),
      ('Manager','/crud/drug-prescription/create'),
      ('Manager','/crud/drug-prescription/update'),
      ('Manager','/crud/drug/create'),
      ('Manager','/crud/drug/update'),
      ('Manager','/crud/icsr-event/create'),
      ('Manager','/crud/icsr-event/update'),
      ('Manager','/crud/icsr-reporter/create'),
      ('Manager','/crud/icsr-reporter/update'),
      ('Manager','/crud/icsr-test/create'),
      ('Manager','/crud/icsr-test/update'),
      ('Manager','/crud/icsr/create'),
      ('Manager','/crud/icsr/update'),
      ('Manager','/crud/icsr/check-duplicate-icsr');
      ");



    }

    public function down()
    {
        $this->execute('DELETE FROM auth_item_child where parent = "Manager" ');
        $this->execute('DELETE FROM auth_item where name = "Manager"');
    }
}
