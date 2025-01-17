<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

class WordPressPostTypeRegistrar implements PostTypeRegistrar {

	public function register( string $postType, array $settings ): void {
		register_post_type($postType, $settings);
	}
}