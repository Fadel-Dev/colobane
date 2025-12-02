<?php

/**
 * Configuration Redis Cache pour NoflayHub
 * 
 * Ce fichier contient la configuration complète pour le système de cache Redis
 */

return [
    /**
     * Driver de cache par défaut
     * Options: 'redis', 'file', 'array', 'database', 'memcached'
     */
    'driver' => env('CACHE_DRIVER', 'redis'),

    /**
     * TTLs (Time To Live) en secondes
     */
    'ttl' => [
        'default' => 3600,              // 1 heure
        'long' => 86400,                // 24 heures
        'short' => 300,                 // 5 minutes
        'immobiliers' => 86400,         // 24 heures
        'categories' => 604800,         // 7 jours
        'listings' => 3600,             // 1 heure
        'stats' => 300,                 // 5 minutes
        'searches' => 600,              // 10 minutes
        'user_data' => 86400,           // 24 heures
    ],

    /**
     * Préfixes de cache pour éviter les collisions
     */
    'prefixes' => [
        'immobiliers' => 'immobiliers:',
        'vehicules' => 'vehicules:',
        'services' => 'services:',
        'users' => 'users:',
        'categories' => 'categories:',
        'listings' => 'listings:',
        'stats' => 'stats:',
        'searches' => 'searches:',
        'api' => 'api:',
        'temp' => 'temp:',
    ],

    /**
     * Routes à mettre en cache automatiquement
     */
    'cacheable_routes' => [
        'GET /api/immobiliers' => 3600,
        'GET /api/categories' => 86400,
        'GET /api/services' => 86400,
        'GET /api/stats' => 300,
        'GET /categorie/*' => 3600,
    ],

    /**
     * Routes à exclure du cache
     */
    'excluded_routes' => [
        'api/auth*',
        'api/admin*',
        'api/user/profile',
        'api/user/favorites',
    ],

    /**
     * Options de performance
     */
    'performance' => [
        /**
         * Activer le cache de requêtes
         */
        'enable_query_cache' => true,

        /**
         * Activer le cache de réponses HTTP
         */
        'enable_response_cache' => true,

        /**
         * Activer le cache d'objets
         */
        'enable_object_cache' => true,

        /**
         * Compresser les données mises en cache (pour les gros objets)
         */
        'compress_cache' => false,

        /**
         * Seuil de compression en bytes (seulement si compress_cache = true)
         */
        'compression_threshold' => 1024 * 100, // 100 KB
    ],

    /**
     * Monitoring et logging
     */
    'monitoring' => [
        /**
         * Enregistrer les hits/misses de cache
         */
        'log_hits' => env('CACHE_LOG_HITS', false),

        /**
         * Enregistrer les erreurs de cache
         */
        'log_errors' => true,

        /**
         * Activer les statistiques en temps réel
         */
        'enable_stats' => true,

        /**
         * Intervalle de mise à jour des stats en secondes
         */
        'stats_interval' => 300,
    ],

    /**
     * Configuration de sécurité
     */
    'security' => [
        /**
         * Nécessite l'authentification pour les endpoints admin
         */
        'require_auth' => true,

        /**
         * Rôles autorisés à gérer le cache
         */
        'admin_roles' => ['admin', 'superadmin'],

        /**
         * Permettre le flush complet
         */
        'allow_flush' => true,

        /**
         * Permettre la lecture des clés sensibles
         */
        'allow_sensitive_keys' => false,
    ],

    /**
     * Éviction de cache automatique
     */
    'eviction' => [
        /**
         * Stratégie d'éviction: 'lru', 'lfu', 'ttl', 'random'
         */
        'policy' => 'allkeys-lru',

        /**
         * Pourcentage de mémoire à utiliser avant éviction
         */
        'memory_threshold' => 80, // %

        /**
         * Nombre maximum de samples pour l'éviction LRU
         */
        'samples' => 5,
    ],

    /**
     * Invalidation de cache intelligente
     */
    'invalidation' => [
        /**
         * Invalider automatiquement les listings après création/modification d'immobilier
         */
        'auto_invalidate_listings' => true,

        /**
         * Invalider automatiquement les stats après changement de données
         */
        'auto_invalidate_stats' => true,

        /**
         * Délai d'attente avant invalidation en secondes (pour grouper les invalidations)
         */
        'debounce_delay' => 5,
    ],

    /**
     * Warm-up de cache au démarrage
     */
    'warmup' => [
        /**
         * Activer le warm-up au démarrage
         */
        'enabled' => env('CACHE_WARMUP', true),

        /**
         * Réchauffer les catégories
         */
        'warm_categories' => true,

        /**
         * Réchauffer les listings populaires
         */
        'warm_listings' => true,

        /**
         * Réchauffer les statistiques
         */
        'warm_stats' => true,
    ],
];

