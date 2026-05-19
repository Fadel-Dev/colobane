<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'region',
        'min_price',
        'max_price',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
