<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_role`.
 */
class m160827_155617_create_user_role_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_role', [
            'user_id' => $this->integer(),
            'role_id' => $this->integer(),

        ]);

        $this->addForeignKey('fk-user_role-role_id','user_role','role_id','role','id','CASCADE');
        $this->addForeignKey('fk-user_role-user_id','user_role','user_id','user','id','CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-user_role-user_id',
            'user_role'
        );

        $this->dropForeignKey(
            'fk-user_role-role_id',
            'user_role'
        );
        $this->dropTable('user_role');
    }
}
