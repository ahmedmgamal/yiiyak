<?php

use yii\db\Migration;

/**
 * Class m180204_171604_alter_meddra_pt_text_column_in_icsr_event_table
 */
class m180204_171604_alter_meddra_pt_text_column_in_icsr_event_table extends Migration
{
    /**
     * @inheritdoc
     */



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('icsr_event', 'meddra_pt_text', 'varchar(100)');
    }

    public function down()
    {
        return false;
    }

}
