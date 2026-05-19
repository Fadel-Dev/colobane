<?php

namespace App\Services;

use App\Models\Immobiliers;
use App\Models\PropertyAlert;
use App\Models\Notification;

class PropertyAlertService
{
    /**
     * Vérifier les alertes pour un nouvel immobilier validé
     */
    public static function checkAlerts(Immobiliers $immobilier)
    {
        if ($immobilier->status !== 'accepter') {
            return;
        }

        // Récupérer les alertes actives qui correspondent aux critères
        $alerts = PropertyAlert::where('is_active', true)
            ->where(function ($query) use ($immobilier) {
                $query->where('type', $immobilier->type)
                    ->orWhereNull('type');
            })
            ->where(function ($query) use ($immobilier) {
                $query->where('region', $immobilier->region)
                    ->orWhereNull('region');
            })
            ->where(function ($query) use ($immobilier) {
                $query->where('min_price', '<=', $immobilier->prix)
                    ->orWhereNull('min_price');
            })
            ->where(function ($query) use ($immobilier) {
                $query->where('max_price', '>=', $immobilier->prix)
                    ->orWhereNull('max_price');
            })
            ->get();

        foreach ($alerts as $alert) {
            // Éviter de notifier le propriétaire
            if ($alert->user_id === $immobilier->user_id) {
                continue;
            }

            Notification::create([
                'user_id' => $alert->user_id,
                'type' => 'alerte',
                'title' => 'Nouvelle annonce correspondante !',
                'message' => "Un(e) {$immobilier->type} à {$immobilier->region} vient d'être publié(e) au prix de " . number_format($immobilier->prix, 0, ',', ' ') . " FCFA.",
                'immobilier_id' => $immobilier->id,
            ]);
        }
    }
}
