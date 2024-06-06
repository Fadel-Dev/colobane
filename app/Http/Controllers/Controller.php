<?php

namespace App\Http\Controllers;

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


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    // HOME

    public function Home()
    {
        $voitures = Voitures::orderBy('created_at', 'desc')->paginate(99999999);
        $voituresBoost = Voitures::where('booster', 1)->paginate(99999999);
        $immobilliersBoost = Immobiliers::where('booster', 1)->paginate(99999999);


        $maisons = Immobiliers::orderBy('created_at', 'desc')->paginate(9999999);
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,

            'voitures' => $voitures,
            'maisons' => $maisons,
            'voituresBoost' => $voituresBoost,
            'immobilliersBoost' => $immobilliersBoost

        ]);
    }




    public function publier()
    {
        return Inertia::render('Publier');
    }



    // details produits immobillier

    public function DetailsImmo($id)
    {
        $immo = Immobiliers::findOrFail($id);
        sleep(1);


        // Récupérer la marque de la voiture actuelle
        $typeImmo = $immo->type;

        // Requête pour obtenir d'autres produits avec la même marque
        $suggestions = Immobiliers::where('type', $typeImmo)
            ->where('id', '!=', $id) // Exclure le produit actuel
            ->limit(4) // Limiter le nombre de suggestions à 5
            ->get();

        // $user = User::findOrFail($id);
        //   name user
        $nomUtilisateur = DB::table('users')
            ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
            ->where('immobiliers.id', $id)
            ->value('users.name');

        //   mail user
        $mailUtilisateur = DB::table('users')
            ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
            ->where('immobiliers.id', $id)
            ->value('users.email');

        //   phone user
        $phoneUtilisateur = DB::table('users')
            ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
            ->where('immobiliers.id', $id)
            ->value('users.phone');

        $urlActuelle = URL::current();


        $maison = Immobiliers::findOrFail($id);
        return Inertia::render('DetailsImmo', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,

            'maison' => $maison,
            'nameSeler' => $nomUtilisateur,
            'mailSeler' => $mailUtilisateur,
            'phoneSeler' => $phoneUtilisateur,
            // 'user' => $user,
            'suggestions' => $suggestions,
            'urlActuelle' => $urlActuelle,

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
            ->limit(4) // Limiter le nombre de suggestions à 5
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
            ->limit(4) // Limiter le nombre de suggestions à 5
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
    $immo = Immobiliers::findOrFail($id);
    sleep(1);


    // Récupérer la marque de la voiture actuelle
    $typeImmo = $immo->type;



    $user = User::findOrFail($id);
    //   name user
    $nomUtilisateur = DB::table('users')
        ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
        ->where('immobiliers.id', $id)
        ->value('users.name');

    //   mail user
    $mailUtilisateur = DB::table('users')
        ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
        ->where('immobiliers.id', $id)
        ->value('users.email');

    //   phone user
    $phoneUtilisateur = DB::table('users')
        ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
        ->where('immobiliers.id', $id)
        ->value('users.phone');

    $urlActuelle = URL::current();


    $maison = Immobiliers::findOrFail($id);
    $car = Voitures::findOrFail($id);

    return Inertia::render('ModifiImmobilierVendu', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,

        'maison' => $maison,
        'car' =>$car,
        'nameSeler' => $nomUtilisateur,
        'mailSeler' => $mailUtilisateur,
        'phoneSeler' => $phoneUtilisateur,
        // 'user' => $user,
        // 'suggestions' => $suggestions,
        'urlActuelle' => $urlActuelle,

    ]);
}
// UpdateVehiculeVendu
public function UpdateVehiculeVendu($id)
{
    $immo = Immobiliers::findOrFail($id);
    $vehi = Voitures::findOrFail($id);

    sleep(1);


    // Récupérer la marque de la voiture actuelle
    $typeImmo = $immo->type;
    $typeVehi = $vehi->type;



    $user = User::findOrFail($id);
    //   name user
    $nomUtilisateur = DB::table('users')
        ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
        ->where('immobiliers.id', $id)
        ->value('users.name');

    //   mail user
    $mailUtilisateur = DB::table('users')
        ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
        ->where('immobiliers.id', $id)
        ->value('users.email');

    //   phone user
    $phoneUtilisateur = DB::table('users')
        ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
        ->where('immobiliers.id', $id)
        ->value('users.phone');

    $urlActuelle = URL::current();


    $maison = Immobiliers::findOrFail($id);
    $car = Voitures::findOrFail($id);

    return Inertia::render('ModifiVehiculeVendu', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,

        'maison' => $maison,
        'car' =>$car,
        'nameSeler' => $nomUtilisateur,
        'mailSeler' => $mailUtilisateur,
        'phoneSeler' => $phoneUtilisateur,
        // 'user' => $user,
        // 'suggestions' => $suggestions,
        'urlActuelle' => $urlActuelle,

    ]);
}
}
