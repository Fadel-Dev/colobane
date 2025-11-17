<?php

namespace Database\Seeders;

use App\Models\Immobiliers;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ImmobilierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');
        $users = User::all();

        $types = ['Maison', 'Appartement', 'Studio', 'Villa', 'Terrain', 'Duplex', 'Immeuble', 'Locaux commerciaux'];
        $cities = ['Dakar', 'Thiès', 'Kaolack', 'Tambacounda', 'Saint-Louis', 'Ziguinchor', 'Kolda', 'Louga'];
        $quartiers = ['Plateau', 'Fann', 'Sacré-Cœur', 'Ouakam', 'Almadies', 'Yoff', 'Liberté', 'Mermoz', 'Ngor', 'Grand-Yoff'];

        // Images Unsplash - URLs directes pour stockage
        $images = [
            'https://images.unsplash.com/photo-1570129477492-45a003537e1f?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1512917774080-9b274b3f5798?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1468036882921-7aae196d8af6?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1567605004555-e3ef3a3f747f?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1542321066-7deced3b7c0f?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1482012182733-540ce549b4eb?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=500&h=300&fit=crop',
        ];

        // Créer 250 annonces immobilières
        for ($i = 0; $i < 250; $i++) {
            $type = $faker->randomElement($types);
            $prix = $faker->numberBetween(5000000, 500000000); // Prix en FCFA
            $surface = $faker->numberBetween(50, 1000);
            $chambres = $faker->numberBetween(1, 10);
            $ville = $faker->randomElement($cities);
            $quartier = $faker->randomElement($quartiers);

            $descriptions = [
                "Belle {$type} spacieuse à {$quartier}, {$ville}. Idéale pour une famille. Proche des commodités.",
                "Luxueuse {$type} neuve avec {$chambres} chambres et terrasse. Localisation privilégiée à {$ville}.",
                "{$type} moderne avec jardin, piscine et parking sécurisé. À {$quartier}, {$ville}.",
                "Investissement immobilier idéal: {$type} en bon état, surface {$surface}m². Rentabilité garantie.",
                "Cozy {$type} parfait pour couple ou petit famille. Situation centrale à {$ville}.",
            ];

            // Sélectionner 3 images aléatoires
            $selectedImages = $faker->randomElements($images, 3);

            Immobiliers::create([
                'user_id' => $users->random()->id,
                'type' => $type,
                'nom' => "{$type} {$chambres}ch à {$quartier}",
                'categorie' => $faker->randomElement(['Vente', 'Location']),
                'description' => $faker->randomElement($descriptions),
                'prix' => (string) $prix,
                'npiece' => (string) $chambres,
                'surface' => (string) $surface,
                'region' => $ville,
                'affaire' => $faker->randomElement(['Neuf', 'Ancien', 'En construction']),
                'image1' => $selectedImages[0],
                'image2' => $selectedImages[1],
                'image3' => $selectedImages[2],
                'booster' => $faker->boolean(30),
                'vendu' => $faker->boolean(20),
                'onceBooster' => $faker->boolean(40),
                'status' => $faker->randomElement(['accepter', 'Vendu', 'En attente']),
            ]);
        }

        $this->command->info('✅ 250 annonces immobilières créées avec images Unsplash !');
    }
}
