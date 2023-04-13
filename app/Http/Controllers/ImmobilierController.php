<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Immobiliers;

class ImmobilierController extends Controller
{
    public function storeVente()
    {
        $image=Request::file('image')->store('topics','public');

        auth()->user()->Immobiliers()->create([
            'type' => Request::input('type'),
            'nom' => Request::input('nom'),
            'prix' => Request::input('prix'),
            'description' => Request::input('description'),
            'region' => Request::input('region'),
            'image' => $image,
            'categorie' =>'immobilier',
            'affaire' =>'vente',
        ]);

        return redirect()->route('dashboard');
    }

    public function storeLocation()
    {
        $image=Request::file('image')->store('topics','public');

        auth()->user()->Immobiliers()->create([
            'type' => Request::input('type'),
            'nom' => Request::input('nom'),
            'prix' => Request::input('prix'),
            'description' => Request::input('description'),
            'region' => Request::input('region'),
            'image' => $image,
            'categorie' =>'immobilier',
            'affaire' =>'location',
        ]);

        return redirect()->route('dashboard');
    }
}
