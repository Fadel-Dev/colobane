<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Immobiliers;
use App\Models\Services;
use App\Models\Voitures;
use App\Models\BlogPost;
use App\Services\SEOService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    // HOME

 public function Home()
{
    $now = now(); 

    // Mettre à jour le statut des Immobiliers (Maintenance légère)
    Immobiliers::where('status', 'accepter')
        ->where('date_fin_booster', '<=', $now)
        ->update(['status' => 'pending']);

    // Optimisation : Utiliser with('user') pour éviter le problème N+1
    // Et charger uniquement les champs nécessaires
    $baseQuery = Immobiliers::where('status', 'accepter')
        ->with('user:id,name,phone')
        ->orderBy('created_at', 'desc');

    $immobilliersBoost = (clone $baseQuery)->where('booster', 1)->paginate(12);
    $maisons = (clone $baseQuery)->paginate(12);
    
    // Calculer le total des annonces disponibles
    $totalAnnonces = (clone $baseQuery)->count();

    // Pour les différentes catégories sur la home, on peut optimiser en utilisant des filtres sur la collection
    // ou des requêtes ciblées si les données sont massives. Ici, on privilégie des requêtes ciblées mais optimisées.
    $chambres = Immobiliers::where('type','Chambre')->orderBy('created_at', 'desc')->paginate(12);
    $chambresBoost = Immobiliers::where('type','Chambre')->where('status', 'accepter')->where('booster', 1)->orderBy('created_at', 'desc')->paginate(12);
    
    $villas = Immobiliers::where('type','Villa')->orderBy('created_at', 'desc')->take(12)->get();
    $villasBoost = Immobiliers::where('type','Villa')->where('status', 'accepter')->where('booster', 1)->orderBy('created_at', 'desc')->take(12)->get();
    
    $immeubles = Immobiliers::where('type','Immeuble')->orderBy('created_at', 'desc')->paginate(12);
    $immeublesBoost = Immobiliers::where('type','Immeuble')->where('status', 'accepter')->where('booster', 1)->orderBy('created_at', 'desc')->paginate(12);
    
    $terrains = Immobiliers::where('type','Terrain')->orderBy('created_at', 'desc')->paginate(12);
    $terrainsBoost = Immobiliers::where(['type' => 'Terrain', 'status' => 'accepter', 'booster' => 1])->orderBy('created_at', 'desc')->paginate(12);
    
    $vergers = Immobiliers::where('type','Verger')->orderBy('created_at', 'desc')->paginate(12);
    $vergersBoost = Immobiliers::where('type','Verger')->where('status', 'accepter')->where('booster', 1)->orderBy('created_at', 'desc')->paginate(12);

    $appartements = Immobiliers::where('type', 'appartement')->orderBy('created_at', 'desc')->paginate(12);
    $appartementsBoost = Immobiliers::where('type', 'appartement')->where('status', 'accepter')->where('booster', 1)->orderBy('created_at', 'desc')->paginate(12);

    $studios = Immobiliers::where('type', 'studio')->orderBy('created_at', 'desc')->paginate(12);
    $studiosBoost = Immobiliers::where('type', 'studio')->where('status', 'accepter')->where('booster', 1)->orderBy('created_at', 'desc')->paginate(12);

    // Voitures
    $voitures = Voitures::where('status', 'accepter')->with('user:id,name,phone')->orderBy('created_at', 'desc')->paginate(12);
    $voituresBoost = Voitures::where('status', 'accepter')->where('booster', 1)->with('user:id,name,phone')->orderBy('created_at', 'desc')->paginate(12);

    // Blog
    $latestPosts = BlogPost::published()->latest()->take(3)->get();

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'totalAnnonces' => $totalAnnonces,
        'maisons' => $maisons,
        'immobilliersBoost' => $immobilliersBoost,
        'voitures' => $voitures,
        'voituresBoost' => $voituresBoost,
        'chambres'=>$chambres,
        'chambresBoost'=>$chambresBoost,
        'villas'=>$villas,
        'villasBoost'=>$villasBoost,
        'immeubles'=>$immeubles,
        'immeublesBoost'=>$immeublesBoost,
        'terrains' => $terrains,
        'terrainsBoost' => $terrainsBoost,
        'appartements' => $appartements,
        'appartementsBoost' => $appartementsBoost,
        'studios' => $studios,
        'studiosBoost' => $studiosBoost,
        'vergers' => $vergers,
        'vergersBoost' => $vergersBoost,
        'latestPosts' => $latestPosts,
    ]);
}

