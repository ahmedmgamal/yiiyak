<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_pt`.
 */
class m161027_055834_create_meddra_pt_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_pt', [
            'id' =>$this->bigInteger()->unsigned(),
            'term' => $this->string(100)->notNull(),
            'null_field' => $this->string(1),
            'soc_id' => $this->bigInteger()->unsigned(),
            'who_art_code' => $this->string(7),
            'harts_code' => $this->bigInteger(),
            'costart_sym' => $this->string(21),
            'icd9' => $this->string(8),
            'icd9_cm' => $this->string(8),
            'icd10' => $this->string(8),
            'jart_code' => $this->string(6),
        ]);

        $this->createIndex(
            'ix1_pt_llt01',
            'meddra_pt',
            'id'
        );

        $this->createIndex(
            'ix1_pt_llt02',
            'meddra_pt',
            'term'
        );

        $this->createIndex(
            'ix1_pt_llt03',
            'meddra_pt',
            'soc_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_pt');
    }
}
