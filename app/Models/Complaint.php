<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'buyers_id', 'no_urut', 'nomer_keluhan', 'tgl_keluhan', 'nama_marketing', 'no_wo', 'no_sc', 'nama_motif', 'cw_qty','jenis','masalah','solusi', 'tgl_proses','status'];

    public $table = "complaints";


    public function buyer(): BelongsTo
    {
        return $this->belongsTo(buyer::class, 'buyers_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}