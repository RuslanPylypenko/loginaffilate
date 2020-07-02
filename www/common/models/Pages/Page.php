<?php

namespace common\models\Pages;

use common\models\Casino;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int status
 * @property string url
 * @property int entity_id
 * @property string entity_type
 * @property mixed|null updated_at
 * @property mixed|null created_at
 * @property mixed|null id
 * @property PageMeta meta
 */
class Page extends ActiveRecord
{
    const STATUS_ACTIVE = 1;

    const CASINO_TYPE = 'casino';

    public static function create(string $url, int $entityId, string $entityType): self
    {
        $page = new self();
        $page->status = self::STATUS_ACTIVE;
        $page->url = $url;
        $page->entity_id = $entityId;
        $page->entity_type = $entityType;
        return $page;
    }

    public static function createForCasino(Casino $casino): self
    {
        $page = new self();
        $page->status = self::STATUS_ACTIVE;
        $page->url = '/rating-casino/' . $casino->url;
        $page->entity_id = $casino->id;
        $page->entity_type = self::CASINO_TYPE;
        return $page;
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => date("Y-m-d H:i:s", time()),
            ]
        ];
    }

    public static function tableName()
    {
        return 'pages';
    }

    public function getUrl(): string
    {
        return '/url/sad';
    }

    public function getMeta()
    {
        return $this->hasOne(PageMeta::class, ['page_id' => 'id']);
    }
}