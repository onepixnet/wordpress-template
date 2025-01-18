<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

use OnePix\WordPress\CustomPostType\Contracts\PostTypeRegistrar;
use OnePix\WordPress\CustomPostType\Contracts\PostType;

final class DefaultPostTypeRegistrar implements PostTypeRegistrar {
	public function register( PostType $post_type ): void {
		register_post_type($post_type->getType(), $post_type->getSettings());
	}
}