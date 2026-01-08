<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the writer user
        $writer = User::whereHas('roles', function ($query) {
            $query->where('name', 'writer');
        })->first();

        if (!$writer) {
            // Create a writer user if none exists
            $writer = User::create([
                'name' => 'Writer User',
                'email' => 'writer@example.com',
                'password' => bcrypt('password'),
            ]);

            // Assign writer role
            $writerRole = \App\Models\Role::where('name', 'writer')->first();
            if ($writerRole) {
                $writer->roles()->attach($writerRole->id);
            }
        }

        $posts = [
            [
                'title' => 'مقدمة إلى Laravel 10',
                'excerpt' => 'دليل شامل للبدء مع أحدث إصدار من Laravel',
                'content' => '<h2>ما هو Laravel؟</h2><p>Laravel هو إطار عمل PHP قوي وحديث يسهل تطوير تطبيقات الويب. يوفر Laravel بنية قوية وواضحة تجعل من السهل بناء تطبيقات قابلة للتطوير والصيانة.</p><h2>المميزات الرئيسية</h2><ul><li>Eloquent ORM</li><li>Blade Templates</li><li>Artisan CLI</li><li>Middleware</li><li>Routing</li></ul><p>في هذا المقال، سنتعرف على الميزات الرئيسية لـ Laravel 10 وكيفية البدء في استخدامه.</p>',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'tags' => ['Laravel', 'PHP']
            ],
            [
                'title' => 'بناء API مع Laravel',
                'excerpt' => 'تعلم كيفية بناء RESTful API احترافي باستخدام Laravel',
                'content' => '<h2>مقدمة</h2><p>بناء API هو جزء أساسي من تطوير التطبيقات الحديثة. Laravel يوفر أدوات قوية لبناء APIs احترافية وسريعة.</p><h2>الخطوات الأساسية</h2><ol><li>إعداد المشروع</li><li>إنشاء Models</li><li>تحديد Routes</li><li>بناء Controllers</li><li>إضافة Authentication</li></ol><p>سنتعلم في هذا الدليل كيفية بناء API كامل من البداية.</p>',
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'tags' => ['Laravel', 'API', 'PHP']
            ],
            [
                'title' => 'Vue.js مع Laravel: أفضل الممارسات',
                'excerpt' => 'كيفية دمج Vue.js مع Laravel لبناء تطبيقات SPA',
                'content' => '<h2>لماذا Vue.js مع Laravel؟</h2><p>Vue.js هو إطار JavaScript تدريجي يجعله سهلاً بناء واجهات مستخدم تفاعلية. عند دمجه مع Laravel، تحصل على قوة كلا الإطارين.</p><h2>الإعداد</h2><p>سنقوم بإعداد مشروع Laravel مع Vue.js باستخدام Laravel Breeze أو Jetstream.</p><h2>المميزات</h2><ul><li>Reactive Components</li><li>State Management</li><li>Routing</li><li>API Integration</li></ul>',
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'tags' => ['Vue.js', 'Laravel', 'JavaScript']
            ],
            [
                'title' => 'أفضل ممارسات الأمان في Laravel',
                'excerpt' => 'حماية تطبيق Laravel من التهديدات الأمنية الشائعة',
                'content' => '<h2>مقدمة</h2><p>الأمان هو جانب مهم جداً في تطوير التطبيقات. Laravel يوفر العديد من الميزات المدمجة لحماية تطبيقك.</p><h2>التهديدات الشائعة</h2><ul><li>SQL Injection</li><li>XSS Attacks</li><li>CSRF Protection</li><li>Authentication</li><li>Authorization</li></ul><p>سنتعرف على كيفية حماية تطبيقك من هذه التهديدات.</p>',
                'status' => 'draft',
                'tags' => ['Laravel', 'Security', 'PHP']
            ],
            [
                'title' => 'تحسين أداء Laravel Applications',
                'excerpt' => 'نصائح وحيل لجعل تطبيق Laravel أسرع',
                'content' => '<h2>مقدمة</h2><p>الأداء هو عامل حاسم في نجاح أي تطبيق ويب. في هذا المقال، سنتعلم كيفية تحسين أداء تطبيقات Laravel.</p><h2>تقنيات التحسين</h2><ol><li>Caching</li><li>Database Optimization</li><li>Asset Minification</li><li>CDN Usage</li><li>Queue System</li></ol><p>كل تقنية من هذه التقنيات ستحسن أداء تطبيقك بشكل ملحوظ.</p>',
                'status' => 'published',
                'published_at' => now()->subDay(),
                'tags' => ['Laravel', 'Performance', 'PHP']
            ]
        ];

        foreach ($posts as $postData) {
            $post = Post::create([
                'user_id' => $writer->id,
                'title' => $postData['title'],
                'excerpt' => $postData['excerpt'],
                'content' => $postData['content'],
                'status' => $postData['status'],
                'published_at' => $postData['published_at'] ?? null,
                'views_count' => rand(50, 500),
                'likes_count' => rand(10, 100),
                'comments_count' => rand(5, 50),
            ]);

            // Attach tags
            if (isset($postData['tags'])) {
                $tagIds = Tag::whereIn('name', $postData['tags'])->pluck('id');
                $post->tags()->attach($tagIds);
            }
        }
    }
}
