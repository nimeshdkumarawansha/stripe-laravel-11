# Laravel 11 Stripe Payment Gateway Integration

This project demonstrates the integration of Stripe payment gateway with Laravel 11. It provides a simple implementation for processing payments using Stripe in a Laravel application.

## Table of Contents
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Testing](#testing)
- [License](#license)

## Requirements

- PHP 8.1 or higher
- Composer
- Laravel 11
- Stripe account

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/nimeshdkumarawansha/stripe-laravel-11.git
   ```

2. Navigate to the project directory:
   ```
   cd stripe-laravel-11
   ```

3. Install dependencies:
   ```
   composer install
   ```

4. Copy the `.env.example` file to `.env`:
   ```
   cp .env.example .env
   ```

5. Generate application key:
   ```
   php artisan key:generate
   ```

## Configuration

1. Open the `.env` file and add your Stripe API keys:

   ```
   STRIPE_KEY=pk_test_xxxxxx
   STRIPE_SECRET=sk_test_xxxxxx
   ```

   Replace `xxxxxx` with your actual Stripe test API keys.

2. Configure other environment variables as needed (database, app name, etc.).

## Running the Application

To run the application, use the following command:

```
php artisan serve
```

The application will be available at `http://localhost:8000/stripe`.

## Testing

For testing purposes, you can use the following test card details:

- Card Name: Test
- Card Number: 4242424242424242
- Month: 07
- Year: 2027
- CVV: 123

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).