<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'likeable_type',
        'likeable_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likeable()
    {
        return $this->morphTo();
    }

    public function scopeForPost($query, $postId)
    {
        return $query->where('likeable_type', Post::class)
            ->where('likeable_id', $postId);
    }

    public function scopeForComment($query, $commentId)
    {
        return $query->where('likeable_type', Comment::class)
            ->where('likeable_id', $commentId);
    }

    public static function toggleLike($userId, $postId = null, $commentId = null)
    {
        $likeableType = $postId ? Post::class : Comment::class;
        $likeableId = $postId ?: $commentId;

        $existingLike = static::where('user_id', $userId)
            ->where('likeable_type', $likeableType)
            ->where('likeable_id', $likeableId)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            return false;
        } else {
            static::create([
                'user_id' => $userId,
                'likeable_type' => $likeableType,
                'likeable_id' => $likeableId,
            ]);
            return true;
        }
    }
}
