<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class buyer extends Model
{
    use HasFactory, SoftDeletes;

     protected $fillable = ['user_id','kode_buyer','nama_buyer','alamat_buyer','cp_buyer','telp_buyer','email_buyer'];

    public $table = "buyers";

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}