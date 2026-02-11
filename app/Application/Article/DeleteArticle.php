<?php

namespace App\Application\Article;

use App\Domain\Exceptions\InvalidUserException;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

final class DeleteArticle
{
    public function __invoke(Article $article): void
    {
        if ($article->author_id !== Auth::user()->id && Auth::user()->role !== 'admin') {
            throw InvalidUserException::cannotPerformAction($article->author_id);
        }

        $article->delete();
    }
}
