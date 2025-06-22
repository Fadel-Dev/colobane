# Guide du Développeur - Plateforme Colobane

## Table des matières
1. [Structure du Projet](#structure-du-projet)
2. [Architecture](#architecture)
3. [Conventions de Code](#conventions-de-code)
4. [Workflow Git](#workflow-git)
5. [Développement Local](#développement-local)
6. [Tests](#tests)
7. [Déploiement](#déploiement)
8. [Dépannage](#dépannage)

## Structure du Projet

```
colobane/
├── app/                  # Code source de l'application
│   ├── Http/             # Contrôleurs et middleware
│   ├── Models/           # Modèles Eloquent
│   ├── Providers/        # Fournisseurs de services
│   └── ...
├── config/              # Fichiers de configuration
├── database/
│   ├── migrations/      # Migrations de base de données
│   ├── seeders/         # Classes de remplissage de la base de données
│   └── factories/       # Usines pour les tests
├── public/              # Point d'entrée public
├── resources/
│   ├── js/             # Code JavaScript/Vue.js
│   ├── views/           # Vues Blade (si utilisées)
│   └── ...
├── routes/              # Définitions des routes
├── storage/             # Fichiers générés par l'application
├── tests/               # Tests automatisés
└── vendor/              # Dépendances Composer
```

## Architecture

L'application utilise l'architecture MVC avec les composants suivants :

- **Frontend** : Vue.js 3 avec Inertia.js
- **Backend** : Laravel 10
- **Base de données** : MySQL
- **Authentification** : Laravel Jetstream avec Sanctum
- **UI** : Tailwind CSS

## Conventions de Code

### PHP
- Suivre les standards PSR-12
- Utiliser le typage strict partout
- Documenter toutes les méthodes avec PHPDoc
- Nommer les classes en PascalCase
- Nommer les méthodes en camelCase
- Nommer les variables de manière descriptive

### JavaScript/Vue
- Utiliser la Composition API de Vue 3
- Nommer les composants en PascalCase
- Utiliser TypeScript pour les nouveaux composants
- Suivre les directives de style officielles de Vue

## Workflow Git

1. **Branches**
   - `main` : Branche de production
   - `develop` : Branche d'intégration
   - `feature/*` : Nouvelles fonctionnalités
   - `bugfix/*` : Corrections de bugs
   - `hotfix/*` : Corrections critiques pour la production

2. **Commit Messages**
   - Format : `type(portée): description`
   - Types : feat, fix, docs, style, refactor, test, chore
   - Exemple : `feat(auth): ajouter la vérification par email`

## Développement Local

### Prérequis
- PHP 8.1+
- Composer 2.0+
- Node.js 16+
- MySQL 8.0+

### Installation

1. Cloner le dépôt
2. Installer les dépendances :
   ```bash
   composer install
   npm install
   ```
3. Configurer `.env`
4. Lancer les migrations :
   ```bash
   php artisan migrate --seed
   ```
5. Démarrer les serveurs de développement :
   ```bash
   php artisan serve
   npm run dev
   ```

## Tests

### Tests PHPUnit
```bash
php artisan test
```

### Tests JavaScript (Jest)
```bash
npm test
```

### Tests d'analyse statique
```bash
# PHPStan
vendor/bin/phpstan analyse

# ESLint
npx eslint resources/js/
```

## Déploiement

Le déploiement est automatisé via GitHub Actions. Pour déployer :

1. Créer un tag versionné :
   ```bash
   git tag -a v1.0.0 -m "Version 1.0.0"
   git push origin v1.0.0
   ```
2. Le pipeline CI/CD s'exécutera automatiquement

## Dépannage

### Problèmes courants

1. **Erreurs de migration**
   ```bash
   php artisan migrate:fresh --seed
   ```

2. **Problèmes de dépendances**
   ```bash
   rm -rf vendor/
   composer install
   ```

3. **Problèmes d'assets**
   ```bash
   npm install
   npm run dev
   ```

## Documentation supplémentaire

- [Documentation Laravel](https://laravel.com/docs)
- [Documentation Vue 3](https://v3.vuejs.org/)
- [Guide Inertia.js](https://inertiajs.com/)
- [Documentation Tailwind CSS](https://tailwindcss.com/docs)
