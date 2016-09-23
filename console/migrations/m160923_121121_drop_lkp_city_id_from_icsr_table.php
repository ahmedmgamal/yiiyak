<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `lkp_city_id_from_icsr`.
 */
class m160923_121121_drop_lkp_city_id_from_icsr_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropForeignKey('fk-lkp_city_icsr','icsr');
        $this->dropColumn('icsr', 'lkp_city_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {

    }
}
