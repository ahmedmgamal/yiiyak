<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_llt`.
 */
class m161027_054246_create_meddra_llt_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_llt', [
            'id' => $this->bigInteger()->unsigned(),
            'term' => $this->string(100)->notNull(),
            'pt_id' => $this->bigInteger()->unsigned(),
            'who_art_code' => $this->string(7),
            'harts_code' => $this->bigInteger()->unsigned(),
            'costart_sym' => $this->string(21),
            'icd9' => $this->string(8),
            'icd9_cm' => $this->string(8),
            'icd10' => $this->string(8),
            'currenct' => $this->string(1),
            'jart_code' => $this->string(6),
        ]);

        $this->createIndex(
            'ix1_pt_llt01',
            'meddra_llt',
            'id'
        );

        $this->createIndex(
            'ix1_pt_llt02',
            'meddra_llt',
            'term'
        );

        $this->createIndex(
            'ix1_pt_llt03',
            'meddra_llt',
            'pt_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_llt');
    }
}
