<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Story' => 'App\Policies\StoryPolicy',
         'App\Models\Page' => 'App\Policies\PagePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', static function ($user) {
            return $user->role === 'admin';
        });
        Gate::define('edit', static function ($page, $user) {
            return $user->id === $page->story->user_id;
        });
    }
}
