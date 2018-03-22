<?php

use yii\db\Migration;

/**
 * Class m180322_114115_alter_meddra_index
 */
class m180322_114115_alter_meddra_index extends Migration
{



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropIndex('fk_icsr_event_meddra_llt1_idx','icsr_event');
        $this->dropIndex('fk_icsr_event_meddra_pt1','icsr_event');
        $this->alterColumn('icsr_event', 'meddra_llt_id', 'bigint(20)   UNSIGNED');
        $this->alterColumn('icsr_event', 'meddra_pt_id', 'bigint(20)   UNSIGNED');

    }

    public function down()
    {
        $this->createIndex('fk_icsr_event_meddra_llt1_idx', 'icsr_event', 'meddra_llt_id');
        $this->createIndex('fk_icsr_event_meddra_llt1_idx', 'icsr_event', 'meddra_pt_id');
    }

}
