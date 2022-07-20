<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemEvalution extends Model
{
   use HasFactory, SoftDeletes;

    protected $fillable = ['users_id', 'kode_item', 'nama_penilaian', 'keterangan'];

    public $table = "item_evaluations";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
   public function satisfaction(): HasMany
    {
        return $this->hashMany(satisfaction::class, 'id');
    }
}