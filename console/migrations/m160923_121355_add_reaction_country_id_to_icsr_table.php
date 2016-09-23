<?php

use yii\db\Migration;

class m160923_121355_add_reaction_country_id_to_icsr_table extends Migration
{
    public function up()
    {
        $this->addColumn('icsr', 'reaction_country_id', $this->integer()->notNull()->defaultValue(1));
        $this->addForeignKey('fk_icsr_country','icsr','reaction_country_id','lkp_country','id','CASCADE');

    }

    public function down()
    {


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
