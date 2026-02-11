<?php

namespace App\Application\Article\DTOs;

final readonly class ArticleData
{
    public function __construct(
        public string $title,
        public string $content,
        public string $status,
        public int $authorId,
        public ?string $publishedAt = null,
        public array $categoryIds = [],
    ) {}
}
