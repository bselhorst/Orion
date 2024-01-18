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

        // Criando as permissões de usuário
        $permission = Permission::create(['name' => 'user.create']);
        $role_admin->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'user.read']);
        $role_admin->givePermissionTo($permission);
        $role_user->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'user.update']);
        $role_admin->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'user.delete']);
        $role_admin->givePermissionTo($permission);

        // Criando as permissões de Projeto
        $permission = Permission::create(['name' => 'projeto.create']);
        $role_admin->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'projeto.read']);
        $role_admin->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'projeto.update']);
        $role_admin->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'projeto.delete']);
        $role_admin->givePermissionTo($permission);

        // Criando as permissões de Orçamento
        $permission = Permission::create(['name' => 'projeto.orcamento.create']);
        $role_admin->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'projeto.orcamento.read']);
        $role_admin->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'projeto.orcamento.update']);
        $role_admin->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'projeto.orcamento.delete']);
        $role_admin->givePermissionTo($permission);
    }
}
