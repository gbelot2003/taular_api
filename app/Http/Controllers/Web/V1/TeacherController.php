<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Teacher;


class TeacherController extends Controller
{
    public function index() {
        $teachers = Teacher::all();
        return Inertia::render('Teachers/Index', ['teachers' => $teachers]);
    }
}
