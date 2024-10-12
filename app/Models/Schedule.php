<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function classModel()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
