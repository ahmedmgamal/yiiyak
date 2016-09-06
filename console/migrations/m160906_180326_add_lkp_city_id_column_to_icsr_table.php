<?php

use yii\db\Migration;

/**
 * Handles adding lkp_city_id to table `icsr`.
 */
class m160906_180326_add_lkp_city_id_column_to_icsr_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
       $this->execute("UPDATE  icsr SET icsr.patient_birth_date = '1993-09-18' WHERE icsr.patient_birth_date IS NULL  ");
        $this->addColumn('icsr', 'lkp_city_id', $this->integer()->notNull()->defaultValue(1));
        $this->addForeignKey('fk-lkp_city_icsr','icsr','lkp_city_id','lkp_city','id','CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('icsr', 'lkp_city_id');
    }
}
