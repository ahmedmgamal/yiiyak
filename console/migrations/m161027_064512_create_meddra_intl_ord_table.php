<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_intl_ord`.
 */
class m161027_064512_create_meddra_intl_ord_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_intl_ord', [
            'intl_ord_id' => $this->bigInteger()->notNull()->unsigned(),
            'soc_id' => $this->bigInteger()->notNull()->unsigned(),
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_intl_ord');
    }
}
