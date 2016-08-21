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
    }

    public function down()
    {
        $this->dropTable('lkp_drug_action');
    }
}
