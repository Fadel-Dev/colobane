<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Carbon;

/**
 * Service pour gérer le caching Redis
 * Fournit des méthodes pratiques pour mettre en cache et récupérer des données
 */
class CacheService
{
    /**
     * Préfixes de cache pour éviter les collisions
     */
    const PREFIX_IMMOBILIERS = 'immobiliers:';
    const PREFIX_VEHICULES = 'vehicules:';
    const PREFIX_SERVICES = 'services:';
    const PREFIX_USERS = 'users:';
    const PREFIX_CATEGORIES = 'categories:';
    const PREFIX_LISTINGS = 'listings:';
    const PREFIX_STATS = 'stats:';
    const PREFIX_SEARCHES = 'searches:';

    /**
     * TTL (Time To Live) par défaut en secondes
     */
    const DEFAULT_TTL = 3600; // 1 heure
    const LONG_TTL = 86400; // 24 heures
    const SHORT_TTL = 300; // 5 minutes

    /**
     * Récupère une donnée du cache ou l'ajoute si elle n'existe pas
     * 
     * @param string $key Clé du cache
     * @param callable $callback Fonction pour générer la donnée
     * @param int $ttl Durée de vie en secondes
     * @return mixed
     */
    public static function remember($key, callable $callback, $ttl = self::DEFAULT_TTL)
    {
        return Cache::remember($key, $ttl, $callback);
    }

    /**
     * Récupère une donnée du cache de manière permanente (jusqu'à invalidation manuelle)
     * 
     * @param string $key Clé du cache
     * @param callable $callback Fonction pour générer la donnée
     * @return mixed
     */
    public static function rememberForever($key, callable $callback)
    {
        return Cache::rememberForever($key, $callback);
    }

    /**
     * Récupère une donnée du cache
     * 
     * @param string $key Clé du cache
     * @param mixed $default Valeur par défaut si non trouvée
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return Cache::get($key, $default);
    }

    /**
     * Ajoute une donnée au cache
     * 
     * @param string $key Clé du cache
     * @param mixed $value Valeur à mettre en cache
     * @param int $ttl Durée de vie en secondes
     * @return bool
     */
    public static function put($key, $value, $ttl = self::DEFAULT_TTL)
    {
        return Cache::put($key, $value, $ttl);
    }

    /**
     * Ajoute une donnée au cache indéfiniment
     * 
     * @param string $key Clé du cache
     * @param mixed $value Valeur à mettre en cache
     * @return bool
     */
    public static function forever($key, $value)
    {
        return Cache::forever($key, $value);
    }

    /**
     * Supprime une donnée du cache
     * 
     * @param string $key Clé du cache
     * @return bool
     */
    public static function forget($key)
    {
        return Cache::forget($key);
    }

    /**
     * Supprime toutes les données du cache
     * 
     * @return bool
     */
    public static function flush()
    {
        return Cache::flush();
    }

    /**
     * Récupère un immobilier du cache
     * 
     * @param int $id ID de l'immobilier
     * @return mixed
     */
    public static function getImmobilier($id)
    {
        return Cache::get(self::PREFIX_IMMOBILIERS . $id);
    }

    /**
     * Met en cache un immobilier
     * 
     * @param int $id ID de l'immobilier
     * @param mixed $data Données de l'immobilier
     * @param int $ttl Durée de vie en secondes
     * @return bool
     */
    public static function putImmobilier($id, $data, $ttl = self::LONG_TTL)
    {
        return Cache::put(self::PREFIX_IMMOBILIERS . $id, $data, $ttl);
    }

    /**
     * Invalide le cache d'un immobilier
     * 
     * @param int $id ID de l'immobilier
     * @return bool
     */
    public static function forgetImmobilier($id)
    {
        return Cache::forget(self::PREFIX_IMMOBILIERS . $id);
    }

    /**
     * Met en cache une liste d'immobiliers avec clé de recherche
     * 
     * @param string $searchKey Clé de recherche (ex: "category:appartements")
     * @param mixed $data Liste d'immobiliers
     * @param int $ttl Durée de vie en secondes
     * @return bool
     */
    public static function putImmobiliersListings($searchKey, $data, $ttl = self::LONG_TTL)
    {
        return Cache::put(self::PREFIX_LISTINGS . $searchKey, $data, $ttl);
    }

