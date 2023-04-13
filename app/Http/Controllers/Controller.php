<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Immobiliers;
use App\Models\Services;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;



    // HOME

    public function Dash()
    {

      return Inertia::render('Dashboard', [
        'topics' =>Immobiliers::all()->map(function($topic){
            return [
                'id'=> $topic->id,
                'name'=> $topic->name,
                'image'=> asset('storage/'.$topic->image),
                'userid'=> $topic->user_id,
              
            ];

        })
      ]);

    }

    public function publier()
{
    return Inertia::render('Publier');
}


}
