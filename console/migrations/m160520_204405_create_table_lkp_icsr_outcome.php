<?php

use yii\db\Schema;
use yii\db\Migration;

class m160520_204405_create_table_lkp_icsr_outcome extends Migration
{

    public function safeUp()
    {
        $this->execute("SET foreign_key_checks = 0;");
		$this->createTable('lkp_icsr_outcome', array(
			'id'=>"int(11) NOT NULL AUTO_INCREMENT",
			'description'=>"varchar(512) DEFAULT NULL",
			'PRIMARY KEY (id)' 
		    ), '');
		$this->execute("SET foreign_key_checks = 1;");
    }
    
    public function safeDown()
    {
        
		$this->dropTable('lkp_icsr_outcome');
    }

    /*
    public function up()
    {

    }

    public function down()
    {
        echo "m160520_204405_create_table_lkp_icsr_outcome cannot be reverted.\n";

        return false;
    }
    */
    
}
