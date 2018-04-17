<?php

use yii\db\Migration;

/**
 * Class m180412_155939_add_icsr_status
 */
class m180412_155939_add_icsr_status extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('icsr', 'status', 'enum("real", "draft") DEFAULT "real"');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('icsr', 'status');
    }

}
