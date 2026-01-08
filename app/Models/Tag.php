<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function findOrCreateByName($name)
    {
        $slug = str()->slug($name);
        return static::firstOrCreate(['slug' => $slug], [
            'name' => $name,
            'color' => '#' . substr(md5(rand()), 0, 6),
        ]);
    }
}
