<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

final class CustomPostType implements PostType {
	private PostTypeSettings $post_type_settings;

	public function __construct(
		private string $post_type,
		?PostTypeSettings $settings = null,
		private readonly PostTypeRegistrar $registrar = new WordPressPostTypeRegistrar(),
	) {
		$this->post_type_settings = $settings ?? new DefaultPostTypeSettings( $this );
	}

	public function get_post_type(): string {
		return $this->post_type;
	}

	public function register(): void {
		$this->registrar->register(
			$this->post_type,
			$this->post_type_settings->getSettings()
		);
	}
}
