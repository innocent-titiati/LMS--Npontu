<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;  // Already imported
use App\Models\Module;  // Already imported

class CourseMaterial extends Model
{
    protected $table = 'course_materials';

    protected $fillable = [
        'course_id', 'module_id', 'title', 'material_type', 'file_path', 'description'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}


