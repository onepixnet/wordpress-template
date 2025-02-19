<?php

declare(strict_types=1);

namespace OnePix\WordPress;

use Illuminate\Container\Container;
use Illuminate\Config\Repository;
use RuntimeException;

/**
 * @see https://laravel.com/docs/11.x/container
 */
function di(): Container {
    static $container        = null;
    static $configRepository = null;

    if ($configRepository === null) {
        $configData  = [];
        $configFiles = glob(__DIR__ . '/config/*.php');

        foreach ($configFiles as $file) {
            $configData[basename($file, '.php')] = require $file;
        }

        $configRepository = new Repository($configData);
    }

    if ($container === null) {
        $container = new Container();

        $container->singleton('config', fn() => $configRepository);
        $container->singleton(App::class);

        /**
         * Bind classes with container.
         *
         * @see Container::bind()
         * @see Container::singleton()
         *
         * $container->bind(SomeInterface::class, SomeClassImplementingInterface::class);
         */

        /** Bind default components */
        /** @var Container $container */
        $container = (require __DIR__ . '/vendor/onepix/wordpress-components/di.php')($container);

        /** Primitives from config for default components */
        $container->when(\OnePix\WordPressComponents\RewriteRulesManager::class)->needs('$optionPrefix')->giveConfig('app.id');

        $container->when(\OnePix\WordPressComponents\ScriptsRegistrar::class)->needs('$translationDomain')->giveConfig('app.id');
        $container->when(\OnePix\WordPressComponents\ScriptsRegistrar::class)->needs('$translationsPath')->giveConfig('app.translationsPath');

        $container->when(\OnePix\WordPressComponents\TemplatesManager::class)->needs('$templatesPath')->giveConfig('app.templatesPath');
        $container->when(\OnePix\WordPressComponents\TemplatesManager::class)->needs('$isDev')->giveConfig('app.isDev');
    }

    return $container;
}

/**
 * Use this function only in config files!
 */
function env(string $key, string $default = null): string
{
    static $env = null;

    if ($env === null) {
        if (!file_exists(__DIR__ . '/.env')) {
            throw new RuntimeException('.env file not found! Copy .env.example to .env and configure your app before booting');
        }

        $env = parse_ini_file(__DIR__ . '/.env');
    }

    return array_key_exists($key, $env) ? $env[$key] : $default;
}
