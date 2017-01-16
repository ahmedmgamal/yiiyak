<?php

use yii\db\Migration;

/**
 * Handles adding rmp_first_deadline to table `drug`.
 */
class m161221_105511_add_rmp_first_deadline_column_to_drug_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('drug', 'rmp_first_deadline', $this->date());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('drug', 'rmp_first_deadline');
    }
}
