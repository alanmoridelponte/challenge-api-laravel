<?php

namespace App\Application\Article;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

final class ListArticles
{
    public function __invoke(): Collection
    {
        return Article::with(['author', 'categories'])->get();
    }
}
