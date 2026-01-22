<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Envoyer un nouveau code de vérification par email.
     */
   public function __invoke(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $user = User::where('email', $request->email)->first();
    
    // Générer un nouveau code à 6 chiffres
    $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $expiresAt = now()->addMinutes(30);

    \Log::info('Mise à jour du code de vérification', [
        'user_id' => $user->id,
        'code' => $verificationCode,
        'expires_at' => $expiresAt,
        'now' => now()
    ]);

    // Mettre à jour le code de vérification
    $updated = $user->update([
        'verification_code' => Hash::make($verificationCode),
        'verification_code_expires_at' => $expiresAt
    ]);

    \Log::info('Résultat de la mise à jour', [
        'success' => $updated,
        'updated_user' => $user->fresh() // Recharger l'utilisateur depuis la base de données
    ]);

    // Envoyer l'email de vérification
    $user->notify(new EmailVerificationNotification($verificationCode));

    // Si la requête est une requête AJAX, renvoyer une réponse JSON
    if ($request->wantsJson()) {
        return response()->json([
            'message' => 'Un nouveau code de vérification a été envoyé à votre adresse email.',
            'expires_in' => 30 * 60 // 30 minutes en secondes
        ]);
    }

    // Sinon, rediriger avec un message de statut
    return back()->with('status', 'verification-code-sent');
}
}
