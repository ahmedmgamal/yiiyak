<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_hlt`.
 */
class m161027_060204_create_meddra_hlt_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_hlt', [
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
            'ix1_hlt01',
            'meddra_hlt',
            'id'
        );

        $this->createIndex(
            'ix1_hlt02',
            'meddra_hlt',
            'term'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_hlt');
    }
}
