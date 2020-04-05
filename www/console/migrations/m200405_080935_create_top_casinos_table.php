<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%top_casinos}}`.
 */
class m200405_080935_create_top_casinos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%top_casinos}}', [
            'id' => $this->primaryKey(),
            'casino_id' => $this->integer(),
            'ord' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%top_casinos}}');
    }
}
