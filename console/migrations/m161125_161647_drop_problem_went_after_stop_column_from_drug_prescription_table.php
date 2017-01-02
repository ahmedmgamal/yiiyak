<?php

use yii\db\Migration;

/**
 * Handles dropping problem_went_after_stop from table `drug_prescription`.
 */
class m161125_161647_drop_problem_went_after_stop_column_from_drug_prescription_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('drug_prescription', 'problem_went_after_stop');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('drug_prescription', 'problem_went_after_stop', $this->boolean());
    }
}
