<?php

declare( strict_types=1 );

use Onepix\Wordpress\CustomPostType\DefaultPostTypesRegistrar;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

require_once __DIR__ . '/vendor/autoload.php';

$container = new ContainerBuilder();
$loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/config'));
$loader->load(__DIR__ . '/di.php');
$container->compile();

/**
 * @var DefaultPostTypesRegistrar $cpt_registrar
 */
$cpt_registrar = $container->get( DefaultPostTypesRegistrar::class);

$cpt_registrar->register();