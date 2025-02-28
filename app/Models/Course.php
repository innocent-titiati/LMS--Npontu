<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'start_date',
        'end_date',
        'manager_id',
    ];

    // Define relationships
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'course_module')->withPivot('order')->orderBy('order');
    }
}
