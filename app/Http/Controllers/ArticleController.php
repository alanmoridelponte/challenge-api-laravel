<?php

namespace App\Http\Controllers;

use App\Application\Article\CreateArticle;
use App\Application\Article\DeleteArticle;
use App\Application\Article\DTOs\ArticleData;
use App\Application\Article\ListArticles;
use App\Application\Article\UpdateArticle;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    public function index(ListArticles $listArticles): ArticleCollection
    {
        return new ArticleCollection($listArticles());
    }

    public function store(ArticleStoreRequest $request, CreateArticle $createArticle): ArticleResource
    {
        $data = new ArticleData(
            title: $request->title,
            content: $request->content,
            status: $request->status,
            authorId: $request->author_id,
            publishedAt: $request->published_at,
            categoryIds: $request->category_ids ?? []
        );

        $article = $createArticle($data);

        return new ArticleResource($article);
    }

    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article->load(['author', 'categories']));
    }

    public function update(ArticleUpdateRequest $request, Article $article, UpdateArticle $updateArticle): ArticleResource
    {
        $data = new ArticleData(
            title: $request->title,
            content: $request->content,
            status: $request->status,
            authorId: $request->author_id,
            publishedAt: $request->published_at,
            categoryIds: $request->category_ids ?? []
        );

        $article = $updateArticle($article, $data);

        return new ArticleResource($article);
    }

    public function destroy(Article $article, DeleteArticle $deleteArticle): Response
    {
        $deleteArticle($article);

        return response()->noContent();
    }
}
