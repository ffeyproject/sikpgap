<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['users_id', 'complaints_id', 'defects_id', 'hasil_penelusuran', 'tindakan', 'tgl_verifikasi', 'target_waktu', 'hasil_verifikasi','asal_masalah'];

    public $table = "result_complaints";


    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class, 'complaints_id');
    }

    public function defect(): BelongsTo
    {
        return $this->belongsTo(Defect::class,  'defects_id');
    }

    public function departements(): BelongsTo
    {
        return $this->belongsTo(Departement::class,  'departements_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
