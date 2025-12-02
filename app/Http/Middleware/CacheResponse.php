<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\CacheService;

/**
 * Middleware pour mettre en cache les réponses HTTP
 */
class CacheResponse
{
    /**
     * Routes à mettre en cache
     */
    protected $cacheable = [
        'GET /api/immobiliers' => 3600,      // 1 heure
        'GET /api/categories' => 86400,      // 24 heures
        'GET /api/services' => 86400,        // 24 heures
        'GET /api/stats' => 300,             // 5 minutes
    ];

    /**
     * Routes à ne pas mettre en cache
     */
    protected $excludedRoutes = [
        'api/auth',
        'api/admin',
        'api/user/profile',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Ignorer les requêtes non-GET
        if ($request->method() !== 'GET') {
            return $next($request);
        }

        // Ignorer les routes exclues
        foreach ($this->excludedRoutes as $exclude) {
            if ($request->path() === $exclude || str_contains($request->path(), $exclude)) {
                return $next($request);
            }
        }

        // Vérifier si la route peut être mise en cache
        $cacheKey = $this->getCacheKey($request);
        $ttl = $this->getCacheTTL($request);

        if ($cacheKey && $ttl) {
            // Essayer de récupérer du cache
            $cached = CacheService::get($cacheKey);
            if ($cached) {
                return response()->json($cached)->header('X-Cache', 'HIT');
            }
        }

        $response = $next($request);

        // Mettre en cache la réponse
        if ($cacheKey && $ttl && $response->isSuccessful() && $this->isJson($response)) {
            try {
                $data = json_decode($response->getContent(), true);
                CacheService::put($cacheKey, $data, $ttl);
                return $response->header('X-Cache', 'MISS');
            } catch (\Exception $e) {
                // Ignorer les erreurs de cache
            }
        }

        return $response;
    }

    /**
     * Génère la clé de cache pour la requête
     */
    protected function getCacheKey(Request $request): ?string
    {
        $path = $request->path();
        $query = $request->query();

        // Exclure les paramètres sensibles
        $excludeParams = ['token', 'password', 'api_key', 'secret'];
        foreach ($excludeParams as $param) {
            unset($query[$param]);
        }

        if (empty($query)) {
            return 'api:' . $path;
        }

        ksort($query);
        return 'api:' . $path . ':' . md5(json_encode($query));
    }

    /**
     * Obtient le TTL pour la requête
     */
    protected function getCacheTTL(Request $request): ?int
    {
        $method = $request->method();
        $path = $request->path();

        foreach ($this->cacheable as $route => $ttl) {
            $routeParts = explode(' ', $route);
            if (count($routeParts) === 2) {
                [$routeMethod, $routePath] = $routeParts;
                if ($routeMethod === $method && str_contains($path, trim($routePath, '/'))) {
                    return $ttl;
                }
            }
        }

        return null;
    }

    /**
     * Vérifie si la réponse est du JSON
     */
    protected function isJson($response): bool
    {
        return str_contains($response->headers->get('Content-Type') ?? '', 'application/json');
    }
}

