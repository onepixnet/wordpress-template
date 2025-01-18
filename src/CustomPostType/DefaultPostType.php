<?php

declare( strict_types=1 );

namespace Onepix\Wordpress\CustomPostType;

use Onepix\Wordpress\CustomPostType\Contracts\PostType;

abstract class DefaultPostType implements PostType {
	final public function getSettings(): array {
		return [
			'public'          => true,
			'supports'        => ['title'],
		];
	}
}