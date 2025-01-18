<?php

declare( strict_types=1 );

namespace Onepix\Wordpress\CustomPostType\Contracts;

interface PostTypeRegistrar {
	public function register(PostType $post_type): void;
}