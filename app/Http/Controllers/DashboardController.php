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
            // Récupérer les immobiliers avec les utilisateurs associés
            $immobiliers = Immobiliers::where('booster', 1)
                ->where('status', 'pending')
                ->with('user:id,name,phone,email,id') // Charger la relation user avec seulement l'id et le nom
                ->get();

                //recuperer les deja booster et terminer hiatorque

                $immobilliersBoosted = Immobiliers::
                where('status', 'null')
                ->where('onceBooster', true)
                ->with('user:id,name,phone,email,id') // Charger la relation user avec seulement l'id et le nom
                ->get();

                //recuperer les en cours de  boost

                $immobilliersBoosting = Immobiliers::where('booster', 1)
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


            // Supprimer les doublons de userIds
            $userIds = array_unique($userIds);

            // Récupérer les utilisateurs
            $users = User::whereIn('id', $userIds)->get(['id', 'name']);

            return Inertia::render('DashboardAdmin', [
                'immobiliers' => $immobiliers,
                'users' => $users, // Passer les utilisateurs récupérés
                'immobilliersBoosted'=> $immobilliersBoosted,
                'immobilliersBoosting'=> $immobilliersBoosting
            ]);
        }

        // Autre logique pour les utilisateurs non-admin...

        $user_id = auth()->id();
        $immobiliers = Immobiliers::where('user_id', $user_id)->get()->toArray();

        // Logique pour séparer les articles vendus et en cours de vente
        $immobiliersVendu = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->toArray();

        $immobiliersActuel = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 0)
            ->get()
            ->toArray();

        // Calculer le total vendu somme (seulement immobiliers)
        $immobiliersVenduForSum = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get();
        
        $totalVenduSomme = $immobiliersVenduForSum->sum(function($item) {
            return (float) $item->prix;
        });
        
        $sommeHabitatVendu = $totalVenduSomme;

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
            'sommeHabitatVendu' => $sommeHabitatVendu,
            'totalArticles' => count($immobiliers),
        ]);
    }







}

