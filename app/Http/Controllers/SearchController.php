<?php

namespace App\Http\Controllers;

use App\Models\Immobiliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function suggestions(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([
                'suggestions' => []
            ]);
        }

        $suggestions = [];

        // Suggestions de régions/villes
        $regions = Immobiliers::select('region')
            ->where('region', 'like', '%' . $query . '%')
            ->whereNotNull('region')
            ->where('region', '!=', '')
            ->distinct()
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'region',
                    'label' => $item->region,
                    'value' => $item->region,
                    'icon' => 'map-marker-alt',
                    'url' => '/p/immobilier?region=' . urlencode($item->region)
                ];
            });

        $suggestions = array_merge($suggestions, $regions->toArray());

        // Suggestions de types de biens
        $typesMap = [
            'Villa' => ['villa', 'villas'],
            'appartement' => ['appartement', 'appartements', 'appart'],
            'Chambre' => ['chambre', 'chambres'],
            'studio' => ['studio', 'studios'],
            'Immeuble' => ['immeuble', 'immeubles'],
            'Terrain' => ['terrain', 'terrains']
        ];
        
        foreach ($typesMap as $type => $keywords) {
            foreach ($keywords as $keyword) {
                if (stripos($keyword, $query) !== false) {
                    $slug = strtolower($type === 'appartement' ? 'appartements' : $type);
                    $suggestions[] = [
                        'type' => 'type',
                        'label' => $type . ' à louer',
                        'value' => $type,
                        'icon' => 'home',
                        'url' => '/categorie/' . $slug
                    ];
                    break; // Éviter les doublons
                }
            }
        }

        // Suggestions basées sur les annonces (titre/nom)
        $annonces = Immobiliers::select('nom', 'type', 'region', 'id')
            ->where(function($q) use ($query) {
                $q->where('nom', 'like', '%' . $query . '%')
                  ->orWhere('region', 'like', '%' . $query . '%')
                  ->orWhere('type', 'like', '%' . $query . '%');
            })
            ->where('status', 'accepter')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'annonce',
                    'label' => $item->nom . ' - ' . $item->type . ' à ' . $item->region,
                    'value' => $item->nom,
                    'icon' => 'building',
                    'url' => '/detail/' . $item->id
                ];
            });

        $suggestions = array_merge($suggestions, $annonces->toArray());

        // Limiter à 8 suggestions au total
        $suggestions = array_slice($suggestions, 0, 8);

        return response()->json([
            'suggestions' => $suggestions,
            'query' => $query
        ]);
    }
}
