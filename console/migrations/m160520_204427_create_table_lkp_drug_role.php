<?php

use yii\db\Schema;
use yii\db\Migration;

class m160520_204427_create_table_lkp_drug_role extends Migration
{

    public function safeUp()
    {
        $this->execute("SET foreign_key_checks = 0;");
		$this->createTable('lkp_drug_role', array(
			'id'=>"int(11) NOT NULL",
			'name'=>"varchar(128) DEFAULT NULL",
			'PRIMARY KEY (id)' 
		    ), '');
		$this->createIndex('idx_name', 'lkp_drug_role', 'name', TRUE);
		$this->execute("SET foreign_key_checks = 1;");
    }
    
    public function safeDown()
    {
        
		$this->dropTable('lkp_drug_role');
    }

    /*
    public function up()
    {

    }

    public function down()
    {
        echo "m160520_204427_create_table_lkp_drug_role cannot be reverted.\n";

        return false;
    }
    */
    
}
