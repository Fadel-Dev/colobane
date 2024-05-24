<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Immobilier>
 */
class ImmobiliersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = \App\Models\Immobiliers::class;
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10), // Associe l'immobilier à un utilisateur
            'date_fin_booster' =>$this->faker->randomElement([0,1]),
            'booster' => $this->faker->randomElement([0,1]),
            'vendu' => $this->faker->boolean(),
            'type' => 'chambre',
            'nom' => $this->faker->words(3, true),
            'description' => $this->faker->paragraphs(3, true),
            'prix' => $this->faker->numberBetween(100000, 10000000),
            'npiece' => 1,
            'image1' => $this->faker->imageUrl(640, 480, 'real-estate', true),
            'image2' => $this->faker->optional()->imageUrl(640, 480, 'real-estate', true),
            'image3' => $this->faker->optional()->imageUrl(640, 480, 'real-estate', true),
            'region' => 'dakar',
            'categorie' => $this->faker->randomElement(['vente', 'location']),
            'affaire' => $this->faker->word(),
            'surface' => $this->faker->numberBetween(20, 500),
        ];
    }
}
