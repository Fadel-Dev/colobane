#!/bin/bash

# Script de configuration Docker pour Colobane
# Ce script configure Docker et résout les problèmes de permissions

echo "🐳 Configuration Docker pour Colobane"
echo "======================================"

# Vérifier si Docker est installé
if ! command -v docker &> /dev/null; then
    echo "❌ Docker n'est pas installé. Veuillez l'installer d'abord."
    echo "📖 Guide d'installation: https://docs.docker.com/engine/install/"
    exit 1
fi

# Vérifier si Docker Compose est installé
if ! command -v docker-compose &> /dev/null && ! docker compose version &> /dev/null; then
    echo "❌ Docker Compose n'est pas installé. Veuillez l'installer d'abord."
    exit 1
fi

echo "✅ Docker et Docker Compose sont installés"

# Vérifier si l'utilisateur est dans le groupe docker
if ! groups $USER | grep -q docker; then
    echo "⚠️  L'utilisateur $USER n'est pas dans le groupe docker"
    echo "🔧 Ajout de l'utilisateur au groupe docker..."
    
    # Ajouter l'utilisateur au groupe docker
    sudo usermod -aG docker $USER
    
    echo "✅ Utilisateur ajouté au groupe docker"
    echo "⚠️  IMPORTANT: Vous devez vous déconnecter et vous reconnecter pour que les changements prennent effet"
    echo "   Ou exécutez: newgrp docker"
    echo ""
    echo "🔄 Redémarrage de la session..."
    newgrp docker
fi

# Vérifier si Docker daemon est en cours d'exécution
if ! docker info &> /dev/null; then
    echo "❌ Docker daemon n'est pas en cours d'exécution"
    echo "🔧 Démarrage de Docker..."
    
    # Démarrer Docker (selon la distribution)
    if command -v systemctl &> /dev/null; then
        sudo systemctl start docker
        sudo systemctl enable docker
    elif command -v service &> /dev/null; then
        sudo service docker start
    else
        echo "❌ Impossible de démarrer Docker automatiquement"
        echo "📖 Veuillez démarrer Docker manuellement"
        exit 1
    fi
    
    echo "✅ Docker démarré"
fi

# Vérifier les permissions Docker
echo "🔍 Vérification des permissions Docker..."
if docker ps &> /dev/null; then
    echo "✅ Permissions Docker OK"
else
    echo "❌ Problème de permissions Docker"
    echo "🔧 Tentative de résolution..."
    
    # Redémarrer Docker
    sudo systemctl restart docker
    
    # Vérifier à nouveau
    if docker ps &> /dev/null; then
        echo "✅ Permissions Docker résolues"
    else
        echo "❌ Impossible de résoudre les permissions Docker"
        echo "📖 Solutions possibles:"
        echo "   1. Redémarrez votre session: newgrp docker"
        echo "   2. Redémarrez votre ordinateur"
        echo "   3. Vérifiez la configuration Docker"
        exit 1
    fi
fi

# Créer le fichier .env s'il n'existe pas
if [ ! -f .env ]; then
    echo "📝 Création du fichier .env..."
    if [ -f docker/env.example ]; then
        cp docker/env.example .env
        echo "✅ Fichier .env créé à partir de docker/env.example"
    else
        echo "⚠️  Fichier docker/env.example non trouvé"
        echo "📝 Création d'un fichier .env basique..."
        cat > .env << EOF
APP_NAME="Colobane"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=colobane
DB_USERNAME=colobane_user
DB_PASSWORD=colobane_password

REDIS_HOST=redis
CACHE_DRIVER=redis
SESSION_DRIVER=redis
EOF
        echo "✅ Fichier .env créé"
    fi
else
    echo "✅ Fichier .env existe déjà"
fi

# Rendre les scripts exécutables
echo "🔧 Configuration des permissions des scripts..."
chmod +x docker/scripts/*.sh
echo "✅ Scripts rendus exécutables"

# Vérifier l'espace disque
echo "💾 Vérification de l'espace disque..."
AVAILABLE_SPACE=$(df -h . | awk 'NR==2 {print $4}' | sed 's/G//')
if [ "$AVAILABLE_SPACE" -lt 5 ]; then
    echo "⚠️  Espace disque faible: ${AVAILABLE_SPACE}G disponible"
    echo "   Recommandé: au moins 5G pour Docker"
else
    echo "✅ Espace disque suffisant: ${AVAILABLE_SPACE}G disponible"
fi

# Nettoyer les images Docker inutilisées (optionnel)
echo "🧹 Nettoyage des images Docker inutilisées..."
docker system prune -f
echo "✅ Nettoyage terminé"

echo ""
echo "🎉 Configuration Docker terminée!"
echo "=================================="
echo ""
echo "📋 Prochaines étapes:"
echo "   1. Construire et démarrer l'application:"
echo "      ./docker/scripts/build.sh"
echo ""
echo "   2. Ou manuellement:"
echo "      docker-compose up -d --build"
echo ""
echo "   3. Vérifier le statut:"
echo "      docker-compose ps"
echo ""
echo "🌐 Une fois démarré, l'application sera disponible sur:"
echo "   - Application: http://localhost:8000"
echo "   - phpMyAdmin: http://localhost:8080"
echo "   - Mailhog: http://localhost:8025"
echo ""
echo "📚 Pour plus d'informations, consultez README-Docker.md"
