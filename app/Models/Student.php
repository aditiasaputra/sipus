<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'student_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
