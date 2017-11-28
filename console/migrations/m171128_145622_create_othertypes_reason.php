<?php

use yii\db\Migration;

/**
 * Class m171128_145622_create_othertypes_reason
 */
class m171128_145622_create_othertypes_reason extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->createTable('other_types', [
            'id' => $this->primaryKey(),
            'icsr_id' => $this->integer()->notNull(),
            'description' => $this->string(2000),

        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171128_145622_create_othertypes_reason cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171128_145622_create_othertypes_reason cannot be reverted.\n";

        return false;
    }
    */
}
