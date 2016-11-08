<?php

use yii\db\Migration;

/**
 * Handles the creation of table `icsr_narritive`.
 * Has foreign keys to the tables:
 *
 * - `icsr`
 */
class m161024_102937_create_icsr_narritive_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('icsr_narritive', [
            'id' => $this->primaryKey(),
            'icsr_id' => $this->integer()->notNull(),
            'narritive' => $this->string(20000),
            'reporter_comment' => $this->string(500),
            'sender_comment' => $this->string(2000),
        ]);

        // creates index for column `icsr_id`
        $this->createIndex(
            'idx-icsr_narritive-icsr_id',
            'icsr_narritive',
            'icsr_id'
        );

        // add foreign key for table `icsr`
        $this->addForeignKey(
            'fk-icsr_narritive-icsr_id',
            'icsr_narritive',
            'icsr_id',
            'icsr',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `icsr`
        $this->dropForeignKey(
            'fk-icsr_narritive-icsr_id',
            'icsr_narritive'
        );

        // drops index for column `icsr_id`
        $this->dropIndex(
            'idx-icsr_narritive-icsr_id',
            'icsr_narritive'
        );

        $this->dropTable('icsr_narritive');
    }
}
