<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImmobilierController;
use App\Http\Controllers\MaisonController;
use App\Http\Controllers\ModeController; 
use App\Http\Controllers\MultimediaController;
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


Route::get('/ShowArticle',function(){
    return Inertia::render('ShowArticle');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',[Controller::class,'Dash'])->name('dashboard');
});



//Publication

// Route::get('/publier',[Controller::class,'publier'])->name('publier');
Route::get('/publier', [Controller::class, 'publier'])->name('publier')->middleware('auth');


// ******************************************************FOR MAIN SECTION POST
Route::get('/p/{section}', [PostController::class,'Section'])->name('section');

// ******************************************************FOR MAIN ARTICLE
Route::get('/publication/{article}',[PostController::class,'Article'])->name('article');







// save VEHICULE
Route::post('/voiture/save',[VehiculeController::class,'storeVoiture']);
Route::post('/moto/save',[VehiculeController::class,'storeMoto']);
Route::post('/equipement/save',[VehiculeController::class,'storeEquipement']);


// save MULTIMEDIA
Route::post('/telephone/save',[MultimediaController::class,'storeTelephone']);
Route::post('/ordinateur/save',[MultimediaController::class,'storeOrdinateur']);
Route::post('/imageSon/save',[MultimediaController::class,'storeImageSon']);



// save Mode
Route::post('/habillement/save',[ModeController::class,'storeHabillement']);
Route::post('/enfant/save',[ModeController::class,'storeEnfant']);
Route::post('/accessoire/save',[ModeController::class,'storeAccessoire']);


// save Service
Route::post('/batiment/save',[ServiceController::class,'storeBatiment']);
Route::post('/domestique/save',[ServiceController::class,'storeDomestique']);
Route::post('/covoiturage/save',[ServiceController::class,'storeCovoiturage']);


// save Electromenager
Route::post('/electromenager/save',[MaisonController::class,'storeElectromenager']);
Route::post('/decoration/save',[MaisonController::class,'storeDecoration']);
Route::post('/outilsPro/save',[MaisonController::class,'storeOutilsPro']);

//Immobilier
Route::post('/location/save',[ImmobilierController::class,'storeVente']);
Route::post('/vente/save',[ImmobilierController::class,'storeLocation']);








Route::post('/topics',[PostController::class,'store'])->name('topics.store');



