<?php

use yii\db\Migration;

class m161222_131257_add_qppv_person_role extends Migration
{
    public function up()
    {

        $this->execute("INSERT INTO auth_item (name,type) VALUES 

      ('Qppv Person',1),
      ('/crud/icsr/get-diff-before-date',2),
      ('/crud/drug/summary-tabulation',2),
      ('/crud/icsr/open-pdf',2),
      ('/crud/icsr/download-xml-file',2),
      ('/site/request-password-reset',2),
      ('/site/reset-password',2),
      ('/crud/icsr-event/get-first-lt-from-pt',2),
      ('/crud/icsr-event/get-pt-from-lt',2),
      ('/crud/icsr-event/search-llt',2),
      ('/crud/icsr-event/search-pt',2),
      ('/crud/icsr-event/search',2);
      ");

        $this->execute("INSERT INTO auth_item_child(parent,child) VALUES

      ('Qppv Person','/crud/drug-prescription/create'),
      ('Qppv Person','/crud/drug-prescription/update'),
      ('Qppv Person','/crud/drug/create'),
      ('Qppv Person','/crud/drug/update'),
      ('Qppv Person','/crud/icsr-event/create'),
      ('Qppv Person','/crud/icsr-event/update'),
      ('Qppv Person','/crud/icsr-reporter/create'),
      ('Qppv Person','/crud/icsr-reporter/update'),
      ('Qppv Person','/crud/icsr-test/create'),
      ('Qppv Person','/crud/icsr-test/update'),
      ('Qppv Person','/crud/icsr/create'),
      ('Qppv Person','/crud/icsr/update'),
      ('Qppv Person','/crud/icsr/check-duplicate-icsr');

      
      ");


    }

    public function down()
    {

        $this->execute('DELETE FROM auth_item_child where parent = "Qppv Person" ');
        $this->execute('DELETE FROM auth_item where name = "Qppv Person"');

    }

}
