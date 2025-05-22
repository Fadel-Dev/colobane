<?php


namespace App\Http\Controllers;
// use Request;
use Illuminate\Http\Request;


use App\Models\Lead;
use App\Models\User;
use App\Models\Immobiliers;
use App\Models\Services;
use App\Models\Voitures;
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
     * Récupère les immobiliers et les voitures de l'utilisateur
     * ainsi que les utilisateurs qui ont des articles en cours de vente
     * et les utilisateurs qui ont des articles vendus
     * @return \Inertia\Response
     */
    public function Dash()
    {
        // Vérifier le rôle administrateur
        if (auth()->user()->role == 'admin') {
            // Statistiques générales
            $totalUsers = User::count();
            $totalImmobiliers = Immobiliers::count();
            $totalVoitures = Voitures::count();
            $totalBoosted = Immobiliers::where('booster', 1)->count() + Voitures::where('booster', 1)->count();
            
            // Récupérer les immobiliers avec les utilisateurs associés
            $immobiliers = Immobiliers::where('booster', 1)
                ->where('status', 'pending')
                ->with('user:id,name,phone,email,id')
                ->latest()
                ->get();

            // Récupérer les immobiliers déjà boostés
            $immobilliersBoosted = Immobiliers::where('status', 'null')
                ->where('onceBooster', true)
                ->with('user:id,name,phone,email,id')
                ->latest()
                ->get();

            // Récupérer les immobiliers en cours de boost
            $immobilliersBoosting = Immobiliers::where('booster', 1)
                ->where('status', 'accepter')
                ->with('user:id,name,phone,email,id')
                ->latest()
                ->get();

            // Récupérer les voitures avec les utilisateurs associés
            $voitures = Voitures::where('booster', 1)
                ->where('status', 'pending')
                ->with('user:id,name,phone,email,id')
                ->latest()
                ->get();

            // Récupérer les voitures déjà boostées
            $voituresBoosted = Voitures::where('status', 'null')
                ->where('onceBooster', true)
                ->with('user:id,name,phone,email,id')
                ->latest()
                ->get();

            // Récupérer les voitures en cours de boost
            $voituresBoosting = Voitures::where('status', 'accepter')
                ->with('user:id,name,phone,email,id')
                ->latest()
                ->get();

            // Statistiques des boost en cours
            $activeBoosts = [
                'immobiliers' => $immobilliersBoosting->count(),
                'voitures' => $voituresBoosting->count(),
                'total' => $immobilliersBoosting->count() + $voituresBoosting->count()
            ];

            // Statistiques des boost en attente
            $pendingBoosts = [
                'immobiliers' => $immobiliers->count(),
                'voitures' => $voitures->count(),
                'total' => $immobiliers->count() + $voitures->count()
            ];

            // Statistiques des boost terminés
            $completedBoosts = [
                'immobiliers' => $immobilliersBoosted->count(),
                'voitures' => $voituresBoosted->count(),
                'total' => $immobilliersBoosted->count() + $voituresBoosted->count()
            ];

            // Dernières activités (combinaison des derniers boost et modifications)
            $latestActivities = collect()
                ->merge($immobiliers->map(function($item) {
                    return [
                        'type' => 'immobilier',
                        'action' => 'Nouveau boost demandé',
                        'item' => $item,
                        'date' => $item->created_at
                    ];
                }))
                ->merge($voitures->map(function($item) {
                    return [
                        'type' => 'voiture',
                        'action' => 'Nouveau boost demandé',
                        'item' => $item,
                        'date' => $item->created_at
                    ];
                }))
                ->sortByDesc('date')
                ->take(10);

            return Inertia::render('DashboardAdmin', [
                'statistics' => [
                    'totalUsers' => $totalUsers,
                    'totalImmobiliers' => $totalImmobiliers,
                    'totalVoitures' => $totalVoitures,
                    'totalBoosted' => $totalBoosted,
                    'activeBoosts' => $activeBoosts,
                    'pendingBoosts' => $pendingBoosts,
                    'completedBoosts' => $completedBoosts
                ],
                'voitures' => $voitures,
                'immobiliers' => $immobiliers,
                'immobilliersBoosted' => $immobilliersBoosted,
                'voituresBoosted' => $voituresBoosted,
                'immobilliersBoosting' => $immobilliersBoosting,
                'voituresBoosting' => $voituresBoosting,
                'latestActivities' => $latestActivities
            ]);
        }

        // Autre logique pour les utilisateurs non-admin...

        $user_id = auth()->id();
        $immobiliers = Immobiliers::where('user_id', $user_id)->get()->toArray();
        $voitures = Voitures::where('user_id', $user_id)->get()->toArray();

        // Logique pour séparer les articles vendus et en cours de vente
        $immobiliersVendu = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->toArray();
        $voituresVendu = Voitures::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->toArray();

        $immobiliersActuel = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 0)
            ->get()
            ->toArray();
        $voituresActuel = Voitures::where('user_id', $user_id)
            ->where('vendu', 0)
            ->get()
            ->toArray();

        return Inertia::render('Dashboard', [
            'vehicules' => $voitures,
            'habitats' => $immobiliers,
            'total' => count($voitures) + count($immobiliers),
            'totalImmobilier' => count($immobiliers),
            'totalVehicule' => count($voitures),
            'resultsVendu' => array_merge($voituresVendu, $immobiliersVendu),
            'totalImmobilierVendu' => count($immobiliersVendu),
            'totalVehiculeVendu' => count($voituresVendu),
            'totalVendu' => count($voituresVendu) + count($immobiliersVendu),
            'resultsActuel' => array_merge($voituresActuel, $immobiliersActuel),
            'totalImmobilierActuel' => count($immobiliersActuel),
            'totalVehiculeActuel' => count($voituresActuel),
            'totalActuel' => count($voituresActuel) + count($immobiliersActuel),
            'restantVoiture' => count($voitures) - count($voituresVendu),
            'restantImmobilier' => count($immobiliers) - count($immobiliersVendu),
            'totalRestant' => count($voitures) - count($voituresVendu) + count($immobiliers) - count($immobiliersVendu),
        ]);
    }







}

