<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Defect extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['users_id', 'kode_defect', 'kategori', 'nama', 'keterangan'];

    public $table = "defects";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}