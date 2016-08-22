<?php

use yii\db\Migration;

class m160820_180914_add_drug_action_column_to_drug_prescription extends Migration
{
    public function up()
    {
        $this->addColumn('drug_prescription', 'lkp_drug_action_id', $this->integer()->notNull()->defaultValue(1));
        $this->addForeignKey('fk-drug-prescription-drug_action','drug_prescription','lkp_drug_action_id','lkp_drug_action','id','CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-drug-prescription-drug_action',
            'drug_prescription'
        );
        $this->dropColumn('drug_prescription', 'lkp_drug_action_id');
    }
}
