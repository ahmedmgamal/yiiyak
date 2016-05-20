<?php

use yii\db\Schema;
use yii\db\Migration;

class m160520_204314_create_table_lkp_time_unit extends Migration
{

    public function safeUp()
    {
        $this->execute("SET foreign_key_checks = 0;");
		$this->createTable('lkp_time_unit', array(
			'id'=>"int(11) NOT NULL",
			'name'=>"varchar(128) DEFAULT NULL",
			'PRIMARY KEY (id)' 
		    ), '');
		$this->createIndex('idx_name', 'lkp_time_unit', 'name', TRUE);
		$this->execute("SET foreign_key_checks = 1;");
    }
    
    public function safeDown()
    {
        
		$this->dropTable('lkp_time_unit');
    }

    /*
    public function up()
    {

    }

    public function down()
    {
        echo "m160520_204314_create_table_lkp_time_unit cannot be reverted.\n";

        return false;
    }
    */
    
}
