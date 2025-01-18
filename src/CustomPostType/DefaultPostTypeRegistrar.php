<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

use Onepix\Wordpress\CustomPostType\Contracts\PostTypeRegistrar;
use Onepix\Wordpress\CustomPostType\Contracts\PostType;

final class DefaultPostTypeRegistrar implements PostTypeRegistrar {
	public function register( PostType $post_type ): void {
		register_post_type($post_type->getType(), $post_type->getSettings());
	}
}