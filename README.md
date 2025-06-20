# Laravel 10 API – User Management with Sanctum

This project demonstrates a basic **User Management System** in Laravel 10 using **Laravel Sanctum** for API authentication and secure token-based access. It includes:

- **User Login API**
- **Fetch User Profile API** (with profile and addresses)
- **Reusable Response Trait**
- **Sanitized, Secure, and Clean Architecture**
- **Structured Seeder for test data**

---

## 🔧 Tech Stack

- PHP 8.1+
- Laravel 10
- Laravel Sanctum (API Auth)
- MySQL/PostgreSQL (DB)
- Postman (for testing APIs)

---

## ✅ Features

| Feature                         | Description                              |
|----------------------------------|------------------------------------------|
| User Authentication             | Login via Sanctum with token             |
| Secure API Access               | Authenticated route via bearer token     |
| Fetch Profile Info by ID        | `/api/users/{user_id}`                   |
| Trait-based API Responses       | Centralized success/error formatting     |
| Optimized Seeder                | Two users with profiles + addresses      |

---

## 🚀 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/your-repo/laravel-user-api.git
cd laravel-user-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=UserSeeder