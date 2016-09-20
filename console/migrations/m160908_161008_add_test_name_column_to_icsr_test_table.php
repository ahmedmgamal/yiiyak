<?php

use yii\db\Migration;

/**
 * Handles adding test_name to table `icsr_test`.
 */
class m160908_161008_add_test_name_column_to_icsr_test_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('icsr_test', 'test_name', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('icsr_test', 'test_name');
    }
}
