<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use App\Models\Immobiliers;
use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Immobiliers>
 */
class ImmobillierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Immobiliers::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array

    {


        return [
            'name' => $this->faker->streetName(),
            'image1' => $this->faker->image(),
            'image2' => $this->faker->image(),
            'image3' => $this->faker->image(),
            'description' => $this->faker->realTextBetween(70,180),
            'region' => 'dakar',
            'affaire' => 'location',
            'prix' => $this->faker->biasedNumberBetween(20000,170000),
            'type' => 'maison',
            'categorie' => 'immobilier',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ];
    }
}
