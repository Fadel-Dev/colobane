<?php

namespace App\Http\Controllers;

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



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;



    // HOME

    public function Home()
    {
      return Inertia::render('Welcome',[
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'topics' =>Immobiliers::all()->map(function($topic){
          return [
              'id'=> $topic->id,
              'nom'=> $topic->nom,
              'prix'=> $topic->prix,
              'region'=> $topic->region,
              'affaire'=> $topic->affaire,
              'updated_at'=> $topic->updated_at,
              'image1'=> asset('storage/'.$topic->image1),
              'userid'=> $topic->user_id,
              
            
          ];

      })
      ]);
    }


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


}
