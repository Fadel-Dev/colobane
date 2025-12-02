<?php


namespace App\Http\Controllers;
// use Request;
use Illuminate\Http\Request;


use App\Models\Lead;
use App\Models\User;
use App\Models\Immobiliers;
use App\Models\Services;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\URL;


class DashboardController extends Controller
{
    /**
     * Renvoie la page de dashboard pour les utilisateurs
     * Récupère les immobiliers de l'utilisateur
     * ainsi que les utilisateurs qui ont des articles en cours de vente
     * et les utilisateurs qui ont des articles vendus
     * @return \Inertia\Response
     */
    public function Dash()
    {
        // Vérifier le rôle administrateur
        if (auth()->user()->role == 'admin') {
            return Inertia::render('DashboardAdmin', $this->getAdminData());
        }

        // Dashboard pour utilisateurs simples
        return $this->getUserDashboard();
    }

    /**
     * Récupérer les données pour le dashboard admin
     */
    private function getAdminData()
    {
        // Récupérer les demandes de boost en attente
        $immobiliers = Immobiliers::where('booster', 1)
            ->where('status', 'pending')
            ->with('user:id,name,phone,email')
            ->get();

        // Récupérer les boosts actuellement en cours
        $immobilliersBoosting = Immobiliers::where('booster', 1)
            ->where('status', 'accepter')
            ->with('user:id,name,phone,email')
            ->get();

        // Récupérer les boosts ARRÊTÉS (booster=0, status='null', onceBooster=1, date_fin_booster NOT NULL)
        // Ces boosts ont une date_fin_booster dans le passé (arrêtés manuellement)
        $immobiliersArretes = Immobiliers::where('booster', 0)
            ->where('status', 'null')
            ->where('onceBooster', 1)
            ->whereNotNull('date_fin_booster')
            ->with('user:id,name,phone,email')
            ->get();

        // Récupérer les boosts complétés naturellement (après 30 jours)
        // Pour les distinguer des arrêtés, on peut utiliser une date_fin_booster dans le passé
        // ou on les récupère différemment selon la logique business
        $immobilliersBoosted = Immobiliers::where('booster', 0)
            ->where('status', 'completed')
            ->with('user:id,name,phone,email')
            ->get();

        return [
            'immobiliers' => $immobiliers,
            'immobilliersBoosted' => $immobilliersBoosted,
            'immobilliersBoosting' => $immobilliersBoosting,
            'immobiliersArretes' => $immobiliersArretes,
            'users' => User::all(['id', 'name']),
        ];
    }

    /**
     * Récupérer les données pour le dashboard utilisateur
     */
    private function getUserDashboard()
    {
        $user_id = auth()->id();
        $immobiliers = Immobiliers::where('user_id', $user_id)->get()->toArray();

        $immobiliersVendu = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->toArray();

        $immobiliersActuel = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 0)
            ->get()
            ->toArray();

        $totalVenduSomme = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->sum(function($item) {
                return (float) $item->prix;
            });

        return Inertia::render('Dashboard', [
            'habitats' => $immobiliers,
            'total' => count($immobiliers),
            'totalImmobilier' => count($immobiliers),
            'resultsVendu' => $immobiliersVendu,
            'totalImmobilierVendu' => count($immobiliersVendu),
            'totalVendu' => count($immobiliersVendu),
            'resultsActuel' => $immobiliersActuel,
            'totalImmobilierActuel' => count($immobiliersActuel),
            'totalActuel' => count($immobiliersActuel),
            'restantImmobilier' => count($immobiliers) - count($immobiliersVendu),
            'totalRestant' => count($immobiliers) - count($immobiliersVendu),
            'totalVenduSomme' => $totalVenduSomme,
            'sommeHabitatVendu' => $totalVenduSomme,
            'totalArticles' => count($immobiliers),
        ]);
    }







}

