<?php
/**
 * @author Maxim Tyugaev <tugmaks@yandex.ru>
 */

declare(strict_types=1);

namespace Tugmaks\Dataprovider;
use yii\web\Request;

/**
 * Class DefaultCacheKeyNamingStrategy
 * @package Tugmaks\Dataprovider
 */
class DefaultCacheKeyNamingStrategy implements CacheKeyNamingStrategy
{
    /**
     * @var string
     */
    private $keyPrefix;

    /**
     * @var string
     */
    private $requestHash;

    /**
     * DefaultCacheKeyNamingStrategy constructor.
     * @param string $keyPrefix
     */
    public function __construct(string $keyPrefix, Request $request)
    {
        $this->keyPrefix   = $keyPrefix;
        $this->requestHash = md5($request->getAbsoluteUrl());
    }

    /**
     * @inheritDoc
     */
    public function createFromCachingItemName(string $cachingItemName): string
    {
        return sprintf('%s.%s.%s', $this->keyPrefix, $cachingItemName, $this->requestHash);
    }
}