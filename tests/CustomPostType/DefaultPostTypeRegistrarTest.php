<?php

declare(strict_types=1);

namespace Onepix\Wordpress\CustomPostType;

use Onepix\Wordpress\CustomPostType\Contracts\PostType;
use WP_UnitTestCase;

/**
 * @covers DefaultPostTypeRegistrar
 */
class DefaultPostTypeRegistrarTest extends WP_UnitTestCase
{
    public function testRegister()
    {
        $mockPostType = $this->createMock(PostType::class);

        $mockType     = 'custom_post_type';
        $mockSettings = [
            'public'   => true,
            'supports' => ['title', 'author'],
        ];

        $mockPostType->method('getType')->willReturn($mockType);
        $mockPostType->method('getSettings')->willReturn($mockSettings);

        $registrar = new DefaultPostTypeRegistrar();
        $registrar->register($mockPostType);

        $this->assertTrue(post_type_exists($mockType));

        $wpPostType = get_post_type_object($mockType);

        $this->assertSame($mockSettings['public'], $wpPostType->public);

        global $_wp_post_type_features;

        $this->assertSame($mockSettings['supports'], array_keys($_wp_post_type_features[$mockType]));

        unregister_post_type( $mockType );
    }
}
