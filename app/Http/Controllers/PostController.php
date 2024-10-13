<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Request;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Voitures;


class PostController extends Controller
{

    public function Section($section)
    {
        return Inertia::render('Section/'.$section);
    }

    public function Article($article)
    {
        return Inertia::render('Categories/'.$article);
    }

    public function store()
    {
        $image=Request::file('image')->store('topics','public');

   auth()->user()->Lead()->create([
    'name' => Request::input('name'),
    'image' => $image,
   ]);



         return redirect()->route('publier');
    }
}
