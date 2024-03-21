<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class ChatPersonal extends Model
{
    use HasFactory, Notifiable;

     public $table = "chat_personals";
    protected $fillable = ['users_id', 'complaints_id', 'message', 'created_at'];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class, 'complaints_id');
    }
}
