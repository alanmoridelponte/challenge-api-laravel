<?php

namespace App\Domain\Article;

use Illuminate\Support\Str;
use App\Models\Article;

final class SlugGenerator
{
    public static function generate(string $title): string
    {
        return Str::slug($title) . '-' . now()->timestamp;
    }

    public static function generateUnique(string $title, ?int $excludeId = null): string
    {
        $slug = self::generate($title);
        $originalSlug = $slug;
        $count = 1;

        while (self::slugExists($slug, $excludeId)) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

    private static function slugExists(string $slug, ?int $excludeId): bool
    {
        return Article::query()
            ->where('slug', $slug)
            ->when($excludeId, fn($query) => $query->where('id', '!=', $excludeId))
            ->exists();
    }
}