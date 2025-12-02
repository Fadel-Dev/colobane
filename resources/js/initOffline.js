/**
 * Initialiser le mode offline
 * À importer dans app.js
 */

import OfflineDB from './Services/OfflineDB';
import OnlineDetector from './Services/OnlineDetector';
import SyncService from './Services/SyncService';

/**
 * Initialiser tous les services offline
 */
export async function initOfflineMode() {
  console.log('🚀 Initializing offline mode...');

  try {
    // 1. Initialiser la base de données
    await OfflineDB.init();

    // 2. Écouter les changements de connexion
    OnlineDetector.subscribe((status) => {
      console.log(`📡 Connection status: ${status}`);
      
      // Synchroniser quand reconnecté
      if (status === 'online') {
        console.log('🔄 Triggering sync...');
        SyncService.syncAll();
      }
    });

    // 3. Demander la permission de persister
    const persistent = await OfflineDB.persistData();
    console.log(`💾 Data persistence: ${persistent ? 'enabled' : 'not available'}`);

    // 4. Récupérer et mettre en cache les données
    if (navigator.onLine) {
      await SyncService.fetchAndCache();
    }

    // 5. Ajouter des événements globaux
    window.OfflineMode = {
      OfflineDB,
      OnlineDetector,
      SyncService,
      isOffline: () => !OnlineDetector.isConnected(),
      isOnline: () => OnlineDetector.isConnected(),
      syncNow: () => SyncService.syncAll(),
    };

    console.log('✅ Offline mode initialized');
    console.log('📱 Global OfflineMode available: window.OfflineMode');

  } catch (error) {
    console.error('❌ Failed to initialize offline mode:', error);
  }
}

/**
 * Hook pour Vue components
 * Usage: import { useOffline } from '@/initOffline'
 *        const { isOffline, syncNow } = useOffline()
 */
export function useOffline() {
  return {
    isOffline: () => !OnlineDetector.isConnected(),
    isOnline: () => OnlineDetector.isConnected(),
    syncNow: () => SyncService.syncAll(),
    isSyncing: () => SyncService.isSyncInProgress(),
    onStatusChange: (callback) => OnlineDetector.subscribe(callback),
    onSyncChange: (callback) => SyncService.onSyncStatusChange(callback),
  };
}

export { OfflineDB, OnlineDetector, SyncService };

