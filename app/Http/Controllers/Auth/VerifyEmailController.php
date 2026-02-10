<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified via URL.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard').'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard').'?verified=1');
    }

    /**
     * Vérifier le code de vérification de l'email
     */
   public function __invoke(Request $request)
{
    $request->validate([
        'code' => 'required|string|size:6',
    ]);

    $user = $request->user();

    \Log::info('Tentative de vérification', [
        'user_id' => $user->id,
        'code_soumis' => $request->code,
        'code_stocke' => $user->verification_code,
        'expiration' => $user->verification_code_expires_at,
        'maintenant' => now(),
        'code_valide' => $user->verification_code && Hash::check($request->code, $user->verification_code),
        'non_expire' => $user->verification_code_expires_at && $user->verification_code_expires_at > now()
    ]);

    // Vérifier si le code correspond et n'est pas expiré
    if (!$user->verification_code || 
        !Hash::check($request->code, $user->verification_code) ||
        !$user->verification_code_expires_at ||
        $user->verification_code_expires_at < now()) {
        
        \Log::error('Échec de la vérification', [
            'raison' => !$user->verification_code ? 'Aucun code stocké' : 
                       (!Hash::check($request->code, $user->verification_code) ? 'Code incorrect' : 'Code expiré')
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Le code de vérification est invalide ou a expiré. Code: ' . $request->code,
                'success' => false
            ], 422);
        }
        
        return back()->withErrors(['code' => 'Le code de vérification est invalide ou a expiré. Code: ' . $request->code]);
    }

    // Marquer l'email comme vérifié
    $user->update([
        'email_verified_at' => now(),
        'verification_code' => null,
        'verification_code_expires_at' => null
    ]);

    \Log::info('Email vérifié avec succès', ['user_id' => $user->id]);

    if ($request->wantsJson()) {
        return response()->json([
            'message' => 'Votre adresse email a été vérifiée avec succès !',
            'redirect' => route('dashboard'),
            'success' => true
        ]);
    }

    return redirect()->route('dashboard')->with('status', 'email-verified');
}
}
