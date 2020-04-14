<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%casino_deposit_systems}}`.
 */
class m200408_173934_create_casino_deposit_systems_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%casino_deposit_systems}}', [
            'id' => $this->primaryKey(),
            'casino_id' => $this->integer(),
            'payment_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%casino_deposit_systems}}');
    }
}
