<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Added import
use App\Models\ChatLog; // Added for clarity

class ChatSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_name',
    ];

    public function chatLogs()
    {
        return $this->hasMany(ChatLog::class, 'chat_session_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
