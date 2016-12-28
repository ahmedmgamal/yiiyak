<?php

use yii\db\Migration;

class m161222_135928_add_qppv_debuty_role extends Migration
{
    public function up()
    {
        $this->execute("INSERT INTO auth_item (name,type) VALUES('Qppv Deputy',1)");

        $this->execute("INSERT INTO auth_item_child(parent,child) VALUES

     


      ('Qppv Deputy','/crud/drug-prescription/index'),
      ('Qppv Deputy','/crud/drug-prescription/view'),
      ('Qppv Deputy','/crud/drug/index'),
      ('Qppv Deputy','/crud/drug/view'),
      ('Qppv Deputy','/crud/icsr-event/get-first-lt-from-pt'),
      ('Qppv Deputy','/crud/icsr-event/get-pt-from-lt'),
      ('Qppv Deputy','/crud/icsr-event/index'),
      ('Qppv Deputy','/crud/icsr-event/view'),
      ('Qppv Deputy','/crud/icsr-event/search'),
      ('Qppv Deputy','/crud/icsr-event/search-llt'),
      ('Qppv Deputy','/crud/icsr-event/search-pt'),
      ('Qppv Deputy','/crud/icsr-reporter/index'),
      ('Qppv Deputy','/crud/icsr-reporter/view'),
      ('Qppv Deputy','/crud/icsr-test/index'),
      ('Qppv Deputy','/crud/icsr-test/view'),
      ('Qppv Deputy','/crud/icsr/index'),
      ('Qppv Deputy','/crud/icsr/view'),
      ('Qppv Deputy','/site/index'),
      ('Qppv Deputy','/site/landing'),
      ('Qppv Deputy','/site/login'),
      ('Qppv Deputy','/site/logout'),
      ('Qppv Deputy','/site/send-mail'),
      ('Qppv Deputy','/site/request-password-reset'),
      ('Qppv Deputy','/site/reset-password'),
      ('Qppv Deputy','/crud/drug/summary-tabulation'),
      ('Qppv Deputy','/crud/reports/summary-tabulation'),
      ('Qppv Deputy','/crud/icsr/open-pdf'),
      ('Qppv Deputy','/crud/icsr/download-xml-file'),
      ('Qppv Deputy','/crud/icsr/get-diff-before-date');
      ");



    }

    public function down()
    {
        $this->execute('DELETE FROM auth_item_child where parent = "Qppv Deputy" ');
        $this->execute('DELETE FROM auth_item where name = "Qppv Deputy"');
    }


}
