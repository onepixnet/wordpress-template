<?php

declare( strict_types=1 );

namespace Onepix\Wordpress\CustomPostType;

use Onepix\Wordpress\CustomPostType\Contracts\PostType;
use Onepix\Wordpress\CustomPostType\Contracts\PostTypeRegistrar;
use Onepix\Wordpress\CustomPostType\Contracts\PostTypesRegistrar;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_locator;

return static function (ContainerConfigurator $di, ContainerBuilder $builder): void {
	$builder->registerForAutoconfiguration(PostType::class)
	        ->addTag(PostType::class);

	$builder->registerForAutoconfiguration(PostTypeRegistrar::class)
	        ->addTag(PostTypeRegistrar::class);

	$di->services()
	    ->defaults()
	        ->autowire()
			->autoconfigure()
	    ->set(PostTypeRegistrar::class, DefaultPostTypeRegistrar::class)
	    ->set(PostTypesRegistrar::class, DefaultPostType::class)
	    ->set(DefaultPostTypesRegistrar::class)
			->args([
				'$postTypes' => tagged_iterator(PostType::class, exclude: [
					DefaultPostType::class
				]),
				'$registrars' => tagged_locator( PostTypeRegistrar::class )
 			])
			->public();
};