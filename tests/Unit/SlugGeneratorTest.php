<?php

use App\Domain\Article\SlugGenerator;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class SlugGeneratorTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function slug_generator_should_generate_a_slug_from_a_title(): void
    {
        $now = now();
        \Illuminate\Support\Carbon::setTestNow($now);
        
        $title = 'My First Post';
        $slug = SlugGenerator::generate($title);
        
        expect($slug)->toBe('my-first-post-' . $now->timestamp);
    }

    #[Test]
    public function slug_generator_should_generate_a_unique_slug_when_one_exists(): void
    {
        $now = now();
        \Illuminate\Support\Carbon::setTestNow($now);
        
        $user = User::factory()->create();
        Article::factory()->create([
            'title' => 'My First Post',
            'slug' => 'my-first-post-' . $now->timestamp,
            'author_id' => $user->id,
        ]);

        $title = 'My First Post';
        $slug = SlugGenerator::generateUnique($title);
        
        expect($slug)->toBe('my-first-post-' . $now->timestamp . '-1');
    }

    #[Test]
    public function slug_generator_should_generate_unique_slugs_with_incrementing_counters(): void
    {
        $now = now();
        \Illuminate\Support\Carbon::setTestNow($now);
        
        $user = User::factory()->create();
        Article::factory()->create([
            'title' => 'My First Post',
            'slug' => 'my-first-post-' . $now->timestamp,
            'author_id' => $user->id,
        ]);
        Article::factory()->create([
            'title' => 'My First Post',
            'slug' => 'my-first-post-' . $now->timestamp . '-1',
            'author_id' => $user->id,
        ]);

        $title = 'My First Post';
        $slug = SlugGenerator::generateUnique($title);
        
        expect($slug)->toBe('my-first-post-' . $now->timestamp . '-2');
    }

    #[Test]
    public function slug_generator_should_exclude_current_article_id_when_generating_unique_slug(): void
    {
        $now = now();
        \Illuminate\Support\Carbon::setTestNow($now);
        
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'title' => 'My First Post',
            'slug' => 'my-first-post-' . $now->timestamp,
            'author_id' => $user->id,
        ]);

        $title = 'My First Post';
        $slug = SlugGenerator::generateUnique($title, $article->id);
        
        expect($slug)->toBe('my-first-post-' . $now->timestamp);
    }
   
}

