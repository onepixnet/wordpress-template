<?php

declare( strict_types=1 );

namespace CustomPostType;

use OnePix\WordPress\CustomPostType\WordPressPostTypeRegistrar;
use WP_UnitTestCase;

/**
 * @covers \OnePix\WordPress\CustomPostType\WordPressPostTypeRegistrar
 */
class WordPressPostTypeRegistrarTest extends WP_UnitTestCase {
	public function test_register(): void {
		$post_type = 'custom_post';
		$registrar = new WordPressPostTypeRegistrar();

		$registrar->register( $post_type, [] );

		$this->assertTrue( post_type_exists( $post_type ) );
	}
}