<?php

use yii\db\Migration;

/**
 * Class m180322_123801_add_foreigns_icsr_event
 */
class m180322_123801_add_foreigns_icsr_event extends Migration
{



    public function up()
    {
        $this->createIndex('fk_icsr_event_meddra_llt1_idx', 'icsr_event', 'meddra_llt_id');
        $this->createIndex('fk_icsr_event_meddra_pt1_idx', 'icsr_event', 'meddra_pt_id');
        $this->addForeignKey ( 'fk_icsr_event_meddra_llt1_idx', 'icsr_event', 'meddra_llt_id', 'meddra_llt', 'id', 'NO ACTION', 'NO ACTION' );
        $this->addForeignKey ( 'fk_icsr_event_meddra_pt1_idx', 'icsr_event', 'meddra_pt_id', 'meddra_pt', 'id', 'NO ACTION', 'NO ACTION' );
    }

    public function down()
    {
        $this->dropIndex('fk_icsr_event_meddra_llt1_idx','icsr_event');
        $this->dropIndex('fk_icsr_event_meddra_pt1_idx','icsr_event');
    }

}
