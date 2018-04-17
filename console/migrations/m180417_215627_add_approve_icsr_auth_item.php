<?php

use yii\db\Migration;

/**
 * Class m180417_215627_add_approve_icsr_auth_item
 */
class m180417_215627_add_approve_icsr_auth_item extends Migration
{



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->execute("INSERT INTO auth_item (name,type) VALUES 
                ('/crud/icsr/approve',2)
      ");

        $this->execute("INSERT INTO auth_item_child(parent,child) VALUES
              ('Qppv Person','/crud/icsr/approve'),
              ('Manager','/crud/icsr/approve')
              ");
    }

    public function down()
    {
        $this->execute('DELETE FROM auth_item_child where child = "/crud/icsr/approve" ');
        $this->execute('DELETE FROM auth_item where name = "/crud/icsr/approve"');
    }

}
