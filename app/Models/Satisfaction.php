<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Satisfaction extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'buyers_id', 'kode_penilaian', 'nama_pelanggan', 'nama_kontak', 'alamat', 'tgl_penilaian', 'desc_kesesuaian', 'kritik_saran', 'status', 'r_nilai'];

    public $table = "satisfactions";


    public function buyer(): BelongsTo
    {
        return $this->belongsTo(buyer::class, 'buyers_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itemevaluation(): BelongsTo
    {
        return $this->belongsTo(ItemEvalution::class, 'item_evaluations_id');
    }

      public function resultsatis(): HasMany
   {
     return $this->hasMany(ResultSatis::class, 'id');
   }


    
}