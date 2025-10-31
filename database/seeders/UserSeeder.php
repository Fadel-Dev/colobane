<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        // Créer un utilisateur administrateur de test
        User::factory()->create([
            'name' => 'Administrateur',
            'email' => 'admin@colobane.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'phone' => '+221771234567',
        ])->each(function ($user) {
            $user->ownedTeams()->create([
                'name' => $user->name . "'s Team",
                'personal_team' => true,
            ]);
        });

        // Créer 199 utilisateurs supplémentaires
        User::factory(199)
            ->create()
            ->each(function ($user) {
                // Créer une équipe personnelle pour chaque utilisateur
                $user->ownedTeams()->create([
                    'name' => $user->name . "'s Team",
                    'personal_team' => true,
                ]);
            });

        $this->command->info('✅ 200 utilisateurs créés avec succès !');
    }
}
