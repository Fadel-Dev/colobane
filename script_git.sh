#!/bin/bash

# Variables
REPO_DIR="/var/www/html/colobane"  # Si vous êtes déjà dans ce répertoire, vous n'avez pas besoin de cette variable.
LOG_FILE="/var/log/git_update.log"
DATE=$(date "+%Y-%m-%d_%H-%M-%S")

# Fonction pour afficher les messages de log
log_message() {
    echo "[$(date)] - $1" >> $LOG_FILE
}

# Vérifier si le répertoire est bien celui du projet
if [ ! -d "$REPO_DIR/.git" ]; then
    log_message "Erreur : Le répertoire $REPO_DIR n'est pas un dépôt Git."
    exit 1
fi

# Accéder au répertoire et effectuer les commandes Git
log_message "Mise à jour du dépôt dans $REPO_DIR"

# Exécuter les commandes avec sudo pour avoir les privilèges nécessaires
sudo bash -c "
    cd $REPO_DIR
    git reset --hard
    git pull origin master
    echo 'Mise à jour du dépôt Git terminée.' >> $LOG_FILE
"

# Vérifier si tout s'est bien passé
if [ $? -eq 0 ]; then
    log_message "Mise à jour réussie dans $REPO_DIR."
else
    log_message "Erreur lors de la mise à jour du dépôt Git dans $REPO_DIR."
    exit 1
fi