public function Category($category)
{
    // Normaliser le nom de la catégorie
    $categoryMap = [
        'villa' => 'Villa',
        'appartements' => 'appartement',
        'appartement' => 'appartement',
        'chambre' => 'Chambre',
        'chambres' => 'Chambre',
        'studio' => 'studio',
        'studios' => 'studio',
        'immeuble' => 'Immeuble',
        'immeubles' => 'Immeuble',
        'terrain' => 'Terrain',
        'terrains' => 'Terrain',
        'immobilier' => 'all',
    ];
    
    $type = $categoryMap[strtolower($category)] ?? 'all';
    
    // Récupérer les paramètres de filtrage
    $filters = request()->only(['min_price', 'max_price', 'min_surface', 'max_surface', 'npiece', 'region', 'affaire', 'sort', 'boosted', 'search']);
    
    // Construire la requête de base
    $query = Immobiliers::query();
    
    // Filtrer par type
    if ($type !== 'all') {
        $query->where('type', $type);
    }
    
    // Appliquer le filtre de recherche textuelle
    if (isset($filters['search']) && $filters['search']) {
        $searchTerm = $filters['search'];
        $query->where(function($q) use ($searchTerm) {
            $q->where('nom', 'like', '%' . $searchTerm . '%')
              ->orWhere('region', 'like', '%' . $searchTerm . '%')
              ->orWhere('type', 'like', '%' . $searchTerm . '%')
              ->orWhere('description', 'like', '%' . $searchTerm . '%');
        });
    }
    
    // Filtrer par statut (boosted = annonces acceptées)
    if (isset($filters['boosted']) && $filters['boosted'] === 'true') {
        $query->where('status', 'accepter');
    }
    
    // Appliquer les filtres
    if (isset($filters['min_price']) && $filters['min_price']) {
        $query->whereRaw('CAST(prix AS UNSIGNED) >= ?', [(int)$filters['min_price']]);
    }
    if (isset($filters['max_price']) && $filters['max_price']) {
        $query->whereRaw('CAST(prix AS UNSIGNED) <= ?', [(int)$filters['max_price']]);
    }
    if (isset($filters['min_surface']) && $filters['min_surface']) {
        $query->whereRaw('CAST(surface AS UNSIGNED) >= ?', [(int)$filters['min_surface']]);
    }
    if (isset($filters['max_surface']) && $filters['max_surface']) {
        $query->whereRaw('CAST(surface AS UNSIGNED) <= ?', [(int)$filters['max_surface']]);
    }
    if (isset($filters['npiece']) && $filters['npiece']) {
        $query->where('npiece', $filters['npiece']);
    }
    if (isset($filters['region']) && $filters['region']) {
        $query->where('region', 'like', '%' . $filters['region'] . '%');
    }
    if (isset($filters['affaire']) && $filters['affaire']) {
        $query->where('affaire', $filters['affaire']);
    }
    
    // Trier les résultats
    $sort = $filters['sort'] ?? 'newest';
    switch ($sort) {
        case 'price_asc':
            $query->orderByRaw('CAST(prix AS UNSIGNED) ASC');
            break;
        case 'price_desc':
            $query->orderByRaw('CAST(prix AS UNSIGNED) DESC');
            break;
        case 'surface_asc':
            $query->orderByRaw('CAST(surface AS UNSIGNED) ASC');
            break;
        case 'surface_desc':
            $query->orderByRaw('CAST(surface AS UNSIGNED) DESC');
            break;
        case 'newest':
        default:
            $query->orderBy('created_at', 'desc');
            break;
    }
    
    // Créer une requête séparée pour les annonces boostées qui respecte les mêmes filtres
    $boostQuery = Immobiliers::query();
    
    // Filtrer par type
    if ($type !== 'all') {
        $boostQuery->where('type', $type);
    }

    // Appliquer le filtre de recherche textuelle à la requête boost
    if (isset($filters['search']) && $filters['search']) {
        $searchTerm = $filters['search'];
        $boostQuery->where(function($q) use ($searchTerm) {
            $q->where('nom', 'like', '%' . $searchTerm . '%')
              ->orWhere('region', 'like', '%' . $searchTerm . '%')
              ->orWhere('type', 'like', '%' . $searchTerm . '%')
              ->orWhere('description', 'like', '%' . $searchTerm . '%');
        });
    }
    
    // Appliquer les mêmes filtres que pour les annonces normales (sauf pagination)
    if (isset($filters['min_price']) && $filters['min_price']) {
        $boostQuery->whereRaw('CAST(prix AS UNSIGNED) >= ?', [(int)$filters['min_price']]);
    }
    if (isset($filters['max_price']) && $filters['max_price']) {
        $boostQuery->whereRaw('CAST(prix AS UNSIGNED) <= ?', [(int)$filters['max_price']]);
    }
    if (isset($filters['min_surface']) && $filters['min_surface']) {
        $boostQuery->whereRaw('CAST(surface AS UNSIGNED) >= ?', [(int)$filters['min_surface']]);
    }
    if (isset($filters['max_surface']) && $filters['max_surface']) {
        $boostQuery->whereRaw('CAST(surface AS UNSIGNED) <= ?', [(int)$filters['max_surface']]);
    }
    if (isset($filters['npiece']) && $filters['npiece']) {
        $boostQuery->where('npiece', $filters['npiece']);
    }
    if (isset($filters['region']) && $filters['region']) {
        $boostQuery->where('region', 'like', '%' . $filters['region'] . '%');
    }
    if (isset($filters['affaire']) && $filters['affaire']) {
        $boostQuery->where('affaire', $filters['affaire']);
    }
    
    // Trier par date de création (les plus récentes en premier)
    $boostQuery->orderBy('created_at', 'desc');
    
    // Récupérer les 12 premières annonces boostées (non paginées, toujours les mêmes)
    $itemsBoost = $boostQuery->where('status', 'accepter')->take(12)->get();
    
    // Récupérer les données paginées pour les annonces normales
    // Si boosted=true, afficher uniquement les annonces boostées dans la pagination
    if (isset($filters['boosted']) && $filters['boosted'] === 'true') {
        $items = (clone $query)->where('status', 'accepter')->paginate(12);
    } else {
        $items = (clone $query)->paginate(12);
    }
    
    // Calculer le total
    $total = (clone $query)->count();
    
    // Récupérer les valeurs min/max pour les filtres
    $priceRange = Immobiliers::selectRaw('MIN(CAST(prix AS UNSIGNED)) as min_price, MAX(CAST(prix AS UNSIGNED)) as max_price')
        ->when($type !== 'all', function($q) use ($type) {
            return $q->where('type', $type);
        })
        ->first();
    
    $surfaceRange = Immobiliers::selectRaw('MIN(CAST(surface AS UNSIGNED)) as min_surface, MAX(CAST(surface AS UNSIGNED)) as max_surface')
        ->when($type !== 'all', function($q) use ($type) {
            return $q->where('type', $type);
        })
        ->first();
    
    // Récupérer les régions uniques
    $regions = Immobiliers::select('region')
        ->when($type !== 'all', function($q) use ($type) {
            return $q->where('type', $type);
        })
        ->whereNotNull('region')
        ->distinct()
        ->orderBy('region')
        ->pluck('region')
        ->filter()
        ->values();
    
    return Inertia::render('Category', [
        'category' => $category,
        'type' => $type,
        'items' => $items,
        'itemsBoost' => $itemsBoost,
        'total' => $total,
        'filters' => $filters,
        'priceRange' => $priceRange,
        'surfaceRange' => $surfaceRange,
        'regions' => $regions,
    ]);
}




    public function publier()
    {
            $user=Auth::user();

            if( $user->role=="boss")
            {
              return Inertia::render('Contact');
            }else
            {
                 return Inertia::render('Publier');
            }

    }



    // details produits immobillier

    public function DetailsImmo($id)
    {
        $immo = Immobiliers::with('user')->findOrFail($id);
        sleep(1);


        // Récupérer la marque de la voiture actuelle
        $typeImmo = $immo->type;

        // Requête pour obtenir d'autres produits avec la même marque
        $suggestions = Immobiliers::where('type', $typeImmo)
            ->where('id', '!=', $id) // Exclure le produit actuel
            ->limit(3) // Limiter le nombre de suggestions à 3
            ->get();

        $seller = $immo->user;
        $nomUtilisateur = $seller->name;
        $mailUtilisateur = $seller->email;
        $phoneUtilisateur = $seller->phone;

        $urlActuelle = URL::current();

        // Vérifier si le bien est dans les favoris de l'utilisateur connecté
        $isFavorite = false;
        if (Auth::check()) {
            $isFavorite = \App\Models\Favori::where('user_id', Auth::id())
                ->where('immobilier_id', $id)
                ->exists();
        }

        // Récupérer les avis pour ce vendeur
        $reviews = \App\Models\Review::with('user')
            ->where('target_user_id', $seller->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $userReview = null;
        if (Auth::check()) {
            $userReview = \App\Models\Review::where('user_id', Auth::id())
                ->where('target_user_id', $seller->id)
                ->where('immobilier_id', $id)
                ->first();
        }

        // Générer des métadonnées SEO dynamiques
        $seoKeywords = SEOService::generateKeywords($immo->nom, $immo->description, 10);
        $seoDescription = SEOService::generateMetaDescription($immo->description, 160);
        if (empty($seoDescription)) {
            $seoDescription = "{$immo->nom} à {$immo->region}. Découvrez ce bien immobilier sur NoflayHub.";
        }

        return Inertia::render('DetailsImmo', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,

            'maison' => $immo,
            'seller' => $seller,
            'nameSeler' => $nomUtilisateur,
            'mailSeler' => $mailUtilisateur,
            'phoneSeler' => $phoneUtilisateur,
            'suggestions' => $suggestions,
            'urlActuelle' => $urlActuelle,
            'isFavorite' => $isFavorite,
            'reviews' => $reviews,
            'userReview' => $userReview,
            'seoKeywords' => implode(', ', $seoKeywords),
            'seoDescription' => $seoDescription,
        ]);
    }


    // VEHICULE
    public function DetailsVehi($id)
    {
        sleep(1);

        // $user = User::findOrFail($id);
        $voiture = Voitures::findOrFail($id);

        // Récupérer la marque de la voiture actuelle
        $marqueVoiture = $voiture->marque;

        // Requête pour obtenir d'autres produits avec la même marque
        $suggestions = Voitures::where('marque', $marqueVoiture)
            ->where('id', '!=', $id) // Exclure le produit actuel
            ->limit(12) // Limiter le nombre de suggestions à 5
            ->get();

        $nomUtilisateur = DB::table('users')
            ->join('voitures', 'users.id', '=', 'voitures.user_id')
            ->where('voitures.id', $id)
            ->value('users.name');

        $mailUtilisateur = DB::table('users')
            ->join('voitures', 'users.id', '=', 'voitures.user_id')
            ->where('voitures.id', $id)
            ->value('users.email');

        $phoneUtilisateur = DB::table('users')
            ->join('voitures', 'users.id', '=', 'voitures.user_id')
            ->where('voitures.id', $id)
            ->value('users.phone');

        $urlActuelle = URL::current();

        // Générer des métadonnées SEO dynamiques
        $seoKeywords = SEOService::generateKeywords($voiture->nom, $voiture->description, 10);
        $seoDescription = SEOService::generateMetaDescription($voiture->description, 160);
        if (empty($seoDescription)) {
            $seoDescription = "{$voiture->marque} {$voiture->model} à vendre/louer. Découvrez ce véhicule sur NoflayHub.";
        }


        return Inertia::render('DetailsVehicule', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'voiture' => $voiture,
            'nameSeler' => $nomUtilisateur,
            'mailSeler' => $mailUtilisateur,
            'phoneSeler' => $phoneUtilisateur,
            // 'user' => $user,
            'suggestions' => $suggestions,
            'urlActuelle' => $urlActuelle,
            'seoKeywords' => implode(', ', $seoKeywords),
            'seoDescription' => $seoDescription,
        ]);
    }

    // For navigte boost article

    public function DetailArticle($id)
    {

        sleep(1);

        // $user = User::findOrFail($id);
        $voiture = Voitures::findOrFail($id);

        // Récupérer la marque de la voiture actuelle
        $marqueVoiture = $voiture->marque;

        // Requête pour obtenir d'autres produits avec la même marque
        $suggestions = Voitures::where('marque', $marqueVoiture)
            ->where('id', '!=', $id) // Exclure le produit actuel
            ->limit(12) // Limiter le nombre de suggestions à 5
            ->get();

        $nomUtilisateur = DB::table('users')
            ->join('voitures', 'users.id', '=', 'voitures.user_id')
            ->where('voitures.id', $id)
            ->value('users.name');

        $mailUtilisateur = DB::table('users')
            ->join('voitures', 'users.id', '=', 'voitures.user_id')
            ->where('voitures.id', $id)
            ->value('users.email');

        $phoneUtilisateur = DB::table('users')
            ->join('voitures', 'users.id', '=', 'voitures.user_id')
            ->where('voitures.id', $id)
            ->value('users.phone');

        $urlActuelle = URL::current();


        return Inertia::render('BoostArticle', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'voiture' => $voiture,
            'nameSeler' => $nomUtilisateur,
            'mailSeler' => $mailUtilisateur,
            'phoneSeler' => $phoneUtilisateur,
            // 'user' => $user,
            'suggestions' => $suggestions,
            'urlActuelle' => $urlActuelle,
        ]);


    }

