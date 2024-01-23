<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Immobiliers;
use Intervention\Image\Facades\Image;

class ImmobilierController extends Controller
{
    public function storeVente()
    {
        $image1=Request::file('image1')->store('topics','public');
        $image2=Request::file('image2')->store('topics','public');
        $image3=Request::file('image3')->store('topics','public');

        $img1=Image::make(public_path("storage/{$image1}"))->resize(1200,1200);
        $img2=Image::make(public_path("storage/{$image2}"))->resize(1200,1200);
        $img3=Image::make(public_path("storage/{$image3}"))->resize(1200,1200);
        $img1->save();
        $img2->save();
        $img3->save();


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
            'categorie' =>'immobilier',
            'surface' =>0,
        ]);

        return redirect()->route('dashboard')->with('message', 'Annone publiee avec success Intervention');
    }

// TERRAIN VERGER
public function storeVente2()
    {
        $image1=Request::file('image1')->store('topics','public');
        $image2=Request::file('image2')->store('topics','public');
        $image3=Request::file('image3')->store('topics','public');

        $img1=Image::make(public_path("storage/{$image1}"))->resize(1200,1200);
        $img2=Image::make(public_path("storage/{$image2}"))->resize(1200,1200);
        $img3=Image::make(public_path("storage/{$image3}"))->resize(1200,1200);
        $img1->save();
        $img2->save();
        $img3->save();



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
            'categorie' =>'immobilier',
            'npiece' =>0,
        ]);

        return redirect()->route('dashboard')->with('message', 'Annonce publiee avec success');
    }

    // TERRAIN FERME
public function storeVente3()
{
    $image1=Request::file('image1')->store('topics','public');
    $image2=Request::file('image2')->store('topics','public');
    $image3=Request::file('image3')->store('topics','public');


    $img1=Image::make(public_path("storage/{$image1}"))->resize(1200,1200);
    $img2=Image::make(public_path("storage/{$image2}"))->resize(1200,1200);
    $img3=Image::make(public_path("storage/{$image3}"))->resize(1200,1200);
    $img1->save();
    $img2->save();
    $img3->save();


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
        'categorie' =>'immobilier',
        'npiece' =>0,
    ]);

    return redirect()->route('dashboard')->with('message', 'Annonce publiee avec success');
}

public function destroy (Immobiliers $maison)
{
    $maison->delete();

}


}