    /**
     * Récupère une liste d'immobiliers du cache
     * 
     * @param string $searchKey Clé de recherche
     * @return mixed
     */
    public static function getImmobiliersListings($searchKey)
    {
        return Cache::get(self::PREFIX_LISTINGS . $searchKey);
    }

    /**
     * Invalide la liste d'immobiliers
     * 
     * @param string $searchKey Clé de recherche
     * @return bool
     */
    public static function forgetImmobiliersListings($searchKey)
    {
        return Cache::forget(self::PREFIX_LISTINGS . $searchKey);
    }

    /**
     * Invalide tous les caches d'immobiliers listings
     * 
     * @return bool
     */
    public static function flushImmobiliersListings()
    {
        return self::flushByPattern(self::PREFIX_LISTINGS);
    }

    /**
     * Met en cache des statistiques
     * 
     * @param string $type Type de stats
     * @param mixed $data Données des stats
     * @param int $ttl Durée de vie en secondes
     * @return bool
     */
    public static function putStats($type, $data, $ttl = self::SHORT_TTL)
    {
        return Cache::put(self::PREFIX_STATS . $type, $data, $ttl);
    }

    /**
     * Récupère des statistiques du cache par type
     * 
     * @param string $type Type de stats
     * @return mixed
     */
    public static function getStatsByType($type)
    {
        return Cache::get(self::PREFIX_STATS . $type);
    }

    /**
     * Invalide les stats d'un type
     * 
     * @param string $type Type de stats
     * @return bool
     */
    public static function forgetStats($type)
    {
        return Cache::forget(self::PREFIX_STATS . $type);
    }

    /**
     * Met en cache les résultats de recherche
     * 
     * @param string $query Requête de recherche
     * @param mixed $results Résultats de la recherche
     * @param int $ttl Durée de vie en secondes
     * @return bool
     */
    public static function putSearch($query, $results, $ttl = self::SHORT_TTL)
    {
        $key = self::PREFIX_SEARCHES . md5($query);
        return Cache::put($key, $results, $ttl);
    }

    /**
     * Récupère les résultats de recherche du cache
     * 
     * @param string $query Requête de recherche
     * @return mixed
     */
    public static function getSearch($query)
    {
        $key = self::PREFIX_SEARCHES . md5($query);
        return Cache::get($key);
    }

    /**
     * Invalide le cache de recherche
     * 
     * @param string $query Requête de recherche
     * @return bool
     */
    public static function forgetSearch($query)
    {
        $key = self::PREFIX_SEARCHES . md5($query);
        return Cache::forget($key);
    }

    /**
     * Met en cache les données utilisateur
     * 
     * @param int $userId ID de l'utilisateur
     * @param string $type Type de donnée (profile, favorites, etc)
     * @param mixed $data Données utilisateur
     * @param int $ttl Durée de vie en secondes
     * @return bool
     */
    public static function putUserData($userId, $type, $data, $ttl = self::LONG_TTL)
    {
        $key = self::PREFIX_USERS . $userId . ':' . $type;
        return Cache::put($key, $data, $ttl);
    }

    /**
     * Récupère les données utilisateur du cache
     * 
     * @param int $userId ID de l'utilisateur
     * @param string $type Type de donnée
     * @return mixed
     */
    public static function getUserData($userId, $type)
    {
        $key = self::PREFIX_USERS . $userId . ':' . $type;
        return Cache::get($key);
    }

    /**
     * Invalide les données utilisateur
     * 
     * @param int $userId ID de l'utilisateur
     * @param string $type Type de donnée (si null, invalide tout)
     * @return bool
     */
    public static function forgetUserData($userId, $type = null)
    {
        if ($type) {
            $key = self::PREFIX_USERS . $userId . ':' . $type;
            return Cache::forget($key);
        }
        // Invalide tous les types pour cet utilisateur
        return self::flushByPattern(self::PREFIX_USERS . $userId);
    }

    /**
     * Incrémente un compteur Redis
     * 
     * @param string $key Clé du compteur
     * @param int $value Valeur à incrémenter
     * @return int Nouvelle valeur
     */
    public static function increment($key, $value = 1)
    {
        return Redis::incr($key . ':' . date('Y-m-d'));
    }

