<?php
/**
 * @author Maxim Tyugaev <tugmaks@yandex.ru>
 */

declare(strict_types=1);

namespace Tugmaks\Dataprovider;


/**
 * Interface CacheSettingsInterface
 * @package Tugmaks\Dataprovider
 */
interface CacheResolverInterface
{

    /**
     * @param $data
     * @param $key
     * @return mixed
     */
    public function resolveDataByKey(callable $data, $key);
}