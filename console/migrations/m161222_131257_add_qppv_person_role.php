<?php

use yii\db\Migration;

class m161222_131257_add_qppv_person_role extends Migration
{
    public function up()
    {

        $this->execute("INSERT INTO auth_item (name,type) VALUES('Qppv Person',1)");
        $this->execute("INSERT INTO auth_item_child(parent,child) VALUES

      ('Qppv Person','/crud/drug-prescription/index'),
      ('Qppv Person','/crud/drug-prescription/view'),
      ('Qppv Person','/crud/drug/index'),
      ('Qppv Person','/crud/drug/view'),
      ('Qppv Person','/crud/icsr-event/get-first-lt-from-pt'),
      ('Qppv Person','/crud/icsr-event/get-pt-from-lt'),
      ('Qppv Person','/crud/icsr-event/index'),
      ('Qppv Person','/crud/icsr-event/view'),
      ('Qppv Person','/crud/icsr-event/search'),
      ('Qppv Person','/crud/icsr-event/search-llt'),
      ('Qppv Person','/crud/icsr-event/search-pt'),
      ('Qppv Person','/crud/icsr-reporter/index'),
      ('Qppv Person','/crud/icsr-reporter/view'),
      ('Qppv Person','/crud/icsr-test/index'),
      ('Qppv Person','/crud/icsr-test/view'),
      ('Qppv Person','/crud/icsr/index'),
      ('Qppv Person','/crud/icsr/view'),
      ('Qppv Person','/site/index'),
      ('Qppv Person','/site/landing'),
      ('Qppv Person','/site/login'),
      ('Qppv Person','/site/logout'),
      ('Qppv Person','/site/send-mail'),
      ('Qppv Person','/site/request-password-reset'),
      ('Qppv Person','/site/reset-password');
      ");


    }

    public function down()
    {

        $this->execute('DELETE FROM auth_item_child where parent = "Qppv Person" ');
        $this->execute('DELETE FROM auth_item where name = "Qppv Person"');

    }

}
