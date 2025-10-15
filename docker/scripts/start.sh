#!/bin/bash

# Attendre que la base de données soit prête
echo "Attente de la base de données..."
while ! php -r "try { new PDO('mysql:host=mysql;port=3306', 'root', 'root_password'); echo 'DB OK'; } catch(Exception \$e) { exit(1); }" 2>/dev/null; do
    echo "En attente de la base de données..."
    sleep 2
done

echo "Base de données prête!"

# Générer la clé d'application si elle n'existe pas
if [ ! -f /var/www/html/.env ]; then
    echo "Création du fichier .env..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Générer la clé d'application
echo "Génération de la clé d'application..."
php artisan key:generate --force

# Exécuter les migrations
echo "Exécution des migrations..."
php artisan migrate --force

# Exécuter les seeders
echo "Exécution des seeders..."
php artisan db:seed --force

# Optimiser l'application
echo "Optimisation de l'application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Créer le lien symbolique pour le stockage
echo "Création du lien symbolique de stockage..."
php artisan storage:link

# Démarrer Supervisor
echo "Démarrage de Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
