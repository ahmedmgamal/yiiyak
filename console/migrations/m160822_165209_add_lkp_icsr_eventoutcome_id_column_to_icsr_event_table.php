<?php

use yii\db\Migration;

/**
 * Handles adding lkp_icsr_eventoutcome_id to table `icsr_event`.
 */
class m160822_165209_add_lkp_icsr_eventoutcome_id_column_to_icsr_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('icsr_event', 'lkp_icsr_eventoutcome_id', $this->integer()->notNull()->defaultValue(1));
        $this->addForeignKey('fk-icsr-event-lkp_icsr_eventoutcome_id','icsr_event','lkp_icsr_eventoutcome_id','lkp_icsr_eventoutcome','id','CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('icsr_event', 'lkp_icsr_eventoutcome_id');
    }
}
