# Smart WiFi Management System - Laravel

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Breeze](https://img.shields.io/badge/Laravel_Breeze-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Spatie](https://img.shields.io/badge/Spatie_Permission-4A154B?style=for-the-badge)

A comprehensive WiFi management system built with Laravel, featuring user authentication with Laravel Breeze and role-based permissions with Spatie.

## Features

- User authentication system
- Role-based access control (Admin, Staff, User)
- WiFi package management
- Customer management
- Responsive admin dashboard
- Database seeding with sample data

## Prerequisites

- PHP 8.0+
- Composer
- Node.js 14+
- MySQL 5.7+
- Git

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/Smart_Wifi.git
cd Smart_Wifi
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Database setup

Create a MySQL database named `Smart_Wifi` and update your `.env` file:

```ini
DB_DATABASE=Smart_Wifi
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

### 6. Set up Spatie Permissions

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### 7. Run migrations and seeders

```bash
php artisan migrate:fresh --seed
```

### 8. Compile assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

### 9. Start the development server

```bash
php artisan serve
```

## Seeded Data

The system comes with pre-seeded data:

- **Roles**: Admin, User

- **Admin User**:
  - Email: admin@wifi.com
  - Password: administrator_defaults11890

- **User**:
  - Email: user@wifi.com
  - Password: user_default_password123

- **Permission**:
  - User permissions
  - Role permissions
  - Permission permissions
  - Pakets permissions
  - Users permissions

- **Paket**:
  - Paket Dasar
  - Paket Reguler
  - Paket Bisnis
  - Paket Eksekutif

## Troubleshooting

### Spatie Package Not Found

```bash
composer require spatie/laravel-permission
```

### Cache Issues

```bash
php artisan optimize:clear
```

### Frontend Assets Not Loading

```bash
npm install && npm run build
```

## Project Structure

```
Smart_Wifi/
├── app/               # Application core
├── database/          # Migrations and seeders
├── resources/         # Views and assets
├── routes/            # Application routes
├── config/            # Configuration files
└── public/            # Publicly accessible files
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
