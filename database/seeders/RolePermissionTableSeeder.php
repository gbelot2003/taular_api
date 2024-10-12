<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionTableSeeder extends Seeder
{
    public function run()
    {
        // Crear Roles si no existen
        $roles = ['administrador', 'supervisor', 'maestro', 'padre', 'alumno'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Crear Permisos
        $permissions = ['ver dashboard', 'ver usuarios', 'crear usuarios', 'editar usuarios'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Asignar todos los permisos al rol de Administrador
        $admin = Role::findByName('administrador');
        $admin->givePermissionTo(Permission::all());

        // Crear usuarios y asignarles roles
        $users = [
            ['name' => 'Supervisor User', 'email' => 'supervisor@example.com', 'role' => 'supervisor'],
            ['name' => 'Maestro User', 'email' => 'maestro@example.com', 'role' => 'maestro'],
            ['name' => 'Padre User', 'email' => 'padre@example.com', 'role' => 'padre'],
            ['name' => 'Alumno User', 'email' => 'alumno@example.com', 'role' => 'alumno'],
        ];

        // Crear el usuario administrador y asignarle el rol
        $adminUser = User::firstOrCreate(
            ['email' => 'tester@tester.com'],
            ['name' => 'Gerardo Belot', 'password' => bcrypt('password')]
        );
        $adminUser->assignRole('administrador');

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                ['name' => $userData['name'], 'password' => bcrypt('password')]
            );
            $user->assignRole($userData['role']);
        }
    }
}
