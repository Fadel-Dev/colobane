<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Request;

use App\Models\Habillements;
use App\Models\Enfants;
use App\Models\Accessoires;

class ModeController extends Controller
{
    public function storeHabillement () 
    {
        $image=Request::file('image')->store('topics','public');
        auth()->user()->Habillements()->create([
            'nom' => Request::input('nom'),
            'prix' => Request::input('prix'),
            'description' => Request::input('description'),
            'region' => Request::input('region'),
            'image' => $image,
            'type' =>Request::input('type'),
            'sexe' =>Request::input('type'),
            'categorie' =>'mode',
            'livraison' =>'N/A',

    
            ])
            ;
            return redirect()->route('publier');
        }

        public function storeEnfant () 
    {
        $image=Request::file('image')->store('topics','public');
        auth()->user()->Enfants()->create([
            'nom' => Request::input('nom'),
            'prix' => Request::input('prix'),
            'description' => Request::input('description'),
            'region' => Request::input('region'),
            'image' => $image,
            'type' =>Request::input('type'),
            'categorie' =>'enfant',

    
            ])
            ;
            return redirect()->route('publier');
        }

        public function storeAccessoire () 
        {
            $image=Request::file('image')->store('topics','public');
            auth()->user()->Accessoires()->create([
                'nom' => Request::input('nom'),
                'prix' => Request::input('prix'),
                'description' => Request::input('description'),
                'region' => Request::input('region'),
                'image' => $image,
                'type' =>Request::input('type'),
                'categorie' =>'accessoireMode',
    
        
                ])
                ;
                return redirect()->route('publier');
            }
}
