<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;


class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear Roles si no existen
        $roles = ['administrador', 'supervisor', 'maestro', 'padre', 'alumno'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Crear Permisos
        $permissions = [
            'ver usuarios', 'crear usuarios', 'editar usuarios', 'suspender usuarios'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Asignar todos los permisos al rol de Administrador
        $admin = Role::findByName('administrador');
        $admin->givePermissionTo(Permission::all());
    }
}
