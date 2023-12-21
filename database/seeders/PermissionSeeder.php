<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criando as roles admin e user
        $role_admin = Role::create(['name' => 'Admin']);
        $role_user = Role::create(['name' => 'User']);

        // Criando as permissões
        $permission = Permission::create(['name' => 'Create Users']);
        $role_admin->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'Read Users']);
        $role_admin->givePermissionTo($permission);
        $role_user->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'Update Users']);
        $role_admin->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'Delete Users']);
        $role_admin->givePermissionTo($permission);
    }
}
