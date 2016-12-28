<?php

use yii\db\Migration;

class m161204_075454_add_image_to_icsr_test extends Migration
{
    public function up()
    {
        $this->addColumn('icsr_test', 'image', $this->string());
    }

    public function down()
    {
        $this->dropColumn('icsr_test', 'image');

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
