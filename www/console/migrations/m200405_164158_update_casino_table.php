<?php

use yii\db\Migration;

/**
 * Class m200405_164158_update_casino_table
 */
class m200405_164158_update_casino_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $this->dropColumn('casinos', 'logo');
        $this->dropColumn('casinos', 'is_top');
        $this->addColumn('casinos', 'website_options', $this->json()->null());
        $this->addColumn('casinos', 'logo_main', $this->string());
        $this->addColumn('casinos', 'logo_small', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('casinos', 'logo', $this->string());
        $this->addColumn('casinos', 'is_top', $this->integer());
        $this->dropColumn('casinos', 'website_options');
        $this->dropColumn('casinos', 'logo_main');
        $this->dropColumn('casinos', 'logo_small');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200405_164158_update_casino_table cannot be reverted.\n";

        return false;
    }
    */
}
