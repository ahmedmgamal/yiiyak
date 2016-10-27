<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_soc_hlgt`.
 */
class m161027_062526_create_meddra_soc_hlgt_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_soc_hlgt', [
            'soc_id' => $this->bigInteger()->notNull()->unsigned(),
            'hlgt_id' => $this->bigInteger()->notNull()->unsigned(),
        ]);

        $this->createIndex(
            'ix1_soc_hlgt01',
            'meddra_soc_hlgt',
            'soc_id'
        );

        $this->createIndex(
            'ix1_soc_hlgt02',
            'meddra_soc_hlgt',
            'hlgt_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_soc_hlgt');
    }
}
