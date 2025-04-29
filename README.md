# 🚀 Custom PHP Framework (Laravel-Inspired)

A lightweight custom PHP framework with Laravel-style routing, controllers, models, and basic CRUD operations.

---

## ✅ Getting Started

### 1. Start the Server

Start the built-in PHP server with:

```bash
php start.php

### 2. Laravel-Inspired Routing
Define clean and expressive routes just like Laravel. Easily manage your app’s endpoints with a simplified syntax.

### 3. Generate a Controller
Create a custom controller with the following command:

php cli.php make:controller Auth AuthController

This will generate AuthController.php inside the Auth/ directory.

### 4. Generate a Model
Create a model using:

php cli.php make:model Auth User

This will generate a User.php model in the Auth/ directory.

### 5. Database Configuration
Configure your database credentials in the .env file:

DB_HOST=localhost
DB_NAME=your_database_name
DB_USER=your_username
DB_PASS=your_password

### 6. CRUD Operations
Easily handle Create, Read, Update, and Delete operations using simple and familiar syntax.

### 7. Make Custom Migration
Easily create migration file:

php cli.php make:migration Admin

This will generate a migration file for Admin table