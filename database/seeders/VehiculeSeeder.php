<?php

namespace Database\Seeders;

use App\Models\Voitures;
use App\Models\Voiturelocation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VehiculeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');
        $users = User::all();

        $marques = [
            'Toyota', 'Honda', 'Hyundai', 'Kia', 'Suzuki', 'Renault', 
            'Peugeot', 'Mercedes', 'BMW', 'Audi', 'Volkswagen', 'Nissan',
            'Dacia', 'Citroën', 'Fiat', 'Chevrolet', 'Ford', 'Mazda'
        ];

        $modeles = [
            'Corolla', 'Civic', 'i10', 'Picanto', 'Swift', 'Clio',
            '206', 'C3', 'E-Class', '3 Series', 'A4', 'Golf'
        ];

        $images_voiture = [
            'https://images.unsplash.com/photo-1552820728-8ac41f1ce891?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1553882900-f2b6dda3e2a7?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1569783902231-08003dc1b917?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1580274455191-1c62238fa333?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1542282088-fe8426682b8f?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500&h=300&fit=crop',
            'https://images.unsplash.com/photo-1464219414925-bed2b0c7bb0c?w=500&h=300&fit=crop',
        ];

        $cities = ['Dakar', 'Thiès', 'Kaolack', 'Tambacounda', 'Saint-Louis', 'Ziguinchor', 'Kolda', 'Louga'];

        // Créer 125 annonces de VOITURES À LA VENTE
        for ($i = 0; $i < 125; $i++) {
            Voitures::create([
                'user_id' => $users->random()->id,
                'nom' => $faker->randomElement($marques) . ' ' . $faker->randomElement($modeles),
                'marque' => $faker->randomElement($marques),
                'model' => $faker->randomElement($modeles),
                'annee' => $faker->numberBetween(2010, 2024),
                'carburant' => $faker->randomElement(['Essence', 'Diesel', 'Hybride']),
                'kilometrage' => (string) $faker->numberBetween(5000, 250000),
                'prix' => (string) $faker->numberBetween(2000000, 50000000), // FCFA
                'description' => $faker->sentence(15),
                'boiteVitesse' => $faker->randomElement(['Manuelle', 'Automatique']),
                'place' => (string) $faker->numberBetween(4, 8),
                'image1' => $faker->randomElement($images_voiture),
                'image2' => $faker->randomElement($images_voiture),
                'image3' => $faker->randomElement($images_voiture),
                'region' => $faker->randomElement($cities),
                'etat' => $faker->randomElement(['Neuf', 'Bon état', 'Occasion']),
                'affaire' => $faker->randomElement(['Bonne affaire', 'Normale', 'Premium']),
                'categorie' => 'Vente',
                'booster' => $faker->boolean(30),
                'vendu' => $faker->boolean(15),
                'onceBooster' => $faker->boolean(40),
                'status' => $faker->randomElement(['Disponible', 'Vendu', 'En réparation']),
            ]);
        }

        // Créer 125 annonces de VOITURES EN LOCATION
        for ($i = 0; $i < 125; $i++) {
            Voiturelocation::create([
                'user_id' => $users->random()->id,
                'nom' => $faker->randomElement($marques) . ' ' . $faker->randomElement($modeles) . ' - Location',
                'marque' => $faker->randomElement($marques),
                'description' => $faker->sentence(15),
                'prix' => $faker->numberBetween(25000, 150000), // FCFA par jour
                'carburant' => $faker->randomElement(['Essence', 'Diesel']),
                'place' => (string) $faker->numberBetween(4, 7),
                'image1' => $faker->randomElement($images_voiture),
                'image2' => $faker->randomElement($images_voiture),
                'image3' => $faker->randomElement($images_voiture),
                'region' => $faker->randomElement($cities),
                'affaire' => $faker->randomElement(['Bonne affaire', 'Normale', 'Premium']),
                'boiteVitesse' => $faker->randomElement(['Manuelle', 'Automatique']),
                'categorie' => 'Location',
            ]);
        }

        $this->command->info('✅ 250 annonces véhicules (125 vente + 125 location) créées avec succès !');
    }
}
