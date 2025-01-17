<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

interface PostType {
	public function register(): void;
}