<?php

declare( strict_types=1 );

namespace Onepix\Wordpress\CustomPostType;

use Onepix\Wordpress\CustomPostType\Contracts\PostType;

abstract class DefaultPostType implements PostType {
	final public function getSettings(): array {
		return [
			'label'           => $this->getType(),
			'labels'          => [
				'name'               => $this->getType(),
				'singular_name'      => $this->getType(),
				'add_new'            => 'Add ' . $this->getType(),
				'add_new_item'       => 'Adding ' . $this->getType(),
				'edit_item'          => 'Editing ' . $this->getType(),
				'new_item'           => 'New ' . $this->getType(),
				'view_item'          => 'View ' . $this->getType(),
				'search_items'       => 'Search ' . $this->getType(),
				'not_found'          => 'No found ' . $this->getType(),
				'not_found_in_trash' => 'Not found in cart ' . $this->getType(),
				'parent_item_colon'  => '',
				'menu_name'          => $this->getType(),
			],
			'description'     => 'Description for ' . $this->getType(),
			'public'          => true,
			'capability_type' => 'post',
			'hierarchical'    => false,
			'supports'        => ['title'],
		];
	}
}