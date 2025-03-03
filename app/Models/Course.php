<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Enrollment;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'instructor_id',
        'status'
    ];

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'course_modules')->withTimestamps();
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'course_instructors')->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')->withTimestamps();
    }

    public function materials()
    {
        return $this->hasMany(CourseMaterial::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * Get the enrollments for the course.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
