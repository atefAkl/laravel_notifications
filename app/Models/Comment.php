<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'content',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    // Relationships
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // Helper methods
    public function approve(): void
    {
        $this->update(['is_approved' => true]);
    }

    public function disapprove(): void
    {
        $this->update(['is_approved' => false]);
    }

    public function isApproved(): bool
    {
        return $this->is_approved;
    }

    public function isReply(): bool
    {
        return !is_null($this->parent_id);
    }

    public function hasReplies(): bool
    {
        return $this->replies()->count() > 0;
    }

    public function canBeEditedBy($user): bool
    {
        return $user->id === $this->user_id || $user->isAdmin() || $user->isWriter();
    }

    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->locale('ar')->format('d M Y H:i');
    }

    // Scope for approved comments
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function approvedReplies()
    {
        return $this->replies()->where('is_approved', true);
    }

    // Scope for top-level comments
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }
}
