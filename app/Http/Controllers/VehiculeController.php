<?php

namespace App\Http\Controllers;

use App\Models\Immobiliers;

use Request;
use Inertia\Inertia;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Voitures;
use Intervention\Image\Facades\Image;




class VehiculeController extends Controller
{
// voiture

     public function storeVoitureVente()
{
    // Stockage des images
    $image1 = Request::file('image1')->store('topics', 'public');
    $image2 = Request::file('image2')->store('topics', 'public');
    $image3 = Request::file('image3')->store('topics', 'public');

    // Redimensionnement proportionnel des images
    $this->resizeImage(public_path("storage/{$image1}"));
    $this->resizeImage(public_path("storage/{$image2}"));
    $this->resizeImage(public_path("storage/{$image3}"));

    // Création de l'entrée en base de données
    auth()->user()->Voitures()->create([
        'model' => Request::input('model'),
        'marque' => Request::input('marque'),
        'nom' => Request::input('nom'),
        'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'carburant' => Request::input('carburant'),
        'region' => Request::input('region'),
        'etat' => Request::input('etat'),
        'boiteVitesse' => Request::input('boiteVitesse'),
        'kilometrage' => Request::input('kilometrage'),
        'place' => Request::input('place'),
        'annee' => Request::input('annee'),
        'affaire' => 'vente',
        'image1' => $image1,
        'image2' => $image2,
        'image3' => $image3,
        'categorie' => 'voiture',
    ]);

    return redirect()->route('publier');
}

      // voiture

   public function storeVoitureLoc()
{
    $image1 = Request::file('image1')->store('topics', 'public');
    $image2 = Request::file('image2')->store('topics', 'public');
    $image3 = Request::file('image3')->store('topics', 'public');

    $this->resizeImage(public_path("storage/{$image1}"));
    $this->resizeImage(public_path("storage/{$image2}"));
    $this->resizeImage(public_path("storage/{$image3}"));

    // Stockez les données de la voiture
    auth()->user()->Voitures()->create([
        'marque' => Request::input('marque'),
        'nom' => Request::input('nom'),
        'model' => 'N',
        'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'kilometrage' => 0,
        'boiteVitesse' => Request::input('boiteVitesse'),
        'carburant' => Request::input('carburant'),
        'region' => Request::input('region'),
        'place' => Request::input('place'),
        'affaire' => 'location',
        'annee' => 0,
        'etat' => 0,
        'image1' => $image1,
        'image2' => $image2,
        'image3' => $image3,
        'categorie' => 'voiture',
    ]);

    return redirect()->route('publier');
}

private function resizeImage($path)
{
    $img = Image::make($path)
        ->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio(); // Maintenir les proportions
            $constraint->upsize(); // Éviter d'agrandir les petites images
        })
        ->save();
}
    //    Edit in Dashboard

    public function UpdateImmobilier($id)
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

        return Inertia::render('ModifiImmobilierArticle', [
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
