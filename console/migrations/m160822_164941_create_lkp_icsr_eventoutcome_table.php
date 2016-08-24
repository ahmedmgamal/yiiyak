<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lkp_icsr_eventoutcome`.
 */
class m160822_164941_create_lkp_icsr_eventoutcome_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('lkp_icsr_eventoutcome', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $seeds = array('recovered/resolved' , 'recovering/resolving' , 'not recovered/not resolved' ,
            'recovered/resolved with sequelae' , 'fatal' , 'unknown3 ');

        foreach ($seeds as $key => $value)
            $this->insert('lkp_icsr_eventoutcome',['name' => "{$value}"]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('lkp_icsr_eventoutcome');
    }
}
