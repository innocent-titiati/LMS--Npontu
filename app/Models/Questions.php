<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
