<?php
/**
 * Plugin name: OnePix Template for WordPress
 * Description: Modern template for WordPress plugin development
 * Requires Plugins:
 * Domain Path: /languages
 * Version: 0.1.0
 */

declare(strict_types=1);

namespace OnePix\WordPress;

require __DIR__ . '/vendor/autoload.php';

di()->make(App::class)->run();