<?php

namespace App\Http\Controllers;

use App\Models\Immobiliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoostRequestController extends Controller
{
    public function __construct()
    {
        // Appliquer CSRF middleware à ces routes
        $this->middleware('auth:sanctum');
    }

    /**
     * Approuver une demande de boost
     */
    public function approve(Request $request, $id)
    {
        // Vérifier que l'utilisateur est admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Non autorisé - Admin requis'], 403);
        }

        try {
            $property = Immobiliers::findOrFail($id);

            // Récupérer la durée demandée par le client (par défaut 30 jours)
            $duration = $property->boost_duration ?? 30;

            $property->update([
                'booster' => true,
                'status' => 'accepter',
                'date_fin_booster' => now()->addDays($duration),
            ]);

            return response()->json([
                'success' => true,
                'message' => "Boost approuvé pour {$duration} jours",
                'property_id' => $property->id,
                'duration' => $duration,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de l\'approbation: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Refuser une demande de boost
     */
    public function reject(Request $request, $id)
    {
        // Vérifier que l'utilisateur est admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Non autorisé - Admin requis'], 403);
        }

        try {
            $property = Immobiliers::findOrFail($id);

            $property->update([
                'booster' => false,
                'status' => 'null',
                'date_fin_booster' => null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Demande refusée',
                'property_id' => $property->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du refus: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Relancer un boost sur une propriété précédente
     */
    public function restart(Request $request, $id)
    {
        // Vérifier que l'utilisateur est admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Non autorisé - Admin requis'], 403);
        }

        try {
            $property = Immobiliers::findOrFail($id);

            // Récupérer la durée demandée par le client (par défaut 30 jours)
            $duration = $property->boost_duration ?? 30;

            $property->update([
                'booster' => true,
                'status' => 'accepter',
                'onceBooster' => true,
                'date_fin_booster' => now()->addDays($duration),
            ]);

            return response()->json([
                'success' => true,
                'message' => "Boost relancé pour {$duration} jours",
                'property_id' => $property->id,
                'duration' => $duration,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du relance: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Arrêter un boost actif
     */
    public function stop(Request $request, $id)
    {
        // Vérifier que l'utilisateur est admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Non autorisé - Admin requis'], 403);
        }

        try {
            $property = Immobiliers::findOrFail($id);

            $property->update([
                'booster' => false,
                'status' => 'null',
                'onceBooster' => true,  // Marquer qu'il avait un boost avant
                'date_fin_booster' => now(),  // Date d'arrêt = maintenant
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Boost arrêté',
                'property_id' => $property->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de l\'arrêt: ' . $e->getMessage()
            ], 500);
        }
    }
}

