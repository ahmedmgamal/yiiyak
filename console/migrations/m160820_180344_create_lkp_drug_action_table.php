<?php

use yii\db\Migration;

class m160820_180344_create_lkp_drug_action_table extends Migration
{
    public function up()
    {
        $this->createTable('lkp_drug_action', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)
        ]);

        $seeds = array('Drug withdrawn' , 'Dose reduced' , 'Dose increased' ,
                        'Dose not changed' , 'Unknown' , 'Not applicable');

        foreach ($seeds as $key => $value)
        $this->insert('lkp_drug_action',['name' => "{$value}"]);
    }

    public function down()
    {
        $this->dropTable('lkp_drug_action');
    }
}
