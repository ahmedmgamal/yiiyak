<?php

use yii\db\Migration;

/**
 * Handles the creation of table `icsr_version_response`.
 * Has foreign keys to the tables:
 *
 * - `icsr_version`
 */
class m161008_183419_create_icsr_version_response_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('icsr_version_response', [
            'id' => $this->primaryKey(),
            'icsr_version_id' => $this->integer()->notNull(),
            'response' => $this->string(),
            'response_date' => $this->dateTime(),
        ]);

        // creates index for column `icsr_version_id`
        $this->createIndex(
            'idx-icsr_version_response-icsr_version_id',
            'icsr_version_response',
            'icsr_version_id'
        );

        // add foreign key for table `icsr_version`
        $this->addForeignKey(
            'fk-icsr_version_response-icsr_version_id',
            'icsr_version_response',
            'icsr_version_id',
            'icsr_version',
            'id'

        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `icsr_version`
        $this->dropForeignKey(
            'fk-icsr_version_response-icsr_version_id',
            'icsr_version_response'
        );

        // drops index for column `icsr_version_id`
        $this->dropIndex(
            'idx-icsr_version_response-icsr_version_id',
            'icsr_version_response'
        );

        $this->dropTable('icsr_version_response');
    }
}
