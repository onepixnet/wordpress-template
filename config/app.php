<?php

declare(strict_types=1);

use function OnePix\WordPress\env;

return [
    'id' => 'wordpress-template',
    'version' => '0.1.0',
    'appPath' => dirname(__DIR__),
    'translationsPath' => dirname(__DIR__) . '/languages',
    'templatesPath' => dirname(__DIR__) . '/templates/',
    'isDev' => env('WP_ENV', 'development') === 'development'
];