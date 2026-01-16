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
4. Publier le lien de stockage (pour les images) :
   ```bash
   php artisan storage:link
   ```

## Base de données

1. Lancer les migrations :
   ```bash
   php artisan migrate
   ```
2. Charger les données de démonstration (catégories, événements, admin) :
   ```bash
   php artisan db:seed
   ```

> Astuce : vous pouvez tout faire en une commande avec `php artisan migrate --seed`.

## Compte administrateur

Le seeder `AdminUserSeeder` crée un compte admin par défaut :

- **Email** : `admin@eventplanner.test`
- **Mot de passe** : `Admin123!`

> **Note** : si l’installation échoue à cause de restrictions réseau, réessayez dans un environnement avec accès complet à Packagist.

## Convention base de données

Toutes les tables et colonnes doivent être préfixées par **`ba_`** (ex: `ba_users`, `ba_id`, `ba_email`).
