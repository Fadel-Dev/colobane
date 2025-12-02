# 🔌 Guide Complet - Mode Hors Ligne pour E-Commerce Laravel

## 📋 Table des matières

1. [Vue d'ensemble](#vue-densemble)
2. [Architecture](#architecture)
3. [Service Worker](#service-worker)
4. [IndexedDB - Stockage Local](#indexeddb--stockage-local)
5. [Synchronisation](#synchronisation)
6. [Implémentation Progressive](#implémentation-progressive)
7. [Cas d'usage E-commerce](#cas-dusage-e-commerce)
8. [Exemples Pratiques](#exemples-pratiques)
9. [Performance](#performance)
10. [Sécurité](#sécurité)

---

## 🎯 Vue d'ensemble

Une **e-commerce Laravel avec fonctionnalité hors ligne** peut:

✅ **En ligne (connecté)**
- Afficher tous les produits
- Chercher/filtrer en temps réel
- Ajouter au panier
- Passer commande immédiatement
- Synchroniser avec le serveur

✅ **Hors ligne (déconnecté)**
- Consulter produits/catégories en cache
- Ajouter items au panier local
- Voir l'historique des commandes précédentes
- Rechercher dans les données en cache
- Mettre à jour automatiquement quand connecté

---

## 🏗️ Architecture

### Composants

```
┌─────────────────────────────────────────────────────────┐
│                    USER INTERFACE                        │
│  (Detect online/offline status, UI adaptée)             │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│                   SERVICE WORKER                         │
│  (Intercepte requests, cache, offline handling)         │
└─────────────────────────────────────────────────────────┘
                          ↓
         ┌────────────────┬────────────────┐
         ↓                ↓                ↓
    ┌─────────┐      ┌──────────┐    ┌─────────┐
    │  CACHE  │      │ IndexedDB │    │ SESSION │
    │ (Assets)│      │(Data Sync)│    │ Storage │
    └─────────┘      └──────────┘    └─────────┘
         ↓                ↓                ↓
    ┌─────────────────────────────────────┐
    │   NETWORK / API SERVER              │
    │   (Quand connecté)                  │
    └─────────────────────────────────────┘
```

### Technologies

| Technologie | Rôle |
|------------|------|
| **Service Worker** | Intercepte les requêtes, gère le cache offline |
| **Cache API** | Stocke les assets (CSS, JS, images) |
| **IndexedDB** | Base de données locale pour données complexes |
| **LocalStorage/SessionStorage** | Stockage simple (config, préférences) |
| **Background Sync API** | Synchronise quand la connexion revient |
| **Progressive Enhancement** | Fonctionne avec ou sans JS |

---

## 🔧 Service Worker - Implémentation

### 1. Service Worker Principal

```javascript
// public/offline-sw.js

const CACHE_NAME = 'noflayhub-v1';
const API_CACHE = 'noflayhub-api-v1';
const OFFLINE_FALLBACK = '/offline.html';

// Installation
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll([
        '/',
        '/offline.html',
        '/css/app.css',
        '/js/app.js',
        '/manifest.json',
        '/logo.png',
      ]);
    })
  );
  self.skipWaiting();
});

// Activation
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames
          .filter((name) => name !== CACHE_NAME && name !== API_CACHE)
          .map((name) => caches.delete(name))
      );
    })
  );
  self.clients.claim();
});

// Fetch - Stratégie "Cache First, Network Fallback"
self.addEventListener('fetch', (event) => {
  const { request } = event;
  const url = new URL(request.url);

  // Static assets - Cache First
  if (request.destination === 'style' || request.destination === 'script' || request.destination === 'image') {
    event.respondWith(
      caches.match(request).then((response) => {
        return response || fetch(request).then((res) => {
          return caches.open(CACHE_NAME).then((cache) => {
            cache.put(request, res.clone());
            return res;
          });
        });
      }).catch(() => caches.match('/offline.html'))
    );
  }

  // API calls - Network First, Cache Fallback
  else if (url.pathname.startsWith('/api/')) {
    event.respondWith(
      fetch(request)
        .then((response) => {
          // Cache successful API responses
          if (response.ok && request.method === 'GET') {
            caches.open(API_CACHE).then((cache) => {
              cache.put(request, response.clone());
            });
          }
          return response;
        })
        .catch(() => {
          // Return cached response if offline
          return caches.match(request).then((response) => {
            if (response) return response;
            
            // Return offline page for HTML requests
            if (request.headers.get('Accept').includes('text/html')) {
              return caches.match('/offline.html');
            }
            
            // Return mock data for API
            return new Response(JSON.stringify({ offline: true }), {
              status: 503,
              statusText: 'Service Unavailable',
              headers: new Headers({ 'Content-Type': 'application/json' }),
            });
          });
        })
    );
  }

  // Navigation - Cache First with Network Fallback
  else if (request.mode === 'navigate') {
    event.respondWith(
      fetch(request)
        .catch(() => caches.match(request))
        .catch(() => caches.match('/offline.html'))
    );
  }
});

// Background Sync - Synchroniser quand connecté
self.addEventListener('sync', (event) => {
  if (event.tag === 'sync-cart') {
    event.waitUntil(syncCart());
  }
});

async function syncCart() {
  try {
    const db = await openDatabase();
    const pendingItems = await getPendingCartItems(db);
    
    for (const item of pendingItems) {
      const response = await fetch('/api/cart/add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(item),
      });
      
      if (response.ok) {
        await markItemSynced(db, item.id);
      }
    }
    
    // Notify client
    self.clients.matchAll().then((clients) => {
      clients.forEach((client) => {
        client.postMessage({ type: 'CART_SYNCED' });
      });
    });
  } catch (error) {
    console.error('Sync failed:', error);
  }
}
```

### 2. Enregistrer le Service Worker

```blade
<!-- Dans resources/views/app.blade.php -->

<script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/offline-sw.js')
      .then((registration) => {
        console.log('Service Worker enregistré');
        
        // Écouter les mises à jour
        registration.addEventListener('updatefound', () => {
          console.log('Nouvelle version disponible!');
          // Notifier l'utilisateur
          window.dispatchEvent(new Event('sw-update'));
        });
      })
      .catch((error) => {
        console.error('Service Worker erreur:', error);
      });
  }
</script>
```

---

## 💾 IndexedDB - Stockage Local

### 1. Wrapper IndexedDB

```javascript
// resources/js/Services/OfflineDB.js

class OfflineDB {
  constructor() {
    this.db = null;
    this.dbName = 'NoflayHub_Offline';
    this.version = 1;
  }

  async init() {
    return new Promise((resolve, reject) => {
      const request = indexedDB.open(this.dbName, this.version);

      request.onerror = () => reject(request.error);
      request.onsuccess = () => {
        this.db = request.result;
        resolve();
      };

      request.onupgradeneeded = (event) => {
        const db = event.target.result;

        // Magasin pour les produits
        if (!db.objectStoreNames.contains('products')) {
          const store = db.createObjectStore('products', { keyPath: 'id' });
          store.createIndex('category', 'category', { unique: false });
          store.createIndex('timestamp', 'timestamp', { unique: false });
        }

        // Magasin pour les favoris
        if (!db.objectStoreNames.contains('favorites')) {
          db.createObjectStore('favorites', { keyPath: 'id' });
        }

        // Magasin pour le panier
        if (!db.objectStoreNames.contains('cart')) {
          db.createObjectStore('cart', { keyPath: 'id', autoIncrement: true });
        }

        // Magasin pour les commandes
        if (!db.objectStoreNames.contains('orders')) {
          db.createObjectStore('orders', { keyPath: 'id' });
        }

        // Magasin pour les données en attente de synchronisation
        if (!db.objectStoreNames.contains('pending')) {
          db.createObjectStore('pending', { keyPath: 'id', autoIncrement: true });
        }
      };
    });
  }

  // Produits
  async saveProducts(products) {
    const tx = this.db.transaction(['products'], 'readwrite');
    const store = tx.objectStore('products');
    
    for (const product of products) {
      product.timestamp = Date.now();
      store.put(product);
    }
    
    return new Promise((resolve, reject) => {
      tx.oncomplete = () => resolve();
      tx.onerror = () => reject(tx.error);
    });
  }

  async getProducts(category = null) {
    const tx = this.db.transaction(['products'], 'readonly');
    const store = tx.objectStore('products');

    return new Promise((resolve, reject) => {
      let request;
      
      if (category) {
        const index = store.index('category');
        request = index.getAll(category);
      } else {
        request = store.getAll();
      }

      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async getProduct(id) {
    const tx = this.db.transaction(['products'], 'readonly');
    const store = tx.objectStore('products');

    return new Promise((resolve, reject) => {
      const request = store.get(id);
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  // Panier
  async addToCart(item) {
    const tx = this.db.transaction(['cart'], 'readwrite');
    const store = tx.objectStore('cart');
    
    const request = store.add({
      ...item,
      addedAt: Date.now(),
      synced: false,
    });

    return new Promise((resolve, reject) => {
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async getCart() {
    const tx = this.db.transaction(['cart'], 'readonly');
    const store = tx.objectStore('cart');

    return new Promise((resolve, reject) => {
      const request = store.getAll();
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async removeFromCart(id) {
    const tx = this.db.transaction(['cart'], 'readwrite');
    const store = tx.objectStore('cart');

    return new Promise((resolve, reject) => {
      const request = store.delete(id);
      request.onsuccess = () => resolve();
      request.onerror = () => reject(request.error);
    });
  }

  async clearCart() {
    const tx = this.db.transaction(['cart'], 'readwrite');
    const store = tx.objectStore('cart');

    return new Promise((resolve, reject) => {
      const request = store.clear();
      request.onsuccess = () => resolve();
      request.onerror = () => reject(request.error);
    });
  }

  // Favoris
  async addToFavorites(product) {
    const tx = this.db.transaction(['favorites'], 'readwrite');
    const store = tx.objectStore('favorites');

    return new Promise((resolve, reject) => {
      const request = store.put(product);
      request.onsuccess = () => resolve();
      request.onerror = () => reject(request.error);
    });
  }

  async getFavorites() {
    const tx = this.db.transaction(['favorites'], 'readonly');
    const store = tx.objectStore('favorites');

    return new Promise((resolve, reject) => {
      const request = store.getAll();
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async removeFromFavorites(id) {
    const tx = this.db.transaction(['favorites'], 'readwrite');
    const store = tx.objectStore('favorites');

    return new Promise((resolve, reject) => {
      const request = store.delete(id);
      request.onsuccess = () => resolve();
      request.onerror = () => reject(request.error);
    });
  }

  // Commandes
  async saveOrder(order) {
    const tx = this.db.transaction(['orders'], 'readwrite');
    const store = tx.objectStore('orders');

    return new Promise((resolve, reject) => {
      const request = store.put({
        ...order,
        timestamp: Date.now(),
        synced: false,
      });
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async getOrders() {
    const tx = this.db.transaction(['orders'], 'readonly');
    const store = tx.objectStore('orders');

    return new Promise((resolve, reject) => {
      const request = store.getAll();
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  // Données en attente
  async addPending(data) {
    const tx = this.db.transaction(['pending'], 'readwrite');
    const store = tx.objectStore('pending');

    return new Promise((resolve, reject) => {
      const request = store.add({
        ...data,
        timestamp: Date.now(),
        type: data.type || 'unknown',
      });
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async getPending() {
    const tx = this.db.transaction(['pending'], 'readonly');
    const store = tx.objectStore('pending');

    return new Promise((resolve, reject) => {
      const request = store.getAll();
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  async removePending(id) {
    const tx = this.db.transaction(['pending'], 'readwrite');
    const store = tx.objectStore('pending');

    return new Promise((resolve, reject) => {
      const request = store.delete(id);
      request.onsuccess = () => resolve();
      request.onerror = () => reject(request.error);
    });
  }
}

export default new OfflineDB();
```

---

## 🔄 Synchronisation

### 1. Service de Synchronisation

```javascript
// resources/js/Services/SyncService.js

import OfflineDB from './OfflineDB';

class SyncService {
  async syncAll() {
    console.log('🔄 Syncing...');
    
    try {
      await this.syncCart();
      await this.syncOrders();
      await this.syncFavorites();
      
      console.log('✅ Sync completed');
      window.dispatchEvent(new Event('sync-complete'));
    } catch (error) {
      console.error('Sync error:', error);
      window.dispatchEvent(new Event('sync-error'));
    }
  }

  async syncCart() {
    const cart = await OfflineDB.getCart();
    
    for (const item of cart) {
      if (!item.synced) {
        try {
          const response = await fetch('/api/cart/add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(item),
          });
          
          if (response.ok) {
            await OfflineDB.removeFromCart(item.id);
          }
        } catch (error) {
          console.error('Cart sync error:', error);
        }
      }
    }
  }

  async syncOrders() {
    const orders = await OfflineDB.getOrders();
    
    for (const order of orders) {
      if (!order.synced) {
        try {
          const response = await fetch('/api/orders', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(order),
          });
          
          if (response.ok) {
            // Marquer comme synchronisé
            order.synced = true;
            await OfflineDB.saveOrder(order);
          }
        } catch (error) {
          console.error('Order sync error:', error);
        }
      }
    }
  }

  async syncFavorites() {
    const favorites = await OfflineDB.getFavorites();
    
    try {
      await fetch('/api/favorites/sync', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ favorites: favorites.map(f => f.id) }),
      });
    } catch (error) {
      console.error('Favorites sync error:', error);
    }
  }

  async fetchAndCache() {
    try {
      // Fetch products
      const response = await fetch('/api/products');
      if (response.ok) {
        const products = await response.json();
        await OfflineDB.saveProducts(products);
      }
    } catch (error) {
      console.error('Fetch error:', error);
    }
  }
}

export default new SyncService();
```

### 2. Détecter la Connexion

```javascript
// resources/js/Services/OnlineDetector.js

class OnlineDetector {
  constructor() {
    this.isOnline = navigator.onLine;
    this.listeners = [];
    
    window.addEventListener('online', () => this.handleOnline());
    window.addEventListener('offline', () => this.handleOffline());
  }

  handleOnline() {
    console.log('🌐 Back online!');
    this.isOnline = true;
    this.notify('online');
  }

  handleOffline() {
    console.log('📴 Now offline');
    this.isOnline = false;
    this.notify('offline');
  }

  subscribe(callback) {
    this.listeners.push(callback);
    return () => {
      this.listeners = this.listeners.filter(l => l !== callback);
    };
  }

  notify(status) {
    this.listeners.forEach(listener => listener(status));
    window.dispatchEvent(new CustomEvent('connection-status', { detail: { status } }));
  }

  getStatus() {
    return this.isOnline ? 'online' : 'offline';
  }
}

export default new OnlineDetector();
```

---

## 🎯 Cas d'usage E-commerce

### 1. Browsing Produits (Hors Ligne)

```javascript
// resources/js/Services/ProductService.js

async function getProducts(category) {
  try {
    // Essayer le réseau d'abord
    const response = await fetch(`/api/products?category=${category}`);
    const products = await response.json();
    
    // Mettre en cache
    await OfflineDB.saveProducts(products);
    return products;
  } catch (error) {
    // Fallback au cache local
    console.log('Fallback to cache');
    return await OfflineDB.getProducts(category);
  }
}
```

### 2. Panier (Online + Offline)

```javascript
async function addToCart(productId, quantity) {
  const product = await OfflineDB.getProduct(productId);
  
  if (!product) {
    throw new Error('Product not found');
  }

  const item = {
    productId,
    quantity,
    price: product.price,
    name: product.name,
    addedAt: Date.now(),
  };

  // Ajouter au panier local
  await OfflineDB.addToCart(item);

  // Essayer de synchroniser immédiatement si online
  if (navigator.onLine) {
    try {
      await fetch('/api/cart/add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(item),
      });
    } catch (error) {
      // Garder en pending si erreur
      console.log('Cart item queued for sync');
    }
  } else {
    // Mettre en attente si offline
    await OfflineDB.addPending({
      type: 'add-to-cart',
      data: item,
    });
  }
}
```

### 3. Commande (Offline with Queuing)

```javascript
async function placeOrder(cartItems, shippingAddress) {
  const order = {
    id: Date.now(),
    items: cartItems,
    shippingAddress,
    status: 'pending',
    placedAt: new Date().toISOString(),
  };

  if (navigator.onLine) {
    // Envoyer directement
    try {
      const response = await fetch('/api/orders', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(order),
      });
      
      if (response.ok) {
        await OfflineDB.clearCart();
        return response.json();
      }
    } catch (error) {
      // Fallback au stockage local
      await OfflineDB.saveOrder(order);
      throw new Error('Order saved locally, will sync when online');
    }
  } else {
    // Sauvegarder localement
    await OfflineDB.saveOrder(order);
    
    // Demander la synchronisation en arrière-plan
    if ('serviceWorker' in navigator && 'SyncManager' in window) {
      try {
        const registration = await navigator.serviceWorker.ready;
        await registration.sync.register('sync-order');
      } catch (error) {
        console.error('Background sync not available');
      }
    }

    return {
      success: true,
      message: 'Order saved locally and will be submitted when online',
      orderId: order.id,
    };
  }
}
```

---

## 📱 Page Offline

```html
<!-- public/offline.html -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mode Hors Ligne - NoflayHub</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto';
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .icon {
            font-size: 80px;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .features {
            text-align: left;
            background: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .features li {
            list-style: none;
            padding: 10px 0;
            color: #555;
        }
        .features li:before {
            content: "✓ ";
            color: #667eea;
            font-weight: bold;
            margin-right: 10px;
        }
        .button {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 40px;
            border-radius: 25px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .button:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">📴</div>
        <h1>Mode Hors Ligne</h1>
        <p>Vous êtes actuellement hors ligne, mais vous pouvez continuer à utiliser NoflayHub!</p>
        
        <div class="features">
            <ul>
                <li>Consulter les produits en cache</li>
                <li>Ajouter des articles au panier</li>
                <li>Voir vos favoris</li>
                <li>Consulter vos commandes précédentes</li>
            </ul>
        </div>

        <p style="font-size: 14px; color: #999;">
            Les données se synchroniseront automatiquement quand la connexion reviendra.
        </p>

        <a href="/" class="button">Retourner à l'accueil</a>
    </div>

    <script>
        // Attendre la reconnexi on
        window.addEventListener('online', () => {
            document.body.style.opacity = '0.5';
            document.body.innerHTML = '<div style="text-align:center; margin-top:50px;"><h1>✓ Reconnecté!</h1><p>Redirection en cours...</p></div>';
            setTimeout(() => location.reload(), 1500);
        });
    </script>
</body>
</html>
```

---

## 🚀 Performance

### TTL (Time To Live)

```javascript
// Garder les données fraîches
const CACHE_TTL = {
  products: 24 * 60 * 60 * 1000,      // 24 heures
  categories: 7 * 24 * 60 * 60 * 1000, // 7 jours
  cart: 30 * 60 * 1000,               // 30 minutes
  orders: 'forever',                  // Pas d'expiration
};
```

### Limites de Stockage

```javascript
// Vérifier l'espace disponible
async function checkStorageQuota() {
  if (navigator.storage && navigator.storage.estimate) {
    const estimate = await navigator.storage.estimate();
    const percentUsed = (estimate.usage / estimate.quota) * 100;
    console.log(`Storage: ${percentUsed.toFixed(2)}% used`);
    return percentUsed < 90;
  }
  return true;
}
```

---

## 🔐 Sécurité

### 1. Ne pas Cacher les Données Sensibles

```javascript
// ❌ MAUVAIS
await OfflineDB.saveProducts({
  ...product,
  userPasswords: [...],  // ❌ JAMAIS!
});

// ✅ BON
await OfflineDB.saveProducts({
  id: product.id,
  name: product.name,
  price: product.price,
  // Pas de données sensibles
});
```

### 2. Persister les Données en Toute Sécurité

```javascript
// Demander la permission de persister
async function persistData() {
  if (navigator.storage && navigator.storage.persist) {
    const persistent = await navigator.storage.persist();
    console.log('Data persistence:', persistent ? 'granted' : 'denied');
  }
}
```

### 3. Valider les Données Synchronisées

```javascript
// Toujours valider côté serveur
app.post('/api/orders', middleware.auth, (req, res) => {
  const { items, shippingAddress } = req.body;
  
  // Valider chaque item
  for (const item of items) {
    // Vérifier que le prix n'a pas changé
    const dbPrice = Product.find(item.productId).price;
    if (item.price !== dbPrice) {
      return res.status(400).json({ error: 'Price mismatch' });
    }
  }
  
  // Créer la commande
  Order.create({ ...req.body, userId: req.user.id });
});
```

---

## 🎯 Résumé des Avantages

✅ **Expérience utilisateur améliorée**
- Fonctionne hors ligne
- Chargement plus rapide (cache)
- Pas d'interruption de service

✅ **Fidélité client**
- Utilisateurs peuvent continuer à naviguer
- Pas de frustration dues à la connexion perdue
- Synchronisation transparente

✅ **Performance**
- Réduction de la charge serveur (cache)
- Moins de requêtes réseau
- Temps de réponse plus rapide

✅ **Monétisation**
- Plus d'achats complétés
- Moins d'abandon de panier
- Meilleur taux de conversion

---

## 📚 Ressources

- [MDN - Service Workers](https://developer.mozilla.org/en-US/docs/Web/API/Service_Worker_API)
- [MDN - IndexedDB](https://developer.mozilla.org/en-US/docs/Web/API/IndexedDB_API)
- [Web.dev - Offline](https://web.dev/reliable/)
- [PWA Checklist](https://web.dev/pwa-checklist/)

---

**Votre e-commerce peut maintenant offrir une expérience premium hors ligne! 🚀**

