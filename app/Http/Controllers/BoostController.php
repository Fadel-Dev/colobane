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
class BoostController extends Controller
{
    public function BoostArticleImmo($id )
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

            return Inertia::render('BoostImmo', [
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

}
