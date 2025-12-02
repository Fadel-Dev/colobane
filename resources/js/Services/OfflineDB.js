/**
 * Service OfflineDB - Base de données locale avec IndexedDB
 * Permet le stockage de produits, panier, favoris, commandes hors ligne
 */

class OfflineDB {
  constructor() {
    this.db = null;
    this.dbName = 'NoflayHub_Offline';
    this.version = 1;
  }

  /**
   * Initialiser la base de données
   */
  async init() {
    return new Promise((resolve, reject) => {
      const request = indexedDB.open(this.dbName, this.version);

      request.onerror = () => reject(request.error);
      request.onsuccess = () => {
        this.db = request.result;
        console.log('✓ OfflineDB initialized');
        resolve();
      };

      request.onupgradeneeded = (event) => {
        const db = event.target.result;

        // Store pour les produits
        if (!db.objectStoreNames.contains('products')) {
          const store = db.createObjectStore('products', { keyPath: 'id' });
          store.createIndex('category', 'category', { unique: false });
          store.createIndex('timestamp', 'timestamp', { unique: false });
        }

        // Store pour les catégories
        if (!db.objectStoreNames.contains('categories')) {
          db.createObjectStore('categories', { keyPath: 'id' });
        }

        // Store pour les favoris
        if (!db.objectStoreNames.contains('favorites')) {
          db.createObjectStore('favorites', { keyPath: 'id' });
        }

        // Store pour le panier
        if (!db.objectStoreNames.contains('cart')) {
          db.createObjectStore('cart', { keyPath: 'id', autoIncrement: true });
        }

        // Store pour les commandes
        if (!db.objectStoreNames.contains('orders')) {
          db.createObjectStore('orders', { keyPath: 'id' });
        }

        // Store pour les données en attente de sync
        if (!db.objectStoreNames.contains('pending')) {
          db.createObjectStore('pending', { keyPath: 'id', autoIncrement: true });
        }

        console.log('✓ Database schema created');
      };
    });
  }

  /**
   * Produits
   */
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

  async searchProducts(query) {
    const products = await this.getProducts();
    const lowerQuery = query.toLowerCase();
    
    return products.filter(p => 
      p.nom?.toLowerCase().includes(lowerQuery) ||
      p.description?.toLowerCase().includes(lowerQuery)
    );
  }

  /**
   * Catégories
   */
  async saveCategories(categories) {
    const tx = this.db.transaction(['categories'], 'readwrite');
    const store = tx.objectStore('categories');
    
    for (const category of categories) {
      store.put(category);
    }
    
    return new Promise((resolve, reject) => {
      tx.oncomplete = () => resolve();
      tx.onerror = () => reject(tx.error);
    });
  }

  async getCategories() {
    const tx = this.db.transaction(['categories'], 'readonly');
    const store = tx.objectStore('categories');

    return new Promise((resolve, reject) => {
      const request = store.getAll();
      request.onsuccess = () => resolve(request.result);
      request.onerror = () => reject(request.error);
    });
  }

  /**
   * Panier
   */
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

  /**
   * Favoris
   */
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

  async isFavorite(id) {
    const favorites = await this.getFavorites();
    return favorites.some(f => f.id === id);
  }

  /**
   * Commandes
   */
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

  /**
   * Données en attente
   */
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

  /**
   * Obtenir la taille du stockage
   */
  async getStorageInfo() {
    if (navigator.storage && navigator.storage.estimate) {
      return await navigator.storage.estimate();
    }
    return null;
  }

  /**
   * Persister les données
   */
  async persistData() {
    if (navigator.storage && navigator.storage.persist) {
      return await navigator.storage.persist();
    }
    return false;
  }
}

export default new OfflineDB();

