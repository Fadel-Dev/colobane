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



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    // HOME

    public function Home()
    {
      $voitures = Voitures::orderBy('created_at', 'desc')->paginate(4);

      $maisons = Immobiliers::orderBy('created_at', 'desc')->paginate(8);
      return Inertia::render('Welcome',[
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,

            'voitures' => $voitures,
            'maisons' => $maisons,

      ]);
    }



    public function Dash()
    {
      $cc = Immobiliers::select('select * from users ');


      return Inertia::render('Dashboard', [
        'topics' =>Immobiliers::all()->map(function($topic){
            return [
                'id'=> $topic->id,
                'name'=> $topic->name,
                'prix'=> $topic->prix,
                'image1'=> asset('storage/'.$topic->image1),
                'userid'=> $topic->user_id,

            ];

        })
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
                       ->limit(5) // Limiter le nombre de suggestions à 5
                       ->get();

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
    'user' => $user,
    'suggestions' => $suggestions,

  ])
  ;
}


// VEHICULE
public function DetailsVehi($id)
{
    sleep(1);

    $user = User::findOrFail($id);
    $voiture = Voitures::findOrFail($id);

    // Récupérer la marque de la voiture actuelle
    $marqueVoiture = $voiture->marque;

    // Requête pour obtenir d'autres produits avec la même marque
    $suggestions = Voitures::where('marque', $marqueVoiture)
                          ->where('id', '!=', $id) // Exclure le produit actuel
                          ->limit(5) // Limiter le nombre de suggestions à 5
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

    return Inertia::render('DetailsVehicule', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'voiture' => $voiture,
        'nameSeler' => $nomUtilisateur,
        'mailSeler' => $mailUtilisateur,
        'phoneSeler' => $phoneUtilisateur,
        'user' => $user,
        'suggestions' => $suggestions,
    ]);
}


}
