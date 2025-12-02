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
    // Gérer les images (peut être un tableau ou des fichiers individuels)
    $image1 = null;
    $image2 = null;
    $image3 = null;
    $allImages = []; // Tableau pour toutes les images
    
    // Si images est un tableau (nouveau format)
    if (Request::hasFile('images')) {
        $images = Request::file('images');
        if (is_array($images)) {
            // Traiter toutes les images du tableau
            foreach ($images as $index => $image) {
                if ($image && $image->isValid()) {
                    $storedPath = $image->store('topics', 'public');
                    if ($storedPath && file_exists(public_path("storage/{$storedPath}"))) {
                        $this->resizeImage(public_path("storage/{$storedPath}"));
                        $allImages[] = $storedPath;
                        
                        // Garder les 3 premières pour image1, image2, image3 (compatibilité)
                        if ($index === 0) {
                            $image1 = $storedPath;
                        } elseif ($index === 1) {
                            $image2 = $storedPath;
                        } elseif ($index === 2) {
                            $image3 = $storedPath;
                        }
                    }
                }
            }
        }
    }
    
    // Fallback sur l'ancien format (image1, image2, image3 individuels)
    if (!$image1 && Request::hasFile('image1')) {
        $file1 = Request::file('image1');
        if ($file1->isValid()) {
            $image1 = $file1->store('topics', 'public');
            if ($image1 && file_exists(public_path("storage/{$image1}"))) {
    $this->resizeImage(public_path("storage/{$image1}"));
                if (!in_array($image1, $allImages)) {
                    $allImages[] = $image1;
                }
            }
        }
    }
    if (!$image2 && Request::hasFile('image2')) {
        $file2 = Request::file('image2');
        if ($file2->isValid()) {
            $image2 = $file2->store('topics', 'public');
            if ($image2 && file_exists(public_path("storage/{$image2}"))) {
    $this->resizeImage(public_path("storage/{$image2}"));
                if (!in_array($image2, $allImages)) {
                    $allImages[] = $image2;
                }
            }
        }
    }
    if (!$image3 && Request::hasFile('image3')) {
        $file3 = Request::file('image3');
        if ($file3->isValid()) {
            $image3 = $file3->store('topics', 'public');
            if ($image3 && file_exists(public_path("storage/{$image3}"))) {
    $this->resizeImage(public_path("storage/{$image3}"));
                if (!in_array($image3, $allImages)) {
                    $allImages[] = $image3;
                }
            }
        }
    }

    // Création de l'entrée en base de données
    auth()->user()->Immobiliers()->create([
        'type' => Request::input('type'),
        'nom' => Request::input('nom'),
        'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'affaire' => Request::input('affaire'),
        'npiece' => Request::input('npiece'),
        'image1' => $image1 ?? '',
        'image2' => $image2 ?? '',
        'image3' => $image3 ?? '',
        'images' => !empty($allImages) ? json_encode($allImages) : null, // Toutes les images en JSON
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
    if (!file_exists($path) || !is_readable($path)) {
        \Log::error("Image file not found or not readable: {$path}");
        return;
    }
    
    try {
    Image::make($path)
        ->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio(); // Maintenir le ratio
            $constraint->upsize();     // Éviter d'agrandir les petites images
        })
        ->save();
    } catch (\Exception $e) {
        \Log::error("Error resizing image {$path}: " . $e->getMessage());
    }
}

