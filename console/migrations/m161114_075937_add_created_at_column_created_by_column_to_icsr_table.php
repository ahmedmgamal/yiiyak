<?php

use yii\db\Migration;

/**
 * Handles adding created_at_column_created_by to table `icsr`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m161114_075937_add_created_at_column_created_by_column_to_icsr_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('icsr', 'created_at', $this->dateTime());
        $this->addColumn('icsr', 'updated_at', $this->dateTime());
        $this->addColumn('icsr', 'created_by', $this->integer()->notNull()->defaultValue(1));

        // creates index for column `created_by`
        $this->createIndex(
            'idx-icsr-created_by',
            'icsr',
            'created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-icsr-created_by',
            'icsr',
            'created_by',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-icsr-created_by',
            'icsr'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            'idx-icsr-created_by',
            'icsr'
        );

        $this->dropColumn('icsr', 'created_at');
        $this->dropColumn('icsr', 'updated_at');
        $this->dropColumn('icsr', 'created_by');
    }
}
