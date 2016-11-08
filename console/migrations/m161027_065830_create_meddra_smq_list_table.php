<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_smq_list`.
 */
class m161027_065830_create_meddra_smq_list_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_smq_list', [
            'id' => $this->bigInteger()->notNull()->unsigned(),
            'name' => $this->string(100)->notNull(),
            'level' => $this->bigInteger()->notNull(),
            'description' => $this->string(2000)->notNull(),
            'source' => $this->string(2000),
            'note' => $this->string(2000),
            'meddra_version' => $this->string(5)->notNull(),
            'status' => $this->string(1)->notNull(),
            'algorithm' => $this->string(1000)->notNull(),
        ]);

        $this->createIndex(
            'ix1_smq_list01',
            'meddra_smq_list',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_smq_list');
    }
}
