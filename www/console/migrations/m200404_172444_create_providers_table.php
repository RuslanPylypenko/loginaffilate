<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%providers}}`.
 */
class m200404_172444_create_providers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%providers}}', [
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
        $this->dropTable('{{%providers}}');
    }
}
