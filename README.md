# Event Planner

Ce dépôt initialise la structure d’un projet Laravel pour l’application **Event Planner**.

## Démarrage

1. Installer les dépendances :
   ```bash
   composer install
   ```
2. Copier la configuration :
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Lancer le serveur :
   ```bash
   php artisan serve
   ```

> **Note** : si l’installation échoue à cause de restrictions réseau, réessayez dans un environnement avec accès complet à Packagist.

## Convention base de données

Toutes les tables et colonnes doivent être préfixées par **`ba_`** (ex: `ba_users`, `ba_id`, `ba_email`).