// UPDATE ARTICLE IMMO
public function UpdateImmobilier($id)
    {
        $immo = Immobiliers::findOrFail($id);
        sleep(1);

        // Récupérer le type de l'immobilier
        $typeImmo = $immo->type;

        // Récupérer les informations de l'utilisateur
        $user = User::findOrFail($immo->user_id);
        $nomUtilisateur = $user->name;
        $mailUtilisateur = $user->email;
        $phoneUtilisateur = $user->phone;

        $urlActuelle = URL::current();

        // Récupérer les informations de la maison et de la voiture
        $maison = $immo;
        $car = Voitures::find($id);

        return Inertia::render('ModifiImmobilierArticle', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'maison' => $maison,
            'car' => $car,
            'nameSeler' => $nomUtilisateur,
            'mailSeler' => $mailUtilisateur,
            'phoneSeler' => $phoneUtilisateur,
            'urlActuelle' => $urlActuelle,
        ]);
    }



// VENDU ARTICLE VEHICULE

public function UpdateVehicule($id)
{

    $vehi = Voitures::findOrFail($id);

    sleep(1);


    // Récupérer la marque de la voiture actuelle
    $typeVehi = $vehi->type;



    $user = User::findOrFail($vehi->user_id);
     // Récupérer les informations de l'utilisateur

     $nomUtilisateur = $user->name;
     $mailUtilisateur = $user->email;
     $phoneUtilisateur = $user->phone;

     $urlActuelle = URL::current();

     $car = Voitures::find($id);

    return Inertia::render('ModifiVehiculeArticle', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,


        'car' =>$car,
        'nameSeler' => $nomUtilisateur,
        'mailSeler' => $mailUtilisateur,
        'phoneSeler' => $phoneUtilisateur,
        // 'user' => $user,
        // 'suggestions' => $suggestions,
        'urlActuelle' => $urlActuelle,

    ]);
}

