<?php

declare(strict_types=1);

namespace OnePix\WordPress;

use Illuminate\Container\Container;
use Illuminate\Config\Repository;

/**
 * @see https://laravel.com/docs/11.x/container
 */
function di(): Container {
    static $container = null;

    if ($container === null) {
        $container = new Container();

        $container->bind(App::class);

        /**
         * Bind classes with container.
         *
         * @see Container::bind()
         * @see Container::singleton()
         *
         * $container->bind(SomeInterface::class, SomeClassImplementingInterface::class);
         */

        /** Bind default components */
        $container = (require __DIR__ . '/vendor/onepix/wordpress-components/di.php')($container);
    }

    return $container;
}

/**
 * Use this function only in the di function for application configuration!
 */
function env(string $key, mixed $default = null): mixed
{
    static $configRepository = null;

    if ($configRepository === null) {
        $configData  = [];
        $configFiles = glob(__DIR__ . '/config/*.php');

        foreach ($configFiles as $file) {
            $configData[basename($file, '.php')] = require $file;
        }

        $configRepository = new Repository($configData);
    }

    return $configRepository->get($key, $default);
}
