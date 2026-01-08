<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

// Main posts routes
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/tags/{tag}', [PostController::class, 'byTag'])->name('posts.byTag');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post management
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('can:create-post');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('can:create-post');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('can:edit-post,post');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('can:edit-post,post');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('can:delete-post,post');
    Route::post('/posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])->name('posts.toggleStatus')->middleware('can:edit-post,post');

    // Comments
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::post('/comments/{comment}/disapprove', [CommentController::class, 'disapprove'])->name('comments.disapprove');

    // Likes
    Route::post('/posts/{post}/like', [LikeController::class, 'togglePostLike'])->name('likes.togglePost')->middleware('auth');
    Route::post('/comments/{comment}/like', [LikeController::class, 'toggleCommentLike'])->name('likes.toggleComment')->middleware('auth');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
});

// Locale
Route::get('locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

require __DIR__ . '/auth.php';
