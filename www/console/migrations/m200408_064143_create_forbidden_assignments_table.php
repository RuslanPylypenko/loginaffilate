<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%forbidden_assignments}}`.
 */
class m200408_064143_create_forbidden_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%forbidden_countries_assignments}}', [
            'id' => $this->primaryKey(),
            'casino_id' => $this->integer(),
            'country_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%forbidden_countries_assignments}}');
    }
}
