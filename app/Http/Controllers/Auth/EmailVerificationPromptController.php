<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmailVerificationPromptController extends Controller
{
    /**
     * Afficher la page de notification de vérification d'email.
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard'))
                    : Inertia::render('Auth/VerifyEmail', [
                        'status' => session('status'),
                        'email' => $request->user()->email
                    ]);
    }
}
