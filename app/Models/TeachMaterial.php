<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachMaterial extends Model
{
    /** @use HasFactory<\Database\Factories\TeachMaterialFactory> */
    use HasFactory;

    protected $fillable = ['grade_id', 'teacher_id', 'code', 'name', 'note', 'file'];
}
