<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Define gates for permissions
        Gate::define('create-post', function (User $user) {
            return $user->canCreatePost();
        });

        Gate::define('edit-post', function (User $user, Post $post) {
            return $user->canEditPost($post);
        });

        Gate::define('delete-post', function (User $user, Post $post) {
            return $user->canDeletePost($post);
        });

        Gate::define('comment', function (User $user) {
            return $user->canComment();
        });

        Gate::define('approve-comment', function (User $user) {
            return $user->isAdmin() || $user->isWriter();
        });

        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('writer', function (User $user) {
            return $user->isWriter();
        });

        Gate::define('reader', function (User $user) {
            return $user->isReader();
        });
    }
}
