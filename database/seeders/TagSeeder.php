<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel', 'color' => '#FF2D20', 'description' => 'كل ما يتعلق بإطار Laravel'],
            ['name' => 'PHP', 'slug' => 'php', 'color' => '#777BB4', 'description' => 'لغة البرمجة PHP'],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'color' => '#F7DF1E', 'description' => 'لغة JavaScript'],
            ['name' => 'Vue.js', 'slug' => 'vuejs', 'color' => '#4FC08D', 'description' => 'إطار Vue.js'],
            ['name' => 'CSS', 'slug' => 'css', 'color' => '#1572B6', 'description' => 'لغة CSS'],
            ['name' => 'HTML', 'slug' => 'html', 'color' => '#E34C26', 'description' => 'لغة HTML'],
            ['name' => 'MySQL', 'slug' => 'mysql', 'color' => '#4479A1', 'description' => 'قاعدة بيانات MySQL'],
            ['name' => 'Git', 'slug' => 'git', 'color' => '#F05032', 'description' => 'نظام Git'],
            ['name' => 'API', 'slug' => 'api', 'color' => '#6DB33F', 'description' => 'واجهات برمجة التطبيقات'],
            ['name' => 'Security', 'slug' => 'security', 'color' => '#FF6B6B', 'description' => 'الأمن السيبراني'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
