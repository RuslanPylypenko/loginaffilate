<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%casinos}}`.
 */
class m200402_185842_create_casinos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%casinos}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'country_id' => $this->integer(),
            'logo' => $this->string(),
            'background' => $this->string(),
            'website' => $this->string(),
            'description' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%casinos}}');
    }
}
