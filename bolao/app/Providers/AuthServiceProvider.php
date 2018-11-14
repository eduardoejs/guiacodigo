<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user){
            if($user->isAdmin())
                return true;
        });

        if(!App::runningInConsole())
        {
            foreach($this->getPermissions() as $permission) {
                Gate::define($permission->name, function($user) use($permission){
                    return $user->hasRoles($permission->roles) /*|| $user->isAdmin()*/;
                });
            }
        }
    }

    private function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
