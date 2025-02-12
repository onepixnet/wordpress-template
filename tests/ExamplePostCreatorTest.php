<?php

declare(strict_types=1);

namespace OnePix\WordPress;

use WP_UnitTestCase;

/**
 * @covers \OnePix\WordPress\ExamplePostCreator
 */
final class ExamplePostCreatorTest extends WP_UnitTestCase {
	public function test_create(): void {
		$creator      = new ExamplePostCreator();
		$posts_amount = 3;

		for ($i = 0; $i < $posts_amount; $i++) {
			$creator->create('title ' . $i, 'content ' . $i);
		}

		$this->assertCount($posts_amount, get_posts());
	}
}
