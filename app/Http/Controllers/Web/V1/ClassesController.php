<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Classes;
use App\Models\User;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = Classes::with('teacher', 'students')->get();
        return Inertia::render('Classes/Index', ['classes' => $classes]);
    }

    public function assignStudent(Classes $class, User $user)
    {
        $user->assignRole('alumno');
        $class->students()->attach($user);
    }

    public function assignTeacher(Classes $class, User $user)
    {
        $user->assignRole('maestro');
        $class->update(['teacher_id' => $user->id]);
    }
}
