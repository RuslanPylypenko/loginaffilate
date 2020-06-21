<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%advert_banner}}`.
 */
class m200621_142257_create_advert_banner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%advert_banner}}', [
            'id' => $this->primaryKey(),
            'advert_id' => $this->integer()->notNull(),
            'block_id' => $this->integer(),
            'photo' => $this->string(),
            'link' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%advert_banner}}');
    }
}
