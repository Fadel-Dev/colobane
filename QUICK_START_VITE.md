# ⚡ Quick Start - Serveurs Vite + Laravel

**Tl;dr** - Démarrer rapidement les 2 serveurs

---

## 🚀 Démarrage rapide

### Étape 1: Ouvrir Terminal 1
```bash
cd /home/fdaelhack/colobane
php artisan serve
```

Vous devriez voir:
```
INFO  Server running on [http://127.0.0.1:8000].
```

### Étape 2: Ouvrir Terminal 2 (NOUVEAU TERMINAL)
```bash
cd /home/fdaelhack/colobane
npm run dev
```

Vous devriez voir:
```
  VITE v5.0.0  ready in 234 ms

  ➜  Local:   http://127.0.0.1:5173/
  ➜  press h + enter to show help
```

### Étape 3: Aller à http://localhost:8000

✅ Terminé! Maintenant tout fonctionne

---

## 🔴 Si ça ne marche pas

### Erreur: Cannot find module 'vite'
```bash
npm install
npm run dev
```

### Erreur: Port 8000 occupé
```bash
php artisan serve --port=8001
```

### Erreur: Port 5173 occupé
```bash
npm run dev -- --port 3000
```

### Erreur: page vide/blanche
- ✅ Vérifier que les 2 serveurs tournent
- ✅ Ouvrir la console (F12)
- ✅ Chercher les erreurs rouges

---

## 🎯 Ce qui devrait se passer

```
Terminal 1: Laravel prêt
Terminal 2: Vite prêt
Browser: Vous accédez à http://localhost:8000
    ↓
Laravel charge la page
    ↓
Assets chargés depuis Vite (http://localhost:5173)
    ↓
Page fonctionne avec HMR (rechargement automatique)
```

---

## 📱 Tester la réinitialisation

1. Aller à `http://localhost:8000/forgot-password`
2. Saisir un email
3. Vérifier l'email dans Mailtrap
4. Cliquer le lien
5. Voir le formulaire magnifique ✅

---

## ⏹️ Arrêter

```bash
Terminal 1: Ctrl+C
Terminal 2: Ctrl+C
```

---

**C'est tout!** 🎉

Vous avez maintenant les 2 serveurs en cours d'exécution et tout fonctionne parfaitement!

