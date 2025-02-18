<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\Closure\StaticClosureRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Strict\Rector\Ternary\DisallowedShortTernaryRuleFixerRector;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
	->withParallel()
	->withCache(__DIR__ . '/var/rector')
	->withPaths([
		__DIR__ . '/src',
		__DIR__ . '/tests',
		__DIR__ . '/di.php',
	])
	->withSets([
		LevelSetList::UP_TO_PHP_81,
	])
	->withTypeCoverageLevel(49) //to 49
	->withDeadCodeLevel(45) //to 45
	->withCodeQualityLevel(74) // to 74
	->withSets([
		SetList::CODING_STYLE,
		SetList::PRIVATIZATION,
		SetList::INSTANCEOF,
		SetList::EARLY_RETURN,
		SetList::STRICT_BOOLEANS,
	])
	->withRules([
		DeclareStrictTypesRector::class,
		StaticClosureRector::class
	])
	->withSkip([
		CatchExceptionNameMatchingTypeRector::class, // breaks snake_case rule in phpcs
		DisallowedShortTernaryRuleFixerRector::class, // Can be useful
		EncapsedStringsToSprintfRector::class, // Doesn't work properly with wpdb and phpstan hook check
	])
	->withImportNames( false, false, false, true );