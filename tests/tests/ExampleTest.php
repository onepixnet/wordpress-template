<?php

declare( strict_types=1 );

use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase {
	public function testHelloWorld(): void {
		$args = [
			'post_title'   => 'title',
			'post_content' => 'content',
			'post_status'  => 'publish',
		];

		wp_insert_post( $args );
		wp_insert_post( $args );
		wp_insert_post( $args );

		$this->assertCount( 3, get_posts() );
	}
}