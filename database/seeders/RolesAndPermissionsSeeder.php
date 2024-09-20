<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {

       // $adminRole = Role::create(['name' => 'admin']);
       // $userRole = Role::create(['name' => 'user']);

      //  Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'read data']);
        Permission::create(['name' => 'edit data']);
        Permission::create(['name' => 'access data']);

       // $adminRole->givePermissionTo(Permission::all());

    }
}
