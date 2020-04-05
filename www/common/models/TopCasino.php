<?php

namespace common\models;


use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "top_casinos".
 *
 * @property int $id
 * @property int|null $casino_id
 * @property int|null $ord
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property Casino casino
 */
class TopCasino extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'top_casinos';
    }

    public static function find()
    {
        return parent::find()->orderBy(['ord' => SORT_ASC]);
    }


    public static function create($casinoId): self
    {
        $topCasino = new self();
        $topCasino->casino_id = $casinoId;
        return $topCasino;
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => date("Y-m-d H:i:s", time()),
            ],
        ];
    }

    public function isFirst(): bool
    {
        return $this->ord == 1;
    }

    public function isLast(): bool
    {
        return $this->ord == self::find()->count();
    }

    public function addToTopList(Casino $casino)
    {
        if ($casino->isTop()) {
            throw new \DomainException('Казино уже добавлено в топ лист');
        }

        if (!$casino->isActive()) {
            throw new \DomainException('Черновик невозможно добавить в топ');
        }

        $countTopCasino = TopCasino::find()->count();

        if ($countTopCasino >= Yii::$app->params['maxTopCasinoCount']) {
            throw new \DomainException(
                "Вы не можете добавить в топ больше чем " . Yii::$app->params['maxTopCasinoCount'] . ' казино.'
            );
        }

        $this->ord = ($countTopCasino + 1);
    }

    public function moveUp()
    {
        if ($this->isFirst()) {
            throw new \DomainException('Казино уже на 1 месте');
        }
        $this->ord--;
    }

    public function moveDown()
    {
        if ($this->isLast()) {
            throw new \DomainException('Казино уже на последнем месте');
        }
        $this->ord++;
    }


    public function getCasino()
    {
        return $this->hasOne(Casino::class, ['id' => 'casino_id']);
    }


}
