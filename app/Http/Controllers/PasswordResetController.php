<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PasswordResetController extends Controller
{
    /**
     * Afficher le formulaire de demande de réinitialisation de mot de passe
     */
    public function showForgotForm()
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Envoyer le lien de réinitialisation par email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Vérifier si l'utilisateur existe
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Ne pas révéler si l'email existe pour des raisons de sécurité
            return back()->with('status', 'Si ce compte existe, vous recevrez un email avec les instructions.');
        }

        // Générer le token de réinitialisation
        $token = Password::createToken($user);

        // Envoyer la notification personnalisée
        $user->notify(new ResetPasswordNotification($token));

        return back()->with('status', 'Vérifiez votre email pour le lien de réinitialisation !');
    }

    /**
     * Afficher le formulaire de réinitialisation
     * 
     * Les paramètres token et email sont passés en query string
     * Format: /reset-password?token=XXX&email=user@example.com
     */
    public function showResetForm(Request $request)
    {
        // Récupérer token et email depuis la query string
        $token = $request->query('token');
        $email = $request->query('email');
        
        // Vérifier que les paramètres existent
        if (!$token || !$email) {
            return redirect('/forgot-password')->with('error', 'Lien de réinitialisation invalide ou expiré.');
        }
        
        return Inertia::render('Auth/ResetPassword', [
            'email' => $email,
            'token' => $token,
        ]);
    }

    /**
     * Traiter la réinitialisation du mot de passe
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', // Au moins une minuscule, une majuscule, un chiffre
            ],
        ], [
            'password.regex' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        // Réinitialiser le mot de passe
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Rediriger en fonction du résultat
        if ($status == Password::PASSWORD_RESET) {
            return redirect('/login')->with('status', trans($status));
        }

        return back()->withInput($request->only('email'))->with('status', trans($status));
    }

    /**
     * Envoyer un lien de réinitialisation à un utilisateur spécifique (pour l'admin)
     */
    public function sendResetLinkToUser(User $user)
    {
        $token = Password::createToken($user);
        $user->notify(new ResetPasswordNotification($token));

        return response()->json([
            'message' => 'Lien de réinitialisation envoyé avec succès à ' . $user->email,
        ]);
    }

    /**
     * Réinitialiser directement le mot de passe (admin)
     */
    public function directReset(Request $request, User $user)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
        ]);

        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));

        return response()->json([
            'message' => 'Le mot de passe a été réinitialisé avec succès.',
        ]);
    }
}

