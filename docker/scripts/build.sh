#!/bin/bash

# Script de build pour l'application Colobane

echo "🚀 Démarrage du build de l'application Colobane..."

# Arrêter les conteneurs existants
echo "📦 Arrêt des conteneurs existants..."
docker-compose down

# Supprimer les images existantes (optionnel)
if [ "$1" = "--clean" ]; then
    echo "🧹 Nettoyage des images existantes..."
    docker-compose down --rmi all
fi

# Construire les images
echo "🔨 Construction des images Docker..."
docker-compose build --no-cache

# Démarrer les services
echo "▶️ Démarrage des services..."
docker-compose up -d

# Attendre que les services soient prêts
echo "⏳ Attente du démarrage des services..."
sleep 30

# Vérifier le statut des conteneurs
echo "📊 Statut des conteneurs:"
docker-compose ps

# Afficher les logs de l'application
echo "📝 Logs de l'application:"
docker-compose logs app

echo "✅ Build terminé!"
echo "🌐 Application disponible sur: http://localhost:8000"
echo "🗄️ phpMyAdmin disponible sur: http://localhost:8080"
echo "📧 Mailhog disponible sur: http://localhost:8025"
