<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_hlgt_hlt`.
 */
class m161030_125325_create_meddra_hlgt_hlt_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_hlgt_hlt', [

            'hlgt_id' => $this->bigInteger()->unsigned(),
            'hlt_id' => $this->bigInteger()->unsigned(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_hlgt_hlt');
    }
}
