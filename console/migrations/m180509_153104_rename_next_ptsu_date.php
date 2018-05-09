<?php

use yii\db\Migration;

/**
 * Class m180509_153104_rename_next_ptsu_date
 */
class m180509_153104_rename_next_ptsu_date extends Migration
{



    public function up()
    {
        $this->renameColumn('drug', 'next_prsu_date', 'next_pbrer_date');
    }

    public function down()
    {
        $this->renameColumn('drug', 'next_pbrer_date', 'next_prsu_date');
    }

}
