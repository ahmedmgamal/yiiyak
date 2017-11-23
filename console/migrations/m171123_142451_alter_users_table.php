<?php

use yii\db\Migration;

/**
 * Class m171123_142451_alter_users_table
 */
class m171123_142451_alter_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'twofa_secret', 'VARCHAR(64) AFTER id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m171123_142451_alter_users_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171123_142451_alter_users_table cannot be reverted.\n";

        return false;
    }
    */
}
