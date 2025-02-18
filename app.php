<?php

declare(strict_types=1);

namespace OnePix\WordPress;

require __DIR__ . '/vendor/autoload.php';

di()->make(App::class)->run();