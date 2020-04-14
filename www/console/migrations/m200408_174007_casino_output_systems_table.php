<?php

use yii\db\Migration;

/**
 * Class m200408_174007_casino_output_systems_table
 */
class m200408_174007_casino_output_systems_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%casino_output_systems}}', [
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
        $this->dropTable('{{%casino_output_systems}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200408_174007_casino_output_systems_table cannot be reverted.\n";

        return false;
    }
    */
}
