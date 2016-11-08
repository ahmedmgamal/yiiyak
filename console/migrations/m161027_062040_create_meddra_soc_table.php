<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_soc`.
 */
class m161027_062040_create_meddra_soc_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_soc', [
            'id' => $this->bigInteger()->unsigned(),
            'term' => $this->string(100)->notNull(),
            'abbrev' => $this->string(5)->notNull(),
            'who_art_code' => $this->string(7),
            'harts_code' => $this->bigInteger(),
            'costart_sym' => $this->string(21),
            'icd9' => $this->string(8),
            'icd9_cm' => $this->string(8),
            'icd10' => $this->string(8),
            'jart_code' => $this->string(6),
        ]);


        $this->createIndex(
            'ix1_soc01',
            'meddra_soc',
            'id'
        );

        $this->createIndex(
            'ix1_soc02',
            'meddra_soc',
            'term'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_soc');
    }
}
