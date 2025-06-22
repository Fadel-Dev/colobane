# Plateforme Colobane

Plateforme de gestion immobilière et de location de véhicules.

## Prérequis

- PHP 8.1 ou supérieur
- Composer
- Node.js (pour les assets frontend)
- Base de données MySQL
- Serveur web (Apache/Nginx)

## Installation

1. Cloner le dépôt :
   ```bash
   git clone [URL_DU_REPO] colobane
   cd colobane
   ```

2. Installer les dépendances PHP :
   ```bash
   composer install
   ```

3. Installer les dépendances NPM :
   ```bash
   npm install
   ```

4. Copier le fichier d'environnement :
   ```bash
   cp .env.example .env
   ```

5. Générer la clé d'application :
   ```bash
   php artisan key:generate
   ```

6. Configurer la base de données dans le fichier `.env` :
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=colobane
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Exécuter les migrations et les seeders :
   ```bash
   php artisan migrate --seed
   ```

8. Compiler les assets :
   ```bash
   npm run dev
   ```

9. Lancer le serveur de développement :
   ```bash
   php artisan serve
   ```

## Accès

- URL : http://localhost:8000
- Compte administrateur par défaut :
  - Email: admin@example.com
  - Mot de passe: password

## Fonctionnalités principales

- Gestion des biens immobiliers
- Gestion des véhicules
- Système de réservation
- Tableau de bord administrateur
- Interface utilisateur responsive

## Technologies utilisées

- Laravel 10
- Inertia.js
- Vue.js 3
- Tailwind CSS
- MySQL

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
