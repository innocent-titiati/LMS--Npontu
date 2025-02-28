<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessages extends Model
{
    use HasFactory;

    protected $table = 'user_messages'; // Specify the table name if it's not the plural of the model name

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'content',
        'timestamp',
    ];

    // Define relationships
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}