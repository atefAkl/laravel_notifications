<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = $post->comments()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
            'parent_id' => $validated['parent_id'] ?? null,
            'is_approved' => true, // Auto-approve all comments for now
        ]);

        $post->increment('comments_count');

        return redirect()->back()
            ->with('success', $comment->is_approved ? 'تم نشر تعليقك بنجاح!' : 'تم إرسال تعليقك للمراجعة!');
    }

    public function update(Request $request, Comment $comment)
    {
        if (!$comment->canBeEditedBy(Auth::user())) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return redirect()->back()->with('success', 'تم تحديث التعليق بنجاح!');
    }

    public function destroy(Comment $comment)
    {
        if (!$comment->canBeEditedBy(Auth::user())) {
            abort(403);
        }

        $post = $comment->post;
        $comment->delete();

        $post->decrement('comments_count');

        return redirect()->back()->with('success', 'تم حذف التعليق بنجاح!');
    }

    public function approve(Comment $comment)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isWriter()) {
            abort(403);
        }

        $comment->approve();
        $comment->post->increment('comments_count');

        return redirect()->back()->with('success', 'تم قبول التعليق بنجاح!');
    }

    public function disapprove(Comment $comment)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isWriter()) {
            abort(403);
        }

        $comment->disapprove();
        $comment->post->decrement('comments_count');

        return redirect()->back()->with('success', 'تم رفض التعليق بنجاح!');
    }
}
