Yii2 DataProvider caching decorator
====================
Simple decorator for dataprovider

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist tugmaks/yii2-cached-dataprovider "0.1"
```

or add

```
"tugmaks/yii2-cached-dataprovider": "0.1"
```

to the require section of your `composer.json` file.


Usage example
-----

First, you need to configure CacheResolver service in container

```php
'singletons' => [
        'cache'                               => function () {
            return \Yii::$app->cache;
        },
        'cache_resolver.naming_strategy.caching_item_name' => [
            ['class' => \Tugmaks\Dataprovider\DefaultCacheKeyNamingStrategy::class],
            [
                'caching_item_name',
            ],
        ],
        'cache_resolver.caching_item_name'                 => [
            ['class' => \Tugmaks\Dataprovider\CacheResolver::class],
            [
                Instance::of('cache'),
                Instance::of('cache_resolver.naming_strategy.caching_item_name'),
                //Additionally you can pass cache ttl and dependecy
            ],
        ],
    ],
```

Second, instead of passing yii\data\DataProviderInterface object directly to data widget, you have to decorate it in this way:

```php
use use Tugmaks\Dataprovider\CachedDataProvider;

$cacheResolver = \Yii::$container->get('cache_resolver.caching_item_name');

$cachedDataProvider = new CachedDataProvider($dataProvider, $cacheResolver);
```

Now pass $cachedDataProvider to data widget.