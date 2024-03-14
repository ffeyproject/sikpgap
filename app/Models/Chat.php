<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    public $table = "chats";
    protected $fillable = ['users_id', 'complaints_id', 'message'];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class, 'complaints_id');
    }
}
