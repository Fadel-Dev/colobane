<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Voitures;
use App\Models\Immobiliers;

class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
       $now = now();
        $voiture = Voitures::factory()->create(['status' => 'accepter', 'date_fin_booster' => $now]);
        $immobilier = Immobiliers::factory()->create(['status' => 'accepter', 'date_fin_booster' => $now]);

        // Appeler la méthode Home
        $response = $this->get(route('home'));


        // Vérifier les mises à jour de statut
        $this->assertDatabaseHas('voitures', ['id' => $voiture->id, 'status' => 'pending']);
        $this->assertDatabaseHas('immobiliers', ['id' => $immobilier->id, 'status' => 'pending']);

        // Vérifier que la vue est rendue correctement
        $response->assertStatus(200);
    }
}
