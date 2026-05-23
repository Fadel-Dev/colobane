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
     * Récupère les immobiliers de l'utilisateur
     * ainsi que les utilisateurs qui ont des articles en cours de vente
     * et les utilisateurs qui ont des articles vendus
     * @return \Inertia\Response
     */
    public function Dash()
    {
        $user = auth()->user();
        
        // Si l'URL demandée commence par /admin
        if (request()->is('admin/*') || request()->is('admin')) {
            if ($user->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'Accès réservé aux administrateurs.');
            }
            return Inertia::render('DashboardAdmin', $this->getAdminData());
        }

        // Si l'utilisateur est admin mais sur /dashboard, on lui montre quand même l'admin
        if ($user->role == 'admin') {
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

        // Récupérer les demandes de boost en attente (Immo + Auto)
        $immobiliers = Immobiliers::where('booster', 1)
            ->where('status', 'pending')
            ->with($userSelect)
            ->latest()
            ->get();
            
        $voituresPending = Voitures::where('booster', 1)
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
            
        $voituresBoosting = Voitures::where('booster', 1)
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

        // --- GESTION UTILISATEURS (Filtrée et Paginée) ---
        $userQuery = User::query();
        
        if (request()->has('user_search')) {
            $search = request('user_search');
            $userQuery->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }
        
        if (request()->has('role') && request('role') !== 'all') {
            $userQuery->where('role', request('role'));
        }

        $sortField = request('sort_by', 'created_at');
        $sortOrder = request('order', 'desc');
        $userQuery->orderBy($sortField, $sortOrder);

        // Statistiques de croissance des utilisateurs
        $userStats = [
            'last_24h' => User::where('created_at', '>=', now()->subDay())->count(),
            'last_48h' => User::where('created_at', '>=', now()->subDays(2))->count(),
            'last_week' => User::where('created_at', '>=', now()->subWeek())->count(),
            'last_month' => User::where('created_at', '>=', now()->subMonth())->count(),
        ];

        // --- MÉTRIQUES BUSINESS PRO ---
        // Revenu total estimé des boosts
        $totalRevenue = Immobiliers::where('status', 'accepter')->where('booster', 1)->sum('boost_price') 
                      + Voitures::where('status', 'accepter')->where('booster', 1)->sum('boost_price');

        // Distribution des annonces
        $immobilierStatus = [
            'published' => Immobiliers::where('status', 'accepter')->count(),
            'pending' => Immobiliers::where('status', 'pending')->count(),
            'sold' => Immobiliers::where('vendu', 1)->count(),
        ];

        $vehicleStatus = [
            'published' => Voitures::where('status', 'accepter')->count(),
            'pending' => Voitures::where('status', 'pending')->count(),
            'sold' => Voitures::where('vendu', 1)->count(),
        ];

        // Top Régions (pour chart simple)
        $topRegions = Immobiliers::select('region', DB::raw('count(*) as count'))
            ->whereNotNull('region')
            ->groupBy('region')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();

        return [
            'immobiliers' => $immobiliers,
            'voituresPending' => $voituresPending,
            'immobilliersBoosted' => $immobilliersBoosted,
            'immobilliersBoosting' => $immobilliersBoosting,
            'voituresBoosting' => $voituresBoosting,
            'immobiliersArretes' => $immobiliersArretes,
            'allUsers' => $userQuery->paginate(20)->withQueryString(),
            'allImmobiliers' => Immobiliers::with('user:id,name')->latest()->paginate(50),
            'allVoitures' => Voitures::with('user:id,name')->latest()->paginate(50),
            'allAlerts' => \App\Models\PropertyAlert::with('user:id,name,phone')->latest()->get(),
            'blogPostsCount' => \App\Models\BlogPost::count(),
            'userStats' => $userStats,
            'businessStats' => [
                'totalRevenue' => (float) $totalRevenue,
                'immobilierStatus' => $immobilierStatus,
                'vehicleStatus' => $vehicleStatus,
                'topRegions' => $topRegions,
            ],
            'filters' => request()->all(['user_search', 'role', 'sort_by', 'order']),
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
        $voitureQuery = Voitures::where('user_id', $user_id);
        
        // Récupérer tous les immobiliers pour l'affichage (léger)
        $immobiliers = (clone $baseQuery)->orderBy('created_at', 'desc')->get();
        $voitures = (clone $voitureQuery)->orderBy('created_at', 'desc')->get();
        
        // Enrichir avec les infos de boost
        $enrichItem = function($item) {
            $item->vendu = (int)$item->vendu;
            
            // Un boost est ACTIF si booster=1 et status=accepter
            $item->is_boosting = $item->booster == 1 && $item->status === 'accepter';
            
            // Un boost est EN ATTENTE si booster=1 et status=pending
            $item->is_pending_boost = $item->booster == 1 && $item->status === 'pending';
            
            $item->boost_remaining_text = null;
            
            if ($item->is_boosting && $item->date_fin_booster) {
                $now = \Carbon\Carbon::now();
                $endDate = \Carbon\Carbon::parse($item->date_fin_booster);
                
                if ($endDate > $now) {
                    $diff = $now->diff($endDate);
                    $item->boost_remaining_text = ($diff->days > 0 ? $diff->days . 'j ' : '') . $diff->h . 'h ' . $diff->i . 'min restants';
                } else {
                    $item->boost_remaining_text = 'Expiré';
                    $item->is_boosting = false;
                }
            }
            
            // On peut activer un boost si l'article est 'accepter' ET n'est pas déjà en train de booster
            $item->can_boost = $item->status === 'accepter' && !$item->is_boosting && !$item->is_pending_boost;
            
            return $item;
        };

        $enrichedImmobiliers = $immobiliers->map($enrichItem);
        $enrichedVoitures = $voitures->map($enrichItem);

        // Statistiques globales
        $totalImmo = (clone $baseQuery)->count();
        $totalVoitures = (clone $voitureQuery)->count();
        $totalCount = $totalImmo + $totalVoitures;

        $totalVenduImmo = (clone $baseQuery)->where('vendu', 1)->count();
        $totalVenduVoitures = (clone $voitureQuery)->where('vendu', 1)->count();
        $totalVenduCount = $totalVenduImmo + $totalVenduVoitures;

        $totalActuelCount = $totalCount - $totalVenduCount;
        
        $sumVenduImmo = (clone $baseQuery)->where('vendu', 1)->sum('prix');
        $sumVenduVoitures = (clone $voitureQuery)->where('vendu', 1)->sum('prix');
        $totalVenduSomme = (float)$sumVenduImmo + (float)$sumVenduVoitures;

        // Récupérer les alertes de l'utilisateur
        $alerts = auth()->user()->propertyAlerts()->latest()->get();

        return Inertia::render('Dashboard', [
            'habitats' => $enrichedImmobiliers,
            'voitures' => $enrichedVoitures,
            'total' => $totalCount,
            'totalImmobilier' => $totalImmo,
            'totalVoitures' => $totalVoitures,
            'totalImmobilierVendu' => $totalVenduImmo,
            'totalVoituresVendu' => $totalVenduVoitures,
            'totalVendu' => $totalVenduCount,
            'totalRestant' => $totalActuelCount,
            'totalVenduSomme' => $totalVenduSomme,
            'sommeHabitatVendu' => (float)$sumVenduImmo,
            'sommeVoitureVendu' => (float)$sumVenduVoitures,
            'totalArticles' => $totalCount,
            'alerts' => $alerts,
            'restantImmobilier' => $totalImmo - $totalVenduImmo,
        ]);
    }







}
