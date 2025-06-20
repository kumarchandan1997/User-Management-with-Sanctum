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
git clone https://github.com/kumarchandan1997/User-Management-with-Sanctum.git
cd User-Management-with-Sanctum
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=UserSeeder
```

## Success Responses

### 1. GET — for login =>  http://localhost:8000/api/login

```http
HTTP/1.1 200
Content-Type: application/json

{
    "status_code": 200,
    "message": "Login successful.",
    "data": {
        "token": "9|3Fml5icBkLyVQT9f2rprNV9AOzsGKqjiKevNsxmpc92410c5",
        "user": {
            "id": 2,
            "name": "home_page",
            "email": "test@example.com"
        }
    }
}
```

### 1. POST — user details =>  http://localhost:8000/api/users/3

```http
HTTP/1.1 200
Content-Type: application/json

{
    "status_code": 200,
    "message": "User details",
    "data": {
        "user_name": "john_doe",
        "mobile": "john@example.com",
        "dob": "1985-08-21",
        "gender": "Male",
        "Address": [
            {
                "address_type": "home",
                "address1": {
                    "door/street": "2nd Street, Green Valley",
                    "landmark": "Near Park",
                    "city": "Hyderabad",
                    "state": "Telangana",
                    "country": "India"
                },
                "primary": "Yes"
            },
            {
                "address_type": "Office",
                "address2": {
                    "door/street": "IT Park Rd, Cyber Towers",
                    "landmark": "Opposite Main Gate",
                    "city": "Hyderabad",
                    "state": "Telangana",
                    "country": "India"
                },
                "primary": "No"
            }
        ]
    }
}
```