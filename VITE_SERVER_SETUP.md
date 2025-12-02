# 🚀 Configuration du serveur Vite

**Date**: 2 Décembre 2025  
**Status**: ✅ **GUIDE SETUP**

---

## 🐛 Le Problème

```
Uncaught (in promise) TypeError: Failed to fetch dynamically imported module: 
http://127.0.0.1:5173/resources/js/Pages/Auth/ResetPassword.vue
```

### Cause
Le serveur Vite ne tourne pas. Laravel essaie de charger les assets depuis Vite mais le serveur est arrêté.

---

## ✅ La Solution

### Vous avez besoin de 2 serveurs en cours d'exécution

```
Terminal 1: Serveur Laravel (port 8000)
Terminal 2: Serveur Vite (port 5173)
```

---

## 🚀 Comment démarrer

### Option 1 : Deux terminaux séparés

#### Terminal 1 - Serveur Laravel
```bash
cd /home/fdaelhack/colobane
php artisan serve
```
✅ Accès: `http://127.0.0.1:8000`

#### Terminal 2 - Serveur Vite
```bash
cd /home/fdaelhack/colobane
npm run dev
```
✅ Accès: `http://127.0.0.1:5173`

### Option 2 : Concurrent (dans un seul terminal)

Installer concurrently si ce n'est pas fait:
```bash
npm install --save-dev concurrently
```

Ajouter dans `package.json`:
```json
{
  "scripts": {
    "dev": "concurrently \"php artisan serve\" \"npm run dev:vite\"",
    "dev:vite": "vite"
  }
}
```

Puis démarrer:
```bash
npm run dev
```

### Option 3 : Sail (si utilisant Docker)

```bash
./vendor/bin/sail up
./vendor/bin/sail npm run dev
```

---

## 🔍 Vérification

### Vérifier que Vite tourne
1. Ouvrir `http://127.0.0.1:5173` dans le navigateur
2. Vous devriez voir une page ou une erreur (mais le serveur répond)

### Vérifier que Laravel tourne
1. Ouvrir `http://127.0.0.1:8000` dans le navigateur
2. Vous devriez voir l'accueil de NoflayHub

### Vérifier les assets
Ouvrir `http://127.0.0.1:5173/resources/js/Pages/Auth/ResetPassword.vue`
- ✅ Si le serveur Vite tourne: vous verrez le contenu Vue
- ❌ Si pas de réponse: Vite ne tourne pas

---

## 📊 Architecture

```
Browser (http://localhost:8000)
    ↓
Laravel Application
    ↓
HTML rendu par Blade/Inertia
    ↓
<script src="http://localhost:5173/@vite/client"></script>
    ↓
Vite Dev Server (http://localhost:5173)
    ↓
Assets (JS, CSS, Vue components)
```

---

## ⚠️ Erreurs courantes

### Erreur: Port 8000 déjà utilisé
```bash
# Utiliser un autre port
php artisan serve --port=8001
```

### Erreur: Port 5173 déjà utilisé
```bash
# Utiliser un autre port
npm run dev -- --port 3000
```

### Erreur: Failed to fetch module
- ❌ Vite ne tourne pas
- ✅ Solution: Démarrer Vite dans Terminal 2

### Erreur: Module not found
- ✅ Vite tourne mais ne peut pas trouver le fichier
- ✅ Vérifier le chemin du fichier
- ✅ Vérifier la configuration vite.config.js

---

## 📝 Commandes utiles

```bash
# Démarrer Vite en développement
npm run dev

# Build pour production
npm run build

# Preview de la build production
npm run preview

# Linter + formatteur
npm run lint
npm run format

# Vider le cache Vite
rm -rf node_modules/.vite
```

---

## 🎯 Flux de développement

```
1. Ouvrir Terminal 1
   cd /home/fdaelhack/colobane
   php artisan serve
   ✅ Attendre: "Server running on..."

2. Ouvrir Terminal 2
   cd /home/fdaelhack/colobane
   npm run dev
   ✅ Attendre: "Local:   http://localhost:5173"

3. Dans le navigateur
   Aller à: http://localhost:8000
   ✅ Les assets se chargent depuis Vite

4. Modifier le code Vue
   ✅ Rechargement automatique (HMR)

5. Pour arrêter
   Terminal 1: Ctrl+C
   Terminal 2: Ctrl+C
```

---

## 🔧 Configuration Vite

### vite.config.js
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        host: '127.0.0.1',
        port: 5173,
    },
});
```

---

## ✅ Checklist

- [ ] Node.js et npm installés (`node -v`, `npm -v`)
- [ ] Dependencies installées (`npm install`)
- [ ] PHP et Laravel installés (`php -v`)
- [ ] Composer dependencies installées (`composer install`)
- [ ] Terminal 1: `php artisan serve` en cours
- [ ] Terminal 2: `npm run dev` en cours
- [ ] http://localhost:8000 accessible
- [ ] http://localhost:5173 accessible
- [ ] Assets se chargent correctement
- [ ] HMR fonctionne (hot reload)

---

## 🚀 Production

En production, vous devez builder les assets:

```bash
npm run build
```

Cela génère:
```
public/build/
  ├── manifest.json
  ├── assets/
  │   ├── app.xxxx.js
  │   ├── app.xxxx.css
  │   └── ...
```

Laravel les sert automatiquement sans Vite.

---

**Version**: 1.0  
**Date**: 2 Décembre 2025  
**Status**: ✅ **GUIDE DE CONFIGURATION**

Une fois les deux serveurs lancés, tout fonctionnera parfaitement! 🚀

