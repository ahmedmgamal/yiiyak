<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lkp_city`.
 */
class m160906_174946_create_lkp_city_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('lkp_city', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $seeds = array('Alexandria' , 'Cairo' , 'Sohag' ,
            'Mansoura' , 'Tanta' , 'Ismalia','El Shrkya');

        foreach ($seeds as $key => $value)
            $this->insert('lkp_city',['name' => "{$value}"]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('lkp_city');
    }
}
