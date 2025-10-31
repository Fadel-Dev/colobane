# 🚀 GUIDE RAPIDE - COLOBANE

## 📌 Démarrage rapide

```bash
# 1. Installer les dépendances
composer install --ignore-platform-reqs
npm install

# 2. Configuration
cp .env.example .env
php artisan key:generate

# 3. Database
php artisan migrate --seed

# 4. Lancer l'app
php artisan serve              # Port 8001
npm run dev                    # Port 5175
```

## 🎯 Points clés en 60 secondes

| Aspect | Détail |
|--------|--------|
| **Langage** | PHP 8.4 + Vue.js 3 |
| **Framework** | Laravel 10 + Inertia.js |
| **BD** | MySQL/MariaDB |
| **Auth** | Jetstream + Sanctum |
| **CSS** | Tailwind CSS |
| **Statut** | ✅ Fonctionnel |

## 📂 Structure de dossiers clés

```
app/
├── Http/Controllers/      ← Contrôleurs (9 fichiers)
├── Models/                ← Modèles (25 fichiers)
└── Actions/               ← Actions Jetstream

resources/
├── js/
│   ├── Pages/            ← Pages Vue (22)
│   ├── Components/       ← Composants (30+)
│   └── Layouts/          ← Layouts (3)
└── css/app.css           ← Tailwind styles

routes/
└── web.php               ← Routes (45+)

database/
├── migrations/           ← 16 migrations
├── factories/            ← Factories
└── seeders/              ← Seeders
```

## 🛣️ Routes principales

### Public
- `GET /` - Accueil
- `GET /p/{section}` - Articles
- `GET /publication/{article}` - Détail article
- `GET /detail/{id}` - Détail immobilier
- `GET /detailVehi/{id}` - Détail véhicule

### Authentifiées
- `GET /dashboard` - Dashboard
- `GET /publier` - Publier annonce

### Admin
- `GET /users/u/1` - Gestion utilisateurs
- `GET /statusImmobilier/{id}` - Détails immo
- `GET /statusVehicule/{id}` - Détails véhicule

## 🎮 Pages Vue principales

| Page | URL | Fonction |
|------|-----|----------|
| Welcome.vue | / | Accueil |
| Dashboard.vue | /dashboard | Dashboard user |
| DashboardAdmin.vue | /users/u/1 | Admin panel |
| Publier.vue | /publier | Créer annonce |
| DetailsImmo.vue | /detail/{id} | Détail bien |
| DetailsVehicule.vue | /detailVehi/{id} | Détail véhicule |

## 🔐 Authentification

**Stack:**
- Jetstream (Auth UI)
- Sanctum (API Tokens)
- Fortify (Auth Logic)

**Middleware:**
```php
'auth:sanctum'                    // Authentification
config('jetstream.auth_session')  // Session
'verified'                        // Email vérifié
```

## 🎨 Couleurs Tailwind

```javascript
principal:    #eb2d53  // Rouge/Rose (primaire)
troisieme:    #FC9918  // Orange (accent)
secondaire:   #101634  // Bleu foncé (fond)
```

## 🐛 Dépannage courant

### Le serveur ne démarre pas
```bash
php artisan cache:clear
php artisan config:clear
php artisan serve
```

### Erreurs de dépendances
```bash
composer install --ignore-platform-reqs
npm install
npm run dev
```

### Problèmes de base de données
```bash
php artisan migrate:refresh --seed
```

### Vite ne compile pas
```bash
rm -rf node_modules
npm install
npm run dev
```

## 📊 Modèles importants

```
User ────┬──→ Team (Jetstream)
         ├──→ Immobiliers
         ├──→ Voitures
         └──→ Voiturelocation

Immobiliers ──→ ImageSons
Voitures ─────→ ImageSons
```

## 🔍 Fichiers importants à connaître

```
config/
├── app.php              ← Configuration générale
├── auth.php             ← Config authentification
├── jetstream.php        ← Config Jetstream
└── database.php         ← Config BD

app/Http/
├── Kernel.php           ← Middleware global
├── Controllers/         ← Contrôleurs
└── Middleware/          ← Middlewares custom

resources/js/
├── app.js               ← Point d'entrée
├── bootstrap.js         ← Bootstrap Inertia
└── Pages/               ← Pages Vue
```

## 📱 Composants réutilisables

```vue
<!-- Formulaires -->
<TextInput />
<Checkbox />
<InputLabel />
<InputError />

<!-- Boutons -->
<PrimaryButton />
<SecondaryButton />
<DangerButton />

<!-- Navigation -->
<Navbar />
<NavLink />
<Dropdown />

<!-- Layouts -->
<AppLayout />
<AuthenticationCard />
```

## ⚡ Performance tips

1. **Lazy loading des images**
```vue
<img loading="lazy" />
```

2. **Pagination des listes**
```php
$items = Model::paginate(20);
```

3. **Eager loading**
```php
Model::with('relations')->get();
```

4. **Caching**
```php
Cache::remember('key', 3600, fn() => Model::all());
```

## 🧪 Commands utiles

```bash
# Artisan
php artisan tinker                    # Shell PHP interactif
php artisan make:model NomModel       # Créer un modèle
php artisan make:controller NomCtrl   # Créer un contrôleur
php artisan make:migration migration  # Créer une migration
php artisan make:request NomRequest   # Créer une Form Request

# Database
php artisan migrate                   # Exécuter migrations
php artisan migrate:rollback          # Annuler dernière
php artisan migrate:refresh --seed    # Reset + seed
php artisan db:seed NomSeeder         # Lancer un seeder

# Cache & Config
php artisan cache:clear               # Vider le cache
php artisan config:clear              # Vider config cache
php artisan optimize                  # Optimiser app

# NPM
npm run dev                           # Dev mode
npm run build                         # Build production
npm run watch                         # Watch files
```

## 🚀 Déploiement basique

```bash
# 1. Production build
npm run build
composer install --no-dev --optimize-autoloader

# 2. Optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Environment
cp .env.production .env
php artisan key:generate

# 4. Database
php artisan migrate --force

# 5. Permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 📚 Documentation externe

- [Laravel Docs](https://laravel.com/docs)
- [Vue.js Docs](https://vuejs.org)
- [Inertia.js](https://inertiajs.com)
- [Tailwind CSS](https://tailwindcss.com)

## 🔗 URLs locales

| Service | URL |
|---------|-----|
| Application | http://127.0.0.1:8001 |
| Vite Dev | http://127.0.0.1:5175 |
| API | http://127.0.0.1:8001/api |
| MySQL | localhost:3306 |

## ⚠️ ATTENTION

- ❌ Modèles inutilisés à nettoyer
- ❌ Routes de test à supprimer avant production
- ❌ Pas de tests - à ajouter!
- ⚠️ Ajouter des migrations manquantes
- ⚠️ Implémenter les politiques (Policies)

## 📞 Support

Pour plus d'informations:
- Lire `ANALYSE_COMPLETE.md`
- Consulter `DIAGRAMME_FLUX.md`
- Vérifier `RESUME_EXECUTIF.txt`

---

**Dernière mise à jour**: 31 Octobre 2025
