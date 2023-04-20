<?php

namespace App\Http\Controllers;

use App\Models\Equipements;
use App\Models\Voiturelocation;
use Request;
use Inertia\Inertia;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Voitures;



class VehiculeController extends Controller
{
// voiture

      public function storeVoitureVente() 
      {
         
          $image1=Request::file('image1')->store('topics','public');
          $image2=Request::file('image2')->store('topics','public');
          $image3=Request::file('image3')->store('topics','public');
  
          auth()->user()->Voitures()->create([
              'model' => Request::input('model'),
              'marque' => Request::input('marque'),
              'nom' => Request::input('nom'),
              'prix' => Request::input('prix'),
              'description' => Request::input('description'),
              'carburant' => Request::input('carburant'),
               'region' => Request::input('region'),
              'etat' => Request::input('etat'),
              'boiteVitesse' => Request::input('boiteVitesse'),
              'kilometrage' => Request::input('kilometrage'),
              'place' => Request::input('place'),
              'annee' => Request::input('annee'),
              'affaire' =>'vente',
              'image1' => $image1,
              'image2' => $image2,
              'image3' => $image3,
              'categorie' =>'voiture',
  
          ])
          ;
          return redirect()->route('publier');
      }

      // voiture

      public function storeVoitureLoc() 
      {
         
          $image1=Request::file('image1')->store('topics','public');
          $image2=Request::file('image2')->store('topics','public');
          $image3=Request::file('image3')->store('topics','public');
  
          auth()->user()->Voitures()->create([
              'marque' => Request::input('marque'),
              'nom' => Request::input('nom'),
              'model' => 'N',
              'prix' => Request::input('prix'),
              'description' => Request::input('description'),
              'kilometrage' => 0,
              'boiteVitesse' => Request::input('boiteVitesse'),
              'carburant' => Request::input('carburant'),
               'region' => Request::input('region'),
              'place' => Request::input('place'),
              'affaire' =>'location',
              'annee' => 0,
              'etat' => 0,
              'image1' => $image1,
              'image2' => $image2,
              'image3' => $image3,
              'categorie' =>'voiture',

  
          ])
          ;
          return redirect()->route('publier');
      }

       // equipement

     
}
