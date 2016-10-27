<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meddra_hlt_pt`.
 */
class m161027_060813_create_meddra_hlt_pt_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('meddra_hlt_pt', [
            'hlt_id' => $this->bigInteger()->notNull()->unsigned(),
            'pt_id' => $this->bigInteger()->notNull()->unsigned(),
        ]);

        $this->createIndex(
            'ix1_hlt_pt01',
            'meddra_hlt_pt',
            'hlt_id'
        );

        $this->createIndex(
            'ix1_hlt_pt02',
            'meddra_hlt_pt',
            'pt_id'
        );


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meddra_hlt_pt');
    }
}
