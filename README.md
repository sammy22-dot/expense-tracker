# Expense Tracker - Laravel App

A simple expense tracking web application built with Laravel. Users can manage their daily expenses, upload profile avatars, and view statistics through a dashboard.

---

## Prerequisites

Make sure you have the following installed:

* PHP (>= 8.x)
* Composer
* Node.js & npm
* XAMPP (Apache & MySQL)
* Git

---

## Installation (Local Setup using XAMPP)

### 1. Clone or Copy Project

Place the project inside your XAMPP `htdocs` folder:

```
d:/xampp/htdocs/expense-tracker/
```

Or clone via Git:

```
git clone https://github.com/your-username/expense-tracker.git
```

---

### 2. Start XAMPP

Start:

* Apache
* MySQL

---

### 3. Install Dependencies

```
composer install
npm install
```

---

### 4. Environment Setup

```
cp .env.example .env
php artisan key:generate
```

Update `.env` database settings:

```
DB_DATABASE=expense_db
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Database Setup

Create a database named:

```
expense_db
```

Then run:

```
php artisan migrate
php artisan db:seed
```

---

### 6. Storage Link (Important for avatars)

```
php artisan storage:link
```

---

### 7. Run the Project

Option 1 (XAMPP URL):

```
http://localhost/expense-tracker/public
```

Option 2 (Artisan server):

```
php artisan serve
```

Then open:

```
http://127.0.0.1:8000
```

---

### 8. Compile Frontend Assets

```
npm run dev
```

---

## Features

* User Authentication (Register/Login)
* CRUD Operations for Expenses
* Profile Avatar Upload & Edit
* User Avatar in Navbar with Dropdown
* Responsive UI using Bootstrap 5
* Categories & Dashboard Statistics
* Logout Confirmation Modal

---

## Usage

* Register or login at:

  * `/register`
  * `/login`

* Dashboard:

  * `/expenses` → manage expenses

* Profile:

  * `/profile` → view stats

* Edit Avatar:

  * `/profile/edit` → upload image (JPG/PNG/GIF, max 2MB)

---

## Project Structure

```
app/Models/User.php
app/Http/Controllers/ProfileController.php
resources/views/profile/
resources/views/layouts/app.blade.php
database/migrations/*_add_avatar*
```

---

## Troubleshooting

* **Missing avatar column**

  ```
  php artisan migrate
  ```

* **Images not loading**

  ```
  php artisan storage:link
  ```

* **NPM errors**

  ```
  npm install && npm run dev
  ```

* **404 Error**
  Make sure you access the `/public` directory or use `php artisan serve`.

---

## Production Notes

* Update `.env` with production database credentials
* Run:

  ```
  php artisan optimize:clear
  ```

---

## Built With

* Laravel 11
* Bootstrap 5
* Blade Template Engine

---

## Author

Your Name
