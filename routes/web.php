<?php

use App\Http\Controllers\BoostController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImmobilierController;

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

Route::get('/test', function () {
    return Inertia::render('teste');
});


Route::get('/', [Controller::class, 'Home'])->name('home');

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

Route::get('/detailVehi/{id}', [Controller::class, 'DetailsVehi'])->name('go');

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

// // UPDATE ARTICLE VENDU
// Route::get('/update/navigateUpdateVenduImmobilier/{id}', [Controller::class, 'UpdateImmobilierVendu']);
// Route::get('/update/navigateUpdateVenduVehicule/{id}', [Controller::class, 'UpdateVehiculeVendu']);


// // UPDATE ARTICLE SAVE
Route::put('/immobilier/{id}', [ImmobilierController::class, 'storeEdit']);
// Route::put('/vehicule/{id}', [ImmobilierController::class, 'storeEditVehicule']);

// // UPDATE ARTICLE VENDU
// Route::put('/immobilierVendu/{id}', [ImmobilierController::class, 'StoreVenduImmo']);
// Route::put('/vehiculeVendu/{id}', [ImmobilierController::class, 'StoreVenduVehicule']);






