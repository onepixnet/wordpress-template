<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

interface PostTypeSettings {
	public function getSettings(): array;
}