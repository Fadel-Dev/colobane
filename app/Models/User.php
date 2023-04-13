<?php

namespace App\Models;

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
        'name', 'email', 'password',
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

    public function MotoScooters()
    {
        return $this->hasMany(MotoScooters::class);
    }

    public function Equipements()
    {
        return $this->hasMany(Equipements::class);
    }
//multimedia
      public function Ordinateurs()
    {
        return $this->hasMany(Ordinateurs::class);
    }

    public function ImagesSons()
    {
        return $this->hasMany(ImagesSons::class);
    }

    public function Telephones()
    {
        return $this->hasMany(Telephones::class);
    }
//Habillement
      public function Habillements()
    {
        return $this->hasMany(Habillements::class);
    }

    public function Enfants()
    {
        return $this->hasMany(Enfants::class);
    }

    public function Accessoires()
    {
        return $this->hasMany(Accessoires::class);
    }
//Service
    public function Batiments()
    {
        return $this->hasMany(Batiments::class);
    }

    public function Domestiques()
    {
        return $this->hasMany(Domestiques::class);
    }

    public function Covoiturages()
    {
        return $this->hasMany(Covoiturages::class);
    }

//Electromenager
public function Electromenagers()
{
    return $this->hasMany(Electromenagers::class);
}

public function Decorations()
{
    return $this->hasMany(Decorations::class);
}

public function OutilsPros()
{
    return $this->hasMany(OutilsPros::class);
}

//Immobillier

public function Immobiliers()
{
    return $this->hasMany(Immobiliers::class);
}
}
