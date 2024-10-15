<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware(['auth', 'role:administrador'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('admin.dashboard');
    });

    Route::middleware(['auth', 'role:maestro'])->group(function () {
        Route::get('/teacher/classes', function () {
            return Inertia::render('Teacher/Classes');
        })->name('teacher.classes');
    });

    Route::middleware(['auth', 'role:padre'])->group(function () {
        Route::get('/parent/reports', function () {
            return Inertia::render('Parent/Reports');
        })->name('parent.reports');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
    });

    Route::get('/grades', [App\Http\Controllers\Web\V1\GradeController::class, 'index'])->name('grades.index');

});
