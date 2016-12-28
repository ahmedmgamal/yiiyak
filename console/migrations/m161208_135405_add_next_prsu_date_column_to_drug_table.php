<?php

use yii\db\Migration;

/**
 * Handles adding next_prsu_date to table `drug`.
 */
class m161208_135405_add_next_prsu_date_column_to_drug_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('drug', 'next_prsu_date', $this->date());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('drug', 'next_prsu_date');
    }
}
