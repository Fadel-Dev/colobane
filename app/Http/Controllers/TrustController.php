<?php

namespace App\Http\Controllers;

use App\Models\Immobiliers;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TrustController extends Controller
{
    /**
     * Envoyer un signalement pour une annonce
     */
    public function storeReport(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Report::create([
            'user_id' => Auth::id(),
            'immobilier_id' => $id,
            'reason' => $request->reason,
            'description' => $request->description,
        ]);

        return back()->with('flash', [
            'banner' => 'Votre signalement a été envoyé et sera examiné par notre équipe.',
            'bannerStyle' => 'success',
        ]);
    }

    /**
     * Ajouter un avis sur un annonceur
     */
    public function storeReview(Request $request)
    {
        $request->validate([
            'target_user_id' => 'required|exists:users,id',
            'immobilier_id' => 'nullable|exists:immobiliers,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Vérifier si l'utilisateur n'a pas déjà noté ce propriétaire pour cette annonce
        $existingReview = Review::where('user_id', Auth::id())
            ->where('target_user_id', $request->target_user_id)
            ->where('immobilier_id', $request->immobilier_id)
            ->first();

        if ($existingReview) {
            $existingReview->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
        } else {
            Review::create([
                'user_id' => Auth::id(),
                'target_user_id' => $request->target_user_id,
                'immobilier_id' => $request->immobilier_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
        }

        return back()->with('flash', [
            'banner' => 'Votre avis a été enregistré. Merci !',
            'bannerStyle' => 'success',
        ]);
    }

    /**
     * Soumettre des documents pour vérification
     */
    public function submitVerification(Request $request)
    {
        $request->validate([
            'documents' => 'required|array',
            'documents.*' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $user = Auth::user();
        $paths = [];

        foreach ($request->file('documents') as $file) {
            $paths[] = $file->store('verification-documents', 'public');
        }

        $user->update([
            'verification_documents' => $paths,
            // 'is_verified' reste false jusqu'à validation manuelle par l'admin
        ]);

        return back()->with('flash', [
            'banner' => 'Vos documents ont été envoyés pour vérification.',
            'bannerStyle' => 'success',
        ]);
    }
}
