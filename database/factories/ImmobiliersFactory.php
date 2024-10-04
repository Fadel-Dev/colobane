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

     protected $model =\App\Models\Immobiliers::class;
    public function definition(): array
    {
        return [

            'user_id' => $this->faker->numberBetween(1, 10), // Associe l'immobilier à un utilisateur
            'date_fin_booster' =>$this->faker->date($format = 'Y-m-d', $max = 'now'),
                       'booster' => $this->faker->randomElement([0,1]),
            'vendu' => 0,
            'type' =>$this->faker->randomElement(['ferme', 'terrain', 'verger','chambre','immeuble','villa']),
            'nom' => $this->faker->words(3, true),
            'description' => $this->faker->paragraphs(1, true),
            'prix' => $this->faker->numberBetween(100000, 10000000),
            'npiece' => 1,
             'image1' => $this->faker->imageUrl(),
             'image2' => $this->faker->imageUrl(),
             'image3' => $this->faker->imageUrl(),

            'region' => 'dakar',
            'categorie' => 'immobilier',
            'affaire' => $this->faker->randomElement(['vente', 'location']),
            'surface' => $this->faker->numberBetween(20, 500),
        ];
    }
}
