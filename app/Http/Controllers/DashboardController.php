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

        $immobiliers = Immobiliers::where('user_id', $user_id)->get()->toArray();
        $voitures = Voitures::where('user_id', $user_id)->get()->toArray();

        // Transforming the arrays to a common structure
        $immobiliers = array_map(function ($immobilier) {
            return [
                'nom' => $immobilier['nom'],
                'prix' => $immobilier['prix'],
                'image1' => $immobilier['image1'],
                'created_at' => $immobilier['created_at'],
                'id' => $immobilier['id'],
            ];
        }, $immobiliers);

        $results = array_merge($voitures, $immobiliers);

        return Inertia::render('Dashboard', [
            'results' => $results,
        ]);
    }

}
