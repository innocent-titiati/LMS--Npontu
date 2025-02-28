<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    use HasFactory;

    protected $table = 'course_materials'; // Specify the table name if it's not the plural of the model name

    protected $fillable = [
        'course_id',
        'module_id',
        'material_type',
        'file_path',
        'uploaded_by',
        'status',
    ];

    // Define relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
