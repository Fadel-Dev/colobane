-- Script d'initialisation de la base de données Colobane
-- Ce script sera exécuté automatiquement lors du premier démarrage du conteneur MySQL

-- Créer la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS colobane CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Utiliser la base de données
USE colobane;

-- Créer un utilisateur spécifique pour l'application (optionnel)
-- CREATE USER IF NOT EXISTS 'colobane_user'@'%' IDENTIFIED BY 'colobane_password';
-- GRANT ALL PRIVILEGES ON colobane.* TO 'colobane_user'@'%';
-- FLUSH PRIVILEGES;

-- Configuration MySQL pour Laravel
SET GLOBAL sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_DATE,NO_ZERO_IN_DATE,ERROR_FOR_DIVISION_BY_ZERO';
SET GLOBAL innodb_file_per_table = ON;
SET GLOBAL innodb_buffer_pool_size = 128M;
