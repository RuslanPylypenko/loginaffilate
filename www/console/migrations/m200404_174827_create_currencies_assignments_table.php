<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currencies_assignments}}`.
 */
class m200404_174827_create_currencies_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currencies_assignments}}', [
            'id' => $this->primaryKey(),
            'casino_id' => $this->integer(),
            'currency_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currencies_assignments}}');
    }
}
