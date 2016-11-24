<?php

use yii\db\Migration;

class m161124_141129_add_meddra_seeds extends Migration
{
    public function up()
    {
        $this->execute("INSERT INTO meddra_pt (id,term,soc_id) VALUES (10001477,'Aged parent',10041244)");
        $this->execute("INSERT INTO meddra_pt (id,term,soc_id) VALUES (10023636,'Lacrimal punctum agenesis',10023636)");
        $this->execute("INSERT INTO meddra_pt (id,term,soc_id) VALUES (10004089,'Bankruptcy',10041244)");
        $this->execute("INSERT INTO meddra_pt (id,term,soc_id) VALUES (10036465,'Poverty',10041244)");

        $this->execute("INSERT INTO meddra_llt (id,term,pt_id) VALUES (10001477,'Aged in-law',10001477)");
        $this->execute("INSERT INTO meddra_llt (id,term,pt_id) VALUES (10001477,'Aged parent',10001477)");
    }

    public function down()
    {
        echo "m161124_141129_add_meddra_seeds cannot be reverted.\n";

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
