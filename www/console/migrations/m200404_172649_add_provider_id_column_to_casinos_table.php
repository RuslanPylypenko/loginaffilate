<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%casinos}}`.
 */
class m200404_172649_add_provider_id_column_to_casinos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('casinos', 'provider_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('casinos', 'provider_id');
    }
}
