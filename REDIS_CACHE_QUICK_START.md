# ⚡ Redis Cache - Quick Start (5 minutes)

## 🚀 Démarrer MAINTENANT

### 1. Configurer .env (1 min)

Ajouter/mettre à jour dans votre `.env`:

```env
CACHE_DRIVER=redis
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_PASSWORD=null
REDIS_DB=0
REDIS_CACHE_DB=1
```

### 2. Vérifier la Connexion (1 min)

```bash
# Lancer Redis
redis-server

# Tester la connexion Laravel
php artisan cache:manage test
```

Résultat attendu:
```
✓ Redis is connected
```

### 3. Utiliser dans un Contrôleur (2 min)

```php
<?php

namespace App\Http\Controllers;

use App\Services\CacheService;
use App\Models\Immobilier;

class ImmobilierController extends Controller
{
    public function index()
    {
        // Utiliser le cache automatiquement
        $immobiliers = CacheService::remember('immobiliers:all', function () {
            return Immobilier::with('owner')->get();
        }, 3600); // 1 heure

        return view('immobilier.index', compact('immobiliers'));
    }

    public function show($id)
    {
        // Cache un immobilier individuel
        $immobilier = CacheService::remember('immobilier:' . $id, function () use ($id) {
            return Immobilier::with('owner', 'images')->find($id);
        }, 86400); // 24 heures

        return view('immobilier.show', compact('immobilier'));
    }
}
```

### 4. Ajouter Trait au Modèle (1 min)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Cacheable;  // ← Ajouter ici

class Immobilier extends Model
{
    use Cacheable;  // ← Et ici

    // ... rest du modèle
}
```

**C'est tout!** L'invalidation de cache se fera automatiquement. ✅

---

## 📚 Utilisation Rapide

### Mettre en Cache

```php
use App\Services\CacheService;

// Simple
CacheService::put('key', 'value', 3600);

// Récupérer et cacher si absent
$data = CacheService::remember('key', function () {
    return expensive_operation();
}, 3600);

// Permanent
CacheService::forever('permanent_key', $data);
```

### Récupérer du Cache

```php
// Récupérer
$value = CacheService::get('key');

// Avec défaut
$value = CacheService::get('key', 'default');

// Vérifier l'existence
if (CacheService::get('key') !== null) {
    // Clé existe
}
```

### Invalider le Cache

```php
// Une clé
CacheService::forget('key');

// Toutes les clés matchant
CacheService::flushByPattern('immobiliers:*');

// Tout
CacheService::flushAll();
```

---

## 🎯 Cas d'Usage Courants

### 1. Cacherbun Listing de Catégorie

```php
public function category($category)
{
    $cacheKey = 'category:' . $category;

    $items = CacheService::remember($cacheKey, function () use ($category) {
        return Immobilier::where('category', $category)->get();
    }, 3600);

    return view('category', compact('items'));
}
```

### 2. Cache de Recherche

```php
public function search(Request $request)
{
    $query = $request->input('q');
    $cacheKey = 'search:' . md5($query);

    $results = CacheService::remember($cacheKey, function () use ($query) {
        return Immobilier::where('nom', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();
    }, 600); // 10 minutes

    return response()->json($results);
}
```

### 3. Données Utilisateur

```php
public function favorites()
{
    $userId = auth()->id();

    $favorites = CacheService::remember("user:$userId:favorites", function () {
        return auth()->user()->favorites()->get();
    }, 86400);

    return response()->json($favorites);
}
```

### 4. Statistiques

```php
public function stats()
{
    $stats = CacheService::remember('stats:dashboard', function () {
        return [
            'total_properties' => Immobilier::count(),
            'total_users' => User::count(),
            'total_views' => cache()->get('total_views', 0),
        ];
    }, 300); // 5 minutes

    return response()->json($stats);
}
```

### 5. Compteurs

```php
public function viewProperty($id)
{
    // Incrémenter le compteur de vues (par jour)
    $views = CacheService::increment('property:' . $id . ':views');

    // Sauvegarder à la BD chaque 100 vues
    if ($views % 100 === 0) {
        Immobilier::find($id)->increment('views', 100);
    }

    return view('property', ['views' => $views]);
}
```

---

## 🛠️ Commandes Artisan Principales

```bash
# Tester la connexion
php artisan cache:manage test

# Afficher les stats
php artisan cache:manage stats

# Vider le cache complet
php artisan cache:manage flush

# Vider par pattern
php artisan cache:manage flush --pattern="immobiliers:*"

# Récupérer une clé
php artisan cache:manage get --key="ma_cle"

# Ajouter une clé
php artisan cache:manage set --key="ma_cle" --ttl=3600

# Supprimer une clé
php artisan cache:manage delete --key="ma_cle"
```

---

## 📊 Monitoring

### Afficher l'Utilisation

```bash
# Statistiques Redis
php artisan cache:manage stats

# Information Redis détaillée
redis-cli INFO

# Regarder les opérations en temps réel
redis-cli MONITOR
```

---

## ✨ TTL Recommandés

```php
// Données très volatiles (stats en temps réel)
300                 // 5 minutes

// Données générales (listings, catégories)
3600                // 1 heure

// Données stables (information utilisateur)
86400               // 24 heures

// Données quasi-permanentes
CacheService::forever($key, $value)
```

---

## 🚨 Troubleshooting Rapide

| Problème | Solution |
|----------|----------|
| Redis non connecté | `redis-server` pour lancer Redis |
| Clé pas trouvée | Vérifier le TTL, faire `cache:manage get --key="..."` |
| Cache trop gros | Réduire les TTLs ou faire `cache:manage flush` |
| N+1 queries | Utiliser `with()` dans le callback du remember |

---

## 📝 Configuration Minimale

```env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_DB=0
REDIS_CACHE_DB=1
```

---

## ✅ Vérifier que Tout Fonctionne

```php
// Test simple
php artisan tinker

// Dans tinker:
>>> use App\Services\CacheService;
>>> CacheService::put('test', 'hello world', 3600);
>>> CacheService::get('test');
=> "hello world"

// Parfait! ✓
```

---

**C'est prêt!** 🎉 Votre système de cache Redis est 100% fonctionnel et prêt à améliorer les performances de votre application!

