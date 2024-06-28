````markdown
# Laravel Rental APP

## Table of Contents

-   [Prerequisites](#prerequisites)
-   [Installation](#installation)
    -   [1. Clone the Repository](#1-clone-the-repository)
    -   [2. Install Dependencies](#2-install-dependencies)
    -   [3. Configure MongoDB](#3-configure-mongodb)
    -   [4. Run Migrations](#4-run-migrations)
    -   [5. Serve the Application](#5-serve-the-application)
-   [Usage](#usage)
    -   [1. Accessing the Application](#1-accessing-the-application)
    -   [2. API Endpoints](#2-api-endpoints)
-   [FAQ](#faq)
-   [Support](#support)

## Prerequisites

Before you begin, ensure you have met the following requirements:

-   PHP 7.4 or higher
-   Composer
-   MongoDB instance (MongoDB Atlas recommended)
-   Node.js and npm (for frontend assets)

## Installation

### 1. Clone the Repository

```bash
git clone 
cd Rental-Car
```
````

### 2. Install Dependencies

Install the Laravel MongoDB Package
Before we can install the MongoDB libraries for Laravel, we need to install the PHP extension for MongoDB. Run the following command:

sudo pecl install mongodb
You will also need to ensure that the mongodb extension is enabled in your php.ini file. The location of your php.ini file will vary depending on your operating system. Add the following line to your php.ini file:

extension="mongodb.so"

Install PHP dependencies using Composer:

```bash
composer install
```

Install JavaScript dependencies using npm:

```bash
npm install
```

### 3. Configure MongoDB

Create a `.env` file by copying the `.env.example` file:

```bash
cp .env.example .env
```

Update the `.env` file with your MongoDB configuration:

```
DB_CONNECTION=mongodb
DB_URI="mongodb://localhost:27017"
DB_DATABASE=rental_mobil
```

### 4. Run Migrations

Run the following command to create the necessary collections in your MongoDB database:

```bash
php artisan migrate
```

### 5. Serve the Application

You can serve the application using the built-in PHP server:

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000`.
