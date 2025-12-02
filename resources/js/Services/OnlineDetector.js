/**
 * Service OnlineDetector - Détecte l'état de la connexion réseau
 */

class OnlineDetector {
  constructor() {
    this.isOnline = navigator.onLine;
    this.listeners = [];
    this.initialized = false;
    
    this.init();
  }

  init() {
    if (this.initialized) return;

    window.addEventListener('online', () => this.handleOnline());
    window.addEventListener('offline', () => this.handleOffline());
    
    // Vérifier périodiquement si online
    setInterval(() => this.checkConnection(), 5000);
    
    this.initialized = true;
    console.log('✓ OnlineDetector initialized');
  }

  handleOnline() {
    if (!this.isOnline) {
      console.log('🌐 Back online!');
      this.isOnline = true;
      this.notify('online');
      
      // Émettre événement personnalisé
      window.dispatchEvent(new CustomEvent('app:online', { 
        detail: { timestamp: Date.now() } 
      }));
    }
  }

  handleOffline() {
    if (this.isOnline) {
      console.log('📴 Now offline');
      this.isOnline = false;
      this.notify('offline');
      
      // Émettre événement personnalisé
      window.dispatchEvent(new CustomEvent('app:offline', { 
        detail: { timestamp: Date.now() } 
      }));
    }
  }

  /**
   * Vérifier la connexion réelle
   */
  async checkConnection() {
    try {
      const response = await fetch('/ping', { 
        method: 'HEAD',
        cache: 'no-store',
      });
      
      if (response.ok && !this.isOnline) {
        this.handleOnline();
      }
    } catch (error) {
      if (this.isOnline) {
        this.handleOffline();
      }
    }
  }

  /**
   * S'abonner aux changements d'état
   */
  subscribe(callback) {
    this.listeners.push(callback);
    // Appeler immédiatement avec l'état actuel
    callback(this.getStatus());
    
    // Retourner une fonction pour se désabonner
    return () => {
      this.listeners = this.listeners.filter(l => l !== callback);
    };
  }

  /**
   * Notifier tous les listeners
   */
  notify(status) {
    this.listeners.forEach(listener => {
      try {
        listener(status);
      } catch (error) {
        console.error('Listener error:', error);
      }
    });
  }

  /**
   * Obtenir le statut actuel
   */
  getStatus() {
    return this.isOnline ? 'online' : 'offline';
  }

  /**
   * Obtenir un boolean
   */
  isConnected() {
    return this.isOnline;
  }
}

export default new OnlineDetector();