    /**
     * Décrémente un compteur Redis
     * 
     * @param string $key Clé du compteur
     * @param int $value Valeur à décrémenter
     * @return int Nouvelle valeur
     */
    public static function decrement($key, $value = 1)
    {
        return Redis::decr($key . ':' . date('Y-m-d'));
    }

    /**
     * Ajoute une valeur à une liste Redis
     * 
     * @param string $key Clé de la liste
     * @param mixed $value Valeur à ajouter
     * @return int Longueur de la liste
     */
    public static function pushToList($key, $value)
    {
        return Redis::rpush($key, json_encode($value));
    }

    /**
     * Récupère une liste Redis
     * 
     * @param string $key Clé de la liste
     * @return array Liste des valeurs
     */
    public static function getList($key)
    {
        $values = Redis::lrange($key, 0, -1);
        return array_map(fn($v) => json_decode($v, true), $values);
    }

    /**
     * Invalide les données d'une liste Redis
     * 
     * @param string $key Clé de la liste
     * @return bool
     */
    public static function flushList($key)
    {
        return Redis::del($key) > 0;
    }

    /**
     * Ajoute une donnée à un set Redis
     * 
     * @param string $key Clé du set
     * @param mixed $value Valeur à ajouter
     * @return int Nombre d'éléments ajoutés
     */
    public static function addToSet($key, $value)
    {
        return Redis::sadd($key, json_encode($value));
    }

    /**
     * Récupère un set Redis
     * 
     * @param string $key Clé du set
     * @return array Ensemble des valeurs
     */
    public static function getSet($key)
    {
        $values = Redis::smembers($key);
        return array_map(fn($v) => json_decode($v, true), $values);
    }

    /**
     * Vérifie si une valeur existe dans un set
     * 
     * @param string $key Clé du set
     * @param mixed $value Valeur à vérifier
     * @return bool
     */
    public static function existsInSet($key, $value)
    {
        return Redis::sismember($key, json_encode($value)) === 1;
    }

    /**
     * Invalide un set Redis
     * 
     * @param string $key Clé du set
     * @return bool
     */
    public static function flushSet($key)
    {
        return Redis::del($key) > 0;
    }

    /**
     * Invalide toutes les clés correspondant à un pattern
     * Attention: Cette opération peut être lente sur de grands datasets
     * 
     * @param string $pattern Pattern à matcher (ex: "immobiliers:*")
     * @return int Nombre de clés supprimées
     */
    public static function flushByPattern($pattern)
    {
        $keys = Redis::keys($pattern . '*');
        if (empty($keys)) {
            return 0;
        }
        return Redis::del(...$keys);
    }

    /**
     * Obtient les informations de Redis
     * 
     * @return array Informations Redis
     */
    public static function getRedisInfo()
    {
        try {
            $info = Redis::info();
            return [
                'status' => 'connected',
                'version' => $info['redis_version'] ?? 'unknown',
                'memory_usage' => $info['used_memory_human'] ?? 'unknown',
                'connected_clients' => $info['connected_clients'] ?? 'unknown',
                'total_commands' => $info['total_commands_processed'] ?? 'unknown',
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'disconnected',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Teste la connexion à Redis
     * 
     * @return bool
     */
    public static function testConnection()
    {
        try {
            Redis::ping();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Flush tous les caches
     * 
     * @return bool
     */
    public static function flushAll()
    {
        try {
            Redis::flushdb();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Obtient les statistiques de cache
     * 
     * @return array Statistiques
     */
    public static function getStats()
    {
        try {
            $info = Redis::info('stats');
            $keyspace = Redis::info('keyspace');
            
            return [
                'total_connections_received' => $info['total_connections_received'] ?? 0,
                'total_commands_processed' => $info['total_commands_processed'] ?? 0,
                'instantaneous_ops_per_sec' => $info['instantaneous_ops_per_sec'] ?? 0,
                'keys_count' => $keyspace['db0']['keys'] ?? 0,
                'expires_count' => $keyspace['db0']['expires'] ?? 0,
            ];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}

