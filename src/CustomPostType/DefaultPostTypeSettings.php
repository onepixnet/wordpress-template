<?php

declare( strict_types=1 );

namespace OnePix\WordPress\CustomPostType;

final class DefaultPostTypeSettings implements PostTypeSettings {
	public function __construct(
		private PostType $post_type
	) {
	}

	public function getSettings(): array {
		return [
			'label'           => $this->post_type->get_post_type(),
			'labels'          => [
				'name'               => $this->post_type->get_post_type(),
				'singular_name'      => $this->post_type->get_post_type(),
				'add_new'            => 'Add ' . $this->post_type->get_post_type(),
				'add_new_item'       => 'Adding ' . $this->post_type->get_post_type(),
				'edit_item'          => 'Editing ' . $this->post_type->get_post_type(),
				'new_item'           => 'New ' . $this->post_type->get_post_type(),
				'view_item'          => 'View ' . $this->post_type->get_post_type(),
				'search_items'       => 'Search ' . $this->post_type->get_post_type(),
				'not_found'          => 'No found ' . $this->post_type->get_post_type(),
				'not_found_in_trash' => 'Not found in cart ' . $this->post_type->get_post_type(),
				'parent_item_colon'  => '',
				'menu_name'          => $this->post_type->get_post_type(),
			],
			'description'     => 'Description for ' . $this->post_type->get_post_type(),
			'public'          => true,
			'capability_type' => 'post',
			'hierarchical'    => false,
			'supports'        => ['title'],
		];
	}
}