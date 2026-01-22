<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Notifications\EmailVerificationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    /**
     * Envoi du code de vérification par email
     */
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Générer un code à 6 chiffres
        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(30);

        // Sauvegarder le code dans la base de données
        $user->update([
            'verification_code' => Hash::make($verificationCode),
            'verification_code_expires_at' => $expiresAt
        ]);

        // Envoyer l'email de vérification
        $user->notify(new EmailVerificationNotification($verificationCode));

        return response()->json([
            'message' => 'Code de vérification envoyé avec succès',
            'expires_in' => 30 * 60 // 30 minutes en secondes
        ]);
    }

    /**
     * Vérification du code
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string|size:6',
        ]);

        $user = User::where('email', $request->email)->first();

        // Vérifier si le code correspond et n'est pas expiré
        if (!$user->verification_code || 
            !Hash::check($request->code, $user->verification_code) ||
            $user->verification_code_expires_at < now()) {
            return response()->json([
                'message' => 'Code de vérification invalide ou expiré',
                'success' => false
            ], 422);
        }

        // Marquer l'email comme vérifié
        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null,
            'verification_code_expires_at' => null
        ]);

        return response()->json([
            'message' => 'Email vérifié avec succès',
            'success' => true
        ]);
    }
}
