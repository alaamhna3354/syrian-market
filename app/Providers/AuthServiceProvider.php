<?php

namespace App\Providers;

use App\Models\User;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('agent', function(User $user) {
            return $user->is_agent ;
        });

        Gate::define('marketer', function(User $user) {
            return $user->marketer ;
        });

        Gate::define('golden_marketer', function(User $user) {
            return $user->marketer->is_golden && $user->marketer->status=='active' ;
        });

        Gate::define('join_as_marketer', function(User $user) {
            return @$user->marketer->status=="disabled" || !$user->marketer ;
        });
        Gate::define('active_marketer', function(User $user) {
            return $user->marketer && $user->marketer->status=='active' ;
        });
        Gate::define('normal_marketer', function(User $user) {
            return $user->marketer->is_golden==0 && $user->marketer->status=='active' ;
        });
    }
}
