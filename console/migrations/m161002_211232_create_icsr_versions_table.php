<?php

use yii\db\Migration;

/**
 * Handles the creation of table `icsr_versions`.
 * Has foreign keys to the tables:
 *
 * - `icsr`
 */
class m161002_211232_create_icsr_versions_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('icsr_version', [
            'id' => $this->primaryKey(),
            'icsr_id' => $this->integer()->notNull(),
            'file_name' => $this->string(),
            'file_url' => $this->string(),
        ]);

        // creates index for column `icsr_id`
        $this->createIndex(
            'idx-icsr_version-icsr_id',
            'icsr_version',
            'icsr_id'
        );

        // add foreign key for table `icsr`
        $this->addForeignKey(
            'fk-icsr_version-icsr_id',
            'icsr_version',
            'icsr_id',
            'icsr',
            'id'

        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `icsr`
        $this->dropForeignKey(
            'fk-icsr_version-icsr_id',
            'icsr_version'
        );

        // drops index for column `icsr_id`
        $this->dropIndex(
            'idx-icsr_version-icsr_id',
            'icsr_version'
        );

        $this->dropTable('icsr_version');
    }
}
