<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%licenses}}`.
 */
class m200404_105147_create_licenses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%licenses}}', [
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
        $this->dropTable('{{%licenses}}');
    }
}
