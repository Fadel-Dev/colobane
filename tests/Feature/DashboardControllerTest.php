<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Immobiliers;
use App\Models\Voitures;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dash_displays_correct_data()
    {
        // Créer un utilisateur administrateur
        $admin = User::factory()->create(['role' => 'admin']);

        // Créer des données pour les immobiliers et voitures
        $immobilier = Immobiliers::factory()->create([
            'booster' => 1,
            'status' => 'pending',
            'user_id' => $admin->id,
        ]);

        $voiture = Voitures::factory()->create([
            'booster' => 1,
            'status' => 'pending',
            'user_id' => $admin->id,
        ]);

        // Authentifier l'utilisateur administrateur
        $this->actingAs($admin);

        // Appeler la méthode Dash
        $response = $this->get(route('dashboard'));

        // Vérifier que la réponse est correcte et contient les données attendues
        $response->assertStatus(200);
        $response->assertInertia(function ($page) use ($immobilier, $voiture) {
            $page->component('DashboardAdmin')
                 ->has('voitures', 1)
                 ->has('immobiliers', 1)
                 ->has('users', 1)
                 ->where('voitures.0.id', $voiture->id)
                 ->where('immobiliers.0.id', $immobilier->id);
        });
    }

    public function test_non_admin_dash_displays_correct_data()
    {
        // Créer un utilisateur non-admin
        $user = User::factory()->create(['role' => 'user']);

        // Créer des données pour les immobiliers et voitures
        $immobilier = Immobiliers::factory()->create([
            'user_id' => $user->id,
            'vendu' => 0,
        ]);

        $voiture = Voitures::factory()->create([
            'user_id' => $user->id,
            'vendu' => 1,
        ]);

        // Authentifier l'utilisateur
        $this->actingAs($user);

        // Appeler la méthode Dash
        $response = $this->get(route('dashboard'));

        // Vérifier que la réponse est correcte et contient les données attendues
        $response->assertStatus(200);
        $response->assertInertia(function ($page) use ($immobilier, $voiture) {
            $page->component('Dashboard')
                 ->has('vehicules', 1)
                 ->has('habitats', 1)
                 ->where('total', 2)
                 ->where('totalVendu', 1)
                 ->where('totalActuel', 1);
        });
    }
}
