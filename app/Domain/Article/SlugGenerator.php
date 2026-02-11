<?php

namespace App\Domain\Article;

use Illuminate\Support\Str;

final class SlugGenerator
{
    public function generate(string $title): string
    {
        return Str::slug($title);
    }
}