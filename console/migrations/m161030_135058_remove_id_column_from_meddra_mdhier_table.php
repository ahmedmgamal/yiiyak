<?php

use yii\db\Migration;

class m161030_135058_remove_id_column_from_meddra_mdhier_table extends Migration
{
    public function up()
    {
        $this->dropColumn('meddra_mdhier', 'id');
    }

    public function down()
    {

    }

}
