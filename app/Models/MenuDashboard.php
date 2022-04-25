<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuDashboard extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'categori_menu', 'item_menu', 'ket_menu', 'status'];

    public $table = "menu_customers";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}