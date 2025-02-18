<?php

declare( strict_types=1 );

namespace OnePix\WordPress;

use Illuminate\Container\Container;

/**
 * @see https://laravel.com/docs/11.x/container
 */
function di(): Container {
    static $container = null;

    if ( $container === null ) {
        $container = new Container();

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
    }

    return $container;
}