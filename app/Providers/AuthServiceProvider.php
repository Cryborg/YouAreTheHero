<?php

namespace App\Providers;

use App\Classes\Constants;
use App\Models\Story;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Story'    => 'App\Policies\StoryPolicy',
        'App\Models\Page'     => 'App\Policies\PagePolicy',
        'App\Models\ItemPage' => 'App\Policies\ItemPagePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('debug', static function ($user) {
            return $user->id === 1 || $user->role === 'developer';
        });
        Gate::define('isAdmin', static function ($user) {
            return $user->role === Constants::ROLE_ADMIN;
        });
        Gate::define('edit', static function ($user, $story = null) {
            if ($story instanceof Story) {
                return $user->id === $story->user_id && $user->role !== Constants::ROLE_TEMPORARY;
            }
            return $user->role !== Constants::ROLE_TEMPORARY;
        });
    }
}
