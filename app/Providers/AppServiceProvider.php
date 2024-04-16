<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        JsonResource::withoutWrapping();
        Gate::define('update-blog', function (User $user, Blog $blog) {
            return $user->id === $blog->user_id;
        });
    }
}
