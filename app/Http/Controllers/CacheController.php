<?php

namespace App\Http\Controllers;

use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * Contrôleur pour gérer les opérations de cache
 */
class CacheController extends Controller
{
    /**
     * Affiche le tableau de bord du cache
     */
    public function dashboard()
    {
        $redisInfo = CacheService::getRedisInfo();
        $cacheStats = CacheService::getStats();
        $isConnected = CacheService::testConnection();

        return response()->json([
            'redis_info' => $redisInfo,
            'cache_stats' => $cacheStats,
            'is_connected' => $isConnected,
            'cache_driver' => config('cache.default'),
        ]);
    }

    /**
     * Nettoie le cache complet
     */
    public function flush(Request $request)
    {
        try {
            CacheService::flushAll();
            return response()->json([
                'status' => 'success',
                'message' => 'Cache flushed successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Nettoie le cache d'un pattern spécifique
     */
    public function flushPattern(Request $request)
    {
        $validated = $request->validate([
            'pattern' => 'required|string',
        ]);

        try {
            $deleted = CacheService::flushByPattern($validated['pattern']);
            return response()->json([
                'status' => 'success',
                'message' => "Flushed $deleted keys matching pattern",
                'deleted_count' => $deleted,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Récupère la valeur d'une clé de cache
     */
    public function get(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string',
        ]);

        try {
            $value = CacheService::get($validated['key']);
            return response()->json([
                'status' => 'success',
                'key' => $validated['key'],
                'value' => $value,
                'exists' => $value !== null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Ajoute une valeur au cache
     */
    public function put(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string',
            'value' => 'required',
            'ttl' => 'nullable|integer|min:1',
        ]);

        try {
            $ttl = $validated['ttl'] ?? CacheService::DEFAULT_TTL;
            CacheService::put($validated['key'], $validated['value'], $ttl);

            return response()->json([
                'status' => 'success',
                'message' => 'Value cached successfully',
                'key' => $validated['key'],
                'ttl' => $ttl,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Supprime une clé de cache
     */
    public function forget(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string',
        ]);

        try {
            CacheService::forget($validated['key']);
            return response()->json([
                'status' => 'success',
                'message' => 'Cache key removed successfully',
                'key' => $validated['key'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Test de connexion à Redis
     */
    public function testConnection()
    {
        $isConnected = CacheService::testConnection();

        return response()->json([
            'status' => $isConnected ? 'success' : 'error',
            'message' => $isConnected ? 'Connected to Redis' : 'Redis connection failed',
            'is_connected' => $isConnected,
        ], $isConnected ? 200 : 500);
    }
}

