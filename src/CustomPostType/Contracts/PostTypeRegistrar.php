<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType\Contracts;

interface PostTypeRegistrar {
	public function register(PostType $post_type): void;
}