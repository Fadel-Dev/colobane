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
use App\Services\PropertyAlertService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
         $immobilier->onceBooster = true;
         $immobilier->save();

         // Déclencher les alertes si l'annonce est acceptée
         if ($validatedData['status'] === 'accepter') {
             PropertyAlertService::checkAlerts($immobilier);
         }

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
          $voiture->onceBooster = true;
         $voiture->save();

         return redirect()->route('dashboard')->with('message', 'Annonce modifiée avec succès');
     }

     /**
      * Supprimer un utilisateur et toutes ses données
      */
     public function deleteUser($id)
     {
         if (auth()->user()->role !== 'admin') {
             abort(403);
         }

         $user = User::findOrFail($id);
         
         // Ne pas supprimer soi-même
         if ($user->id === auth()->id()) {
             return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte admin.');
         }

         $user->delete();

         return back()->with('message', 'Utilisateur supprimé avec succès.');
     }

     /**
      * Supprimer un bien immobilier
      */
     public function deleteImmobilier($id)
     {
         if (auth()->user()->role !== 'admin') {
             abort(403);
         }

         $immo = Immobiliers::findOrFail($id);
         $immo->delete();

         return back()->with('message', 'Annonce immobilière supprimée.');
     }

     /**
      * Supprimer un véhicule
      */
     public function deleteVoiture($id)
     {
         if (auth()->user()->role !== 'admin') {
             abort(403);
         }

         $voiture = Voitures::findOrFail($id);
         $voiture->delete();

         return back()->with('message', 'Annonce véhicule supprimée.');
     }

     /**
      * Créer un nouvel utilisateur (Admin)
      */
     public function storeUser(Request $request)
     {
         if (auth()->user()->role !== 'admin') {
             abort(403);
         }

         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'phone' => 'required|string|max:20',
             'password' => 'required|string|min:8',
             'role' => 'required|string|in:user,admin',
         ]);

         User::create([
             'name' => $validated['name'],
             'email' => $validated['email'],
             'phone' => $validated['phone'],
             'password' => Hash::make($validated['password']),
             'role' => $validated['role'],
             'email_verified_at' => now(), // Auto-verify for admin created users
         ]);

         return back()->with('message', 'Utilisateur créé avec succès.');
     }

     /**
      * Mettre à jour un utilisateur (Admin)
      */
     public function updateUserData(Request $request, $id)
     {
         if (auth()->user()->role !== 'admin') {
             abort(403);
         }

         $user = User::findOrFail($id);

         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users,email,' . $id,
             'phone' => 'required|string|max:20',
             'role' => 'required|string|in:user,admin',
             'password' => 'nullable|string|min:8',
         ]);

         $user->update([
             'name' => $validated['name'],
             'email' => $validated['email'],
             'phone' => $validated['phone'],
             'role' => $validated['role'],
         ]);

         if ($request->filled('password')) {
             $user->update(['password' => Hash::make($validated['password'])]);
         }

         return back()->with('message', 'Utilisateur mis à jour.');
     }




}
