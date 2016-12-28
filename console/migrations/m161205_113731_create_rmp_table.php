<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rmp`.
 * Has foreign keys to the tables:
 *
 * - `drug`
 * - `user`
 */
class m161205_113731_create_rmp_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('rmp', [
            'id' => $this->primaryKey(),
            'drug_id' => $this->integer()->notNull(),
            'version' => $this->decimal(10,2),
            'version_description' => $this->string(),
            'rmp_file_url' => $this->string(),
            'ack_file_url' => $this->string(),
            'rmp_created_by' => $this->integer()->notNull(),
            'rmp_created_at' => $this->dateTime(),
            'ack_created_by' => $this->integer(),
            'ack_created_at' => $this->dateTime(),
        ]);

        // creates index for column `drug_id`
        $this->createIndex(
            'idx-rmp-drug_id',
            'rmp',
            'drug_id'
        );

        // add foreign key for table `drug`
        $this->addForeignKey(
            'fk-rmp-drug_id',
            'rmp',
            'drug_id',
            'drug',
            'id',
            'CASCADE'
        );

        // creates index for column `rmp_created_by`
        $this->createIndex(
            'idx-rmp-rmp_created_by',
            'rmp',
            'rmp_created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-rmp-rmp_created_by',
            'rmp',
            'rmp_created_by',
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
            'fk-rmp-drug_id',
            'rmp'
        );

        // drops index for column `drug_id`
        $this->dropIndex(
            'idx-rmp-drug_id',
            'rmp'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-rmp-rmp_created_by',
            'rmp'
        );

        // drops index for column `rmp_created_by`
        $this->dropIndex(
            'idx-rmp-rmp_created_by',
            'rmp'
        );

        $this->dropTable('rmp');
    }
}
