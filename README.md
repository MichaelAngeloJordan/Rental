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
-   Node.js and npm (for frontend assets)

Clone the Repository

git https://github.com/MichaelAngeloJordan/Rental.git
cd Rental

```bash
php artisan migrate
```

You can serve the application using the built-in PHP server:

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000`.
