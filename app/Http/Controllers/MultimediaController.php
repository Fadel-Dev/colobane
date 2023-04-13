<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Lead;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Voitures;
use Intervention\Image\Facades\Image;
use App\Models\Ordinateurs;
use App\Models\Telephones;
use App\Models\ImageSons;
use GuzzleHttp\Psr7\Request as Psr7Request;

class MultimediaController extends Controller
{
  
        public function storeOrdinateur()
        {
            $image=Request::file('image')->store('topics','public');

            auth()->user()->Ordinateurs()->create([
                'marque' => Request::input('marque'),
                'nom' => Request::input('nom'),
                'prix' => Request::input('prix'),
                'stockage' => Request::input('stockage'),
                'description' => Request::input('description'),
                'region' => Request::input('region'),
                'image' => $image,
                'categorie' =>'ordinateur',
            ]);

            return redirect()->route('dashboard');
        }

        public function storeTelephone()
        {
            $image=Request::file('image')->store('topics','public');

            auth()->user()->Telephones()->create([
                'marque' => Request::input('marque'),
                'nom' => Request::input('nom'),
                'prix' => Request::input('prix'),
                'stockage' => Request::input('stockage'),
                'description' => Request::input('description'),
                'region' => Request::input('region'),
                'image' => $image,
                'categorie' =>'telephone',
            ]);

            return redirect()->route('dashboard');
        }

        public function storeImageSon()
        {
            $image=Request::file('image')->store('topics','public');

            auth()->user()->ImageSons()->create([
                'nom' => Request::input('nom'),
                'prix' => Request::input('prix'),
                'type' => Request::input('type'),
                'description' => Request::input('description'),
                'region' => Request::input('region'),
                'image' => $image,
                'categorie' =>'imageSons',
            ]);

            return redirect()->route('dashboard');
        }
}
