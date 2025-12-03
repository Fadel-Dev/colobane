<?php

return [
    'currency' => 'FCFA',
    'currency_symbol' => 'F',
    
    'plans' => [
        // 2 heures = 120 minutes = 0.083 jours (HEURES pour la base de données!)
        'mini' => [
            'duration_hours' => 2,
            'duration_minutes' => 120,
            'duration_days' => 2 / 24, // 0.0833... jours (stocké comme ça en DB)
            'price' => 500,
            'label' => '2 Heures',
            'icon' => '⚡',
            'description' => 'Parfait pour tester',
        ],
        
        // 48 heures = 2 jours (HEURES pour la base de données!)
        'standard' => [
            'duration_hours' => 48,
            'duration_minutes' => 2880,
            'duration_days' => 48 / 24, // 2 jours (stocké comme ça en DB)
            'price' => 2000,
            'label' => '48 Heures',
            'icon' => '🔥',
            'description' => 'Le plus populaire',
        ],
        
        // 72 heures = 3 jours (HEURES pour la base de données!)
        'premium' => [
            'duration_hours' => 72,
            'duration_minutes' => 4320,
            'duration_days' => 72 / 24, // 3 jours (stocké comme ça en DB)
            'price' => 2500,
            'label' => '72 Heures',
            'icon' => '💎',
            'description' => 'Très populaire',
        ],
        
        // 1 semaine = 7 jours = 168 heures (HEURES pour la base de données!)
        'platinum' => [
            'duration_hours' => 168,
            'duration_minutes' => 10080,
            'duration_days' => 168 / 24, // 7 jours (stocké comme ça en DB)
            'price' => 4000,
            'label' => '1 Semaine',
            'icon' => '👑',
            'description' => 'Meilleure visibilité',
        ],
    ],

    // Prix spéciaux (réductions)
    'discounts' => [
        'multiple_boosts' => 0.10, // 10% de réduction si 2+ boosts actifs
        'weekly_subscriber' => 0.15, // 15% de réduction pour les abonnés
    ],

    // Configuration d'affichage
    'display' => [
        'show_savings' => true,
        'best_value_indicator' => 'platinum', // Quel plan afficher comme "meilleure offre"
    ],
];

