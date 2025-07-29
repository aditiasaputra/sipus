<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'student_id'];

    /**
     * Get the user that owns the student.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the grades that belong to the student.
     */
    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class, 'student_has_grade', 'student_id', 'grade_id')
                    ->withTimestamps();
    }
}
