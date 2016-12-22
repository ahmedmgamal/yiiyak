<?php

use yii\db\Migration;

/**
 * Handles the creation of table `exports_history`.
 */
class m161222_160110_create_exports_history_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('exports_history', [
            'id' => $this->primaryKey(),
            'created_by'=>$this->integer(),
            'creation_date'=>$this->date(),
            'file_size'=>$this->integer(),
            'drugs_number'=>$this->integer(),
            'icsrs_number'=>$this->integer(),
            'file_path'=>$this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('exports_history');
    }
}
