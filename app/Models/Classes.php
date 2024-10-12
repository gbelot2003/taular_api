<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_student')->whereHas('roles', function ($query) {
            $query->where('name', 'alumno');
        });
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id')->whereHas('roles', function ($query) {
            $query->where('name', 'maestro');
        });
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
