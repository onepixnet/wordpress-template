<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$testDir = getenv('WORDPRESS_TEST_DIR');

if (! file_exists("{$testDir}/includes/functions.php")) {
	echo "Could not find {$testDir}/includes/functions.php, have you run WordPress tests library ?" . PHP_EOL;
	exit(1);
}

// Give access to tests_add_filter() function.
require_once "{$testDir}/includes/functions.php";

// Start up the WP testing environment.
require_once "{$testDir}/includes/bootstrap.php";
