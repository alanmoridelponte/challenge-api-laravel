<?php

namespace App\Application\Category\DTOs;

final readonly class CategoryData
{
    public function __construct(
        public string $name,
        public ?string $description,
        public string $status,
    ) {}
}
