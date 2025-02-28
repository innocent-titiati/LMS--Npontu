<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    // Define relationships if needed
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_module')->withPivot('order')->orderBy('order');
    }
}