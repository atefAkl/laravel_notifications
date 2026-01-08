<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'views_count',
        'likes_count',
        'comments_count',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'likes_count' => 'integer',
        'comments_count' => 'integer',
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'likeable_id')
            ->where('likeable_type', Post::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // Helper methods
    public function isPublished(): bool
    {
        return $this->status === 'published' && $this->published_at && $this->published_at->isPast();
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isArchived(): bool
    {
        return $this->status === 'archived';
    }

    public function getFormattedPublishedAtAttribute(): string
    {
        if (!$this->published_at) {
            return '';
        }

        return $this->published_at->locale('ar')->format('d M Y');
    }

    public function getReadingTimeAttribute(): int
    {
        $wordsPerMinute = 200;
        $wordCount = str_word_count(strip_tags($this->content));

        return max(1, ceil($wordCount / $wordsPerMinute));
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function incrementLikes(): void
    {
        $this->increment('likes_count');
    }

    public function decrementLikes(): void
    {
        $this->decrement('likes_count');
    }

    public function incrementComments(): void
    {
        $this->increment('comments_count');
    }

    public function decrementComments(): void
    {
        $this->decrement('comments_count');
    }

    public function getExcerptAttribute($value): string
    {
        if ($value) {
            return $value;
        }

        return Str::limit(strip_tags($this->content), 150);
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->title);
    }

    public function getUrlAttribute(): string
    {
        return route('posts.show', $this);
    }
}
