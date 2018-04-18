<?php

use yii\db\Migration;

/**
 * Class m180225_170439_insert_guest_record_to_auth_item_table
 */
class m180225_170439_insert_guest_record_to_auth_item_table extends Migration
{
    /**
     * @inheritdoc
     */



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'guest',
            'type' => 1,
        ]);
    }

    public function down()
    {
        $this->delete('auth_item', ['name'=>'guest']);
    }

}