// TERRAIN VERGER
public function storeVente2()
{
    // Gérer les images (peut être un tableau ou des fichiers individuels)
    $image1 = null;
    $image2 = null;
    $image3 = null;
    $allImages = []; // Tableau pour toutes les images
    
    // Si images est un tableau (nouveau format)
    if (Request::hasFile('images')) {
        $images = Request::file('images');
        if (is_array($images)) {
            // Traiter toutes les images du tableau
            foreach ($images as $index => $image) {
                if ($image && $image->isValid()) {
                    $storedPath = $image->store('topics', 'public');
                    if ($storedPath && file_exists(public_path("storage/{$storedPath}"))) {
                        $this->resizeImage(public_path("storage/{$storedPath}"));
                        $allImages[] = $storedPath;
                        
                        // Garder les 3 premières pour image1, image2, image3 (compatibilité)
                        if ($index === 0) {
                            $image1 = $storedPath;
                        } elseif ($index === 1) {
                            $image2 = $storedPath;
                        } elseif ($index === 2) {
                            $image3 = $storedPath;
                        }
                    }
                }
            }
        }
    }
    
    // Fallback sur l'ancien format (image1, image2, image3 individuels)
    if (!$image1 && Request::hasFile('image1')) {
        $file1 = Request::file('image1');
        if ($file1->isValid()) {
            $image1 = $file1->store('topics', 'public');
            if ($image1 && file_exists(public_path("storage/{$image1}"))) {
    $this->resizeImage(public_path("storage/{$image1}"));
                if (!in_array($image1, $allImages)) {
                    $allImages[] = $image1;
                }
            }
        }
    }
    if (!$image2 && Request::hasFile('image2')) {
        $file2 = Request::file('image2');
        if ($file2->isValid()) {
            $image2 = $file2->store('topics', 'public');
            if ($image2 && file_exists(public_path("storage/{$image2}"))) {
    $this->resizeImage(public_path("storage/{$image2}"));
                if (!in_array($image2, $allImages)) {
                    $allImages[] = $image2;
                }
            }
        }
    }
    if (!$image3 && Request::hasFile('image3')) {
        $file3 = Request::file('image3');
        if ($file3->isValid()) {
            $image3 = $file3->store('topics', 'public');
            if ($image3 && file_exists(public_path("storage/{$image3}"))) {
    $this->resizeImage(public_path("storage/{$image3}"));
                if (!in_array($image3, $allImages)) {
                    $allImages[] = $image3;
                }
            }
        }
    }

    // Création de l'entrée en base de données
    auth()->user()->Immobiliers()->create([
        'type' => 'verger',
        'nom' => Request::input('nom'),
        'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'affaire' => Request::input('affaire'),
        'surface' => Request::input('surface'),
        'image1' => $image1 ?? '',
        'image2' => $image2 ?? '',
        'image3' => $image3 ?? '',
        'images' => !empty($allImages) ? json_encode($allImages) : null, // Toutes les images en JSON
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
    // Gérer les images (peut être un tableau ou des fichiers individuels)
    $image1 = null;
    $image2 = null;
    $image3 = null;
    $allImages = []; // Tableau pour toutes les images
    
    // Si images est un tableau (nouveau format)
    if (Request::hasFile('images')) {
        $images = Request::file('images');
        if (is_array($images)) {
            // Traiter toutes les images du tableau
            foreach ($images as $index => $image) {
                if ($image && $image->isValid()) {
                    $storedPath = $image->store('topics', 'public');
                    if ($storedPath && file_exists(public_path("storage/{$storedPath}"))) {
                        $this->resizeImage(public_path("storage/{$storedPath}"));
                        $allImages[] = $storedPath;
                        
                        // Garder les 3 premières pour image1, image2, image3 (compatibilité)
                        if ($index === 0) {
                            $image1 = $storedPath;
                        } elseif ($index === 1) {
                            $image2 = $storedPath;
                        } elseif ($index === 2) {
                            $image3 = $storedPath;
                        }
                    }
                }
            }
        }
    }
    
    // Fallback sur l'ancien format (image1, image2, image3 individuels)
    if (!$image1 && Request::hasFile('image1')) {
        $file1 = Request::file('image1');
        if ($file1->isValid()) {
            $image1 = $file1->store('topics', 'public');
            if ($image1 && file_exists(public_path("storage/{$image1}"))) {
    $this->resizeImage(public_path("storage/{$image1}"));
                if (!in_array($image1, $allImages)) {
                    $allImages[] = $image1;
                }
            }
        }
    }
    if (!$image2 && Request::hasFile('image2')) {
        $file2 = Request::file('image2');
        if ($file2->isValid()) {
            $image2 = $file2->store('topics', 'public');
            if ($image2 && file_exists(public_path("storage/{$image2}"))) {
    $this->resizeImage(public_path("storage/{$image2}"));
                if (!in_array($image2, $allImages)) {
                    $allImages[] = $image2;
                }
            }
        }
    }
    if (!$image3 && Request::hasFile('image3')) {
        $file3 = Request::file('image3');
        if ($file3->isValid()) {
            $image3 = $file3->store('topics', 'public');
            if ($image3 && file_exists(public_path("storage/{$image3}"))) {
    $this->resizeImage(public_path("storage/{$image3}"));
                if (!in_array($image3, $allImages)) {
                    $allImages[] = $image3;
                }
            }
        }
    }

    // Création de l'entrée en base de données
    auth()->user()->Immobiliers()->create([
        'type' => 'ferme',
        'nom' => Request::input('nom'),
        'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'affaire' => Request::input('affaire'),
        'surface' => Request::input('surface'),
        'image1' => $image1 ?? '',
        'image2' => $image2 ?? '',
        'image3' => $image3 ?? '',
        'images' => !empty($allImages) ? json_encode($allImages) : null, // Toutes les images en JSON
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
public function storeEdit($id)
{
    $immobilier = auth()->user()->Immobiliers()->findOrFail($id);
    
    // Récupérer les images existantes
    $existingImages = [];
    if ($immobilier->images) {
        $existingImages = is_array($immobilier->images) 
            ? $immobilier->images 
            : json_decode($immobilier->images, true) ?? [];
    }
    
    // Ajouter image1, image2, image3 si elles existent
    if ($immobilier->image1 && !in_array($immobilier->image1, $existingImages)) {
        $existingImages[] = $immobilier->image1;
    }
    if ($immobilier->image2 && !in_array($immobilier->image2, $existingImages)) {
        $existingImages[] = $immobilier->image2;
    }
    if ($immobilier->image3 && !in_array($immobilier->image3, $existingImages)) {
        $existingImages[] = $immobilier->image3;
    }
    
    // Gérer les nouvelles images uploadées
    $image1 = $immobilier->image1;
    $image2 = $immobilier->image2;
    $image3 = $immobilier->image3;
    $allImages = $existingImages;
    
    // Si images est un tableau (nouveau format)
    if (Request::hasFile('images')) {
        $images = Request::file('images');
        if (is_array($images)) {
            foreach ($images as $index => $image) {
                if ($image && $image->isValid()) {
                    $storedPath = $image->store('topics', 'public');
                    if ($storedPath && file_exists(public_path("storage/{$storedPath}"))) {
                        $this->resizeImage(public_path("storage/{$storedPath}"));
                        $allImages[] = $storedPath;
                        
                        // Mettre à jour image1, image2, image3 si nécessaire
                        if ($index === 0) {
                            $image1 = $storedPath;
                        } elseif ($index === 1) {
                            $image2 = $storedPath;
                        } elseif ($index === 2) {
                            $image3 = $storedPath;
                        }
                    }
                }
            }
        }
    }
    
    // Fallback sur l'ancien format (image1, image2, image3 individuels)
    if (Request::hasFile('image1')) {
        $file1 = Request::file('image1');
        if ($file1->isValid()) {
            $image1 = $file1->store('topics', 'public');
            if ($image1 && file_exists(public_path("storage/{$image1}"))) {
                $this->resizeImage(public_path("storage/{$image1}"));
                if (!in_array($image1, $allImages)) {
                    $allImages[] = $image1;
                }
            }
        }
    }
    if (Request::hasFile('image2')) {
        $file2 = Request::file('image2');
        if ($file2->isValid()) {
            $image2 = $file2->store('topics', 'public');
            if ($image2 && file_exists(public_path("storage/{$image2}"))) {
                $this->resizeImage(public_path("storage/{$image2}"));
                if (!in_array($image2, $allImages)) {
                    $allImages[] = $image2;
                }
            }
        }
    }
    if (Request::hasFile('image3')) {
        $file3 = Request::file('image3');
        if ($file3->isValid()) {
            $image3 = $file3->store('topics', 'public');
            if ($image3 && file_exists(public_path("storage/{$image3}"))) {
                $this->resizeImage(public_path("storage/{$image3}"));
                if (!in_array($image3, $allImages)) {
                    $allImages[] = $image3;
                }
            }
        }
    }
    
    // Gérer la suppression d'images existantes (si deletedImages est envoyé)
    if (Request::has('deletedImages') && is_array(Request::input('deletedImages'))) {
        $deletedImages = Request::input('deletedImages');
        
        // Normaliser tous les chemins d'images existants pour comparaison
        $normalizedExistingImages = [];
        foreach ($allImages as $img) {
            // Normaliser le chemin (enlever storage/ ou /storage/)
            $normalized = $img;
            if (strpos($img, 'storage/') === 0) {
                $normalized = substr($img, 8); // Enlever "storage/"
            } elseif (strpos($img, '/storage/') !== false) {
                $normalized = str_replace('/storage/', '', $img);
            }
            $normalizedExistingImages[$normalized] = $img;
        }
        
        // Pour chaque image à supprimer, normaliser et retirer
        foreach ($deletedImages as $deletedUrl) {
            // Normaliser l'URL supprimée
            $normalizedDeleted = $deletedUrl;
            if (strpos($deletedUrl, '/storage/') !== false) {
                $normalizedDeleted = str_replace('/storage/', '', $deletedUrl);
            } elseif (strpos($deletedUrl, 'storage/') === 0) {
                $normalizedDeleted = substr($deletedUrl, 8);
            }
            
            // Retirer de normalizedExistingImages si trouvé
            if (isset($normalizedExistingImages[$normalizedDeleted])) {
                unset($normalizedExistingImages[$normalizedDeleted]);
            }
            
            // Aussi comparer avec basename pour être sûr
            $deletedBasename = basename($normalizedDeleted);
            foreach ($normalizedExistingImages as $normalized => $original) {
                if (basename($normalized) === $deletedBasename) {
                    unset($normalizedExistingImages[$normalized]);
                }
            }
        }
        
        // Reconstruire allImages avec les images restantes
        $allImages = array_values($normalizedExistingImages);
        
        // Mettre à jour image1, image2, image3 si elles ont été supprimées
        if (empty($allImages)) {
            $image1 = '';
            $image2 = '';
            $image3 = '';
        } else {
            $image1 = $allImages[0] ?? '';
            $image2 = isset($allImages[1]) ? $allImages[1] : '';
            $image3 = isset($allImages[2]) ? $allImages[2] : '';
        }
    }
    
    // Préparer les données de mise à jour
    $updateData = [
            'nom' => Request::input('nom'),
            'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'categorie' => Request::input('categorie'),
        'affaire' => Request::input('affaire'),
        'image1' => $image1 ?? '',
        'image2' => $image2 ?? '',
        'image3' => $image3 ?? '',
        'images' => !empty($allImages) ? json_encode($allImages) : null,
    ];
    
    // Ajouter npiece ou surface selon le type
    if (Request::has('npiece')) {
        $updateData['npiece'] = Request::input('npiece');
    }
    if (Request::has('surface')) {
        $updateData['surface'] = Request::input('surface');
    }
    
    // Mettre à jour l'immobilier
    $immobilier->update($updateData);

    return redirect()->route('dashboard')->with('message', 'Annonce modifiée avec succès');
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
        // Récupérer la durée en minutes depuis le formulaire
        $durationMinutes = Request::input('duration');
        
        // Convertir les minutes en jours
        // 120 minutes = 0.083 jours ≈ 1 jour minimum
        // 2880 minutes = 2 jours
        // 4320 minutes = 3 jours
        // 10080 minutes = 7 jours
        $durationDays = ceil($durationMinutes / 1440); // 1440 minutes = 1 jour

        auth()->user()->Immobiliers()->where('id', $id)->update([
            // 'type' => Request::input('type'),
            'booster' => Request::input('boost'),
            'duration' => $durationMinutes,  // Garder la durée originale en minutes
            'boost_duration' => $durationDays,  // Stocker la durée en jours
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
