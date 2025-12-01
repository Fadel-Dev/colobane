<?php

use App\Http\Controllers\BoostController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerForAdmin;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImmobilierController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SitemapController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehiculeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/ShowArticle', function () {
    return Inertia::render('ShowArticle');
});

Route::get('/tt', function () {
    return Inertia::render('Contact');
});


Route::get('/', [Controller::class, 'Home'])->name('home');

// Static pages
Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/aide', function () {
    return Inertia::render('HelpCenter');
})->name('help');

Route::get('/faq', function () {
    return Inertia::render('FAQ');
})->name('faq');

Route::get('/comment-ca-marche', function () {
    return Inertia::render('HowItWorks');
})->name('how-it-works');

Route::get('/terms', function () {
    return Inertia::render('Terms');
})->name('terms');

Route::get('/privacy', function () {
    return Inertia::render('Privacy');
})->name('privacy');

Route::get('/cookies', function () {
    return Inertia::render('Cookies');
})->name('cookies');

// Sitemap routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap-pages.xml', [SitemapController::class, 'pages'])->name('sitemap.pages');
Route::get('/sitemap-immobilier.xml', [SitemapController::class, 'immobilier'])->name('sitemap.immobilier');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'Dash'])->name('dashboard');
});

// delete product

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'Dash'])->name('dashboard');
// });



//Publication

// Route::get('/publier',[Controller::class,'publier'])->name('publier');
Route::get('/publier', [Controller::class, 'publier'])->name('publier')->middleware('auth');


// ******************************************************FOR MAIN SECTION POST
Route::get('/p/{section}', [PostController::class, 'Section'])->name('section');

// ******************************************************FOR CATEGORY PAGES
Route::get('/categorie/{category}', [Controller::class, 'Category'])->name('category');

// ******************************************************FOR MAIN ARTICLE
Route::get('/publication/{article}', [PostController::class, 'Article'])->name('article');

// save VEHICULE
Route::post('/voitureVente/save', [VehiculeController::class, 'storeVoitureVente']);
Route::post('/voitureLocation/save', [VehiculeController::class, 'storeVoitureLoc']);

//Immobilier
Route::post('/immobilier/save', [ImmobilierController::class, 'storeVente']);
Route::post('/immobilier2/save', [ImmobilierController::class, 'storeVente2']);
Route::post('/immobilier3/save', [ImmobilierController::class, 'storeVente3']);

Route::post('/topics', [PostController::class, 'store'])->name('topics.store');

// DETAILS PRODUCTS IMMOBILLIER

Route::get('/detail/{id}', [Controller::class, 'DetailsImmo']);

// DETAILS PRODUCTS IMMOBILLIER

Route::get('/detailVehi/{id}', [Controller::class, 'DetailsVehi']);

//-for modify and delete products
    //Route::get('/detailVehi/{id}', [Controller::class, 'DetailsVehi'])->name('go');

    //
// For Boost

// Route::get('/boost', [Controller::class, 'BoostArticle']);






// Route::get('/testee', function () {
//     return Inertia::render('BoostArticle', []);
// });

// // Route::get('/detailArticle/c/{id}', [Controller::class, 'DetailArticle']);

// // Route::get('teste',function(){
// //     return Inertia::render('teste');
// // });

// // UPADTE ARTICLE PAGE
Route::get('/update/immobilier/{id}', [Controller::class, 'UpdateImmobilier']);
// // UPDATE VEHICULE
Route::get('/update/vehicule/{id}', [Controller::class, 'UpdateVehicule']);

// // UPDATE ARTICLE VENDU pour cocher vendu ou pas
Route::get('/update/navigateUpdateVenduImmobilier/{id}', [Controller::class, 'UpdateImmobilierVendu']);
Route::get('/update/navigateUpdateVenduVehicule/{id}', [Controller::class, 'UpdateVehiculeVendu']);


// // UPDATE ARTICLE SAVE
Route::put('/immobilier/{id}', [ImmobilierController::class, 'storeEdit']);
Route::put('/vehicule/{id}', [ImmobilierController::class, 'storeEditVehicule']);

// // UPDATE ARTICLE VENDU
Route::put('/immobilierVendu/{id}', [ImmobilierController::class, 'StoreVenduImmo']);
Route::put('/vehiculeVendu/{id}', [ImmobilierController::class, 'StoreVenduVehicule']);

//  FOR BOOST ARTICLE
Route::get('/boost/immo/{id}', [BoostController::class, 'BoostArticleImmo']);
Route::get('/boost/vehi/{id}', [BoostController::class, 'BoostArticleVehi']);

// // UPDATE ARTICLE BOOST
Route::put('/immobilierBoost/{id}', [ImmobilierController::class, 'StoreBoostImmo']);
Route::put('/vehiculeBoost/{id}', [ImmobilierController::class, 'StoreBoostVehicule']);





Route::get('/infos', function () {
    return Inertia::render('infos');
});

// Favoris
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/favoris', [FavoriController::class, 'index'])->name('favoris');
    Route::post('/favoris/add/{id}', [FavoriController::class, 'add'])->name('favoris.add');
    Route::delete('/favoris/remove/{id}', [FavoriController::class, 'remove'])->name('favoris.remove');
    Route::post('/favoris/toggle/{id}', [FavoriController::class, 'toggle'])->name('favoris.toggle');
    Route::get('/favoris/check/{id}', [FavoriController::class, 'check'])->name('favoris.check');
});

// Notifications
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/count', [NotificationController::class, 'count'])->name('notifications.count');
});








// Admin
// for immobillier
Route::get('/statusImmobilier/{id}',[AdminController::class,'Details'])->name('go');
// for vehicule
Route::get('/statusVehicule/{id}',[AdminController::class,'DetailsVehicule'])->name('god');

// for Immobillier
// Route::get('/detailupdateVehiculeAdmin/{id}',[DashboardController::class,'Details'])->name('go');
Route::put('/rv/update/{id}',[AdminController::class,'Update']);
// for vehicule
Route::put('/rvVoiture/update/{id}',[AdminController::class,'UpdateVoiture']);


// for admin

Route::get('/users/u/1', [ControllerForAdmin::class, 'ForUser'])->name('users.index');









