<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::published()
            ->with(['user', 'tags', 'comments' => function ($query) {
                $query->approved()->take(3);
            }])
            ->withCount(['comments', 'likes'])
            ->latest('published_at')
            ->paginate(12);

        $featuredPosts = Post::published()
            ->with(['user', 'tags'])
            ->withCount(['comments', 'likes'])
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('posts.index', compact('posts', 'featuredPosts'));
    }

    public function show(Post $post)
    {
        if (!$post->isPublished() && (!Auth::check() || (!Auth::user()->canEditPost($post) && !Auth::user()->isAdmin()))) {
            abort(404);
        }

        $post->incrementViews();

        $post->load([
            'user',
            'tags',
            'comments' => function ($query) {
                $query->approved()->with(['user', 'approvedReplies.user'])->latest();
            }
        ]);

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->whereHas('tags', function ($query) use ($post) {
                $query->whereIn('tags.id', $post->tags->pluck('id'));
            })
            ->with(['user', 'tags'])
            ->withCount(['comments', 'likes'])
            ->take(4)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    public function create()
    {
        if (!Auth::user()->canCreatePost()) {
            abort(403);
        }

        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->canCreatePost()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', Rule::in(['draft', 'published'])],
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('featured_images', $imageName, 'public');
            $validated['featured_image'] = $imageName;
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $post = Post::create($validated);

        if (!empty($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return redirect()->route('posts.show', $post)
            ->with('success', $post->isPublished() ? 'تم نشر المقال بنجاح!' : 'تم حفظ المقال كمسودة!');
    }

    public function edit(Post $post)
    {
        if (!Auth::user()->canEditPost($post)) {
            abort(403);
        }

        $post->load('tags');
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        if (!Auth::user()->canEditPost($post)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete('featured_images/' . $post->featured_image);
            }

            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('featured_images', $imageName, 'public');
            $validated['featured_image'] = $imageName;
        }

        if ($validated['status'] === 'published' && !$post->isPublished()) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()->route('posts.show', $post)
            ->with('success', 'تم تحديث المقال بنجاح!');
    }

    public function destroy(Post $post)
    {
        if (!Auth::user()->canDeletePost($post)) {
            abort(403);
        }

        if ($post->featured_image) {
            Storage::disk('public')->delete('featured_images/' . $post->featured_image);
        }

        $post->delete();

        return redirect()->route('dashboard')
            ->with('success', 'تم حذف المقال بنجاح!');
    }

    public function toggleStatus(Post $post)
    {
        if (!Auth::user()->canEditPost($post)) {
            abort(403);
        }

        if ($post->status === 'published') {
            $post->update(['status' => 'draft']);
            $message = 'تم إيقاف المقال!';
        } else {
            $post->update([
                'status' => 'published',
                'published_at' => now()
            ]);
            $message = 'تم نشر المقال!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return redirect()->route('posts.index');
        }

        $posts = Post::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->with(['user', 'tags'])
            ->withCount(['comments', 'likes'])
            ->latest('published_at')
            ->paginate(12);

        return view('posts.search', compact('posts', 'query'));
    }

    public function byTag(Tag $tag)
    {
        $posts = $tag->posts()
            ->published()
            ->with(['user', 'tags'])
            ->withCount(['comments', 'likes'])
            ->latest('published_at')
            ->paginate(12);

        return view('posts.by-tag', compact('posts', 'tag'));
    }
}
