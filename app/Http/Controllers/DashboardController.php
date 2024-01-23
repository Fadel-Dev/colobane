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
        // $user_id = auth()->id();
        // $dashNom = Immobiliers::where('user_id',$user_id)
        // ->value('immobiliers.nom');
        // // prix
        // $dashPrix = Immobiliers::where('user_id',$user_id)
        // ->value('immobiliers.prix');
        // // image1
        // $dashImage = Immobiliers::where('user_id',$user_id)
        // ->value('immobiliers.image1');

        // //
        // $user_id = auth()->id();
        // $dashNomV = Voitures::where('user_id',$user_id)
        // ->value('voitures.nom');
        // // prix
        // $dashPrixV = Voitures::where('user_id',$user_id)
        // ->value('voitures.prix');
        // // image1
        // $dashImageV = Voitures::where('user_id',$user_id)
        // ->value('voitures.image1');
        //  // date
        //  $dashDateV = Voitures::where('user_id',$user_id)
        //  ->value('voitures.created_at');
        //  // date
        //  $dashDateV = Voitures::where('user_id',$user_id)
        //  ->value('voitures.created_at');




        // return Inertia::render('Dashboard',[
                    // 'id' => $topic->id,
                    // 'name' => $topic->name,
                    // 'prix' => $topic->prix,
                    // 'image1' => asset('storage/' . $topic->image1),
                    // 'userid' => $topic->user_id,
                    // 'AA' => $topic->user_id,
                    // 'dashNom'=>$dashNom,
                    // 'dashPrix'=>$dashPrix,
                    // 'dashImage'=>$dashImage,


                    // 'dashNomV'=>$dashNomV,
                    // 'dashPrixV'=>$dashPrixV,
                    // 'dashImageV'=>$dashImageV,
                    // 'dashDateV'=>$dashDateV,
                    // 'dashIdV'=>$dashIdV,

        // ]);
        $user_id = auth()->id();

$voitures = Voitures::where('user_id', $user_id)->get(); // Récupérer toutes les voitures

return Inertia::render('Dashboard', [
    'voitures' => $voitures,
]);

    }

}
