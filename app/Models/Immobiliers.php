<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immobiliers extends Model
{
protected $guarded=[];

protected $casts = [
    'images' => 'array', // Caster le champ JSON en tableau
];

public function user ()
{
   return $this->belongsTo(User::class);
}

// Favoris
public function favoris()
{
    return $this->hasMany(Favori::class, 'immobilier_id');
}

public function favorisUsers()
{
    return $this->belongsToMany(User::class, 'favoris', 'immobilier_id', 'user_id')
        ->withTimestamps();
}

    use HasFactory;
}
