<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

       Gate::define('post-create', function($user){
          if($user->role == 'SuperAdmin' || $user->role == 'Admin'){
            return true;
          }
          return false;
       });

       Gate::define('post-edit', function($user){
          if($user->role == 'SuperAdmin' || $user->role == 'Admin'){
            return true;
          }
          return false;
       });
       Gate::define('post-view', function($user){
          if($user->role == 'Admin' || $user->role == 'SuperAdmin' || $user->role == 'User'){
            return true;
          }
          return false;
       });
       Gate::define('post-delete', function($user){
          if($user->role == 'SuperAdmin'){
            return true;
          }
          return false;
       });

    }
}
