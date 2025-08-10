<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### Installation

1. Clone the Repository
   git clone <repository-url>
   cd <repository-name>

2. Copy the Environment File
   - Duplicate the .env.example file to create a .env file:
   cp .env.example .env
   - Update the .env file with your database credentials and other configurations (e.g., DB_DATABASE, DB_USERNAME, DB_PASSWORD).

3. Install Dependencies
   - Install PHP dependencies via Composer:
   composer install
   - Install frontend dependencies via NPM:
   npm install

4. Generate Application Key
   - Run the following command to generate a unique application key:
   php artisan key:generate

5. Run Migrations
   - Migrate the database to create the necessary tables:
   php artisan migrate
   - (Optional) Seed the database with test data if you have a seeder:
   php artisan db:seed

### Running the Application

- Using Laravel Herd:
  - If you're using Laravel Herd, you don’t need to run a separate server. Herd automatically serves your Laravel app based on the project directory. Access it via the site URL assigned by Herd (e.g., http://<project-name>.test instead of localhost). Check Herd's dashboard to confirm the URL.
  - Note: localhost won’t work directly with Herd unless you manually configure it to point to the project. The URL is user-specific and depends on your Herd setup.

- Alternative (Manual Server):
  - If not using Herd, start the built-in PHP development server:
  php artisan serve
  - Access the app at http://localhost:8000.

- Compile Assets:
  - Run the following command to compile your frontend assets (CSS/JS):
  npm run dev
  - For development with auto-reloading, use:
  npm run watch

### Testing the Application

1. Verify Installation
   - Open your browser and navigate to the Herd URL (e.g., http://<project-name>.test) or http://localhost:8000 (if using php artisan serve).
   - You should see the Laravel welcome page or your app’s homepage.

2. Test Routes and Features
   - Check key routes (e.g., /kasir, /transaksi) to ensure they load without errors.
   - Test the search functionality on the Kasir, Barang, and Transaksi pages by entering sample values.
   - Add items to the cart on the Kasir page and click "Bayar" to ensure the transaction saves correctly.

3. Database Interaction
   - Verify that migrations created the transaksi, barang, and detail_transaksi tables.
   - Check the database for new records after a successful checkout.

4. Troubleshooting
   - If you encounter errors, check the Laravel log file (storage/logs/laravel.log) or your browser’s console.
   - Ensure all environment variables in .env are correctly set.

### Additional Notes
- For Herd users, the site URL is automatically generated based on your project name (e.g., myapp.test). Update your .env APP_URL to match if needed.
- Run php artisan optimize after migrations to clear and re-optimize the configuration cache.

Happy coding with Laravel!

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
