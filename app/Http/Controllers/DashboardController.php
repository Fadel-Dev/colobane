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


class DashboardController extends Controller
{
    public function Dash()
    {
        // Vérifier le rôle administrateur
        if (auth()->user()->role == 'admin') {
            // $voitures = Voitures::all()->toArray();
            // $immobiliers = Immobiliers::all()->toArray();
    
            // // Logique pour séparer les articles vendus et en cours de vente
            // $immobiliersVendu = Immobiliers::where('vendu', 1)->get()->toArray();
            // $voituresVendu = Voitures::where('vendu', 1)->get()->toArray();
    
            // $immobiliersActuel = Immobiliers::where('vendu', 0)->get()->toArray();
            // $voituresActuel = Voitures::where('vendu', 0)->get()->toArray();
            // $user = auth()->user();

            // $myRvs = Immobiliers::where('user_id', $user->id)->get();
            $immobiliers = Voitures::all();
    
            return Inertia::render('DashboardAdmin', [
                // 'voitures' => $voitures,
                'immobiliers' => $immobiliers,
                // 'total' => count($voitures) + count($immobiliers),
                // 'totalImmobilier' => count($immobiliers),
                // 'totalVehicule' => count($voitures),
                // 'resultsVendu' => array_merge($voituresVendu, $immobiliersVendu),
                // 'totalImmobilierVendu' => count($immobiliersVendu),
                // 'totalVehiculeVendu' => count($voituresVendu),
                // 'totalVendu' => count($voituresVendu) + count($immobiliersVendu),
                // 'resultsActuel' => array_merge($voituresActuel, $immobiliersActuel),
                // 'totalImmobilierActuel' => count($immobiliersActuel),
                // 'totalVehiculeActuel' => count($voituresActuel),
                // 'totalActuel' => count($voituresActuel) + count($immobiliersActuel),
            ]);
        }
    
        $user_id = auth()->id();
        $immobiliers = Immobiliers::where('user_id', $user_id)->get()->toArray();
        $voitures = Voitures::where('user_id', $user_id)->get()->toArray();
    
        // Logique pour séparer les articles vendus et en cours de vente
        $immobiliersVendu = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->toArray();
        $voituresVendu = Voitures::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->toArray();
    
        $immobiliersActuel = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 0)
            ->get()
            ->toArray();
        $voituresActuel = Voitures::where('user_id', $user_id)
            ->where('vendu', 0)
            ->get()
            ->toArray();
    
        return Inertia::render('Dashboard', [
            'vehicules' => $voitures,
            'habitats' => $immobiliers,
            'total' => count($voitures) + count($immobiliers),
            'totalImmobilier' => count($immobiliers),
            'totalVehicule' => count($voitures),
            'resultsVendu' => array_merge($voituresVendu, $immobiliersVendu),
            'totalImmobilierVendu' => count($immobiliersVendu),
            'totalVehiculeVendu' => count($voituresVendu),
            'totalVendu' => count($voituresVendu) + count($immobiliersVendu),
            'resultsActuel' => array_merge($voituresActuel, $immobiliersActuel),
            'totalImmobilierActuel' => count($immobiliersActuel),
            'totalVehiculeActuel' => count($voituresActuel),
            'totalActuel' => count($voituresActuel) + count($immobiliersActuel),
        ]);
    }




    // ADMIN VEHI

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

        // Récupérer les informations de la maison et de la voiture
        $maison = $immo;
        $car = Voitures::find($id);

        return Inertia::render('UpdateByAdmin/DetailVehicule', [
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

    // Update

    public function update( )
{


$rv = Immobiliers::findOrFail(1);


if ($rv) {
    // Mettre à jour les colonnes "heure", "date" et "etat" à partir du formulaire
    $rv->status = Request::input('status');
    $rv->boosted_at = Request::input('boosted_at');
    $rv->date_fin_booster = Request::input('date_fin_booster');

    // Sauvegarder les modifications dans la base de données
    $rv->save();


}
    return redirect()->route('dashboard')->with('message', 'Rendezs-vous modifier  avec success');

;


}

    // Admin Immo

    

   
    
}
