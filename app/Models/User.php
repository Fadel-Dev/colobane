<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password','phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
//Vehicule
    public function Lead()
    {
        return $this->hasMany(Lead::class);
    }

    public function Voitures()
    {
        return $this->hasMany(Voitures::class);
    }

    public function Voiturelocation()
    {
        return $this->hasMany(Voiturelocation::class);
    }




//Immobillier

public function Immobiliers()
{
    return $this->hasMany(Immobiliers::class);
}

// Favoris
public function favoris()
{
    return $this->hasMany(Favori::class);
}

public function favorisImmobiliers()
{
    return $this->belongsToMany(Immobiliers::class, 'favoris', 'user_id', 'immobilier_id')
        ->withTimestamps();
}

// Notifications
public function notifications()
{
    return $this->hasMany(\App\Models\Notification::class)->orderBy('created_at', 'desc');
}

public function unreadNotifications()
{
    return $this->hasMany(\App\Models\Notification::class)->where('read', false)->orderBy('created_at', 'desc');
}

/**
 * Envoyer une notification de réinitialisation de mot de passe personnalisée
 * 
 * Cette méthode remplace la notification par défaut de Fortify
 * par notre notification en français avec design cool et logo
 * 
 * @param string $token
 * @return void
 */
public function sendPasswordResetNotification($token)
{
    // Envoyer notre notification personnalisée au lieu de celle par défaut de Fortify
    $this->notify(new ResetPasswordNotification($token));
}
}
