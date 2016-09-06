<?php

use yii\db\Migration;

/**
 * Handles dropping reaction_country_id from table `icsr`.
 */
class m160906_175801_drop_reaction_country_id_column_from_icsr_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropForeignKey('fk_icsr_country','icsr');
        $this->dropIndex('fk_icsr_country_idx1', 'icsr');
        $this->dropColumn('icsr', 'reaction_country_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('icsr', 'reaction_country_id', $this->integer());
    }
}
