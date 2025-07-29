<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teach extends Model
{
    /** @use HasFactory<\Database\Factories\TeachFactory> */
    use HasFactory;

    protected $fillable = ['grade_id', 'subject_id', 'teacher_id', 'code', 'name', 'time', 'room'];
}
