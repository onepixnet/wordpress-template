<?php

declare( strict_types=1 );

namespace Onepix\Wordpress\CustomPostType\Contracts;

interface PostTypesRegistrar {
	public function register(): void;
}