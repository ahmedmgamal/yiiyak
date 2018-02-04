<?php

use yii\db\Migration;

/**
 * Class m180204_171107_alter_meddra_llt_text_column_in_icsr_event_table
 */
class m180204_171107_alter_meddra_llt_text_column_in_icsr_event_table extends Migration
{



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('icsr_event', 'meddra_llt_text', 'varchar(100)');
    }

    public function down()
    {
        return false;
    }

}
