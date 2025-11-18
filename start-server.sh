#!/bin/bash

# Script de démarrage du serveur avec limites d'upload augmentées
php -d upload_max_filesize=50M \
    -d post_max_size=50M \
    -d max_file_uploads=20 \
    -d max_execution_time=300 \
    -d max_input_time=300 \
    -d memory_limit=256M \
    artisan serve

