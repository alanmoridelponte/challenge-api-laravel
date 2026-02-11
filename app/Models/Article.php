<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'slug',
        'status',
        'published_at',
        'author_id',
    ];

     protected static function booted(): void
    {
        static::creating(function (Post $post) {

            // si no vino slug manual
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }

        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'published_at' => 'timestamp',
            'author_id' => 'integer',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
