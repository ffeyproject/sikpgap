<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageComplaint extends Model
{
    use HasFactory;

    protected $fillable = ['complaints_id', 'nama_image', 'keterangan'];

     public $table = "image_complaints";


    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class, 'complaints_id');
    }
}