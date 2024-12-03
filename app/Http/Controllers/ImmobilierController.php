<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Immobiliers;
use App\Models\Voitures;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ImmobilierController extends Controller
{


public function storeVente()
{
    // Vérification de la présence des fichiers image
    $image1 = Request::file('image1');
    $image2 = Request::file('image2');
    $image3 = Request::file('image3');

    if (!$image1 || !$image2 || !$image3) {
        return redirect()->back()->with('error', 'Veuillez télécharger toutes les images.');
    }

    // Chemin de destination dans le dossier public
    $destinationPath = public_path('topics');

    // Créer le dossier 'topics' s'il n'existe pas
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }

    // Génération de noms de fichiers uniques
    $image1Name = $this->generateUniqueFileName($image1);
    $image2Name = $this->generateUniqueFileName($image2);
    $image3Name = $this->generateUniqueFileName($image3);

    // Enregistrement des fichiers dans 'public/topics'
    $image1->move($destinationPath, $image1Name);
    $image2->move($destinationPath, $image2Name);
    $image3->move($destinationPath, $image3Name);

    // Chemins relatifs des images
    $image1Path = "topics/{$image1Name}";
    $image2Path = "topics/{$image2Name}";
    $image3Path = "topics/{$image3Name}";

    // Redimensionnement et sauvegarde des images
    $this->resizeImage(public_path($image1Path));
    $this->resizeImage(public_path($image2Path));
    $this->resizeImage(public_path($image3Path));

    // Création de l'enregistrement dans la base de données
    auth()->user()->Immobiliers()->create([
        'type' => Request::input('type'),
        'nom' => Request::input('nom'),
        'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'affaire' => Request::input('affaire'),
        'npiece' => Request::input('npiece'),
        'image1' => $image1Path,
        'image2' => $image2Path,
        'image3' => $image3Path,
        'categorie' => 'immobilier',
        'surface' => 0,
    ]);

    return redirect()->route('dashboard')->with('message', 'Annonce publiée avec succès.');
}

private function resizeImage($imageFullPath)
{
    if (file_exists($imageFullPath)) {
        // Redimensionner l'image
        $image = Image::make($imageFullPath)->resize(1200, 1200);
        $image->save($imageFullPath);  // Sauvegarder l'image après redimensionnement
    }
}

private function generateUniqueFileName($file)
{
    return uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
}


// TERRAIN VERGER

public function storeVente2(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prix' => 'required|numeric|min:0',
        'description' => 'required|string',
        'region' => 'required|string|max:255',
        'affaire' => 'required|string|max:255',
        'surface' => 'required|numeric|min:0',
        'image1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'image2' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'image3' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Chemin de destination
    $destinationPath = public_path('topics');

    // Créer le dossier s'il n'existe pas
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }

    // Enregistrement des fichiers avec noms uniques
    $image1Name = $this->generateUniqueFileName($request->file('image1'));
    $image2Name = $this->generateUniqueFileName($request->file('image2'));
    $image3Name = $this->generateUniqueFileName($request->file('image3'));

    // Vérification du téléchargement des fichiers
    if (!$request->file('image1')->move($destinationPath, $image1Name) ||
        !$request->file('image2')->move($destinationPath, $image2Name) ||
        !$request->file('image3')->move($destinationPath, $image3Name)) {
        return redirect()->back()->with('error', 'Le téléchargement des images a échoué.');
    }

    // Chemins relatifs pour la base de données
    $image1Path = "topics/{$image1Name}";
    $image2Path = "topics/{$image2Name}";
    $image3Path = "topics/{$image3Name}";

    // Redimensionnement des images
    $this->resizeAndSaveImage(public_path($image1Path));
    $this->resizeAndSaveImage(public_path($image2Path));
    $this->resizeAndSaveImage(public_path($image3Path));

    // Création de l'enregistrement dans la base de données
    auth()->user()->Immobiliers()->create([
        'type' => 'verger',
        'nom' => $validated['nom'],
        'prix' => $validated['prix'],
        'description' => $validated['description'],
        'region' => $validated['region'],
        'affaire' => $validated['affaire'],
        'surface' => $validated['surface'],
        'image1' => $image1Path,
        'image2' => $image2Path,
        'image3' => $image3Path,
        'categorie' => 'immobilier',
        'npiece' => 0,
    ]);

    return redirect()->route('dashboard')->with('message', 'Annonce publiée avec succès.');
}

private function resizeAndSaveImage($filePath)
{
    if (file_exists($filePath)) {
        $image = Image::make($filePath)->resize(1200, 1200);
        $image->save($filePath);  // Sauvegarder l'image après redimensionnement
    }
}











    // TERRAIN FERME




public function storeVente3(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prix' => 'required|numeric|min:0',
        'description' => 'required|string',
        'region' => 'required|string|max:255',
        'affaire' => 'required|string|max:255',
        'surface' => 'required|numeric|min:0',
        'image1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'image2' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'image3' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    try {
        // Chemin de destination
        $destinationPath = public_path('topics');

        // Créer le dossier s'il n'existe pas
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Enregistrement des fichiers avec vérification de leur présence et validité
        if (!$request->hasFile('image1') || !$request->file('image1')->isValid()) {
            return redirect()->back()->with('error', 'L\'image 1 est manquante ou invalide.');
        }
        if (!$request->hasFile('image2') || !$request->file('image2')->isValid()) {
            return redirect()->back()->with('error', 'L\'image 2 est manquante ou invalide.');
        }
        if (!$request->hasFile('image3') || !$request->file('image3')->isValid()) {
            return redirect()->back()->with('error', 'L\'image 3 est manquante ou invalide.');
        }

        // Générer des noms de fichiers uniques pour les images
        $image1Name = $this->generateUniqueFileName($request->file('image1'));
        $image2Name = $this->generateUniqueFileName($request->file('image2'));
        $image3Name = $this->generateUniqueFileName($request->file('image3'));

        // Déplacer les fichiers
        $request->file('image1')->move($destinationPath, $image1Name);
        $request->file('image2')->move($destinationPath, $image2Name);
        $request->file('image3')->move($destinationPath, $image3Name);

        // Chemins relatifs pour la base de données
        $image1Path = "topics/{$image1Name}";
        $image2Path = "topics/{$image2Name}";
        $image3Path = "topics/{$image3Name}";

        // Redimensionner les images
        $this->resizeAndSaveImage(public_path($image1Path));
        $this->resizeAndSaveImage(public_path($image2Path));
        $this->resizeAndSaveImage(public_path($image3Path));

        // Créer un enregistrement dans la base de données
        auth()->user()->Immobiliers()->create([
            'type' => 'ferme',
            'nom' => $validated['nom'],
            'prix' => $validated['prix'],
            'description' => $validated['description'],
            'region' => $validated['region'],
            'affaire' => $validated['affaire'],
            'surface' => $validated['surface'],
            'image1' => $image1Path,
            'image2' => $image2Path,
            'image3' => $image3Path,
            'categorie' => 'immobilier',
            'npiece' => 0,
        ]);

        return redirect()->route('dashboard')->with('message', 'Annonce publiée avec succès.');
    } catch (\Exception $e) {
        \Log::error('Erreur lors de la création de l\'annonce : ' . $e->getMessage());
        return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
    }
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
