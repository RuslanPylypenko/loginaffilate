<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%advertising_statistic}}`.
 */
class m200624_192101_create_advertising_statistic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%advertising_statistic}}', [
            'id' => $this->primaryKey(),
            'advert_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'action' => $this->string(),
            'amount' => $this->float()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%advertising_statistic}}');
    }
}
