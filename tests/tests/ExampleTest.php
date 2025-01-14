<?php

declare( strict_types=1 );

use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase {
	public function testHelloWorld(): void {

		$this->assertSame( 'Hello World!', 'Hello World!' );
	}
}