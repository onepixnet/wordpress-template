<?php

declare(strict_types=1);

namespace OnePix\WordPress\CustomPostType;

use OnePix\WordPress\CustomPostType\Contracts\PostType;

abstract class DefaultPostType implements PostType
{
    final public function getSettings(): array
    {
        return [
            'public'   => true,
            'supports' => ['title'],
        ];
    }
}
