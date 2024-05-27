<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
        $this->registerPolicies();
        // handel Permissions:
        foreach ($this->getPermissions() as $permission){
            Gate::define($permission->title, function ($user) use ($permission){
                return $user->role->hasPermisssion($permission->title);
            });//میاد بررسی میکنه مجوزهای که این userلاگین کرده roleاش چه permissionدارد

        }

//        Gate::define('create-role', function (User $user){
//            return $user->role->hasPermission('create-role');
//        });
    }

    public function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
