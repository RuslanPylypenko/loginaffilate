<?php

use yii\db\Migration;

/**
 * Class m200408_064557_uptate_casinos_table
 */
class m200408_064557_uptate_casinos_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('casinos', 'has_license', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('casinos', 'has_license');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200408_064557_uptate_casinos_table cannot be reverted.\n";

        return false;
    }
    */
}
