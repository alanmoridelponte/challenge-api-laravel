<?php

namespace App\Application\Article;

use App\Application\Article\DTOs\ArticleData;
use App\Domain\Article\SlugGenerator;
use App\Domain\Exceptions\InactiveUserException;
use App\Models\Article;
use App\Models\User;

final class UpdateArticle
{
    public function __invoke(Article $article, ArticleData $data): Article
    {
        $author = User::findOrFail($data->authorId);

        if (! $author->active) {
            throw InactiveUserException::cannotPerformAction($author->id);
        }

        $slug = $article->slug;
        if ($article->title !== $data->title) {
            $slug = SlugGenerator::generateUnique($data->title, $article->id);
        }

        $article->update([
            'title' => $data->title,
            'content' => $data->content,
            'slug' => $slug,
            'status' => $data->status,
            'author_id' => $data->authorId,
            'published_at' => $data->publishedAt,
        ]);

        if (isset($data->categoryIds)) {
            $article->categories()->sync($data->categoryIds);
        }

        return $article;
    }
}
