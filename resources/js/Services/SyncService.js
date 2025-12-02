/**
 * Service SyncService - Synchronise les données hors ligne avec le serveur
 */

import OfflineDB from './OfflineDB';
import OnlineDetector from './OnlineDetector';

class SyncService {
  constructor() {
    this.isSyncing = false;
    this.syncListeners = [];
  }

  /**
   * Synchroniser toutes les données
   */
  async syncAll() {
    if (this.isSyncing || !OnlineDetector.isConnected()) {
      console.log('⏸ Sync skipped (already syncing or offline)');
      return;
    }

    this.isSyncing = true;
    this.notifySyncStatus('syncing');
    
    console.log('🔄 Syncing all data...');
    
    try {
      await this.syncCart();
      await this.syncOrders();
      await this.syncFavorites();
      await this.syncPendingRequests();
      
      console.log('✅ Sync completed successfully');
      this.notifySyncStatus('completed');
      window.dispatchEvent(new CustomEvent('app:sync-complete'));
    } catch (error) {
      console.error('❌ Sync error:', error);
      this.notifySyncStatus('error');
      window.dispatchEvent(new CustomEvent('app:sync-error', { detail: { error } }));
    } finally {
      this.isSyncing = false;
    }
  }

  /**
   * Synchroniser le panier
   */
  async syncCart() {
    try {
      const cart = await OfflineDB.getCart();
      
      if (cart.length === 0) return;

      console.log(`📦 Syncing ${cart.length} cart items...`);

      for (const item of cart) {
        if (!item.synced) {
          try {
            const response = await fetch('/api/cart/add', {
              method: 'POST',
              headers: { 
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
              },
              body: JSON.stringify({
                product_id: item.productId,
                quantity: item.quantity,
              }),
            });
            
            if (response.ok) {
              await OfflineDB.removeFromCart(item.id);
              console.log(`✓ Cart item synced: ${item.productId}`);
            }
          } catch (error) {
            console.error('Cart item sync error:', error);
          }
        }
      }
    } catch (error) {
      console.error('Cart sync error:', error);
    }
  }

  /**
   * Synchroniser les commandes
   */
  async syncOrders() {
    try {
      const orders = await OfflineDB.getOrders();
      
      if (orders.length === 0) return;

      console.log(`📋 Syncing ${orders.length} orders...`);

      for (const order of orders) {
        if (!order.synced) {
          try {
            const response = await fetch('/api/orders', {
              method: 'POST',
              headers: { 
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
              },
              body: JSON.stringify(order),
            });
            
            if (response.ok) {
              order.synced = true;
              order.status = 'confirmed';
              await OfflineDB.saveOrder(order);
              console.log(`✓ Order synced: ${order.id}`);
            }
          } catch (error) {
            console.error('Order sync error:', error);
          }
        }
      }
    } catch (error) {
      console.error('Orders sync error:', error);
    }
  }

  /**
   * Synchroniser les favoris
   */
  async syncFavorites() {
    try {
      const favorites = await OfflineDB.getFavorites();
      
      if (favorites.length === 0) return;

      console.log(`❤️ Syncing ${favorites.length} favorites...`);

      try {
        const response = await fetch('/api/favorites/sync', {
          method: 'POST',
          headers: { 
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
          body: JSON.stringify({ 
            favorites: favorites.map(f => f.id) 
          }),
        });

        if (response.ok) {
          console.log(`✓ Favorites synced`);
        }
      } catch (error) {
        console.error('Favorites sync error:', error);
      }
    } catch (error) {
      console.error('Getting favorites error:', error);
    }
  }

  /**
   * Synchroniser les requêtes en attente
   */
  async syncPendingRequests() {
    try {
      const pending = await OfflineDB.getPending();
      
      if (pending.length === 0) return;

      console.log(`⏳ Syncing ${pending.length} pending requests...`);

      for (const item of pending) {
        try {
          // Traiter selon le type
          switch (item.type) {
            case 'add-to-cart':
              await this.syncCartItem(item.data);
              break;
            case 'add-favorite':
              await this.syncFavorite(item.data);
              break;
            case 'place-order':
              await this.syncOrder(item.data);
              break;
            default:
              console.log(`Unknown pending type: ${item.type}`);
          }
          
          await OfflineDB.removePending(item.id);
        } catch (error) {
          console.error(`Error syncing pending ${item.type}:`, error);
        }
      }
    } catch (error) {
      console.error('Pending sync error:', error);
    }
  }

  /**
   * Synchroniser un article du panier
   */
  async syncCartItem(data) {
    const response = await fetch('/api/cart/add', {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
      },
      body: JSON.stringify(data),
    });
    
    if (!response.ok) throw new Error('Failed to sync cart item');
    console.log(`✓ Pending cart item synced`);
  }

  /**
   * Synchroniser un favori
   */
  async syncFavorite(data) {
    const response = await fetch('/api/favorites/add', {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
      },
      body: JSON.stringify(data),
    });
    
    if (!response.ok) throw new Error('Failed to sync favorite');
    console.log(`✓ Pending favorite synced`);
  }

  /**
   * Synchroniser une commande
   */
  async syncOrder(data) {
    const response = await fetch('/api/orders', {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
      },
      body: JSON.stringify(data),
    });
    
    if (!response.ok) throw new Error('Failed to sync order');
    console.log(`✓ Pending order synced`);
  }

  /**
   * Charger et mettre en cache les données
   */
  async fetchAndCache() {
    try {
      console.log('📥 Fetching and caching data...');

      // Fetch products
      const productsResponse = await fetch('/api/products');
      if (productsResponse.ok) {
        const products = await productsResponse.json();
        await OfflineDB.saveProducts(products.data || products);
        console.log(`✓ ${products.length || 0} products cached`);
      }

      // Fetch categories
      const categoriesResponse = await fetch('/api/categories');
      if (categoriesResponse.ok) {
        const categories = await categoriesResponse.json();
        await OfflineDB.saveCategories(categories.data || categories);
        console.log(`✓ Categories cached`);
      }
    } catch (error) {
      console.error('Fetch and cache error:', error);
    }
  }

  /**
   * S'abonner aux changements de sync
   */
  onSyncStatusChange(callback) {
    this.syncListeners.push(callback);
    // Appeler immédiatement
    callback(this.isSyncing ? 'syncing' : 'idle');
    
    return () => {
      this.syncListeners = this.syncListeners.filter(l => l !== callback);
    };
  }

  /**
   * Notifier du changement de statut
   */
  notifySyncStatus(status) {
    this.syncListeners.forEach(listener => {
      try {
        listener(status);
      } catch (error) {
        console.error('Sync listener error:', error);
      }
    });
  }

  /**
   * Obtenir le statut de sync
   */
  isSyncInProgress() {
    return this.isSyncing;
  }
}

export default new SyncService();