// update VENDU ARTICLE IMMOBILIER

public function UpdateImmobilierVendu($id)
{
    // Récupérer l'immobilier
    $immo = Immobiliers::findOrFail($id);

    // Pause de 1 seconde
    sleep(1);

    // Récupérer les informations sur le propriétaire de l'immobilier
    $user = User::findOrFail($immo->user_id);

    // Récupérer les informations nécessaires sur le propriétaire
    $nomUtilisateur = $user->name;
    $mailUtilisateur = $user->email;
    $phoneUtilisateur = $user->phone;

    // Récupérer l'URL actuelle
    $urlActuelle = URL::current();

    // Vous avez mentionné une voiture, mais assurez-vous que cela soit nécessaire
    // $car = Voitures::find($id); // Utiliser find au lieu de findOrFail pour éviter une erreur si ce n'est pas trouvé

    return Inertia::render('ModifiImmobilierVendu', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,

        'maison' => $immo,
        // 'car' => $car,
        'nameSeler' => $nomUtilisateur,
        'mailSeler' => $mailUtilisateur,
        'phoneSeler' => $phoneUtilisateur,
        'urlActuelle' => $urlActuelle,
    ]);
}

// UpdateVehiculeVendu
public function UpdateVehiculeVendu($id)
{
    // Récupérer l'immobilier
    // $immo = Immobiliers::findOrFail($id);

    // Récupérer la voiture associée
    $vehi = Voitures::findOrFail($id);

    // Pause de 1 seconde
    sleep(1);

    // Récupérer les informations sur le propriétaire de l'immobilier
    $user = User::findOrFail($vehi->user_id);

    // Récupérer les informations nécessaires sur le propriétaire
    $nomUtilisateur = $user->name;
    $mailUtilisateur = $user->email;
    $phoneUtilisateur = $user->phone;

    // Récupérer l'URL actuelle
    $urlActuelle = URL::current();

    return Inertia::render('ModifiVehiculeVendu', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,

        // 'maison' => $immo,
        'car' => $vehi,
        'nameSeler' => $nomUtilisateur,
        'mailSeler' => $mailUtilisateur,
        'phoneSeler' => $phoneUtilisateur,
        'urlActuelle' => $urlActuelle,
    ]);
}

}
