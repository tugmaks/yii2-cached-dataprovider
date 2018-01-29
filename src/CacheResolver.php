<?php
/**
 * @author Maxim Tyugaev <tugmaks@yandex.ru>
 */

declare(strict_types=1);

namespace Tugmaks\Dataprovider;

use yii\caching\CacheInterface;
use yii\caching\Dependency;

/**
 * Class CacheResolver
 * @package Tugmaks\Dataprovider
 */
class CacheResolver implements CacheResolverInterface
{
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var Dependency
     */
    private $dependency;

    /**
     * @var CacheKeyNamingStrategy
     */
    private $keyNamingStrategy;

    /**
     * Cache ttl
     *
     * @var int
     */
    private $ttl;

    /**
     * CacheResolver constructor.
     * @param CacheInterface         $cache
     * @param CacheKeyNamingStrategy $keyNamingStrategy
     * @param null|Dependency        $dependency
     */
    public function __construct(
        CacheInterface $cache,
        CacheKeyNamingStrategy $keyNamingStrategy,
        int $ttl = null,
        Dependency $dependency = null
    ) {
        $this->cache             = $cache;
        $this->dependency        = $dependency;
        $this->keyNamingStrategy = $keyNamingStrategy;
    }

    /**
     * @inheritDoc
     */
    public function resolveDataByKey(callable $data, $key)
    {
        return $this->cache->getOrSet(
            $this->keyNamingStrategy->createFromCachingItemName($key),
            $data,
            $this->ttl,
            $this->dependency
        );
    }
}