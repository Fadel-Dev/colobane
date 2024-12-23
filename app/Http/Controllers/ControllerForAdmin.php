<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Immobiliers;
use App\Models\Voitures;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
class ControllerForAdmin extends Controller
{
   public function ForUser()
{
    // Obtenez les utilisateurs avec le nombre de publications (immobiliers et voitures)
    $users = User::withCount([
        'immobiliers as immobiliers_count',
        'voitures as voitures_count'
    ])->get();

    $immobiliers = Immobiliers::all();
    $voitures = Voitures::all();

    return Inertia::render('Users', [
        'users' => $users,
        'immobiliers' => $immobiliers,
        'voitures' => $voitures,
    ]);
}

}
