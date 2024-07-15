<?php

namespace App\Http\Controllers;
// use Request;
use Illuminate\Http\Request;


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

class AdminController extends Controller
{
     // ADMIN for Immobillier

     public function Details($id)
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
         $immobiliers = Immobiliers::all();
 
         // Récupérer les informations de la maison et de la voiture
         $maison = $immo;
         $car = Voitures::find($id);
 
         return Inertia::render('UpdateByAdmin/DetailImmobilier', [
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
             'immobiliers' => $immobiliers,
         ]);
     
     
     }
 
     // Update
 
     public function update(Request $request, $id)
     {
         $immobilier = Immobiliers::findOrFail($id);
     
         // Valider les données reçues
         $validatedData = $request->validate([
             'status' => 'required|string',
             'duration' => 'required|integer',
             'date_fin_booster' => 'required|date',
         ]);
     
         // Mettre à jour l'enregistrement avec les données validées
         $immobilier->status = $validatedData['status'];
         $immobilier->duration = $validatedData['duration'];
         $immobilier->date_fin_booster = $validatedData['date_fin_booster'];
         $immobilier->save();
     
         return redirect()->route('dashboard')->with('message', 'Annonce modifiée avec succès');
     }
 
}
