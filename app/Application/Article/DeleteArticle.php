<?php

namespace App\Application\Article;

use App\Models\Article;

final class DeleteArticle
{
    public function __invoke(Article $article): void
    {
        $article->delete();
    }
}
