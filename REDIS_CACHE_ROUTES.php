<?php

/**
 * Routes à ajouter à routes/api.php pour l'API de cache
 * 
 * COPIER/COLLER le contenu ci-dessous dans routes/api.php
 */

// Routes de cache (optionnel - pour l'API REST)
// Décommenter pour activer les endpoints

/*
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('cache')->controller(CacheController::class)->group(function () {
        // Dashboard
        Route::get('/dashboard', 'dashboard')
            ->name('cache.dashboard');

        // Test connexion
        Route::get('/test', 'testConnection')
            ->name('cache.test');

        // Récupérer une clé
        Route::get('/get', 'get')
            ->name('cache.get');

        // Ajouter une clé
        Route::post('/put', 'put')
            ->name('cache.put');

        // Supprimer une clé
        Route::delete('/forget', 'forget')
            ->name('cache.forget');

        // Vider complètement
        Route::post('/flush', 'flush')
            ->name('cache.flush');

        // Vider par pattern
        Route::post('/flush-pattern', 'flushPattern')
            ->name('cache.flush-pattern');
    });
});

// Routes publiques (optionnel - pour debugging en development)
if (app()->environment('local')) {
    Route::prefix('cache-public')->controller(CacheController::class)->group(function () {
        Route::get('/test', 'testConnection');
        Route::get('/dashboard', 'dashboard');
    });
}
*/

/**
 * UTILISATION DES ROUTES:
 * 
 * GET    /api/cache/test              → Tester la connexion
 * GET    /api/cache/dashboard         → Afficher le dashboard
 * GET    /api/cache/get?key=ma_cle   → Récupérer une clé
 * POST   /api/cache/put               → Ajouter une clé (avec body JSON)
 * DELETE /api/cache/forget            → Supprimer une clé (avec query param)
 * POST   /api/cache/flush             → Vider tout le cache
 * POST   /api/cache/flush-pattern     → Vider par pattern (avec body JSON)
 */

/**
 * EXEMPLES AVEC CURL:
 * 
 * # Tester la connexion
 * curl http://localhost:8000/api/cache/test
 * 
 * # Récupérer une clé
 * curl "http://localhost:8000/api/cache/get?key=mon_cle"
 * 
 * # Ajouter une clé
 * curl -X POST http://localhost:8000/api/cache/put \
 *   -H "Content-Type: application/json" \
 *   -d '{"key":"ma_cle","value":"ma_valeur","ttl":3600}'
 * 
 * # Supprimer une clé
 * curl -X DELETE "http://localhost:8000/api/cache/forget?key=ma_cle"
 * 
 * # Vider tout
 * curl -X POST http://localhost:8000/api/cache/flush
 * 
 * # Vider par pattern
 * curl -X POST http://localhost:8000/api/cache/flush-pattern \
 *   -H "Content-Type: application/json" \
 *   -d '{"pattern":"immobiliers:*"}'
 */

