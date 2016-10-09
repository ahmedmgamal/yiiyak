<?php

use yii\db\Migration;

class m161004_121853_add_foreign_key_to_icsr_version_table extends Migration
{
    public function up()
    {
        $this->alterColumn('icsr_version','exported_by','integer');
        $this->addForeignKey('fk_icsr_version_user','icsr_version','exported_by','user','id');

    }

    public function down()
    {
        echo "m161004_121853_add_foreign_key_to_icsr_version_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
