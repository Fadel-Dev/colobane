<?php
use App\Http\Controllers\BoostController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerForAdmin;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImmobilierController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehiculeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

// Pages statiques
Route::get('/ShowArticle', fn () => Inertia::render('ShowArticle'));
Route::get('/tt', fn () => Inertia::render('Contact'));
Route::get('/infos', fn () => Inertia::render('infos'));

// Accueil
Route::get('/', [Controller::class, 'Home'])->name('home');

// Authentification requise
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'Dash'])->name('dashboard');
    Route::get('/publier', [Controller::class, 'publier'])->name('publier');
});

// Routes pour les articles et sections
Route::prefix('publication')->group(function () {
    Route::get('/{article}', [PostController::class, 'Article'])->name('article');
    Route::post('/topics', [PostController::class, 'store'])->name('topics.store');
});

Route::get('/p/{section}', [PostController::class, 'Section'])->name('section');

// Routes pour véhicules
Route::prefix('voiture')->group(function () {
    Route::post('/vente/save', [VehiculeController::class, 'storeVoitureVente']);
    Route::post('/location/save', [VehiculeController::class, 'storeVoitureLoc']);
});

// Routes pour immobilier
Route::prefix('immobilier')->group(function () {
    Route::post('/save', [ImmobilierController::class, 'storeVente']);
    Route::post('/save2', [ImmobilierController::class, 'storeVente2']);
    Route::post('/save3', [ImmobilierController::class, 'storeVente3']);
});

// Détails des produits
Route::get('/detail/{id}', [Controller::class, 'DetailsImmo']);
Route::get('/detailVehi/{id}', [Controller::class, 'DetailsVehi']);

// Mise à jour des produits
Route::prefix('update')->group(function () {
    Route::get('/immobilier/{id}', [Controller::class, 'UpdateImmobilier']);
    Route::get('/vehicule/{id}', [Controller::class, 'UpdateVehicule']);
    Route::get('/navigateUpdateVenduImmobilier/{id}', [Controller::class, 'UpdateImmobilierVendu']);
    Route::get('/navigateUpdateVenduVehicule/{id}', [Controller::class, 'UpdateVehiculeVendu']);

    Route::put('/immobilier/{id}', [ImmobilierController::class, 'storeEdit']);
    Route::put('/vehicule/{id}', [ImmobilierController::class, 'storeEditVehicule']);
    Route::put('/immobilierVendu/{id}', [ImmobilierController::class, 'StoreVenduImmo']);
    Route::put('/vehiculeVendu/{id}', [ImmobilierController::class, 'StoreVenduVehicule']);
});

// Routes pour le boost d'annonces
Route::prefix('boost')->group(function () {
    Route::get('/immo/{id}', [BoostController::class, 'BoostArticleImmo']);
    Route::get('/vehi/{id}', [BoostController::class, 'BoostArticleVehi']);
    Route::put('/immobilier/{id}', [ImmobilierController::class, 'StoreBoostImmo']);
    Route::put('/vehicule/{id}', [ImmobilierController::class, 'StoreBoostVehicule']);
});

// Routes pour l'administration
Route::prefix('admin')->group(function () {
    Route::get('/statusImmobilier/{id}', [AdminController::class, 'Details'])->name('go');
    Route::get('/statusVehicule/{id}', [AdminController::class, 'DetailsVehicule'])->name('god');
    Route::put('/rv/update/{id}', [AdminController::class, 'Update']);
    Route::put('/rvVoiture/update/{id}', [AdminController::class, 'UpdateVoiture']);
    Route::get('/users/u/1', [ControllerForAdmin::class, 'ForUser'])->name('users.index');
});

// Génération du sitemap
// Route::get('/sitemap.xml', function () {
//     $sitemap = Sitemap::create()
//         ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'))
//         ->add(Url::create('/immobilier')->setPriority(0.8)->setChangeFrequency('weekly'))
//         ->add(Url::create('/voitures')->setPriority(0.8)->setChangeFrequency('weekly'));

//     return response($sitemap->render())->header('Content-Type', 'application/xml');
// });

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'))
        ->add(Url::create('/immobilier')->setPriority(0.8)->setChangeFrequency('weekly'))
        ->add(Url::create('/voitures')->setPriority(0.8)->setChangeFrequency('weekly'));

    // Ajouter les annonces immobilières
    $immobiliers = Immobilier::all();
    foreach ($immobiliers as $immo) {
        $sitemap->add(
            Url::create("/detail/{$immo->id}")
                ->setPriority(0.7)
                ->setChangeFrequency('weekly')
                ->setLastModificationDate($immo->updated_at)
        );
    }

    // Ajouter les véhicules
    $vehicules = Vehicule::all();
    foreach ($vehicules as $vehicule) {
        $sitemap->add(
            Url::create("/detailVehi/{$vehicule->id}")
                ->setPriority(0.7)
                ->setChangeFrequency('weekly')
                ->setLastModificationDate($vehicule->updated_at)
        );
    }

    return response($sitemap->render())->header('Content-Type', 'application/xml');
});
