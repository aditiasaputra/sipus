<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSubject extends Model
{
    /** @use HasFactory<\Database\Factories\TaskSubjectFactory> */
    use HasFactory;

    protected $fillable = ['subject_id', 'grade_id', 'teacher_id', 'code', 'name', 'note', 'file'];
}
