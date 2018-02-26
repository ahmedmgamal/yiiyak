<?php

use yii\db\Migration;

/**
 * Class m180226_211524_add_perrmssions_to_Guest
 */
class m180226_211524_add_perrmssions_to_Guest extends Migration
{
    /**
     * @inheritdoc
     */

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        /* create */
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr/create',
        ]);
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr-reporter/create',
        ]);
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr-test/create',
        ]);
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr-event/create',
        ]);

        /*update */
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr/update',
        ]);
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr-reporter/update',
        ]);
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr-test/update',
        ]);
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr-event/update',
        ]);

        /* delete */
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr/delete',
        ]);
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr-reporter/delete',
        ]);
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr-test/delete',
        ]);
        $this->insert('auth_item_child', [
            'parent' => 'Guest',
            'child' => '/crud/icsr-event/delete',
        ]);
    }

    public function down()
    {
        $this->delete('auth_item_child', ['parent'=>'Guest']);
    }

}
