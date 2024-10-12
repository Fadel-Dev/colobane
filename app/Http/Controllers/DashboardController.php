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
    public function Dash()
    {
        // Vérifier le rôle administrateur
     if (auth()->user()->role == 'admin') {
            // Récupérer les immobiliers avec les utilisateurs associés
            $immobiliers = Immobiliers::where('booster', 1)
                ->where('status', 'pending')
                ->with('user:id,name,phone,email,id') // Charger la relation user avec seulement l'id et le nom
                ->get();

                //recuperer les deja booster

                $immobilliersBoost = Immobiliers::where('booster', 1)
                ->where('status', 'terminer')
                ->with('user:id,name,phone,email,id') // Charger la relation user avec seulement l'id et le nom
                ->get();

                //recuperer les en cours de  boost

                $immobilliersBoosting = Immobiliers::where('booster', 1)
                ->where('status', 'accepter')
                ->with('user:id,name,phone,email,id') // Charger la relation user avec seulement l'id et le nom
                ->get();

            // Récupérer les voitures avec les utilisateurs associés
            $voitures = Voitures::where('booster', 1)
                ->where('status', 'pending')
                ->with('user:id,name,phone,email,id') // Charger la relation user avec seulement l'id et le nom
                ->get();

                // recuprer les deja booster
                $voituresBoosted = Voitures::where('booster', 1)
                ->where('status', 'accepter')
                ->with('user:id,name,phone,email,id') // Charger la relation user avec seulement l'id et le nom
                ->get();

                // recuprer les en cours de boost

                  $voituresBoosting = Voitures::where('booster', 1)
                ->where('status', 'accepter')
                ->with('user:id,name,phone,email,id') // Charger la relation user avec seulement l'id et le nom
                ->get();

            // Tableau pour stocker les informations
            $articles = [];
            $userIds = []; // Tableau pour stocker les user_id

            // Parcourir les immobiliers et stocker les informations
            foreach ($immobiliers as $immobilier) {
                $articles[] = [
                    'type' => 'immobilier',
                    'article_id' => $immobilier->id,
                    'user_id' => $immobilier->user->id,
                    'user_name' => $immobilier->user->name,
                    'user_phone' => $immobilier->user->phone,
                    'user_email' => $immobilier->user->email,
                ];

                // Stocker le user_id dans un tableau
                $userIds[] = $immobilier->user->id;
            }

            // Parcourir les voitures et stocker les informations
            foreach ($voitures as $voiture) {
                $articles[] = [
                    'type' => 'voiture',
                    'article_id' => $voiture->id,
                    'user_id' => $voiture->user->id,
                    'user_name' => $voiture->user->name,
                    'user_phone' => $voiture->user->phone,
                    'user_email' => $voiture->user->email,
                ];

                // Stocker le user_id dans un tableau
                $userIds[] = $voiture->user->id;
            }

            // Supprimer les doublons de userIds
            $userIds = array_unique($userIds);

            // Récupérer les utilisateurs
            $users = User::whereIn('id', $userIds)->get(['id', 'name']);

            return Inertia::render('DashboardAdmin', [
                'voitures' => $voitures,
                'immobiliers' => $immobiliers,
                'users' => $users, // Passer les utilisateurs récupérés
                'immobilliersBoosted'=> $immobilliersBoost,
                'voituresBoosted'=> $voituresBoosted,
                'immobilliersBoosting'=> $immobilliersBoosting,
                'voituresBoosting'=> $voituresBoosting
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

