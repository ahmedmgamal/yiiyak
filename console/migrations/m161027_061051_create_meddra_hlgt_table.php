<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_hlgt`.
 */
class m161027_061051_create_meddra_hlgt_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_hlgt', [
            'id' => $this->bigInteger()->unsigned(),
            'term' => $this->string(100)->notNull(),
            'who_art_code' => $this->string(7),
            'harts_code' => $this->bigInteger(),
            'costart_sym' => $this->string(21),
            'icd9' => $this->string(8),
            'icd9_cm' => $this->string(8),
            'icd10' => $this->string(8),
            'jart_code' => $this->string(6),
        ]);

        $this->createIndex(
            'ix1_hlgt01',
            'meddra_hlgt',
            'id'
        );

        $this->createIndex(
            'ix1_hlgt02',
            'meddra_hlgt',
            'term'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_hlgt');
    }
}
