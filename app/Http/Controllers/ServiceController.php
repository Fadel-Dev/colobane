<?php

namespace App\Http\Controllers;

use App\Models\Batiments;
use App\Models\Domestiques;
use App\Models\Covoiturages;
use Request;

class ServiceController extends Controller
{
   
    public function storeBatiment()
    {
        $image=Request::file('image')->store('topics','public');

        auth()->user()->Batiments()->create([
            'type' => Request::input('type'),
            'nom' => Request::input('nom'),
            'prix' => Request::input('prix'),
            'description' => Request::input('description'),
            'region' => Request::input('region'),
            'image' => $image,
            'categorie' =>'batiment',
        ]);

        return redirect()->route('dashboard');
    }

    public function storeDomestique()
    {
        $image=Request::file('image')->store('topics','public');

        auth()->user()->Domestiques()->create([
            'nom' => Request::input('nom'),
            'type' => Request::input('type'),
            'description' => Request::input('description'),
            'region' => Request::input('region'),
            'prix' => Request::input('prix'),
            'image' => $image,
            'categorie' =>'domestique',
        ]);

        return redirect()->route('dashboard');
    }

    public function storeCovoiturage()
    {
        $image=Request::file('image')->store('topics','public');

        auth()->user()->Covoiturages()->create([
            'nom' => Request::input('nom'),
            'prix' => Request::input('prix'),
            'depart' => Request::input('depart'),
            'description' => Request::input('description'),
            'destination' => Request::input('destination'),
            'image' => $image,
            'categorie' =>'covoiturage',
        ]);

        return redirect()->route('dashboard');
    }
}
