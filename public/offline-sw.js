/**
 * Service Worker - Gestion du mode offline
 * Intercepte les requêtes et fournit du cache quand offline
 */

const CACHE_NAME = 'noflayhub-v1';
const API_CACHE = 'noflayhub-api-v1';
const OFFLINE_FALLBACK = '/offline.html';

// Assets critiques à mettre en cache à l'installation
const CRITICAL_ASSETS = [
  '/',
  '/offline.html',
  '/manifest.json',
  '/logo.png',
];

/**
 * Installation - Mettre en cache les assets critiques
 */
self.addEventListener('install', (event) => {
  console.log('🔧 Service Worker installing...');
  
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log('📦 Caching critical assets');
      return cache.addAll(CRITICAL_ASSETS).catch((err) => {
        console.warn('Some assets failed to cache:', err);
        // Ne pas échouer l'installation si quelques assets ne peuvent pas être cachés
      });
    })
  );
  
  self.skipWaiting();
});

/**
 * Activation - Nettoyer les anciens caches
 */
self.addEventListener('activate', (event) => {
  console.log('⚙️ Service Worker activating...');
  
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames
          .filter((name) => name !== CACHE_NAME && name !== API_CACHE)
          .map((name) => {
            console.log('🗑️ Deleting old cache:', name);
            return caches.delete(name);
          })
      );
    })
  );
  
  self.clients.claim();
});

/**
 * Fetch - Stratégies de cache
 */
self.addEventListener('fetch', (event) => {
  const { request } = event;
  const url = new URL(request.url);

  // Ignorer les requêtes non-GET
  if (request.method !== 'GET') {
    return;
  }

  // ===== ASSETS STATIQUES (CSS, JS, Images, Fonts) =====
  if (
    request.destination === 'style' ||
    request.destination === 'script' ||
    request.destination === 'image' ||
    request.destination === 'font' ||
    url.pathname.includes('/build/')
  ) {
    event.respondWith(
      caches.match(request).then((response) => {
        if (response) {
          console.log('✓ Served from cache:', url.pathname);
          return response;
        }

        return fetch(request).then((res) => {
          // Cache successful responses
          if (res && res.status === 200) {
            const cloned = res.clone();
            caches.open(CACHE_NAME).then((cache) => {
              cache.put(request, cloned);
            });
          }
          return res;
        }).catch(() => {
          // Return placeholder for failed assets
          if (request.destination === 'image') {
            return new Response(
              '<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"><rect fill="#f0f0f0" width="100" height="100"/></svg>',
              { headers: { 'Content-Type': 'image/svg+xml' } }
            );
          }
          return caches.match(OFFLINE_FALLBACK);
        });
      })
    );
  }

  // ===== API CALLS (Network First, Cache Fallback) =====
  else if (url.pathname.startsWith('/api/')) {
    event.respondWith(
      fetch(request)
        .then((response) => {
          // Cache successful responses
          if (response && response.status === 200) {
            const cloned = response.clone();
            caches.open(API_CACHE).then((cache) => {
              cache.put(request, cloned);
            });
          }
          return response;
        })
        .catch(() => {
          console.log('📡 Offline - returning cached API:', url.pathname);
          
          // Return cached response if offline
          return caches.match(request).then((response) => {
            if (response) {
              return response;
            }

            // Return mock error for offline
            return new Response(
              JSON.stringify({
                error: 'offline',
                message: 'Vous êtes actuellement hors ligne',
              }),
              {
                status: 503,
                statusText: 'Service Unavailable',
                headers: new Headers({ 'Content-Type': 'application/json' }),
              }
            );
          });
        })
    );
  }

  // ===== HTML PAGES (Stale While Revalidate) =====
  else if (request.mode === 'navigate') {
    event.respondWith(
      fetch(request)
        .then((response) => {
          // Cache successful responses
          if (response && response.status === 200) {
            const cloned = response.clone();
            caches.open(CACHE_NAME).then((cache) => {
              cache.put(request, cloned);
            });
          }
          return response;
        })
        .catch(() => {
          console.log('📴 Offline - returning cached page or offline page');
          
          // Return cached page
          return caches.match(request).then((response) => {
            if (response) {
              return response;
            }
            
            // Return offline page
            return caches.match(OFFLINE_FALLBACK);
          });
        })
    );
  }

  // ===== AUTRES REQUÊTES =====
  else {
    event.respondWith(
      caches.match(request).then((response) => {
        return response || fetch(request);
      })
    );
  }
});

/**
 * Background Sync - Synchroniser quand reconnecté
 */
self.addEventListener('sync', (event) => {
  console.log('🔄 Background sync triggered:', event.tag);
  
  if (event.tag === 'sync-offline-data') {
    event.waitUntil(syncOfflineData());
  }
});

async function syncOfflineData() {
  try {
    // Notifier le client de démarrer la sync
    const clients = await self.clients.matchAll();
    clients.forEach((client) => {
      client.postMessage({
        type: 'SYNC_START',
        message: 'Starting background sync',
      });
    });

    console.log('✅ Background sync completed');

    // Notifier la fin
    clients.forEach((client) => {
      client.postMessage({
        type: 'SYNC_COMPLETE',
        message: 'Background sync completed',
      });
    });
  } catch (error) {
    console.error('Background sync error:', error);
  }
}

/**
 * Message Handler - Recevoir les messages des clients
 */
self.addEventListener('message', (event) => {
  console.log('📨 Service Worker received message:', event.data);
  
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
  
  if (event.data && event.data.type === 'CLEAR_CACHE') {
    caches.delete(API_CACHE);
    event.ports[0].postMessage({ success: true });
  }
});

console.log('✅ Offline Service Worker loaded');

