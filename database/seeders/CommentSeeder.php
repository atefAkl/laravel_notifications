<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get posts and users
        $posts = Post::all();
        $users = User::all();

        // Sample comments
        $comments = [
            'مقال رائع! شكراً على المعلومات القيمة.',
            'هل يمكنك توضيح هذه النقطة أكثر؟',
            'أحببت الطريقة التي شرحت بها الموضوع.',
            'هل هناك مصادر إضافية للتعلم أكثر؟',
            'مقال مفيد جداً، تمت مشاركته مع الأصدقاء.',
            'لدي سؤال بخصوص الجزء الخاص بـ...',
            'ممتاز! هذا بالضبط ما كنت أبحث عنه.',
            'هل يمكنك عمل مقال متقدم عن هذا الموضوع؟',
            'تجربتي مع Laravel كانت مختلفة قليلاً.',
            'مقال شامل ومفصل، شكراً على الجهد.',
            'هل ينطبق هذا على Laravel 11 أيضاً؟',
            'أحببت أمثلة الكود في المقال.',
            'مقال ممتاز، ننتظر المزيد منك.',
            'هل هناك بدائل أخرى لهذه الطريقة؟',
            'مقال مفيد للمبتدئين مثلي.',
        ];

        foreach ($posts as $post) {
            // Add 2-5 random comments for each post
            $commentCount = rand(2, 5);

            for ($i = 0; $i < $commentCount; $i++) {
                $user = $users->random();
                $comment = $comments[array_rand($comments)];

                // Sometimes add replies
                if (rand(0, 1) && $i > 0) {
                    // This is a reply to a previous comment
                    $parentComment = Comment::where('post_id', $post->id)->inRandomOrder()->first();

                    if ($parentComment) {
                        Comment::create([
                            'post_id' => $post->id,
                            'user_id' => $user->id,
                            'parent_id' => $parentComment->id,
                            'content' => $comment,
                            'is_approved' => true,
                        ]);
                    }
                } else {
                    // This is a top-level comment
                    Comment::create([
                        'post_id' => $post->id,
                        'user_id' => $user->id,
                        'content' => $comment,
                        'is_approved' => rand(0, 3) ? true : false, // 75% approved
                    ]);
                }
            }
        }
    }
}
