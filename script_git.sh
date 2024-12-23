#!/bin/bash

# Variables
LOG_FILE="/var/log/git_update.log"
DATE=$(date "+%Y-%m-%d_%H-%M-%S")

# Fonction pour afficher les messages de log
log_message() {
    echo "[$(date)] - $1" | sudo tee -a $LOG_FILE > /dev/null
}

# Vérifier si le répertoire courant est bien un dépôt Git
if [ ! -d ".git" ]; then
    log_message "Erreur : Ce répertoire n'est pas un dépôt Git."
    exit 1
fi

# Mise à jour du dépôt
log_message "Mise à jour du dépôt dans $(pwd)"

# Exécuter les commandes Git avec sudo
sudo bash -c "
    cd $(pwd)
    git reset --hard
    git pull origin master
    echo 'Mise à jour du dépôt Git terminée.' >> $LOG_FILE
"

# Vérifier si la commande a réussi
if [ $? -eq 0 ]; then
    log_message "Mise à jour réussie dans $(pwd)."
else
    log_message "Erreur lors de la mise à jour du dépôt Git dans $(pwd)."
    exit 1
fi
