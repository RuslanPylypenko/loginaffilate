<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page_meta}}`.
 */
class m200629_201808_create_page_meta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page_meta}}', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer(),
            'title' => $this->string(),
            'meta_title' => $this->string()->null(),
            'meta_description' => $this->text()->null(),
            'footer_title' => $this->string()->null(),
            'footer_text' => $this->text()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page_meta}}');
    }
}
