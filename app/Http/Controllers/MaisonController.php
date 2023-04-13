<?php

namespace App\Http\Controllers;

use App\Models\Electromenagers;
use App\Models\Decorations;
use App\Models\OutilsPros;
use Request;

class MaisonController extends Controller
{

    public function storeElectromenager()
    {
    $image=Request::file('image')->store('topics','public');

    auth()->user()->Electromenagers()->create([
        'type' => Request::input('type'),
        'nom' => Request::input('nom'),
        'prix' => Request::input('prix'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'image' => $image,
        'categorie' =>'electromenager',
    ]);

    return redirect()->route('dashboard');
}

public function storeDecoration()
{
    $image=Request::file('image')->store('topics','public');

    auth()->user()->Decorations()->create([
        'nom' => Request::input('nom'),
        'type' => Request::input('type'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'prix' => Request::input('prix'),
        'image' => $image,
        'categorie' =>'decoration',
    ]);

    return redirect()->route('dashboard');
}

public function storeOutilsPro()
{
    $image=Request::file('image')->store('topics','public');

    auth()->user()->OutilsPros()->create([
        'nom' => Request::input('nom'),
        'type' => Request::input('type'),
        'description' => Request::input('description'),
        'region' => Request::input('region'),
        'prix' => Request::input('prix'),
        'image' => $image,
        'categorie' =>'decoration',
    ]);

    return redirect()->route('dashboard');
    }

}
