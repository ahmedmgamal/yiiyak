<?php

use yii\db\Migration;

/**
 * Handles adding short_name to table `company`.
 */
class m161024_135235_add_short_name_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'short_name', $this->string(4));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'short_name');
    }
}
