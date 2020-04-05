<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currencies}}`.
 */
class m200404_174323_create_currencies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currencies}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string(),
            'status' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currencies}}');
    }
}
