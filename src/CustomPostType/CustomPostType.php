<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

final class CustomPostType implements PostType {
	public function __construct(
		private string $post_type,
		private PostTypeSettings $post_type_settings,
		private readonly PostTypeRegistrar $registrar
	) {}

	public function register(): void {
		$this->registrar->register(
			$this->post_type,
			$this->post_type_settings->getSettings()
		);
	}
}
