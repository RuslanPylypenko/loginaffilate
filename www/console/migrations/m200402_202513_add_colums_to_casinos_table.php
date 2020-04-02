<?php

use yii\db\Migration;

/**
 * Class m200402_202513_add_colums_to_casinos_table
 */
class m200402_202513_add_colums_to_casinos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%casinos}}', 'url', $this->string());
        $this->addColumn('{{%casinos}}', 'status', $this->integer());
        $this->addColumn('{{%casinos}}', 'rating', $this->integer()->defaultValue(0));
        $this->addColumn('{{%casinos}}', 'is_top', $this->integer()->defaultValue(0));
        $this->addColumn('{{%casinos}}', 'is_advert', $this->integer()->defaultValue(0));
        $this->addColumn('{{%casinos}}', 'created_at', $this->dateTime());
        $this->addColumn('{{%casinos}}', 'updated_at', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%casinos}}', 'url');
        $this->dropColumn('{{%casinos}}', 'status');
        $this->dropColumn('{{%casinos}}', 'rating');
        $this->dropColumn('{{%casinos}}', 'is_top');
        $this->dropColumn('{{%casinos}}', 'is_advert');
        $this->dropColumn('{{%casinos}}', 'created_at');
        $this->dropColumn('{{%casinos}}', 'updated_at');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200402_202513_add_colums_to_casinos_table cannot be reverted.\n";

        return false;
    }
    */
}
