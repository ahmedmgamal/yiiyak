<?php

use yii\db\Migration;

/**
 * Handles dropping product_avilable from table `drug_prescription_`.
 */
class m160908_153940_drop_product_avilable_column_from_drug_prescription__table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('drug_prescription', 'product_avilable');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('drug_prescription', 'product_avilable', $this->integer());
    }
}
