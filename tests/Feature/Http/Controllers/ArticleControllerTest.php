<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\User;
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
        $user = User::factory()->create(['active' => true]);
        $articles = Article::factory()->count(3)->create();

        $response = $this->actingAs($user, 'api')->get(route('articles.index'));

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
        $user = User::factory()->create(['active' => true]);
        $title = fake()->sentence(4);
        $content = fake()->paragraphs(3, true);
        $slug = fake()->slug();
        $status = fake()->randomElement(['draft', 'published']);
        $author = User::factory()->create(['active' => true]);

        $response = $this->actingAs($user, 'api')->post(route('articles.store'), [
            'title' => $title,
            'content' => $content,
            'slug' => $slug,
            'status' => $status,
            'author_id' => $author->id,
        ]);

        $articles = Article::query()
            ->where('title', $title)
            ->where('content', $content)
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
        $user = User::factory()->create(['active' => true]);
        $article = Article::factory()->create();

        $response = $this->actingAs($user, 'api')->get(route('articles.show', $article));

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
        $user = User::factory()->create(['active' => true]);
        $article = Article::factory()->create(['author_id' => $user->id]);
        $title = fake()->sentence(4);
        $content = fake()->paragraphs(3, true);
        $slug = fake()->slug();
        $status = fake()->randomElement(['draft', 'published']);
        $author = User::factory()->create(['active' => true]);

        $response = $this->actingAs($user, 'api')->put(route('articles.update', $article), [
            'title' => $title,
            'content' => $content,
            'slug' => $slug,
            'status' => $status,
            'author_id' => $user->id,
        ]);

        $article->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $article->title);
        $this->assertEquals($content, $article->content);
        $this->assertNotNull($article->slug);
        $this->assertEquals($status, $article->status);
        $this->assertEquals($user->id, $article->author_id);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $user = User::factory()->create(['active' => true]);

        $article = Article::factory()->create();

        $this->actingAs($user, 'api');

        $response = $this->delete(route('articles.destroy', $article));

        $response->assertNoContent();

        $this->assertModelMissing($article);
    }
}
