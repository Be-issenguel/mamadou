<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Permission;
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

        //dd(Permission::with('roles')->get()[0]->roles);
        foreach(Permission::with('roles')->get() as $permission){
            Gate::define($permission->nome, function ($user) use ($permission){
                return $permission->roles->intersect($user->roles)->count();
            });
        }
    }
}
