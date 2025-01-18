<?php

declare( strict_types=1 );

namespace Onepix\Wordpress\CustomPostType;

use Onepix\Wordpress\CustomPostType\Contracts\PostType;
use Onepix\Wordpress\CustomPostType\Contracts\PostTypeRegistrar;
use Psr\Container\ContainerInterface;
use WP_UnitTestCase;

/**
 * @covers DefaultPostTypesRegistrar
 */
class DefaultPostTypesRegistrarTest extends WP_UnitTestCase {
    public function testRegister(): void {
        $postType1 = new class implements PostType {
            public static function registrar(): string {
                return 'PostTypeRegistrarClass1';
            }
            public function getType(): string {
                return 'type1';
            }
            public function getSettings(): array {
                return [];
            }
        };

        $postType2 = new class implements PostType {
            public static function registrar(): string {
                return 'PostTypeRegistrarClass2';
            }
            public function getType(): string {
                return 'type2';
            }
            public function getSettings(): array {
                return [];
            }
        };

        $registrar1 = $this->createMock(PostTypeRegistrar::class);
        $registrar2 = $this->createMock(PostTypeRegistrar::class);

        $registrar1->expects($this->once())
                   ->method('register')
                   ->with($postType1);

        $registrar2->expects($this->once())
                   ->method('register')
                   ->with($postType2);

        $container = $this->createMock(ContainerInterface::class);
        $container->method('get')->willReturnMap([
            ['PostTypeRegistrarClass1', $registrar1],
            ['PostTypeRegistrarClass2', $registrar2],
        ]);

        $defaultPostTypesRegistrar = new DefaultPostTypesRegistrar(
            [$postType1, $postType2],
            $container
        );

        $defaultPostTypesRegistrar->register();
    }
}

