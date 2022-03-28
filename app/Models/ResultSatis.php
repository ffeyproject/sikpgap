<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResultSatis extends Model
{
    use HasFactory;

    protected $fillable = ['satisfactions_id', 'item_evaluations_id', 'score'];

    public $table = "result_satisfactions";


    public function satisfaction(): BelongsTo
    {
        return $this->belongsTo(satisfaction::class, 'satisfactions_id');
    }

    public function itemevaluation(): BelongsTo
    {
        return $this->belongsTo(ItemEvalution::class, 'item_evaluations_id');
    }


}