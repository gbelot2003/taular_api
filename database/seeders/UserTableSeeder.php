<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        // Asignar permisos a cada usuario generado
        foreach ($users as $user) {
            $role = Role::firstOrCreate(['name' => 'alumno']);
            $user->assignRole($role); // Asignar el rol 'alumno' a cada usuario
        }

       // Crear un usuario específico con rol de administrador
       $adminUser = User::factory()->create([
        'name' => 'Gerardo Belot',
        'email' => 'tester@tester.com',
    ]);

        $adminRole = Role::findByName('administrador');
        $adminUser->assignRole($adminRole); // Asignar rol de administrador
    }
}
