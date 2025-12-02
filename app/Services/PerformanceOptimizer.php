<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Service d'optimisation des performances
 * Gère le caching, la pagination et l'optimisation des requêtes
 */
class PerformanceOptimizer
{
    /**
     * Cache une réponse API
     * 
     * @param string $key
     * @param callable $callback
     * @param int $ttl (en secondes)
     * @return mixed
     */
    public static function cache(string $key, callable $callback, int $ttl = 3600)
    {
        return Cache::remember($key, $ttl, $callback);
    }

    /**
     * Invalide le cache
     * 
     * @param array $keys
     */
    public static function invalidateCache(array $keys)
    {
        Cache::forget($keys);
    }

    /**
     * Optimise une requête de listing avec pagination
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @param int $perPage
     * @param array $with (relations à eager load)
     * @return \Illuminate\Pagination\Paginator
     */
    public static function optimizedPaginate($query, int $perPage = 20, array $with = [])
    {
        // Eager load relationships
        if (!empty($with)) {
            $query = $query->with($with);
        }

        // Paginate
        return $query->paginate($perPage);
    }

    /**
     * Optimise les relations eager loading
     * 
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function withOptimizedRelations($model, array $relations = [])
    {
        $query = $model::query();

        // Ajouter les relations communes
        $commonRelations = [
            'category',
            'user',
            'images',
        ];

        // Merger avec les relations spécifiques
        $allRelations = array_merge($commonRelations, $relations);
        $allRelations = array_unique($allRelations);

        return $query->with($allRelations);
    }

    /**
     * Sélectionne uniquement les colonnes nécessaires
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $columns
     * @return \Illuminate\Database\Query\Builder
     */
    public static function selectOnlyNeeded($query, array $columns)
    {
        return $query->select($columns);
    }

    /**
     * Ajoute la pagination et le caching
     * 
     * @param string $cacheKey
     * @param callable $query
     * @param int $perPage
     * @param int $ttl
     * @return mixed
     */
    public static function cachedPaginate(
        string $cacheKey,
        callable $query,
        int $perPage = 20,
        int $ttl = 3600
    ) {
        return Cache::remember(
            $cacheKey,
            $ttl,
            function () use ($query, $perPage) {
                return $query()->paginate($perPage);
            }
        );
    }

    /**
     * Optimise une requête complète avec tous les paramètres
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $config
     * @return mixed
     */
    public static function optimizeQuery($query, array $config = [])
    {
        $defaults = [
            'with' => [],
            'select' => ['*'],
            'perPage' => 20,
            'cache' => true,
            'cacheTtl' => 3600,
            'cacheKey' => null,
        ];

        $config = array_merge($defaults, $config);

        // Sélectionner colonnes
        if ($config['select'] !== ['*']) {
            $query = $query->select($config['select']);
        }

        // Eager load relations
        if (!empty($config['with'])) {
            $query = $query->with($config['with']);
        }

        // Appliquer caching si activé
        if ($config['cache'] && $config['cacheKey']) {
            return Cache::remember(
                $config['cacheKey'],
                $config['cacheTtl'],
                function () use ($query, $config) {
                    return $query->paginate($config['perPage']);
                }
            );
        }

        return $query->paginate($config['perPage']);
    }

    /**
     * Cache une collection en JSON
     * 
     * @param string $key
     * @param Collection $collection
     * @param int $ttl
     */
    public static function cacheCollection(string $key, Collection $collection, int $ttl = 3600)
    {
        Cache::put($key, $collection->toJson(), $ttl);
    }

    /**
     * Récupère une collection du cache
     * 
     * @param string $key
     * @return Collection|null
     */
    public static function getCachedCollection(string $key): ?Collection
    {
        $cached = Cache::get($key);
        
        if ($cached) {
            return collect(json_decode($cached, true));
        }

        return null;
    }
}

