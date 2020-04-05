<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%casinos}}`.
 */
class m200404_092436_drop_country_id_column_from_casinos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('casinos', 'country_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('casinos', 'country_id', $this->integer());
    }
}
