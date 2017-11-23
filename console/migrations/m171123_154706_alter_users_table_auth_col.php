<?php

use yii\db\Migration;

/**
 * Class m171123_154706_alter_users_table_auth_col
 */
class m171123_154706_alter_users_table_auth_col extends Migration
{
    /**
     * @inheritdoc
     */
    public function Up()
    {
        $this->addColumn('user', 'auth', 'tinyint AFTER id');
    }

    /**
     * @inheritdoc
     */
    public function Down()
    {
        echo "m171123_154706_alter_users_table_auth_col cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171123_154706_alter_users_table_auth_col cannot be reverted.\n";

        return false;
    }
    */
}
