<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%license_assignments}}`.
 */
class m200404_112437_create_license_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%license_assignments}}', [
            'id' => $this->primaryKey(),
            'casino_id' => $this->integer(),
            'license_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%license_assignments}}');
    }
}
