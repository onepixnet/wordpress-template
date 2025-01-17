<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

interface PostType {
	public function get_post_type(): string;

	public function register(): void;
}