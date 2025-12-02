<?php

namespace App\Traits;

use App\Services\CacheService;

/**
 * Trait pour rendre les modèles Eloquent cachéables
 * Utilisation: use Cacheable; dans le modèle
 */
trait Cacheable
{
    /**
     * Récupère un modèle par ID avec caching
     */
    public static function findCached($id, $ttl = CacheService::LONG_TTL)
    {
        $cacheKey = static::class . ':' . $id;
        return CacheService::remember($cacheKey, function () use ($id) {
            return static::find($id);
        }, $ttl);
    }

    /**
     * Récupère tous les modèles avec caching
     */
    public static function allCached($ttl = CacheService::LONG_TTL)
    {
        $cacheKey = static::class . ':all';
        return CacheService::remember($cacheKey, function () {
            return static::all();
        }, $ttl);
    }

    /**
     * Récupère les modèles avec une condition spécifique et les cache
     */
    public static function getCached($query, $ttl = CacheService::LONG_TTL)
    {
        $cacheKey = static::class . ':' . md5(serialize($query));
        return CacheService::remember($cacheKey, function () use ($query) {
            if (is_callable($query)) {
                return static::where($query)->get();
            }
            return static::where($query)->get();
        }, $ttl);
    }

    /**
     * Hook appelé après la création d'un modèle
     */
    public static function bootCacheable()
    {
        // Invalider le cache après création
        static::created(function ($model) {
            $model->invalidateCache();
        });

        // Invalider le cache après mise à jour
        static::updated(function ($model) {
            $model->invalidateCache();
        });

        // Invalider le cache après suppression
        static::deleted(function ($model) {
            $model->invalidateCache();
        });
    }

    /**
     * Invalide le cache du modèle
     */
    public function invalidateCache()
    {
        // Invalider le cache du modèle spécifique
        CacheService::forget(static::class . ':' . $this->id);

        // Invalider le cache global de la classe
        CacheService::forget(static::class . ':all');

        // Invalider les listings
        CacheService::flushByPattern(CacheService::PREFIX_LISTINGS);

        // Invalider les stats
        CacheService::flushByPattern(CacheService::PREFIX_STATS);
    }

    /**
     * Invalide tout le cache de ce modèle
     */
    public static function invalidateAllCache()
    {
        CacheService::flushByPattern(static::class);
        CacheService::flushByPattern(CacheService::PREFIX_LISTINGS);
    }

    /**
     * Récupère la clé de cache du modèle
     */
    public function getCacheKey()
    {
        return static::class . ':' . $this->id;
    }

    /**
     * Récupère la clé de cache de tous les modèles
     */
    public static function getAllCacheKey()
    {
        return static::class . ':all';
    }
}

