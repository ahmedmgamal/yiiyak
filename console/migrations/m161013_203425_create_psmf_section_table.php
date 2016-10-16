<?php

use yii\db\Migration;

/**
 * Handles the creation of table `psmf_section`.
 * Has foreign keys to the tables:
 *
 * - `psmf_company`
 */
class m161013_203425_create_psmf_section_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('psmf_section', [
            'id' => $this->primaryKey(),
            'psmf_id' => $this->integer()->notNull(),
            'section_name' => $this->string(),
            'section_content' => $this->text(),
        ]);

        // creates index for column `psmf_id`
        $this->createIndex(
            'idx-psmf_section-psmf_id',
            'psmf_section',
            'psmf_id'
        );

        // add foreign key for table `psmf_company`
        $this->addForeignKey(
            'fk-psmf_section-psmf_id',
            'psmf_section',
            'psmf_id',
            'psmf_company',
            'psmf_id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `psmf_company`
        $this->dropForeignKey(
            'fk-psmf_section-psmf_id',
            'psmf_section'
        );

        // drops index for column `psmf_id`
        $this->dropIndex(
            'idx-psmf_section-psmf_id',
            'psmf_section'
        );

        $this->dropTable('psmf_section');
    }
}
