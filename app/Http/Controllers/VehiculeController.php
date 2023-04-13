<?php

namespace App\Http\Controllers;

use App\Models\Equipements;
use App\Models\MotoScooters;
use Request;
use Inertia\Inertia;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Voitures;



class VehiculeController extends Controller
{
// voiture

      public function storeVoiture() 
      {
         
          $image=Request::file('image')->store('topics','public');
  
          auth()->user()->Voitures()->create([
              'model' => Request::input('model'),
              'marque' => Request::input('marque'),
              'nom' => Request::input('nom'),
              'prix' => Request::input('prix'),
              'description' => Request::input('description'),
              'carburant' => Request::input('carburant'),
              'annee' => Request::input('annee'),
              'boiteVitesse' => Request::input('boiteVitesse'),
              'region' => Request::input('region'),
              'etat' => Request::input('etat'),
              'image' => $image,
              'categorie' =>'voiture',
  
          ])
          ;
          return redirect()->route('publier');
      }

      // voiture

      public function storeMoto() 
      {
         
          $image=Request::file('image')->store('topics','public');
  
          auth()->user()->MotoScooters()->create([
              'marque' => Request::input('marque'),
              'nom' => Request::input('nom'),
              'prix' => Request::input('prix'),
              'description' => Request::input('description'),
              'region' => Request::input('region'),
              'image' => $image,
              'categorie' =>'moto',
  
          ])
          ;
          return redirect()->route('publier');
      }

       // equipement

       public function storeEquipement() 
       {
          
           $image=Request::file('image')->store('topics','public');
   
           auth()->user()->Equipements()->create([
               'nom' => Request::input('nom'),
               'prix' => Request::input('prix'),
               'description' => Request::input('description'),
               'region' => Request::input('region'),
               'image' => $image,
               'categorie' =>'equipement',
               'type' =>Request::input('type'),
               'ville' =>'N',
               'etat' =>'N',
   
           ])
           ;
           return redirect()->route('publier');
       }
}
