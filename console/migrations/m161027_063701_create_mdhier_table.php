<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mdhier`.
 */
class m161027_063701_create_mdhier_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_mdhier', [
            'id' => $this->primaryKey(),
            'pt_id' => $this->bigInteger()->notNull()->unsigned(),
            'hlt_id' => $this->bigInteger()->notNull()->unsigned(),
            'hlgt_id' => $this->bigInteger()->notNull()->unsigned(),
            'soc_id' => $this->bigInteger()->notNull()->unsigned(),
            'pt_term' => $this->string(100)->notNull(),
            'hlt_term' => $this->string(100)->notNull(),
            'hlgt_term' => $this->string(100)->notNull(),
            'soc_term' => $this->string(100)->notNull(),
            'soc_abbrev' => $this->string(5)->notNull(),
            'null_field' => $this->string(1),
            'pt_soc_id' => $this->bigInteger()->unsigned(),
            'primary_soc_fg' => $this->string(1),
        ]);

        $this->createIndex(
            'ix1_md_hier01',
            'meddra_mdhier',
            'pt_id'
        );

        $this->createIndex(
            'ix1_md_hier02',
            'meddra_mdhier',
            'hlt_id'
        );

        $this->createIndex(
            'ix1_md_hier03',
            'meddra_mdhier',
            'hlgt_id'
        );

        $this->createIndex(
            'ix1_md_hier04',
            'meddra_mdhier',
            'soc_id'
        );

        $this->createIndex(
            'ix1_md_hier05',
            'meddra_mdhier',
            'pt_soc_id'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_mdhier');
    }
}
