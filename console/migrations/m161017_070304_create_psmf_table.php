<?php

use yii\db\Migration;

/**
 * Handles the creation of table `psmf`.
 * Has foreign keys to the tables:
 *
 * - `company`
 * - `user`
 */
class m161017_070304_create_psmf_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('psmf', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'comment' => $this->text(),
            'version' => $this->integer(),
            'file_url' => $this->string(),
            'created_at' => $this->dateTime()
        ]);

        // creates index for column `company_id`
        $this->createIndex(
            'idx-psmf-company_id',
            'psmf',
            'company_id'
        );

        // add foreign key for table `company`
        $this->addForeignKey(
            'fk-psmf-company_id',
            'psmf',
            'company_id',
            'company',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id_id`
        $this->createIndex(
            'idx-psmf-user_id',
            'psmf',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-psmf-user_id',
            'psmf',
            'user_id',
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
        // drops foreign key for table `company`
        $this->dropForeignKey(
            'fk-psmf-company_id',
            'psmf'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-psmf-company_id',
            'psmf'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-psmf-user_id',
            'psmf'
        );

        // drops index for column `user_id_id`
        $this->dropIndex(
            'idx-psmf-user_id',
            'psmf'
        );

        $this->dropTable('psmf');
    }
}
