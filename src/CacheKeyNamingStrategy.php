<?php
/**
 * @author Maxim Tyugaev <tugmaks@yandex.ru>
 */

declare(strict_types=1);

namespace Tugmaks\Dataprovider;

/**
 * Interface CacheKeyNamingStrategy
 * @package Tugmaks\Dataprovider
 */
interface CacheKeyNamingStrategy
{
    /**
     * @param string $cachingItemName
     * @return string
     */
    public function createFromCachingItemName(string $cachingItemName): string;
}