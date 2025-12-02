# 🚀 Guide Complet du Cache Redis - NoflayHub

## 📋 Table des matières

1. [Installation & Configuration](#installation--configuration)
2. [CacheService - L'API principale](#cacheservice--lapi-principale)
3. [Utilisation dans les contrôleurs](#utilisation-dans-les-contrôleurs)
4. [Trait Cacheable pour les modèles](#trait-cacheable-pour-les-modèles)
5. [Middleware de cache HTTP](#middleware-de-cache-http)
6. [Commandes Artisan](#commandes-artisan)
7. [API REST pour le cache](#api-rest-pour-le-cache)
8. [Exemples pratiques](#exemples-pratiques)
9. [Performance & Bonnes pratiques](#performance--bonnes-pratiques)
10. [Troubleshooting](#troubleshooting)

---

## 🛠️ Installation & Configuration

### Prérequis

```bash
# 1. Redis doit être installé et lancé
redis-server

# 2. Extension PHP redis
sudo apt-get install php-redis

# 3. Dépendance Composer (généralement déjà présente)
composer require predis/predis  # ou phpredis
```

### Configuration .env

```env
# Cache Driver - Utiliser Redis
CACHE_DRIVER=redis

# Redis Connection Settings
REDIS_CLIENT=phpredis           # ou 'predis'
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_DB=0                      # Database pour application
REDIS_CACHE_DB=1                # Database pour cache

# Cache Prefix
CACHE_PREFIX=noflayhub_

# Logging
CACHE_LOG_HITS=false            # true pour déboguer
```

### Vérifier la configuration

```bash
# Vérifier la connexion Redis
php artisan cache:manage test

# Résultat attendu:
# ✓ Redis is connected
# +-------------------+---------+
# | Property          | Value   |
# +-------------------+---------+
# | Status            | connected
# | Version           | 6.0.0   |
# | Memory            | 1.23M   |
# | Connected Clients | 1       |
# | Total Commands    | 123     |
# +-------------------+---------+
```

---

## 🎯 CacheService - L'API Principale

Le `CacheService` fournit une API simple et puissante pour gérer le cache Redis.

### Méthodes Principales

#### 1. Stockage Simple

```php
use App\Services\CacheService;

// Mettre une valeur en cache (1 heure par défaut)
CacheService::put('mon_cle', 'ma_valeur');

// Mettre en cache avec TTL personnalisé
CacheService::put('mon_cle', 'ma_valeur', 3600); // 1 heure

// Mettre en cache indéfiniment
CacheService::forever('ma_cle_permanente', $data);

// Récupérer une valeur
$value = CacheService::get('mon_cle');

// Récupérer avec valeur par défaut
$value = CacheService::get('mon_cle', 'valeur_par_defaut');

// Supprimer une clé
CacheService::forget('mon_cle');

// Supprimer tout le cache
CacheService::flush();
```

#### 2. Remember Pattern

```php
// Si la clé n'existe pas, exécuter le callback et mettre en cache
$user = CacheService::remember('user:1', function () {
    return User::find(1);
}, 3600); // 1 heure

// Remember permanent (jusqu'à invalidation manuelle)
$categories = CacheService::rememberForever('categories:all', function () {
    return Category::all();
});
```

#### 3. Gestion des Immobiliers

```php
// Mettre en cache un immobilier
$immobilier = Immobilier::find(123);
CacheService::putImmobilier(123, $immobilier);

// Récupérer un immobilier du cache
$immobilier = CacheService::getImmobilier(123);

// Invalider le cache d'un immobilier
CacheService::forgetImmobilier(123);
```

#### 4. Listings & Recherches

```php
// Mettre en cache une liste d'immobiliers
$listings = Immobilier::where('category', 'appartement')->get();
CacheService::putImmobiliersListings('category:appartement', $listings);

// Récupérer la liste du cache
$listings = CacheService::getImmobiliersListings('category:appartement');

// Invalider les listings
CacheService::forgetImmobiliersListings('category:appartement');
CacheService::flushImmobiliersListings(); // Tout invalider
```

#### 5. Données Utilisateur

```php
// Mettre en cache les favoris d'un utilisateur
$favorites = auth()->user()->favorites;
CacheService::putUserData(auth()->id(), 'favorites', $favorites);

// Récupérer les favoris du cache
$favorites = CacheService::getUserData(auth()->id(), 'favorites');

// Invalider les favoris
CacheService::forgetUserData(auth()->id(), 'favorites');

// Invalider TOUT le cache utilisateur
CacheService::forgetUserData(auth()->id());
```

#### 6. Statistiques

```php
// Mettre en cache des stats (court TTL par défaut)
$stats = [
    'total_properties' => Immobilier::count(),
    'total_users' => User::count(),
];
CacheService::putStats('dashboard', $stats);

// Récupérer les stats
$stats = CacheService::getStats('dashboard');

// Invalider les stats
CacheService::forgetStats('dashboard');
```

#### 7. Compteurs & Listes Redis Natives

```php
// Incrémenter un compteur (par jour)
$views = CacheService::increment('property:123:views');   // Retourne 1, 2, 3...

// Décémenter un compteur
$views = CacheService::decrement('property:123:views');

// Listes Redis (pour les files d'attente, etc)
CacheService::pushToList('notifications:queue', $notification);
$notifications = CacheService::getList('notifications:queue');
CacheService::flushList('notifications:queue');

// Sets Redis (pour les collections uniques)
CacheService::addToSet('online:users', auth()->id());
$onlineUsers = CacheService::getSet('online:users');
$isOnline = CacheService::existsInSet('online:users', auth()->id());
CacheService::flushSet('online:users');
```

#### 8. Invalidation par Pattern

```php
// Invalider toutes les clés contenant "immobiliers"
CacheService::flushByPattern('immobiliers:*');

// Invalider toutes les listings
CacheService::flushByPattern(CacheService::PREFIX_LISTINGS);

// Invalider tout le cache des statistiques
CacheService::flushByPattern(CacheService::PREFIX_STATS);
```

#### 9. Informations Redis

```php
// Obtenir les infos Redis
$info = CacheService::getRedisInfo();
// Retourne: [
//     'status' => 'connected',
//     'version' => '6.0.0',
//     'memory_usage' => '1.23M',
//     'connected_clients' => 1,
//     'total_commands' => 123,
// ]

// Tester la connexion
if (CacheService::testConnection()) {
    echo 'Redis est connecté!';
}

// Obtenir les statistiques
$stats = CacheService::getStats();
// Retourne: [
//     'total_connections_received' => 123,
//     'total_commands_processed' => 456,
//     'instantaneous_ops_per_sec' => 10,
//     'keys_count' => 50,
//     'expires_count' => 30,
// ]
```

---

## 🎮 Utilisation dans les Contrôleurs

### Exemple: Contrôleur Immobilier

```php
<?php

namespace App\Http\Controllers;

use App\Models\Immobilier;
use App\Services\CacheService;

class ImmobilierController extends Controller
{
    /**
     * Afficher tous les immobiliers d'une catégorie
     */
    public function category($category)
    {
        // Vérifier le cache
        $cacheKey = 'category:' . $category;
        $listings = CacheService::getImmobiliersListings($cacheKey);

        if ($listings === null) {
            // Cache miss - récupérer de la BD
            $listings = Immobilier::where('type', $category)
                ->with('owner')
                ->paginate(12);

            // Mettre en cache (1 heure)
            CacheService::putImmobiliersListings($cacheKey, $listings);
        }

        return view('immobilier.category', compact('listings'));
    }

    /**
     * Afficher les détails d'un immobilier
     */
    public function show($id)
    {
        // Utiliser remember pattern
        $immobilier = CacheService::remember('immobilier:' . $id, function () use ($id) {
            return Immobilier::with('owner', 'images', 'reviews')->find($id);
        }, 86400); // 24 heures

        if (!$immobilier) {
            abort(404);
        }

        return view('immobilier.show', compact('immobilier'));
    }

    /**
     * Chercher un immobilier
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        // Vérifier le cache de recherche
        $results = CacheService::getSearch($query);

        if ($results === null) {
            // Cache miss
            $results = Immobilier::where('nom', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%")
                ->limit(20)
                ->get();

            // Mettre en cache (10 minutes)
            CacheService::putSearch($query, $results, 600);
        }

        return response()->json($results);
    }

    /**
     * Créer un immobilier
     */
    public function store(Request $request)
    {
        $validated = $request->validate([...]);
        
        $immobilier = Immobilier::create($validated);

        // Invalider les listings en cache (la classe modèle le fera automatiquement avec le Trait)
        // CacheService::flushImmobiliersListings();

        return redirect()->route('immobilier.show', $immobilier);
    }

    /**
     * Mettre à jour un immobilier
     */
    public function update(Request $request, $id)
    {
        $immobilier = Immobilier::find($id);
        
        $validated = $request->validate([...]);
        $immobilier->update($validated);

        // Invalider le cache (le Trait le fera automatiquement)
        // CacheService::forgetImmobilier($id);
        // CacheService::flushImmobiliersListings();

        return redirect()->route('immobilier.show', $immobilier);
    }

    /**
     * Supprimer un immobilier
     */
    public function destroy($id)
    {
        $immobilier = Immobilier::find($id);
        $immobilier->delete();

        // Invalider le cache (le Trait le fera automatiquement)
        // CacheService::forgetImmobilier($id);

        return redirect()->route('immobilier.index');
    }
}
```

---

## 🏷️ Trait Cacheable pour les Modèles

### Ajouter le Trait à un Modèle

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Cacheable;

class Immobilier extends Model
{
    use Cacheable;  // Ajouter le trait

    // ... rest du modèle
}
```

### Utiliser les Méthodes du Trait

```php
// Récupérer avec cache (24 heures par défaut)
$immobilier = Immobilier::findCached(123);

// Récupérer avec cache TTL personnalisé
$immobilier = Immobilier::findCached(123, 3600); // 1 heure

// Récupérer tous les immobiliers avec cache
$all = Immobilier::allCached();

// Récupérer tous les immobiliers avec cache personnalisé
$all = Immobilier::allCached(86400); // 24 heures

// Le cache s'invalide automatiquement sur:
// - Immobilier::created()  - Après création
// - Immobilier::updated()  - Après mise à jour
// - Immobilier::deleted()  - Après suppression
```

---

## 🌐 Middleware de Cache HTTP

### Enregistrer le Middleware

```php
// app/Http/Kernel.php

protected $routeMiddleware = [
    // ...
    'cache.response' => \App\Http\Middleware\CacheResponse::class,
];
```

### Utiliser sur des Routes

```php
// routes/api.php

Route::middleware(['cache.response'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/immobiliers', [ImmobilierController::class, 'index']);
    Route::get('/immobiliers/{id}', [ImmobilierController::class, 'show']);
});
```

### Comment Ça Marche

1. Les requêtes GET sont interceptées
2. Une clé de cache est générée basée sur l'URL et les paramètres
3. Si la réponse est en cache, elle est retournée avec header `X-Cache: HIT`
4. Sinon, la requête continue normalement et la réponse JSON est mise en cache
5. Le header `X-Cache: MISS` indique une nouvelle mise en cache

### Configuration des Routes

Dans `config/redis-cache.php`:

```php
'cacheable_routes' => [
    'GET /api/categories' => 86400,     // 24 heures
    'GET /api/immobiliers' => 3600,     // 1 heure
    'GET /api/stats' => 300,            // 5 minutes
],

'excluded_routes' => [
    'api/auth*',
    'api/user/profile',
],
```

---

## 🛠️ Commandes Artisan

### Tester la connexion Redis

```bash
php artisan cache:manage test

# Output:
# Testing Redis connection...
# ✓ Redis is connected
# +-------------------+---------+
# | Property          | Value   |
# +-------------------+---------+
# | Status            | connected
# | Version           | 6.0.0   |
# | Memory            | 1.23M   |
# | Connected Clients | 1       |
# | Total Commands    | 123     |
# +-------------------+---------+
```

### Afficher les Statistiques

```bash
php artisan cache:manage stats

# Output:
# Cache Statistics:
# +----------------------+-----+
# | Metric               | Value
# +----------------------+-----+
# | Total Connections    | 123
# | Total Commands       | 456
# | Ops/sec              | 10
# | Keys Count           | 50
# | Expires Count        | 30
# +----------------------+-----+
```

### Vider le Cache Complet

```bash
php artisan cache:manage flush

# Vous demande une confirmation, puis vide tout le cache
```

### Vider avec Pattern

```bash
php artisan cache:manage flush --pattern="immobiliers:*"

# Vide toutes les clés matchant "immobiliers:*"
```

### Récupérer une Clé

```bash
php artisan cache:manage get --key="mon_cle"

# Affiche la valeur de la clé
```

### Ajouter une Clé

```bash
php artisan cache:manage set --key="ma_cle" --ttl=3600

# Vous demande la valeur, puis l'ajoute avec TTL de 1 heure
```

### Supprimer une Clé

```bash
php artisan cache:manage delete --key="ma_cle"

# Vous demande une confirmation, puis supprime
```

### Réchauffer le Cache

```bash
php artisan cache:manage warm-up

# Pré-charge les données fréquemment utilisées
```

---

## 📡 API REST pour le Cache

### Endpoints Available

```
POST   /api/cache/dashboard     - Afficher le tableau de bord
POST   /api/cache/flush         - Vider le cache complet
POST   /api/cache/flush-pattern - Vider par pattern
GET    /api/cache/get           - Récupérer une clé
POST   /api/cache/put           - Ajouter une clé
DELETE /api/cache/forget        - Supprimer une clé
GET    /api/cache/test          - Tester la connexion
```

### Enregistrer les Routes

```php
// routes/api.php

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(CacheController::class)->group(function () {
        Route::get('/cache/dashboard', 'dashboard');
        Route::post('/cache/flush', 'flush');
        Route::post('/cache/flush-pattern', 'flushPattern');
        Route::get('/cache/get', 'get');
        Route::post('/cache/put', 'put');
        Route::delete('/cache/forget', 'forget');
        Route::get('/cache/test', 'testConnection');
    });
});
```

### Exemples d'Utilisation

```bash
# Tester la connexion
curl http://localhost:8000/api/cache/test

# Récupérer une valeur
curl "http://localhost:8000/api/cache/get?key=mon_cle"

# Ajouter une valeur
curl -X POST http://localhost:8000/api/cache/put \
  -d '{"key":"ma_cle","value":"ma_valeur","ttl":3600}' \
  -H "Content-Type: application/json"

# Vider par pattern
curl -X POST http://localhost:8000/api/cache/flush-pattern \
  -d '{"pattern":"immobiliers:*"}' \
  -H "Content-Type: application/json"

# Vider tout
curl -X POST http://localhost:8000/api/cache/flush
```

---

## 💡 Exemples Pratiques

### 1. Cache d'une Page Complète

```php
// Dans un contrôleur
public function index()
{
    return CacheService::remember('page:immobiliers:index', function () {
        return view('immobiliers.index', [
            'categories' => Category::all(),
            'featured' => Immobilier::featured()->get(),
            'recent' => Immobilier::latest()->take(10)->get(),
        ])->render();
    }, 3600);
}
```

### 2. Cache avec Invalidation Intelligente

```php
// Dans le modèle
class Immobilier extends Model
{
    use Cacheable;

    protected static function booted()
    {
        static::created(function ($model) {
            // Invalider automatiquement
            CacheService::flushImmobiliersListings();
            CacheService::forgetStats('total_properties');
        });
    }
}
```

### 3. Compteurs en Temps Réel

```php
// Augmenter les vues
public function view()
{
    $views = CacheService::increment('property:' . $id . ':views');
    
    // Sauvegarder à la BD chaque 100 vues
    if ($views % 100 === 0) {
        Immobilier::find($id)->increment('views', 100);
    }
}
```

### 4. Cache de Recherche Avancée

```php
public function advancedSearch(Request $request)
{
    $searchParams = $request->only(['category', 'min_price', 'max_price', 'region']);
    $cacheKey = 'search:' . md5(json_encode($searchParams));

    return CacheService::remember($cacheKey, function () use ($searchParams) {
        return Immobilier::where('category', $searchParams['category'])
            ->whereBetween('price', [$searchParams['min_price'], $searchParams['max_price']])
            ->where('region', $searchParams['region'])
            ->get();
    }, 1800); // 30 minutes
}
```

### 5. Cache de Suggestions Personnalisées

```php
public function recommendations()
{
    $userId = auth()->id();

    $recommendations = CacheService::remember('user:' . $userId . ':recommendations', function () use ($userId) {
        $user = auth()->user();
        
        return Immobilier::where('category', $user->preferred_category)
            ->where('price', '<=', $user->max_budget)
            ->inRandomOrder()
            ->take(10)
            ->get();
    }, 86400); // 24 heures

    return response()->json($recommendations);
}
```

---

## ⚡ Performance & Bonnes Pratiques

### 1. Choisir le bon TTL

```php
// Cache rapide (stats, compteurs)
const SHORT_TTL = 300;          // 5 minutes

// Cache normal (listings, recherches)
const DEFAULT_TTL = 3600;       // 1 heure

// Cache long (données statiques)
const LONG_TTL = 86400;         // 24 heures

// Cache permanent (jusqu'à invalidation manuelle)
CacheService::forever($key, $value);
```

### 2. Utiliser des Patterns Cohérents

```php
// ✅ BON
'immobiliers:123'              // Un immobilier spécifique
'category:appartements:page:1' // Une page listée
'search:' . md5($query)        // Recherche hashée

// ❌ MAUVAIS
'im_123'                       // Nom ambigu
'cat_app_p1'                   // Trop court, pas clair
'search_query'                 // Peut être très long
```

### 3. Invalidation Intelligente

```php
// ✅ BON - Invalider seulement ce qui est affecté
CacheService::forgetImmobilier($id);
CacheService::flushByPattern('category:' . $category);

// ❌ MAUVAIS - Vider tout indiscriminément
CacheService::flushAll();
```

### 4. Éviter N+1 avec Cache

```php
// ✅ BON
$immobiliers = CacheService::remember('immobiliers:all', function () {
    return Immobilier::with('owner', 'images')->get(); // Eager loading
}, 3600);

// ❌ MAUVAIS
$immobiliers = Immobilier::all(); // N+1 queries à chaque accès
```

### 5. Monitorer l'Utilisation

```bash
# Afficher les stats régulièrement
php artisan cache:manage stats

# Vérifier la mémoire utilisée
redis-cli INFO memory
```

---

## 🐛 Troubleshooting

### Redis non connecté

```bash
# Vérifier si Redis est lancé
ps aux | grep redis

# Lancer Redis
redis-server

# Ou si c'est un service
sudo systemctl start redis-server
```

### Erreur: "WRONGTYPE Operation against a key holding the wrong kind of value"

```php
// Cela arrive si vous utilisez une clé comme string, puis comme liste
// Solution: Utiliser des noms de clés différents

CacheService::put('items', 'single_value');      // String
CacheService::pushToList('items_list', $value);  // List (clé différente)
```

### Clé non trouvée alors qu'elle devrait être en cache

```php
// Vérifier le TTL
$value = CacheService::get($key);

// Vérifier manuellement dans Redis
redis-cli GET "noflayhub_cache_mon_cle"

// Si vide, la clé a probablement expiré
```

### Mémoire Redis pleine

```bash
# Vérifier l'utilisation
redis-cli INFO memory

# Configurer une politique d'expulsion dans redis.conf
maxmemory 256mb
maxmemory-policy allkeys-lru
```

### Cache pas à jour après mise à jour des données

```php
// S'assurer que le modèle utilise le Trait Cacheable
use App\Traits\Cacheable;

class Immobilier extends Model
{
    use Cacheable; // IMPORTANT!
}

// Ou invalider manuellement
CacheService::forgetImmobilier($id);
```

---

## 🎓 Résumé

Le système de cache Redis est maintenant **100% fonctionnel** avec:

✅ **CacheService** - API simple et puissante  
✅ **Trait Cacheable** - Intégration automatique aux modèles  
✅ **Middleware HTTP** - Cache automatique des réponses  
✅ **Commandes Artisan** - Gestion facile du cache  
✅ **API REST** - Endpoints pour gérer le cache  
✅ **Configuration** - Complète et flexible  

**Prêt à l'emploi!** 🚀

