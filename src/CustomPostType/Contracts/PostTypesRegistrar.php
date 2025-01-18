<?php

declare(strict_types=1);

namespace OnePix\WordPress\CustomPostType\Contracts;

interface PostTypesRegistrar
{
    public function register(): void;
}
