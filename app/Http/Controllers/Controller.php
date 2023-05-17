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
        
      $maisons = Immobiliers::orderBy('created_at', 'desc')->paginate(4);
      return Inertia::render('Welcome',[
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,

            'voitures' => $voitures,
            'maisons' => $maisons,

      ]);
    }


    // test
    // public function index()
    // {
    //     $usersList = User::orderBy('id', 'desc')
    //                     ->paginate(6);
  
    //     return Inertia::render('teste', [
    //         'usersList' => $usersList
    //     ]);
    // }

    // DASH

    public function Dash()
    {

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



// details produits

public function Details($id)
{
  $user = User::findOrFail($id);
  $nomUtilisateur = DB::table('users')
  ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
  ->where('immobiliers.id', $id)
  ->value('users.name');
  $mailUtilisateur = DB::table('users')
  ->join('immobiliers', 'users.id', '=', 'immobiliers.user_id')
  ->where('immobiliers.id', $id)
  ->value('users.email');
  $maison = Immobiliers::findOrFail($id);
  return Inertia::render('Details', [
    'maison' => $maison,
     'nameSeler' => $nomUtilisateur,
     'mailSeler' => $mailUtilisateur,
    'user' => $user
  ])
  ;
}

}
