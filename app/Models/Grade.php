<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Grade extends Model
{
    /** @use HasFactory<\Database\Factories\GradeFactory> */
    use HasFactory;

    protected $fillable = ['teacher_id', 'code', 'name'];

    /**
     * Get the students for the grade.
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_has_grade', 'grade_id', 'student_id')
                    ->withTimestamps();
    }

    /**
     * Get the detail teacher.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
