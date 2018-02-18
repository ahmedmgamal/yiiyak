<?php

use yii\db\Migration;

/**
 * Handles dropping username from table `user`.
 */
class m180218_163137_drop_username_column_from_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'username');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->addColumn('user', 'username', $this->varchar(255));
    }
}
