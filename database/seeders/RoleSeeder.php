<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        /**
         * super-admin roles
         */

        $superAdmin = Role::query()->create([
            'title' => 'super-admin',
        ]);

        $superAdmin->permissions()->attach(Permission::all());//یعنی هرچی مجوز دسترسی هست رابه سوپر ادمین بده


        /**
         * normal-user
         */
        Role::query()->insert([
            'title' => 'normal-user',
        ]);

    }
}
