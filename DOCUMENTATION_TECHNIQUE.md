# Documentation Technique - Plateforme Colobane

## Table des Matières
1. [Architecture Générale](#architecture-générale)
2. [Routes de l'Application](#routes-de-lapplication)
3. [Contrôleurs](#contrôleurs)
   - [Controller](#controller)
   - [VehiculeController](#vehiculecontroller)
   - [ImmobilierController](#immobiliercontroller)
   - [PostController](#postcontroller)
   - [AdminController](#admincontroller)
   - [DashboardController](#dashboardcontroller)
   - [BoostController](#boostcontroller)
4. [Modèles de Données](#modèles-de-données)
5. [Sécurité](#sécurité)
6. [Workflow des Requêtes](#workflow-des-requêtes)

## Architecture Générale

L'application suit une architecture MVC (Modèle-Vue-Contrôleur) avec les composants suivants :

- **Frontend** : Inertia.js avec Vue.js 3
- **Backend** : Laravel 10
- **Authentification** : Laravel Jetstream avec Sanctum
- **Base de données** : MySQL
- **Templating** : Composants Vue.js avec Inertia

## Routes de l'Application

### Routes Publiques
- `GET /` : Page d'accueil (`Controller@Home`)
- `GET /p/{section}` : Affichage des publications par section (`PostController@section`)
- `GET /publication/{article}` : Affichage d'un article (`PostController@Article`)
- `GET /detail/{id}` : Détails d'un bien immobilier (`Controller@DetailsImmo`)
- `GET /detailVehi/{id}` : Détails d'un véhicule (`Controller@DetailsVehi`)

### Routes Authentifiées
- `GET /dashboard` : Tableau de bord utilisateur (`DashboardController@Dash`)
- `GET /publier` : Page de publication (`Controller@publier`)

### Routes d'API

#### Gestion des Véhicules
- `POST /voitureVente/save` : Enregistrement d'une voiture à vendre (`VehiculeController@storeVoitureVente`)
- `POST /voitureLocation/save` : Enregistrement d'une voiture en location (`VehiculeController@storeVoitureLoc`)

#### Gestion Immobilière
- `POST /immobilier/save` : Enregistrement d'un bien immobilier (type 1) (`ImmobilierController@storeVente`)
- `POST /immobilier2/save` : Enregistrement d'un bien immobilier (type 2) (`ImmobilierController@storeVente2`)
- `POST /immobilier3/save` : Enregistrement d'un bien immobilier (type 3) (`ImmobilierController@storeVente3`)

#### Publications
- `POST /topics` : Création d'une nouvelle publication (`PostController@store`)

## Contrôleurs

### Controller
**Chemin**: `app/Http/Controllers/Controller.php`

#### Méthodes Principales
- `Home()` : Affiche la page d'accueil avec les publications récentes
- `publier()` : Affiche le formulaire de publication (protégé par authentification)
- `DetailsImmo($id)` : Affiche les détails d'un bien immobilier
- `DetailsVehi($id)` : Affiche les détails d'un véhicule

### VehiculeController
**Chemin**: `app/Http/Controllers/VehiculeController.php`

#### Méthodes Principales
- `storeVoitureVente(Request $request)` : Traite l'enregistrement d'une voiture à vendre
  - Validation des données
  - Traitement des images
  - Enregistrement en base de données
  - Redirection avec message de succès/erreur

- `storeVoitureLoc(Request $request)` : Traite l'enregistrement d'une voiture en location
  - Logique similaire à storeVoitureVente avec des spécificités pour la location

### ImmobilierController
**Chemin**: `app/Http/Controllers/ImmobilierController.php`

#### Méthodes Principales
- `storeVente(Request $request)` : Enregistrement d'un bien immobilier (type 1)
- `storeVente2(Request $request)` : Enregistrement d'un bien immobilier (type 2)
- `storeVente3(Request $request)` : Enregistrement d'un bien immobilier (type 3)

Chaque méthode gère :
- La validation des données spécifiques
- Le traitement des images multiples
- L'enregistrement en base de données
- Les messages de retour utilisateur

### PostController
**Chemin**: `app/Http/Controllers/PostController.php`

#### Méthodes Principales
- `Section($section)` : Affiche les publications d'une section spécifique
- `Article($article)` : Affiche un article complet
- `store(Request $request)` : Enregistre une nouvelle publication

### AdminController
**Chemin**: `app/Http/Controllers/AdminController.php`

#### Méthodes Principales
- `Update($id, Request $request)` : Met à jour une publication immobilière
- `UpdateVoiture($id, Request $request)` : Met à jour une publication de véhicule

### DashboardController
**Chemin**: `app/Http/Controllers/DashboardController.php`

#### Méthodes Principales
- `Dash()` : Affiche le tableau de bord utilisateur avec les statistiques et publications récentes

## Modèles de Données

### Modèles Principaux
1. **Publication**
   - Titre
   - Description
   - Prix
   - Catégorie
   - Statut
   - Utilisateur (relation)
   - Images (relation)

2. **Véhicule** (hérite de Publication)
   - Marque
   - Modèle
   - Année
   - Kilométrage
   - Type de transmission
   - Type de carburant

3. **Immobilier** (hérite de Publication)
   - Type de bien
   - Surface
   - Nombre de pièces
   - Localisation
   - Équipements

## Sécurité

### Middleware
- `auth:sanctum` : Vérifie l'authentification de l'utilisateur
- `verified` : Vérifie que l'email de l'utilisateur est vérifié
- `can:admin` : Vérifie les droits d'administration

### Protection CSRF
Tous les formulaires incluent un jeton CSRF pour la protection contre les attaques cross-site request forgery.

## Workflow des Requêtes

1. **Requête Utilisateur**
   - L'utilisateur effectue une action (ex: accéder à une page, soumettre un formulaire)
   
2. **Routage**
   - Laravel route la requête vers le contrôleur approprié
   - Les middlewares sont exécutés dans l'ordre défini
   
3. **Traitement**
   - Le contrôleur reçoit la requête
   - Validation des données
   - Appel aux modèles si nécessaire
   - Traitement métier
   
4. **Réponse**
   - Retour d'une vue Inertia avec les données
   - Ou redirection avec message flash
   - Gestion des erreurs et retours utilisateur

## Bonnes Pratiques de Développement

1. **Validation**
   - Toujours valider les entrées utilisateur
   - Utiliser les Form Requests pour les règles complexes

2. **Sécurité**
   - Ne jamais faire confiance aux données utilisateur
   - Utiliser les préparations de requêtes pour éviter les injections SQL
   - Hasher les mots de passe avec bcrypt

3. **Performance**
   - Utiliser l'eager loading pour les relations
   - Mettre en cache les requêtes fréquentes
   - Optimiser les images avant upload

4. **Maintenabilité**
   - Suivre les conventions de nommage
   - Documenter le code
   - Écrire des tests unitaires
