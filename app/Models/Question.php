<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['course_id', 'content'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}