<?php

declare( strict_types=1 );

namespace CustomPostType;

use OnePix\WordPress\CustomPostType\CustomPostType;
use OnePix\WordPress\CustomPostType\PostTypeRegistrar;
use OnePix\WordPress\CustomPostType\PostTypeSettings;
use WP_UnitTestCase;

/**
 * @covers \OnePix\WordPress\CustomPostType\CustomPostType
 */
class CustomPostTypeTest extends WP_UnitTestCase {
	public function test_register_with_custom_params(): void {
		$postType = 'custom_post';
		$expectedSettings = [
			'label' => 'custom_post',
			'public' => true,
		];

		$registrarMock = $this->createMock(PostTypeRegistrar::class);

		$registrarMock->expects($this->once())
		              ->method('register')
		              ->with($this->equalTo($postType), $this->equalTo($expectedSettings));

		$settingsMock = $this->createMock(PostTypeSettings::class);
		$settingsMock->method('getSettings')
		             ->willReturn($expectedSettings);

		$customPostType = new CustomPostType($postType, $settingsMock, $registrarMock);

		$customPostType->register();
	}
}