<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%advertising}}`.
 */
class m200621_142227_create_advertising_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%advertising}}', [
            'id' => $this->primaryKey(),
            'status' => $this->string(),
            'advertiser_id' => $this->integer(),
            'name' => $this->string(),
            'date_start' => $this->dateTime(),
            'date_end' => $this->dateTime()->null(),
            'paid_type' => $this->integer(),
            'price' => $this->integer()->null(),
            'bonus' => $this->integer()->null(),
            'budget' => $this->integer()->null(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%advertising}}');
    }
}
