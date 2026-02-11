<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    public function index(Request $request): Response
    {
        $articles = Article::all();

        return new ArticleCollection($articles);
    }

    public function store(ArticleStoreRequest $request): Response
    {
        $article = Article::create($request->validated());

        return new ArticleResource($article);
    }

    public function show(Request $request, Article $article): Response
    {
        return new ArticleResource($article);
    }

    public function update(ArticleUpdateRequest $request, Article $article): Response
    {
        $article->update($request->validated());

        return new ArticleResource($article);
    }

    public function destroy(Request $request, Article $article): Response
    {
        $article->delete();

        return response()->noContent();
    }
}
