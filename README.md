# Laravel Admin Project

A comprehensive Laravel-based CMS with an admin panel for managing dynamic website content.

## Features

- **Admin Panel**: Secure admin interface built with AdminLTE
- **Dynamic Pages**: Manage About Us, Services, and Contact pages
- **Contact Form**: Receive and manage contact form submissions
- **User Management**: Create and manage admin users
- **Site Settings**: Manage global site settings

## Requirements

- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- Node.js and NPM (for asset compilation)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/laravel-admin-project.git
   cd laravel-admin-project
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Copy the environment file and configure your database:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Set up the project with a single command:
   ```bash
   php artisan setup:project
   ```
   
   This command will:
   - Run migrations
   - Set up storage directories
   - Copy sample images
   - Seed the database with initial data

6. Or run the setup steps individually:
   ```bash
   php artisan migrate:fresh
   php artisan setup:storage-directories
   php artisan setup:sample-images
   php artisan db:seed
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

## Admin Access

After setup, you can access the admin panel at:
- URL: `http://localhost:8000/admin/login`
- Email: `admin@example.com`
- Password: `password`

## Pages

The project includes the following pages:

- **Home/Landing Page**: The main entry point of the website
- **About Us**: Information about the company, team, and skills
- **Services**: List of services offered by the company
- **Contact**: Contact information and form for visitors to send messages

## Admin Features

- **Dashboard**: Overview of site statistics
- **Landing Page Management**: Manage the content of the landing page
- **About Us Page Management**: Manage the content of the About Us page
- **Services Page Management**: Manage the content of the Services page
- **Contact Page Management**: Manage the content of the Contact page
- **Contact Form Submissions**: View and manage contact form submissions
- **Site Settings**: Manage global site settings
- **User Management**: Manage admin users

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
