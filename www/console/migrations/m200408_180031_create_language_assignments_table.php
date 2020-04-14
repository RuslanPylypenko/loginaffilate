<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%language_assignments}}`.
 */
class m200408_180031_create_language_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%language_assignments}}', [
            'id' => $this->primaryKey(),
            'casino_id' => $this->integer(),
            'language_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%language_assignments}}');
    }
}
