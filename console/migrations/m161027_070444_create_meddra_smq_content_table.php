<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_smq_content`.
 */
class m161027_070444_create_meddra_smq_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_smq_content', [
            'smq_id' => $this->bigInteger()->notNull(),
            'code' => $this->bigInteger()->notNull(),
            'level' => $this->bigInteger()->notNull(),
            'scope' => $this->bigInteger()->notNull(),
            'category' => $this->string(1)->notNull(),
            'weight' => $this->bigInteger()->notNull(),
            'status' => $this->string(1)->notNull(),
            'addition_ver' => $this->string(5)->notNull(),
            'last_modified_ver' => $this->string(5)->notNull(),
        ]);

        $this->createIndex(
            'ix1_smq_content01',
            'meddra_smq_content',
            'smq_id'
        );

        $this->createIndex(
            'ix1_smq_content02',
            'meddra_smq_content',
            'code'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_smq_content');
    }
}
