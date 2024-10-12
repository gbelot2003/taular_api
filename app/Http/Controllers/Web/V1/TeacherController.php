<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;


class TeacherController extends Controller
{
    public function index()
    {
        // Obtiene todos los usuarios que tienen el rol de maestro
        $teachers = User::role('maestro')->get();

        return Inertia::render('Teachers/Index', [
            'teachers' => $teachers,
        ]);
    }

    public function create()
    {
        return Inertia::render('Teachers/Create');
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Crear el usuario
        $teacher = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Asignar el rol de maestro
        $teacher->assignRole('maestro');

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function edit(User $teacher)
    {
        return Inertia::render('Teachers/Edit', [
            'teacher' => $teacher,
        ]);
    }

    public function update(Request $request, User $teacher)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $teacher->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Actualizar los datos del maestro
        $teacher->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $teacher->password,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(User $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
