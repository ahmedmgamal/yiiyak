<?php

use yii\db\Migration;

/**
 * Handles the creation of table `psmf_company`.
 * Has foreign keys to the tables:
 *
 * - `company`
 */
class m161013_203024_create_psmf_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('psmf_company', [
            'psmf_id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'version' => $this->integer(),
        ]);

        // creates index for column `company_id`
        $this->createIndex(
            'idx-psmf_company-company_id',
            'psmf_company',
            'company_id'
        );

        // add foreign key for table `company`
        $this->addForeignKey(
            'fk-psmf_company-company_id',
            'psmf_company',
            'company_id',
            'company',
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
            'fk-psmf_company-company_id',
            'psmf_company'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-psmf_company-company_id',
            'psmf_company'
        );

        $this->dropTable('psmf_company');
    }
}
