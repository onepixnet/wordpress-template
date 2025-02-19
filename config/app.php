<?php

declare(strict_types=1);

return [
    'id' => 'wordpress-template',
    'version' => '0.1.0',
    'appPath' => dirname(__DIR__),
    'translationsPath' => dirname(__DIR__) . '/languages',
    'templatesPath' => dirname(__DIR__) . '/templates/',
    'isDev' => true, //ToDo: Move this to .env
];