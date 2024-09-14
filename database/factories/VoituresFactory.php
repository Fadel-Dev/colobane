<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voitures>
 */
class VoituresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Voitures::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10), // Associe la voiture à un utilisateur
            'nom' => $this->faker->word(),
            'date_fin_booster' => $this->faker->optional()->date($format = 'Y-m-d', $max = 'now'),
            'booster' => $this->faker->boolean(),
            'vendu' =>0,
            'marque' => $this->faker->randomElement(["Toyota",
    "Ford",
    "BMW",
    "Mercedes-Benz",
    "Audi",
    "Honda",
    "Nissan",
    "Volkswagen",
    "Peugeot",
    "Renault",
    "Chevrolet",
    "Hyundai",
    "Kia",
    "Land Rover",
    "Volvo",
    "Porsche",
    "Tesla",
    "Fiat",
    "Lexus",
    "Jaguar"]),
            'model' => $this->faker->word(),
            'description' => $this->faker->paragraph(1),
            'prix' => $this->faker->numberBetween(1000000, 50000000),
            'boiteVitesse' => $this->faker->randomElement(['automatique', 'manuelle']),
            'kilometrage' => $this->faker->numberBetween(0, 200000),
            'carburant' => $this->faker->randomElement(['essence', 'diesel', 'électrique']),
            'place' => $this->faker->randomElement(['2', '4', '5', '7']),
            'image1' => $this->faker->imageUrl(),
             'image2' => $this->faker->imageUrl(),
             'image3' => $this->faker->imageUrl(),
            'region' => 'dakar',
            'annee' => $this->faker->year(),
            'etat' => $this->faker->randomElement(['neuf', 'occasion']),
            'affaire' => $this->faker->randomElement(['vente', 'location']),
            'categorie' =>'voiture',
        ];
    }
}
