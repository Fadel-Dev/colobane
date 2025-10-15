#!/bin/bash

# Script pour résoudre les problèmes de permissions Docker

echo "🔧 Résolution des problèmes de permissions Docker"
echo "================================================"

# Fonction pour vérifier si Docker fonctionne
check_docker() {
    if docker ps &> /dev/null; then
        return 0
    else
        return 1
    fi
}

# Vérifier les permissions actuelles
echo "🔍 Vérification des permissions Docker..."

if check_docker; then
    echo "✅ Docker fonctionne correctement"
    exit 0
fi

echo "❌ Problème de permissions Docker détecté"
echo ""

# Solution 1: Ajouter l'utilisateur au groupe docker
echo "🔧 Solution 1: Ajout de l'utilisateur au groupe docker"
if ! groups $USER | grep -q docker; then
    echo "   Ajout de $USER au groupe docker..."
    sudo usermod -aG docker $USER
    echo "   ✅ Utilisateur ajouté au groupe docker"
else
    echo "   ✅ Utilisateur déjà dans le groupe docker"
fi

# Solution 2: Redémarrer Docker
echo ""
echo "🔧 Solution 2: Redémarrage de Docker"
echo "   Arrêt de Docker..."
sudo systemctl stop docker 2>/dev/null || true

echo "   Démarrage de Docker..."
sudo systemctl start docker
sudo systemctl enable docker

# Attendre que Docker démarre
sleep 3

# Solution 3: Vérifier les permissions du socket
echo ""
echo "🔧 Solution 3: Vérification des permissions du socket Docker"
DOCKER_SOCK="/var/run/docker.sock"
if [ -e "$DOCKER_SOCK" ]; then
    echo "   Permissions actuelles du socket:"
    ls -la $DOCKER_SOCK
    
    # Corriger les permissions si nécessaire
    sudo chmod 666 $DOCKER_SOCK 2>/dev/null || true
    echo "   ✅ Permissions du socket corrigées"
else
    echo "   ⚠️  Socket Docker non trouvé"
fi

# Solution 4: Redémarrer la session
echo ""
echo "🔧 Solution 4: Application des changements de groupe"
echo "   Application des nouveaux groupes..."
newgrp docker << 'EOF'
echo "   ✅ Nouveaux groupes appliqués"
EOF

# Vérification finale
echo ""
echo "🔍 Vérification finale..."
sleep 2

if check_docker; then
    echo "✅ Problème résolu! Docker fonctionne maintenant"
    echo ""
    echo "🎉 Vous pouvez maintenant exécuter:"
    echo "   docker-compose up -d --build"
else
    echo "❌ Le problème persiste"
    echo ""
    echo "📋 Solutions supplémentaires:"
    echo "   1. Redémarrez votre ordinateur"
    echo "   2. Vérifiez que Docker est correctement installé"
    echo "   3. Consultez la documentation Docker pour votre distribution"
    echo ""
    echo "🔍 Informations de débogage:"
    echo "   - Utilisateur: $USER"
    echo "   - Groupes: $(groups)"
    echo "   - Docker version: $(docker --version 2>/dev/null || echo 'Non disponible')"
    echo "   - Docker Compose version: $(docker-compose --version 2>/dev/null || echo 'Non disponible')"
fi
