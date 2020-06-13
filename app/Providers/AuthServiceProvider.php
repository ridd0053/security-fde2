<?php

namespace App\Providers;
use App\Policies\AccountPolicy;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => AccountPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('edit-users', function($user){
            return $user->hasRole('admin');
        });
        Gate::define('delete-users', function($user){
            
            return $user->hasRole('admin');
        });
        Gate::define('delete-own-account', function($user){
            
            return $user->isAllowedToDeleteOwnAccount($user->id);
            
        });
        Gate::define('edit-own-role', function($user){
            
            return $user->isAllowedToEditOwnAdminRole($user->id);
            
        });
        Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(['admin', 'author']);
        });

        Gate::define('manage-account', function($user){
            
            return $user->canEditOwnAccount($user->id);
        });


        Gate::define('create-posts', function($user){
            return $user->hasRole('author');
        });
        
        
        Gate::define('edit-posts', function($user){
            return $user->hasAnyRoles(['admin', 'author']);
        });

        Gate::define('see-posts', function($user){
            return $user->hasAnyRoles(['admin', 'author', 'user']);
        });

        Gate::define('delete-posts', function($user){
            return $user->canDeletePost();
        });
    
    }
}
