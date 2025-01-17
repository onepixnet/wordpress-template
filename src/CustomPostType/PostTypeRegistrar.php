<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

interface PostTypeRegistrar {
	public function register(string $postType, array $settings): void;
}