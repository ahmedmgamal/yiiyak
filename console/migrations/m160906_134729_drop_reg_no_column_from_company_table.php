<?php

use yii\db\Migration;

/**
 * Handles dropping reg_no from table `company`.
 */
class m160906_134729_drop_reg_no_column_from_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('company', 'reg_no');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('company', 'reg_no', $this->string());
    }
}
