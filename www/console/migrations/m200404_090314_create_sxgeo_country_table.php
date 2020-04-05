<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sxgeo_country}}`.
 */
class m200404_090314_create_sxgeo_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sxgeo_country}}', [
            'id' => $this->primaryKey(),
            'iso' => $this->string(),
            'continent' => $this->string(),
            'name' => $this->string(),
            'name_en' => $this->string(),
            'name_ru' => $this->string(),
            'name_uk' => $this->string(),
            'name_az' => $this->string(),
            'name_ka' => $this->string(),
            'name_cs' => $this->string(),
            'name_hy' => $this->string(),
            'name_pl' => $this->string(),
            'name_nl' => $this->string(),
            'name_fr' => $this->string(),
            'name_tr' => $this->string(),
            'name_de' => $this->string(),
            'name_et' => $this->string(),
            'name_sk' => $this->string(),
            'name_zh' => $this->string(),
            'name_it' => $this->string(),
            'lat' => $this->double(),
            'lon' => $this->double(),
            'timezone' => $this->string(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sxgeo_country}}');
    }
}
