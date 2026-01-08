<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function togglePostLike(Post $post)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $liked = Like::toggleLike(Auth::id(), $post->id);

        if ($liked) {
            $post->increment('likes_count');
            $message = 'تم إضافة الإعجاب!';
        } else {
            $post->decrement('likes_count');
            $message = 'تم إزالة الإعجاب!';
        }

        // Check if request expects JSON (AJAX)
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'liked' => $liked,
                'likes_count' => $post->likes_count,
                'message' => $message
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function toggleCommentLike(Comment $comment)
    {
        if (!Auth::user()->canComment()) {
            abort(403);
        }

        $liked = Like::toggleLike(Auth::id(), null, $comment->id);

        if ($liked) {
            $message = 'تم إضافة الإعجاب بالتعليق!';
        } else {
            $message = 'تم إزالة الإعجاب بالتعليق!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function getPostLikes(Post $post)
    {
        $likes = $post->likes()
            ->with('user')
            ->latest()
            ->paginate(20);

        return response()->json($likes);
    }

    public function getCommentLikes(Comment $comment)
    {
        $likes = $comment->likes()
            ->with('user')
            ->latest()
            ->paginate(20);

        return response()->json($likes);
    }
}
