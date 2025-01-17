<?php

declare( strict_types=1 );

namespace Onepix\Wordpress;

use OnePix\WordPress\CustomPostType\DefaultPostTypeSettings;
use OnePix\WordPress\CustomPostType\PostType;
use WP_UnitTestCase;

/**
 * @covers \OnePix\WordPress\CustomPostType\DefaultPostTypeSettings
 */
final class DefaultPostTypeSettingsTest extends WP_UnitTestCase {
	public function test_get_settings() {
		$postType = 'custom_post';
		$customPostTypeMock = $this->createMock(PostType::class);
		$customPostTypeMock->method('get_post_type')->willReturn($postType);

		$expectedSettings = [
			'label' => $postType,
			'labels' => [
				'name' => $postType,
				'singular_name' => $postType,
				'add_new' => 'Add ' . $postType,
				'add_new_item' => 'Adding ' . $postType,
				'edit_item' => 'Editing ' . $postType,
				'new_item' => 'New ' . $postType,
				'view_item' => 'View ' . $postType,
				'search_items' => 'Search ' . $postType,
				'not_found' => 'No found ' . $postType,
				'not_found_in_trash' => 'Not found in cart ' . $postType,
				'parent_item_colon' => '',
				'menu_name' => $postType,
			],
			'description' => 'Description for ' . $postType,
			'public' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => ['title'],
		];

		$settings = new DefaultPostTypeSettings($customPostTypeMock);

		$this->assertEquals($expectedSettings, $settings->getSettings());
	}
}
