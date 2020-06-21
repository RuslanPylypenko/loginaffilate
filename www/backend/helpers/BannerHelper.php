<?php

namespace backend\helpers;

class BannerHelper
{
    public static function loadBlockList(): array
    {
        return [
            0 => 'Главная страница (0)',
            1 => 'Топ баннер (2)',
            3 => 'Банер номер 1 на странице слотов, после тринадцатого слота (1)',
            5 => 'Банер номер 2 на странице слотов, после тринадцатого слота (1)',
            4 => 'Банер номер 1 на странице слотов, после третьего слота (0)',
        ];
    }

    /**
     * @param int $blockId
     * @return string
     */
    public static function getBlock(int $blockId): string
    {
        $blocks = self::loadBlockList();

        if (!isset($blocks[$blockId])) {
            throw new \InvalidArgumentException('Block not found');
        }

        return $blocks[$blockId];
    }
}