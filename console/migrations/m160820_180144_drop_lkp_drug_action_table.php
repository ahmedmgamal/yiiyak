<?php

use yii\db\Migration;

class m160820_180144_drop_lkp_drug_action_table extends Migration
{
    public function up()
    {
        $this->dropTable('lkp_drug_action');
    }

    public function down()
    {
        $this->createTable('lkp_drug_action', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)
        ]);
    }
}
