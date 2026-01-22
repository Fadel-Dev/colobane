<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisterController extends Controller
{
    /**
     * Afficher le formulaire d'inscription
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Traiter l'inscription d'un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required|string|max:20',
        ]);

        // Créer l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        // Générer un code de vérification
        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(30);

        // Sauvegarder le code de vérification
        $user->update([
            'verification_code' => Hash::make($verificationCode),
            'verification_code_expires_at' => $expiresAt
        ]);

        // Envoyer l'email de vérification
        $user->notify(new EmailVerificationNotification($verificationCode));

        // Connecter automatiquement l'utilisateur
        auth()->login($user);

        // Rediriger vers la page de vérification d'email
        return redirect()->route('verification.notice');
    }
}
