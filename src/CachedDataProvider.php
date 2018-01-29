<?php
/**
 * @author Maxim Tyugaev <tugmaks@yandex.ru>
 */

declare(strict_types=1);

namespace Tugmaks\Dataprovider;

use yii\data\DataProviderInterface;

class CachedDataProvider implements DataProviderInterface
{
    /** @var DataProviderInterface */
    private $dataProvider;

    /**
     * @var CacheResolverInterface
     */
    private $cacheResolver;

    /**
     * CachedDataProvider constructor.
     * @param DataProviderInterface  $dataProvider
     * @param CacheResolverInterface $cacheResolver
     */
    public function __construct(DataProviderInterface $dataProvider, CacheResolverInterface $cacheResolver)
    {
        $this->dataProvider  = $dataProvider;
        $this->cacheResolver = $cacheResolver;
    }

    /**
     * @inheritDoc
     */
    public function prepare($forcePrepare = false)
    {
        return $this->cacheResolver->resolveDataByKey(
            \Closure::fromCallable([$this->dataProvider, 'prepare']),
            __METHOD__
        );
    }

    /**
     * @inheritDoc
     */
    public function getCount()
    {
        return $this->cacheResolver->resolveDataByKey(
            \Closure::fromCallable([$this->dataProvider, 'getCount']),
            __METHOD__
        );
    }

    /**
     * @inheritDoc
     */
    public function getTotalCount()
    {
        return $this->cacheResolver->resolveDataByKey(
            \Closure::fromCallable([$this->dataProvider, 'getTotalCount']),
            __METHOD__
        );
    }

    /**
     * @inheritDoc
     */
    public function getModels()
    {
        return $this->cacheResolver->resolveDataByKey(
            \Closure::fromCallable([$this->dataProvider, 'getModels']),
            __METHOD__
        );
    }

    /**
     * @inheritDoc
     */
    public function getKeys()
    {
        return $this->cacheResolver->resolveDataByKey(
            \Closure::fromCallable([$this->dataProvider, 'getKeys']),
            __METHOD__
        );
    }

    /**
     * @inheritDoc
     */
    public function getSort()
    {
        return $this->cacheResolver->resolveDataByKey(
            \Closure::fromCallable([$this->dataProvider, 'getSort']),
            __METHOD__
        );
    }

    /**
     * @inheritDoc
     */
    public function getPagination()
    {
        return $this->cacheResolver->resolveDataByKey(
            \Closure::fromCallable([$this->dataProvider, 'getPagination']),
            __METHOD__
        );
    }

}