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
        // Optimisation : Sélectionner uniquement les colonnes nécessaires
        $userSelect = 'user:id,name,phone,email';

        // Récupérer les demandes de boost en attente
        $immobiliers = Immobiliers::where('booster', 1)
            ->where('status', 'pending')
            ->with($userSelect)
            ->latest()
            ->get();

        // Récupérer les boosts actuellement en cours
        $immobilliersBoosting = Immobiliers::where('booster', 1)
            ->where('status', 'accepter')
            ->with($userSelect)
            ->latest()
            ->get();

        // Récupérer les boosts ARRÊTÉS
        $immobiliersArretes = Immobiliers::where('booster', 0)
            ->where('status', 'null')
            ->where('onceBooster', 1)
            ->whereNotNull('date_fin_booster')
            ->with($userSelect)
            ->latest()
            ->get();

        // Récupérer les boosts complétés naturellement
        $immobilliersBoosted = Immobiliers::where('booster', 0)
            ->where('status', 'completed')
            ->with($userSelect)
            ->latest()
            ->get();

        return [
            'immobiliers' => $immobiliers,
            'immobilliersBoosted' => $immobilliersBoosted,
            'immobilliersBoosting' => $immobilliersBoosting,
            'immobiliersArretes' => $immobiliersArretes,
            'users' => User::select('id', 'name')->get(),
            'blogPostsCount' => \App\Models\BlogPost::count(),
        ];
    }

    /**
     * Récupérer les données pour le dashboard utilisateur
     */
    private function getUserDashboard()
    {
        $user_id = auth()->id();
        
        // Requête de base pour les immobiliers de l'utilisateur
        $baseQuery = Immobiliers::where('user_id', $user_id);
        
        // Récupérer tous les immobiliers pour l'affichage (léger)
        $immobiliers = (clone $baseQuery)->orderBy('created_at', 'desc')->get();
        
        // Enrichir avec les infos de boost (transformation côté PHP nécessaire pour la logique complexe)
        $enrichedImmobiliers = $immobiliers->map(function($item) {
            $item->is_boosting = $item->booster == 1 && $item->status === 'accepter';
            $item->boost_remaining_hours = null;
            $item->boost_remaining_text = null;
            
            if ($item->is_boosting && $item->date_fin_booster) {
                $now = \Carbon\Carbon::now();
                $endDate = \Carbon\Carbon::parse($item->date_fin_booster);
                
                if ($endDate > $now) {
                    $diff = $now->diff($endDate);
                    $hours = $diff->days * 24 + $diff->h;
                    $minutes = $diff->i;
                    $seconds = $diff->s;
                    
                    $item->boost_remaining_hours = $hours + ($minutes / 60) + ($seconds / 3600);
                    
                    // Format texte: "2j 3h 45min"
                    $text_parts = [];
                    if ($diff->days > 0) $text_parts[] = $diff->days . 'j';
                    if ($diff->h > 0) $text_parts[] = $diff->h . 'h';
                    if ($diff->i > 0) $text_parts[] = $diff->i . 'min';
                    
                    $item->boost_remaining_text = implode(' ', $text_parts) . ' restants';
                } else {
                    $item->boost_remaining_text = 'Expiré';
                    $item->is_boosting = false;
                }
            }
            
            $item->boost_can_activate = !$item->is_boosting;
            
            return $item;
        });

        // Statistiques performantes via SQL direct
        $totalCount = (clone $baseQuery)->count();
        $totalVenduCount = (clone $baseQuery)->where('vendu', 1)->count();
        $totalActuelCount = $totalCount - $totalVenduCount;
        $totalVenduSomme = (clone $baseQuery)->where('vendu', 1)->sum('prix');

        // Récupérer les alertes de l'utilisateur
        $alerts = auth()->user()->propertyAlerts()->latest()->get();

        return Inertia::render('Dashboard', [
            'habitats' => $enrichedImmobiliers,
            'total' => $totalCount,
            'totalImmobilier' => $totalCount,
            'resultsVendu' => $enrichedImmobiliers->where('vendu', 1)->values(),
            'totalImmobilierVendu' => $totalVenduCount,
            'totalVendu' => $totalVenduCount,
            'resultsActuel' => $enrichedImmobiliers->where('vendu', 0)->values(),
            'totalImmobilierActuel' => $totalActuelCount,
            'totalActuel' => $totalActuelCount,
            'restantImmobilier' => $totalActuelCount,
            'totalRestant' => $totalActuelCount,
            'totalVenduSomme' => (float) $totalVenduSomme,
            'sommeHabitatVendu' => (float) $totalVenduSomme,
            'totalArticles' => $totalCount,
            'alerts' => $alerts,
        ]);
    }







}

