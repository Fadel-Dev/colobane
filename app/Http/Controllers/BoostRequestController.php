<?php

namespace App\Http\Controllers;

use App\Models\Immobiliers;
use App\Services\PropertyAlertService;
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

        $type = $request->input('type', 'immobilier');
        $modelClass = $type === 'voiture' ? \App\Models\Voitures::class : \App\Models\Immobiliers::class;

        try {
            $property = $modelClass::findOrFail($id);

            // Récupérer la durée demandée par le client en heures (décimal)
            $durationHours = $property->boost_duration ?? 24; 

            $property->update([
                'booster' => true,
                'status' => 'accepter',
                'date_fin_booster' => now()->addHours($durationHours),
            ]);

            // Déclencher les alertes (seulement pour immo pour l'instant)
            if ($type === 'immobilier') {
                PropertyAlertService::checkAlerts($property);
            }

            return response()->json([
                'success' => true,
                'message' => "Boost approuvé pour {$durationHours}h",
                'id' => $property->id,
                'type' => $type
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Refuser une demande de boost
     */
    public function reject(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $type = $request->input('type', 'immobilier');
        $modelClass = $type === 'voiture' ? \App\Models\Voitures::class : \App\Models\Immobiliers::class;

        try {
            $property = $modelClass::findOrFail($id);
            $property->update([
                'booster' => false,
                'status' => 'null',
                'date_fin_booster' => null,
            ]);

            return response()->json(['success' => true, 'message' => 'Demande refusée']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Relancer un boost
     */
    public function restart(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $type = $request->input('type', 'immobilier');
        $modelClass = $type === 'voiture' ? \App\Models\Voitures::class : \App\Models\Immobiliers::class;

        try {
            $property = $modelClass::findOrFail($id);
            $durationHours = $property->boost_duration ?? 24;

            $property->update([
                'booster' => true,
                'status' => 'accepter',
                'onceBooster' => true,
                'date_fin_booster' => now()->addHours($durationHours),
            ]);

            if ($type === 'immobilier') {
                PropertyAlertService::checkAlerts($property);
            }

            return response()->json(['success' => true, 'message' => "Relancé pour {$durationHours}h"]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Arrêter un boost actif
     */
    public function stop(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $type = $request->input('type', 'immobilier');
        $modelClass = $type === 'voiture' ? \App\Models\Voitures::class : \App\Models\Immobiliers::class;

        try {
            $property = $modelClass::findOrFail($id);
            $property->update([
                'booster' => false,
                'status' => 'null',
                'onceBooster' => true,
                'date_fin_booster' => now(),
            ]);

            return response()->json(['success' => true, 'message' => 'Boost arrêté']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur: ' . $e->getMessage()], 500);
        }
    }
}

