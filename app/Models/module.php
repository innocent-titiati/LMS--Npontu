<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course; // Import Course model

class Module extends Model
{
    protected $primaryKey = 'module_id'; // if your primary key is not "id"

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_module', 'module_id', 'course_id');
    }
}

