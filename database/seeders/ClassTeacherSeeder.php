<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Classes;

class ClassTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Crear algunos maestros
            $teachers = [
                ['name' => 'Carlos Gomez', 'email' => 'carlos.maestro@example.com'],
                ['name' => 'Maria Perez', 'email' => 'maria.maestro@example.com'],
            ];

            foreach ($teachers as $teacherData) {
                // Crear usuarios con el rol de maestro
                $teacher = User::firstOrCreate(
                    ['email' => $teacherData['email']],
                    ['name' => $teacherData['name'], 'password' => bcrypt('password')]
                );
                $teacher->assignRole('maestro');

                // Crear clases asociadas a los maestros
                Classes::create([
                    'name' => 'Clase de ' . $teacher->name,
                    'teacher_id' => $teacher->id,
                ]);
            }
    }
}
