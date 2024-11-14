<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as RequestData;
use App\Models\Grade;

class GradeController extends Controller
{

    public function index()
    {
        return Inertia::render('Grade/Index', [
            'cursos' => Grade::all(),
            'filters' => Request::only(['search']),
        ]);
    }

    public function store(RequestData $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Grade::create([
            'name' => $request->name,
        ]);

        return redirect()->route('grades.index');
    }
}
