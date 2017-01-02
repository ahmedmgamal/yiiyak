<?php

use yii\db\Migration;

/**
 * Handles the creation of table `prsu`.
 */
class m161208_115719_create_prsu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('prsu', [
            'id' => $this->primaryKey(),
            'drug_id' => $this->integer()->notNull(),
            'version' => $this->decimal(10,2),
            'version_description' => $this->string(),
            'prsu_file_url' => $this->string(),
            'ack_file_url' => $this->string(),
            'prsu_created_by' => $this->integer()->notNull(),
            'prsu_created_at' => $this->dateTime(),
            'ack_created_by' => $this->integer(),
            'ack_created_at' => $this->dateTime(),
            'next_prsu_date' => $this->date()
        ]);

        // creates index for column `drug_id`
        $this->createIndex(
            'idx-prsu-drug_id',
            'prsu',
            'drug_id'
        );

        // add foreign key for table `drug`
        $this->addForeignKey(
            'fk-prsu-drug_id',
            'prsu',
            'drug_id',
            'drug',
            'id',
            'CASCADE'
        );

        // creates index for column `prsu_created_by`
        $this->createIndex(
            'idx-prsu-prsu_created_by',
            'prsu',
            'prsu_created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-prsu-prsu_created_by',
            'prsu',
            'prsu_created_by',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `drug`
        $this->dropForeignKey(
            'fk-prsu-drug_id',
            'prsu'
        );

        // drops index for column `drug_id`
        $this->dropIndex(
            'idx-prsu-drug_id',
            'prsu'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-prsu-prsu_created_by',
            'prsu'
        );

        // drops index for column `prsu_created_by`
        $this->dropIndex(
            'idx-prsu-prsu_created_by',
            'prsu'
        );

        $this->dropTable('prsu');
    }
}
