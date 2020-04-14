<?php

use yii\db\Migration;

/**
 * Class m200408_064517_delete_license_assignments_table
 */
class m200408_064517_delete_license_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%license_assignments}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%license_assignments}}', [
            'id' => $this->primaryKey(),
            'casino_id' => $this->integer(),
            'license_id' => $this->integer(),
        ]);

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200408_064517_delete_license_assignments_table cannot be reverted.\n";

        return false;
    }
    */
}
