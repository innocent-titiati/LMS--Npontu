<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module; // Import Module model

class Course extends Model
{
    protected $primaryKey = 'course_id'; // if your primary key is not "id"

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'course_module', 'course_id', 'module_id');
    }
}
