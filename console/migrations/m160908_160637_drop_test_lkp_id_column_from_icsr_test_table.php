<?php

use yii\db\Migration;

/**
 * Handles dropping test_lkp_id from table `icsr_test`.
 */
class m160908_160637_drop_test_lkp_id_column_from_icsr_test_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

        $this->dropForeignKey('fk_icsr_test_test_lkp1','icsr_test');
        $this->dropColumn('icsr_test', 'test_lkp_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('icsr_test', 'test_lkp_id', $this->integer());
    }
}
