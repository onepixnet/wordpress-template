<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

use WP_UnitTestCase;

/**
 * @covers DefaultPostType
 */
abstract class DefaultPostTypeTestCase extends WP_UnitTestCase {
	/**
	 * Returns an instance of the post type being tested.
	 *
	 * @return DefaultPostType
	 */
	abstract protected function getPostType(): DefaultPostType;

	public function testGetSettings() {
		$postType = $this->getPostType();
		$type     = $postType->getType();

		$expected = [
			'label'           => $type,
			'labels'          => [
				'name'               => $type,
				'singular_name'      => $type,
				'add_new'            => 'Add ' . $type,
				'add_new_item'       => 'Adding ' . $type,
				'edit_item'          => 'Editing ' . $type,
				'new_item'           => 'New ' . $type,
				'view_item'          => 'View ' . $type,
				'search_items'       => 'Search ' . $type,
				'not_found'          => 'No found ' . $type,
				'not_found_in_trash' => 'Not found in cart ' . $type,
				'parent_item_colon'  => '',
				'menu_name'          => $type,
			],
			'description'     => 'Description for ' . $type,
			'public'          => true,
			'capability_type' => 'post',
			'hierarchical'    => false,
			'supports'        => [ 'title' ],
		];

		$this->assertSame( $expected, $postType->getSettings() );
	}
}
