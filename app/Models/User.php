<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'bio',
        'avatar',
        'birth_date',
        'address',
        'city',
        'country',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isWriter()
    {
        return $this->hasRole('writer');
    }

    public function isReader()
    {
        return $this->hasRole('reader');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function publishedPosts()
    {
        return $this->posts()->published();
    }

    public function draftPosts()
    {
        return $this->posts()->draft();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->comments()->approved();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes')
            ->whereNull('likes.comment_id');
    }

    public function hasLiked(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)
            ->whereNull('comment_id')
            ->exists();
    }

    public function canCreatePost()
    {
        return $this->hasRole('writer') || $this->hasRole('admin');
    }

    public function canEditPost(Post $post)
    {
        return $this->id === $post->user_id || $this->hasRole('admin');
    }

    public function canDeletePost(Post $post)
    {
        return $this->id === $post->user_id || $this->hasRole('admin');
    }

    public function canComment()
    {
        return $this->hasRole('reader') || $this->hasRole('writer') || $this->hasRole('admin');
    }

    public function hasLikedPost(Post $post)
    {
        return $this->likes()->where('likeable_type', Post::class)
            ->where('likeable_id', $post->id)
            ->exists();
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/avatars/' . $this->avatar);
        }

        $default = "https://ui-avatars.com/api/?name=" . urlencode($this->name) . "&color=7F9CF5&background=EBF4FF";
        return $default;
    }
}
