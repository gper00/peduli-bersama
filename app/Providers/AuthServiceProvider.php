<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Campaign;
use App\Policies\CampaignPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Campaign::class => CampaignPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Register gate for admin access
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });
        
        // Register gate for campaign management (admin and creator)
        Gate::define('manage-campaigns', function ($user) {
            return in_array($user->role, ['admin', 'creator']);
        });
        
        // Register gate for category management (admin only)
        Gate::define('manage-categories', function ($user) {
            return $user->role === 'admin';
        });
    }
}
