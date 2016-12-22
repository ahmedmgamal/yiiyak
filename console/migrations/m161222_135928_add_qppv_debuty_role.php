<?php

use yii\db\Migration;

class m161222_135928_add_qppv_debuty_role extends Migration
{
    public function up()
    {
        $this->execute("INSERT INTO auth_item (name,type) VALUES('Qppv Deputy',1)");

        $this->execute("INSERT INTO auth_item_child(parent,child) VALUES

      ('Qppv Deputy','/crud/drug-prescription/create'),
      ('Qppv Deputy','/crud/drug-prescription/update'),
      ('Qppv Deputy','/crud/drug/create'),
      ('Qppv Deputy','/crud/drug/update'),
      ('Qppv Deputy','/crud/icsr-event/create'),
      ('Qppv Deputy','/crud/icsr-event/update'),
      ('Qppv Deputy','/crud/icsr-reporter/create'),
      ('Qppv Deputy','/crud/icsr-reporter/update'),
      ('Qppv Deputy','/crud/icsr-test/create'),
      ('Qppv Deputy','/crud/icsr-test/update'),
      ('Qppv Deputy','/crud/icsr/create'),
      ('Qppv Deputy','/crud/icsr/update'),
      ('Qppv Deputy','/crud/icsr/check-duplicate-icsr');
      ");



    }

    public function down()
    {
        $this->execute('DELETE FROM auth_item_child where parent = "Qppv Deputy" ');
        $this->execute('DELETE FROM auth_item where name = "Qppv Deputy"');
    }


}
