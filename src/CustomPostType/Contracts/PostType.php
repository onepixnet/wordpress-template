<?php

declare( strict_types=1 );

namespace Onepix\Wordpress\CustomPostType\Contracts;

interface PostType {
	/**
	 * Method made static for potential lazy loading.
	 *
	 * @return class-string<PostTypeRegistrar>
	 */
	public static function registrar():string;

	public function getType(): string;

	public function getSettings(): array;
}