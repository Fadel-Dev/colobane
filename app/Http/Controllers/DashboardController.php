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


        $user_id = auth()->id();

  $users=User::all();
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
        // Vérifier le rôle administrateur
        if (auth()->user()->role == 'admin') {
            return   Inertia::render('DashboardAdmin', [
                'results' => array_merge($voitures, $immobiliers),
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
                'users' => $users,
            ]);
}
        
       
      

        // Calcul d'autres métriques et résultats nécessaires à l'affichage du tableau de bord

        return Inertia::render('Dashboard', [
            'results' => array_merge($voitures, $immobiliers),
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
}
