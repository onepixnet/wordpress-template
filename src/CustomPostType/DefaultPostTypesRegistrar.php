<?php

declare( strict_types=1 );

namespace Onepix\Wordpress\CustomPostType;

use Onepix\Wordpress\CustomPostType\Contracts\PostTypesRegistrar;
use Onepix\Wordpress\CustomPostType\Contracts\PostType;
use Psr\Container\ContainerInterface;

class DefaultPostTypesRegistrar implements PostTypesRegistrar {

	/**
	 * @param PostType[] $postTypes
	 * @param ContainerInterface $registrars
	 */
	public function __construct(
		private iterable $postTypes,
		private ContainerInterface $registrars,
	) {
	}

	final public function register(): void {
		foreach ($this->postTypes as $postTypes) {
			$this->registrars->get($postTypes->registrar())->register($postTypes);
		}
	}
}