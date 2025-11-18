<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'immobilier_id',
        'read',
    ];

    protected $casts = [
        'read' => 'boolean',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec l'immobilier (si applicable)
     */
    public function immobilier()
    {
        return $this->belongsTo(Immobiliers::class, 'immobilier_id');
    }

    /**
     * Marquer la notification comme lue
     */
    public function markAsRead()
    {
        $this->update(['read' => true]);
    }
}
