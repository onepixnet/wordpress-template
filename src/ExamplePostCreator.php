<?php

declare( strict_types=1 );

namespace Docker\WP;

use Exception;

class ExamplePostCreator {
	/**
	 * @throws Exception
	 */
	public function create( string $title, string $content ): int {
		$result = wp_insert_post(
			[
				'post_title'   => $title,
				'post_content' => $content,
				'post_status'  => 'publish',
			],
			true
		);

		if ( $result instanceof \WP_Error ) {
			throw new Exception( 'Unable to create post: ' . $result->get_error_message() );
		}

		return $result;
	}
}
