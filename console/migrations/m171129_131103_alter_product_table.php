<?php

use yii\db\Migration;

/**
 * Class m171129_131103_alter_product_table
 */
class m171129_131103_alter_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function Up()
    {
        $this->addColumn('drug', 'country_id', 'integer AFTER id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m171129_131103_alter_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171129_131103_alter_product_table cannot be reverted.\n";

        return false;
    }
    */
}
