<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['users_id', 'kode_asal', 'asal_masalah', 'keterangan'];

    public $table = "departements";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}