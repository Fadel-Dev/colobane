# Dockerisation de l'Application Colobane

Ce guide explique comment dockeriser et déployer l'application Laravel Colobane avec Docker.

## 🐳 Services Inclus

- **Application Laravel** : PHP 8.1 + Apache
- **Base de données** : MySQL 8.0
- **Cache/Sessions** : Redis 7
- **Serveur Web** : Nginx (optionnel)
- **Email** : Mailhog (développement)
- **Admin DB** : phpMyAdmin

## 🚀 Démarrage Rapide

### 1. Prérequis
- Docker et Docker Compose installés
- Git (pour cloner le projet)

### 2. Configuration
```bash
# Cloner le projet
git clone <votre-repo> colobane
cd colobane

# Configuration automatique Docker (recommandé)
./docker/scripts/setup.sh

# Ou configuration manuelle
cp docker/env.example .env
chmod +x docker/scripts/*.sh
```

### 3. Résolution des Problèmes de Permissions
Si vous rencontrez des erreurs de permissions Docker :
```bash
# Script automatique de résolution
./docker/scripts/fix-permissions.sh

# Ou manuellement
sudo usermod -aG docker $USER
newgrp docker
sudo systemctl restart docker
```

### 4. Démarrage
```bash
# Build et démarrage automatique
./docker/scripts/build.sh

# Ou manuellement
docker-compose up -d --build
```

## 📊 Accès aux Services

| Service | URL | Description |
|---------|-----|-------------|
| Application | http://localhost:8000 | Interface principale |
| phpMyAdmin | http://localhost:8080 | Gestion base de données |
| Mailhog | http://localhost:8025 | Interface email (dev) |
| Nginx | http://localhost:80 | Serveur web (production) |

## 🔧 Commandes Utiles

### Gestion des Conteneurs
```bash
# Démarrer tous les services
docker-compose up -d

# Arrêter tous les services
docker-compose down

# Voir les logs
docker-compose logs -f app

# Redémarrer un service
docker-compose restart app
```

### Commandes Laravel
```bash
# Exécuter des commandes Artisan
docker-compose exec app php artisan migrate
docker-compose exec app php artisan tinker
docker-compose exec app php artisan queue:work

# Accéder au shell du conteneur
docker-compose exec app bash
```

### Base de Données
```bash
# Accéder à MySQL
docker-compose exec mysql mysql -u root -p

# Sauvegarder la base
docker-compose exec mysql mysqldump -u root -p colobane > backup.sql

# Restaurer la base
docker-compose exec -T mysql mysql -u root -p colobane < backup.sql
```

## 🏗️ Structure Docker

```
docker/
├── apache/           # Configuration Apache
├── nginx/            # Configuration Nginx
├── php/              # Configuration PHP
├── supervisor/       # Configuration Supervisor
├── scripts/          # Scripts de build/démarrage
├── mysql/            # Scripts d'initialisation MySQL
└── env.example       # Variables d'environnement
```

## ⚙️ Configuration

### Variables d'Environnement
Les variables principales à configurer dans `.env` :

```env
APP_NAME="Colobane"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_DATABASE=colobane
DB_USERNAME=colobane_user
DB_PASSWORD=colobane_password

REDIS_HOST=redis
CACHE_DRIVER=redis
SESSION_DRIVER=redis
```

### Ports
- **8000** : Application Laravel
- **3306** : MySQL
- **6379** : Redis
- **8080** : phpMyAdmin
- **8025** : Mailhog
- **80/443** : Nginx (production)

## 🔒 Sécurité

### Production
Pour un déploiement en production :

1. **Changer les mots de passe** par défaut
2. **Configurer SSL** avec des certificats valides
3. **Utiliser des secrets** pour les variables sensibles
4. **Activer le firewall** et limiter les accès
5. **Configurer les backups** automatiques

### Variables Sensibles
```bash
# Générer une clé d'application sécurisée
docker-compose exec app php artisan key:generate

# Changer les mots de passe par défaut
# Modifier dans docker-compose.yml et .env
```

## 📈 Monitoring

### Logs
```bash
# Logs de l'application
docker-compose logs -f app

# Logs de la base de données
docker-compose logs -f mysql

# Logs de tous les services
docker-compose logs -f
```

### Performance
```bash
# Utilisation des ressources
docker stats

# Espace disque
docker system df
```

## 🛠️ Développement

### Hot Reload
Pour le développement avec hot reload :

```bash
# Démarrer avec volumes pour le développement
docker-compose -f docker-compose.yml -f docker-compose.dev.yml up
```

### Debug
```bash
# Activer le mode debug
# Dans .env : APP_DEBUG=true

# Accéder au conteneur pour debug
docker-compose exec app bash
```

## 🚨 Dépannage

### Problèmes Courants

1. **Port déjà utilisé**
   ```bash
   # Vérifier les ports utilisés
   netstat -tulpn | grep :8000
   
   # Changer le port dans docker-compose.yml
   ```

2. **Permissions de fichiers**
   ```bash
   # Corriger les permissions
   docker-compose exec app chown -R www-data:www-data /var/www/html
   ```

3. **Base de données non accessible**
   ```bash
   # Vérifier la connexion
   docker-compose exec app php artisan tinker
   # Puis : DB::connection()->getPdo();
   ```

4. **Cache Laravel**
   ```bash
   # Nettoyer le cache
   docker-compose exec app php artisan cache:clear
   docker-compose exec app php artisan config:clear
   docker-compose exec app php artisan route:clear
   ```

## 📚 Ressources

- [Documentation Docker](https://docs.docker.com/)
- [Documentation Laravel](https://laravel.com/docs)
- [Documentation Docker Compose](https://docs.docker.com/compose/)

## 🤝 Support

Pour toute question ou problème :
1. Vérifier les logs : `docker-compose logs -f`
2. Consulter la documentation Laravel
3. Créer une issue sur le repository

