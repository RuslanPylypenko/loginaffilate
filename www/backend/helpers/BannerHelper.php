<?php

namespace backend\helpers;

class BannerHelper
{
    public static function loadBlockList(): array
    {
        return [
            1 => 'Баннер под меню',
            2 => 'Баннер сайдбар 1',
            3 => 'Баннер сайдбар 2',
            4 => 'Баннер сайдбар 3',
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