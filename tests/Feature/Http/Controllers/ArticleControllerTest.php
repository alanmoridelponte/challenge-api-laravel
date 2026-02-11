<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ArticleController
 */
final class ArticleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $articles = Article::factory()->count(3)->create();

        $response = $this->get(route('articles.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ArticleController::class,
            'store',
            \App\Http\Requests\ArticleStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $title = fake()->sentence(4);
        $content = fake()->paragraphs(3, true);
        $slug = fake()->slug();
        $status = fake()->randomElement(/** enum_attributes **/);
        $author = Author::factory()->create();

        $response = $this->post(route('articles.store'), [
            'title' => $title,
            'content' => $content,
            'slug' => $slug,
            'status' => $status,
            'author_id' => $author->id,
        ]);

        $articles = Article::query()
            ->where('title', $title)
            ->where('content', $content)
            ->where('slug', $slug)
            ->where('status', $status)
            ->where('author_id', $author->id)
            ->get();
        $this->assertCount(1, $articles);
        $article = $articles->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $article = Article::factory()->create();

        $response = $this->get(route('articles.show', $article));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ArticleController::class,
            'update',
            \App\Http\Requests\ArticleUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $article = Article::factory()->create();
        $title = fake()->sentence(4);
        $content = fake()->paragraphs(3, true);
        $slug = fake()->slug();
        $status = fake()->randomElement(/** enum_attributes **/);
        $author = Author::factory()->create();

        $response = $this->put(route('articles.update', $article), [
            'title' => $title,
            'content' => $content,
            'slug' => $slug,
            'status' => $status,
            'author_id' => $author->id,
        ]);

        $article->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $article->title);
        $this->assertEquals($content, $article->content);
        $this->assertEquals($slug, $article->slug);
        $this->assertEquals($status, $article->status);
        $this->assertEquals($author->id, $article->author_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $article = Article::factory()->create();

        $response = $this->delete(route('articles.destroy', $article));

        $response->assertNoContent();

        $this->assertModelMissing($article);
    }
}
