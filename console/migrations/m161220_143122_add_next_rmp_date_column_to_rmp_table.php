<?php

use yii\db\Migration;

/**
 * Handles adding next_rmp_date to table `rmp`.
 */
class m161220_143122_add_next_rmp_date_column_to_rmp_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('rmp', 'next_rmp_date', $this->date());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('rmp', 'next_rmp_date');
    }
}
