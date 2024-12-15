<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Immobiliers;
use App\Models\Voitures;
use Intervention\Image\Facades\Image;

class ImmobilierController extends Controller
{
   public function storeVente()
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
    auth()->user()->Immobiliers()->create([
        'type' => Request::input('type'),
        'nom' => Request::input('nom'),
        'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'affaire' => Request::input('affaire'),
        'npiece' => Request::input('npiece'),
        'image1' => $image1,
        'image2' => $image2,
        'image3' => $image3,
        'categorie' => 'immobilier',
        'surface' => 0,
    ]);

    return redirect()->route('dashboard')->with('message', 'Annonce publiée avec succès');
}

/**
 * Redimensionner une image de manière proportionnelle.
 */
private function resizeImage($path)
{
    Image::make($path)
        ->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio(); // Maintenir le ratio
            $constraint->upsize();     // Éviter d'agrandir les petites images
        })
        ->save();
}

// TERRAIN VERGER
public function storeVente2()
{
    // Stockage des images
    $image1 = Request::file('image1')->store('topics', 'public');
    $image2 = Request::file('image2')->store('topics', 'public');
    $image3 = Request::file('image3')->store('topics', 'public');

    // Redimensionnement des images avec la méthode de redimensionnement proportionnel
    $this->resizeImage(public_path("storage/{$image1}"));
    $this->resizeImage(public_path("storage/{$image2}"));
    $this->resizeImage(public_path("storage/{$image3}"));

    // Création de l'entrée en base de données
    auth()->user()->Immobiliers()->create([
        'type' => 'verger',
        'nom' => Request::input('nom'),
        'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'affaire' => Request::input('affaire'),
        'surface' => Request::input('surface'),
        'image1' => $image1,
        'image2' => $image2,
        'image3' => $image3,
        'categorie' => 'immobilier',
        'npiece' => 0,
    ]);

    return redirect()->route('dashboard')->with('message', 'Annonce publiée avec succès');
}

/**
 * Redimensionner une image de manière proportionnelle.
 */


    // TERRAIN FERME
public function storeVente3()
{
    // Stockage des images
    $image1 = Request::file('image1')->store('topics', 'public');
    $image2 = Request::file('image2')->store('topics', 'public');
    $image3 = Request::file('image3')->store('topics', 'public');

    // Redimensionnement des images avec la méthode de redimensionnement proportionnel
    $this->resizeImage(public_path("storage/{$image1}"));
    $this->resizeImage(public_path("storage/{$image2}"));
    $this->resizeImage(public_path("storage/{$image3}"));

    // Création de l'entrée en base de données
    auth()->user()->Immobiliers()->create([
        'type' => 'ferme',
        'nom' => Request::input('nom'),
        'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'affaire' => Request::input('affaire'),
        'surface' => Request::input('surface'),
        'image1' => $image1,
        'image2' => $image2,
        'image3' => $image3,
        'categorie' => 'immobilier',
        'npiece' => 0,
    ]);

    return redirect()->route('dashboard')->with('message', 'Annonce publiée avec succès');
}


public function destroy (Immobiliers $maison)
{
    $maison->delete();

}

// MODIFIER VENDU
public function venduArticle($id)
{
    // Récupérer l'immobilier existant
    $immobilier = auth()->user()->Immobiliers()->findOrFail($id);

    // Mettre à jour les images si nécessaire
    if (Request::hasFile('image1')) {
        $image1 = Request::file('image1')->store('topics', 'public');
        Image::make(public_path("storage/{$image1}"))->resize(1200, 1200)->save();
        $immobilier->image1 = $image1;
    }
    if (Request::hasFile('image2')) {
        $image2 = Request::file('image2')->store('topics', 'public');
        Image::make(public_path("storage/{$image2}"))->resize(1200, 1200)->save();
        $immobilier->image2 = $image2;
    }
    if (Request::hasFile('image3')) {
        $image3 = Request::file('image3')->store('topics', 'public');
        Image::make(public_path("storage/{$image3}"))->resize(1200, 1200)->save();
        $immobilier->image3 = $image3;
    }

    // Mettre à jour les autres champs
    $immobilier->type = 'ferme';
    $immobilier->nom = Request::input('nom');
    $immobilier->prix = Request::input('prix');
    $immobilier->description = Request::input('description');
    $immobilier->region = Request::input('region');
    $immobilier->affaire = Request::input('affaire');
    $immobilier->surface = Request::input('surface');
    $immobilier->categorie = 'immobilier';
    $immobilier->npiece = 0;

    // Sauvegarder les modifications
    $immobilier->save();

    return redirect()->route('dashboard')->with('message', 'Annonce modifiée avec succès');
}

// MODIFIER immobillier
public function storeEdit($id )
    {


        auth()->user()->Immobiliers()->where('id', $id)->update([
            // 'type' => Request::input('type'),
            'nom' => Request::input('nom'),
            'prix' => Request::input('prix'),
            'description' => Request::input('description')
        ]);

        return redirect()->route('dashboard')->with('message', 'Annone publiee avec success Intervention');
    }

    // Vendu Vehicule



    // Vendu

    public function StoreVenduImmo($id )
    {


        auth()->user()->Immobiliers()->where('id', $id)->update([
            // 'type' => Request::input('type'),
            'vendu' => Request::input('vendu'),

        ]);

        return redirect()->route('dashboard')->with('message', 'Annone publiee avec success Intervention');
    }

    public function storeEditVehicule($id )
    {


        auth()->user()->Voitures()->where('id', $id)->update([
            // 'type' => Request::input('type'),
            'nom' => Request::input('nom'),
            'prix' => Request::input('prix'),
            'description' => Request::input('description')
        ]);

        return redirect()->route('dashboard')->with('message', 'Annone publiee avec success Intervention');
    }

    // Vendu

    public function StoreVenduVehicule($id )
    {


        auth()->user()->Voitures()->where('id', $id)->update([
            // 'type' => Request::input('type'),
            'vendu' => Request::input('vendu'),
            // 'vendu' => Request::input('vendu'),

        ]);

        return redirect()->route('dashboard')->with('message', 'Annone publiee avec success Intervention');
    }


    // enregistrer detail boost

    public function StoreBoostImmo($id )
    {


        auth()->user()->Immobiliers()->where('id', $id)->update([
            // 'type' => Request::input('type'),
            'booster' => Request::input('boost'),
            'duration' => Request::input('duration'),
            'status' => 'pending',


        ]);

        return redirect()->route('dashboard')->with('message', 'boost avec Succes attente de validation');
    }


    // store update vboost vehicule

    public function vehiculeBoost($id)
    {


        auth()->user()->Voitures()->where('id', $id)->update([
            'booster' => Request::input('boost'),



        ]);

        return redirect()->route('dashboard')->with('message',  'boost avec Succes attente de validation');
    }


    // store boost vehi

    public function StoreBoostVehicule($id )
    {


        auth()->user()->Voitures()->where('id', $id)->update([
            // 'type' => Request::input('type'),
                 'booster' => Request::input('boost'),
            'duration' => Request::input('duration'),
            'status' => 'pending',

        ]);

        return redirect()->back()->with('message', 'Votre annonce est en attente de vérification.');
    }


}
