<?php

use yii\db\Migration;

/**
 * Class m180205_132739_alter_auth_key_column_in_users_table
 */
class m180205_132739_alter_auth_key_column_in_users_table extends Migration
{



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('user', 'auth_key', 'varchar(300)');
    }

    public function down()
    {

        return false;
    }

}
