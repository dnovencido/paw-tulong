<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Added import
use App\Models\ChatSession; // Added for clarity

class ChatLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chat_session_id',
        'question',
        'answer',
        'category',
        'response_time',
    ];

    protected $casts = [
        'response_time' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsTo(ChatSession::class, 'chat_session_id');
    }
}
