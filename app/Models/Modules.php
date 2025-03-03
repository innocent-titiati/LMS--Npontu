<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modules extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'description'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_modules')->withTimestamps();
    }
}

