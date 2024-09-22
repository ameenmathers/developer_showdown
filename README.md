<<<<<<< HEAD
# developer_showdown
Mid Level Laravel Developer Test for Jibrin Idris
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
# User Batch Processing System

This project implements a system for processing user attributes and sending them to a third-party API in batches. The system listens for changes in user attributes such as `firstname`, `lastname`, and `timezone`, stores the updated users temporarily, and sends their data to the API in batches, respecting the API's rate limits.

## Features
- **Batch Processing**: Processes up to 1,000 users per batch, sending them to a third-party API.
- **API Rate Limiting**: Ensures that no more than 50 requests are made per hour to comply with the third-party API rate limit.
- **Event-Driven Updates**: Listens for changes in user attributes and only processes users whose data has changed.
- **Unit Testing**: Includes unit tests that mock API calls using Laravel's HTTP faking capabilities.

## Prerequisites
- **PHP 8.0+**
- **Composer**
- **Laravel 9+**
- **Database** (MySQL, SQLite, etc.)

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/your-repository.git
    cd your-repository
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```

4. Generate an application key:
    ```bash
    php artisan key:generate
    ```

5. Set up your database connection in the `.env` file.

6. Run migrations:
    ```bash
    php artisan migrate
    ```

7. (Optional) Seed the database with test users:
    ```bash
    php artisan db:seed
    ```

## Usage

### 1. Run the Laravel development server:
   ```bash
   php artisan serve
 ```

### 2. Process user updates via artisan command:
   ```bash
   php artisan users:process-batch
 ```

### 3. Running Tests:
   ```bash
  php artisan test
 ```


###  Project Structure
Events: Listens for user attribute changes.
Commands: Handles batch processing of user updates.
HTTP Client: Uses Laravel's Http facade to send requests to the third-party API.
Unit Tests: Includes tests to verify that user batches are processed and sent correctly.

## Configuration

API Endpoint: Update the third-party API endpoint in the code or via environment variables if needed.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> aa28f03 (Initial commit)
