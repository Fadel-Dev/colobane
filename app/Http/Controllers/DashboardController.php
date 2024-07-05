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
        // VENDU ARTICLES
        // FOR VENDU ARTICLES
        $immobiliersVendu = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->toArray();
        $voituresVendu = Voitures::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->toArray();
        // FOR ACTUEL ARTICLES

        $immobiliersActuel = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 0)
            ->get()
            ->toArray();
        $voituresActuel = Voitures::where('user_id', $user_id)
            ->where('vendu', 0)
            ->get()
            ->toArray();

        $vehicules = $voitures;
        $habitats = $immobiliers;
        $vehiculesVendu = $voituresVendu;
        $habitatsVendu = $immobiliersVendu;
        // FOR ARTICLE VENDU

        $vehiculesActuel = $voituresActuel;
        $habitatsActuel = $immobiliersActuel;

        // FOR VENDU ARTICLES
        $immobiliersVendu = Immobiliers::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->toArray();
        $voituresVendu = Voitures::where('user_id', $user_id)
            ->where('vendu', 1)
            ->get()
            ->toArray();


        // Transforming the arrays to a common structure
        /**
         * Transform the immobiliers array by extracting relevant fields and
         * returning a new array of immobiliers with the transformed data.
         *
         * @param array $immobiliers The original array of immobiliers
         * @return array The transformed array of immobiliers
         */
        $immobiliers = array_map(function ($immobilier) {
            /**
             * Extract relevant fields from each immobilier and return
             * a new immobilier with the transformed data.
             *
             * @param array $immobilier The original immobilier
             * @return array The transformed immobilier
             */
            return [
                // The nom field of the immobilier
                'nom' => $immobilier['nom'],
                // The prix field of the immobilier
                'prix' => $immobilier['prix'],
                // The image1 field of the immobilier
                'image1' => $immobilier['image1'],
                // The created_at field of the immobilier
                'created_at' => $immobilier['created_at'],
                // The id field of the immobilier
                'id' => $immobilier['id'],
                // The affaire field of the immobilier
                'affaire' => $immobilier['affaire'],
            ];
        }, $immobiliers);

        $results = array_merge($voitures, $immobiliers);
        $resultsVendu = array_merge($voituresVendu, $immobiliersVendu);
        $resultsActuel = array_merge($voituresActuel, $immobiliersActuel);


        $total = count($results);
        $totalImmobilier = count($habitats);
        $totalVehicule = count($vehicules);
        // VENDU ARTICLES
        $totalImmobilierVendu = count($habitatsVendu);
        $totalVehiculeVendu = count($vehiculesVendu);


        $totalVendu = count($resultsVendu);
        $sommeHabitatVendu=0;
        $sommeVehiculeVendu=0;


        // $totalVenduSomme += $resultsVendu['prix'];

        $totalVenduSomme=0;
        foreach ($resultsVendu as $article) {
            $totalVenduSomme += $article['prix'];
        }
        // VENDU ARTICLES Immobilier

        foreach($habitatsVendu as $articlevfg){
            $sommeHabitatVendu += $articlevfg['prix'];
        }
        // VENDU ARTICLES Vehicule
        foreach($vehiculesVendu as $articleee){
            $sommeVehiculeVendu += $articleee['prix'];
        }



        // ARICLE EN COURS DE VENTE

        $totalImmobilierActuel = count($habitatsActuel);
        $totalVehiculeActuel = count($vehiculesActuel);
        $totalActuel = count($resultsActuel);


        // calcule

        $restantImmobilier= $totalImmobilier - $totalImmobilierVendu;
        $restantVoiture=$totalVehicule - $totalVehiculeVendu;
        $totalArticles=$totalVehicule - $totalImmobilier;
        $totalRestant=$restantVoiture + $restantImmobilier;


        // $totalPrixVendu += $voiture['prix'];


        // Render the 'Dashboard' Inertia component with various data passed as props.
        //
        // @param array $results Array of merged vehicle and housing data.
        // @param array $vehicules Array of vehicles data.
        // @param array $habitats Array of housing data.
        // @param int $total Total count of merged vehicle and housing data.
        // @param int $totalImmobilier Total count of housing data.
        // @param int $totalVehicule Total count of vehicle data.
        // @param array $resultsVendu Array of merged sold vehicle and sold housing data.
        // @param int $totalImmobilierVendu Total count of sold housing data.
        // @param int $totalVehiculeVendu Total count of sold vehicle data.
        // @param int $totalVendu Total count of merged sold vehicle and sold housing data.
        // @param array $resultsActuel Array of merged on-sale vehicle and on-sale housing data.
        // @param int $totalImmobilierActuel Total count of on-sale housing data.
        // @param int $totalVehiculeActuel Total count of on-sale vehicle data.
        // @param int $totalActuel Total count of merged on-sale vehicle and on-sale housing data.
        // @return \Inertia\Response
        return Inertia::render('Dashboard', [
            // Merged array of vehicle and housing data.
            'results' => $results,
            // Array of vehicle data.
            'vehicules' => $vehicules,
            // Array of housing data.
            'habitats' => $habitats,
            // Total count of merged vehicle and housing data.
            'total' => $total,
            // Total count of housing data.
            'totalImmobilier' => $totalImmobilier,
            // Total count of vehicle data.
            'totalVehicule' => $totalVehicule,
            // Merged array of sold vehicle and sold housing data.
            'resultsVendu' => $resultsVendu,
            // Total count of sold housing data.
            'totalImmobilierVendu' => $totalImmobilierVendu,
            // Total count of sold vehicle data.
            'totalVehiculeVendu' => $totalVehiculeVendu,
            // Total count of merged sold vehicle and sold housing data.
            'totalVendu' => $totalVendu,
            // Merged array of on-sale vehicle and on-sale housing data.
            'resultsActuel' => $resultsActuel,
            // Total count of on-sale housing data.
            'totalImmobilierActuel' => $totalImmobilierActuel,
            // Total count of on-sale vehicle data.
            'totalVehiculeActuel' => $totalVehiculeActuel,
            // Total count of merged on-sale vehicle and on-sale housing data.
            'totalActuel' => $totalActuel,

            // Total price of sold all article
            'totalVenduSomme' => $totalVenduSomme,

            // Total price of sold all immobilier
            // Total price of sold all immobilier
            'sommeHabitatVendu' => $sommeHabitatVendu,
            'sommeVehiculeVendu' => $sommeVehiculeVendu,

            // CALCULE FOR STATISTIQUE

            
             'restantImmobilier' => $restantImmobilier,
             'restantVoiture' => $restantVoiture,
             "totalArticles" => $totalArticles,
              "totalRestant" => $totalRestant,

             
        ]);
    }
}
