<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'certificate_number',
        'course_id',
        'issued_by',
        'issued_date',
    ];

    // Define relationships
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}