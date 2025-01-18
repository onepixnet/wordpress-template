<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$testsDir = getenv('WORDPRESS_TEST_DIR');

if (! file_exists("{$testsDir}/includes/functions.php")) {
	echo "Could not find {$testsDir}/includes/functions.php, have you run WordPress tests library ?" . PHP_EOL;
	exit(1);
}

// Give access to tests_add_filter() function.
require_once "{$testsDir}/includes/functions.php";

// Start up the WP testing environment.
require_once "{$testsDir}/includes/bootstrap.php";
