<?php

namespace App\Http\Controllers;
// use Request;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
    // Trouver l'immobilier avec l'ID spécifié
    $immo = Immobiliers::findOrFail($id);
    sleep(1);

    // Récupérer les informations de l'utilisateur
    $user = User::findOrFail($immo->user_id);
    $nomUtilisateur = $user->name;
    $mailUtilisateur = $user->email;
    $phoneUtilisateur = $user->phone;

    // Récupérer la durée depuis l'immobilier (en minutes)
    $duration = $immo->duration;

    // Date et heure actuelles
    $currentDateTime = Carbon::now();

    // Ajouter la durée à la date et l'heure actuelles
    $newDateTime = $currentDateTime->copy()->addMinutes($duration);

    $urlActuelle = URL::current();

    return Inertia::render('UpdateByAdmin/DetailImmobilier', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'immobilier' => $immo,
        'nameSeler' => $nomUtilisateur,
        'mailSeler' => $mailUtilisateur,
        'phoneSeler' => $phoneUtilisateur,
        'urlActuelle' => $urlActuelle,
        'currentDateTime' => $currentDateTime->toDateTimeString(),
        'newDateTime' => $newDateTime->toDateTimeString(),
    ]);
}


public function DetailsVehicule($id)
{
    // Trouver la voiture avec l'ID spécifié
    $voiture = Voitures::findOrFail($id);
    sleep(1);

    // Récupérer les informations de l'utilisateur
    $user = User::findOrFail($voiture->user_id);
    $nomUtilisateur = $user->name;
    $mailUtilisateur = $user->email;
    $phoneUtilisateur = $user->phone;

    // Récupérer la durée depuis la voiture
    $duration = $voiture->duration; // Durée en minutes

    // Date et heure actuelles
    $currentDateTime = Carbon::now();

    // Ajouter la durée à la date et l'heure actuelles
    $newDateTime = $currentDateTime->copy()->addMinutes($duration);

    $urlActuelle = URL::current();

    return Inertia::render('UpdateByAdmin/DetailVehicule', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'voiture' => $voiture,
        'nameSeler' => $nomUtilisateur,
        'mailSeler' => $mailUtilisateur,
        'phoneSeler' => $phoneUtilisateur,
        'urlActuelle' => $urlActuelle,
        'currentDateTime' => $currentDateTime->toDateTimeString(),
        'newDateTime' => $newDateTime->toDateTimeString(),
    ]);
}






     // Update

     /**
      * Update an existing record with the validated data.
      *
      * @param Request $request The request object containing the data to update
      * @param int $id The ID of the record to update
      * @throws ValidationException when the request data validation fails
      * @return RedirectResponse with a success message
      */
     public function update(Request $request, $id)
     {
         $immobilier = Immobiliers::findOrFail($id);

         // Valider les données reçues
         $validatedData = $request->validate([
             'status' => 'required|string',
            //  'duration' => 'required|integer',
             'date_fin_booster' => 'required|date',
         ]);

         // Mettre à jour l'enregistrement avec les données validées
         $immobilier->status = $validatedData['status'];
        //  $immobilier->duration = $validatedData['duration'];
         $immobilier->date_fin_booster = $validatedData['date_fin_booster'];
         $immobilier->save();

         return redirect()->route('dashboard')->with('message', 'Annonce modifiée avec succès');
     }


    /**
     * Update an existing record with the validated data.
     *
     * @param Request $request The request object containing the data to update
     * @param int $id The ID of the record to update
     * @throws ValidationException when the request data validation fails
     * @return RedirectResponse with a success message
     */
     public function updateVoiture(Request $request, $id)
     {
         $voiture = Voitures::findOrFail($id);

         // Valider les données reçues
         $validatedData = $request->validate([
             'status' => 'required|string',
            //  'duration' => 'required|integer',
             'date_fin_booster' => 'required|date',
         ]);

         // Mettre à jour l'enregistrement avec les données validées
         $voiture->status = $validatedData['status'];
        //  $voiture->duration = $validatedData['duration'];
         $voiture->date_fin_booster = $validatedData['date_fin_booster'];
         $voiture->save();

         return redirect()->route('dashboard')->with('message', 'Annonce modifiée avec succès');
     }




}
