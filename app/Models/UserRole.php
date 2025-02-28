<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_role'; // Specify the table name if it's not the plural of the model name

    protected $fillable = [
        'user_id',
        'role',
        'status',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}