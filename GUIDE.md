# Expense Tracker Application

A modern, feature-rich expense tracking application built with **Laravel** and **Bootstrap**. Manage your finances effortlessly with beautiful UI and intuitive features.

## Features

✨ **Full CRUD Operations** - Create, read, update, and delete expenses
📊 **Category Management** - Pre-configured expense categories (Food, Transportation, Entertainment, Utilities, Shopping, Health, Education, and more)
🔐 **User Authentication** - Secure login and registration
💰 **Amount Tracking** - Track expenses with decimal precision
📅 **Date Management** - Record expense dates for better organization
📝 **Descriptions** - Add notes to your expenses
📊 **Dashboard** - View total expenses, count, and averages
🎨 **Bootstrap Styling** - Clean, responsive, modern UI

## Pre-configured Categories

1. **Food & Dining** - Groceries, restaurants, food delivery
2. **Transportation** - Fuel, parking, public transport
3. **Entertainment** - Movies, games, hobbies, events
4. **Utilities** - Electricity, water, internet, phone bills
5. **Shopping** - Clothing, household items
6. **Health & Medical** - Doctor visits, medicines, gym membership
7. **Education** - Courses, books, training materials
8. **Other** - Miscellaneous expenses

## Technology Stack

- **Backend**: Laravel 11 (PHP Framework)
- **Frontend**: Bootstrap 5 (CSS Framework)
- **Database**: MySQL
- **Authentication**: Laravel built-in authentication
- **ORM**: Eloquent

## Installation & Setup

### 1. Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL or MariaDB
- Node.js (for npm)

### 2. Database Setup
Make sure you have MySQL running and create a database:
```bash
mysql -u root -p
CREATE DATABASE expense_db;
EXIT;
```

### 3. Application Setup
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations and seed database
php artisan migrate:fresh --seed
```

### 4. Run the Application
```bash
# For development
php artisan serve

# The app will be available at http://localhost:8000
```

## Project Structure

```
├── app/
│   ├── Models/
│   │   ├── User.php (with expenses relationship)
│   │   ├── Expense.php (main expense model)
│   │   └── Category.php (category model)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ExpenseController.php (main CRUD controller)
│   │   │   └── Auth/ (authentication controllers)
│   └── Policies/
│       └── ExpensePolicy.php (authorization policies)
├── database/
│   ├── migrations/
│   │   ├── create_categories_table.php
│   │   └── create_expenses_table.php
│   └── seeders/
│       └── DatabaseSeeder.php (seeds default categories)
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php (main layout)
│   │   ├── expenses/
│   │   │   ├── index.blade.php (list expenses)
│   │   │   ├── create.blade.php (create form)
│   │   │   └── edit.blade.php (edit form)
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   └── welcome.blade.php (home page)
│   └── css/
│       └── app.css (custom styles)
└── routes/
    ├── web.php (web routes)
    └── auth.php (authentication routes)
```

## Database Schema

### Users Table
- id
- name
- email
- password
- email_verified_at
- remember_token
- timestamps

### Categories Table
- id
- name (unique)
- description (nullable)
- color (default: #007bff)
- timestamps

### Expenses Table
- id
- user_id (foreign key)
- category_id (foreign key)
- amount (decimal: 10,2)
- description (nullable)
- date
- timestamps

## API Routes

### Authentication Routes
- `GET /register` - Registration form
- `POST /register` - Register user
- `GET /login` - Login form
- `POST /login` - Login user
- `POST /logout` - Logout user

### Expense Routes
- `GET /expenses` - List all expenses (with dashboard stats)
- `GET /expenses/create` - Create expense form
- `POST /expenses` - Store new expense
- `GET /expenses/{id}/edit` - Edit expense form
- `PUT /expenses/{id}` - Update expense
- `DELETE /expenses/{id}` - Delete expense

## Usage Guide

### 1. Create Account
1. Visit the welcome page
2. Click "Register" or "Get Started"
3. Fill in your details (name, email, password)
4. Click "Register"

### 2. Login
1. Go to login page
2. Enter your email and password
3. Check "Remember me" if desired
4. Click "Login"

### 3. Add Expense
1. Click "Add Expense" button in navbar
2. Fill in the form:
   - Date: Select expense date
   - Category: Choose from dropdown
   - Amount: Enter amount (e.g., 45.99)
   - Description: Add optional notes
3. Click "Create Expense"

### 4. View Expenses
1. Dashboard shows:
   - Total expenses (sum of all amounts)
   - Total records (number of expenses)
   - Average expense
   - Number of categories
2. List view shows:
   - Date of expense
   - Description
   - Category (color-coded)
   - Amount in red text

### 5. Edit Expense
1. Find the expense in the list
2. Click "Edit" button
3. Modify the details
4. Click "Update Expense"

### 6. Delete Expense
1. Find the expense in the list
2. Click "Delete" button
3. Confirm deletion in alert

## Security Features

- **CSRF Protection** - All forms include CSRF tokens
- **Authentication Middleware** - Expense routes require login
- **Authorization Policies** - Users can only edit/delete their own expenses
- **Password Hashing** - Passwords are hashed using Laravel's hashing
- **Session Management** - Secure session handling

## Customization

### Add More Categories
Edit `database/seeders/DatabaseSeeder.php` and add new categories in the array:
```php
['name' => 'Your Category', 'description' => 'Description', 'color' => '#COLOR_HEX'],
```

Then run:
```bash
php artisan db:seed --class=DatabaseSeeder
```

### Change Colors
Categories use Bootstrap-compatible color codes (hex). Modify colors in the seeder file.

### Add New Fields to Expenses
1. Create a new migration
2. Add the field to the migration
3. Update the Expense model's `$fillable` array
4. Update forms and views

## Troubleshooting

### Database Connection Error
- Check `.env` file has correct DB credentials
- Ensure MySQL is running
- Run migrations: `php artisan migrate`

### Authentication Issues
- Clear cache: `php artisan cache:clear`
- Regenerate key: `php artisan key:generate`

### Missing Expenses
- Check user_id matches authenticated user
- Verify migrations ran: `php artisan migrate:status`

## Future Enhancements

- 📈 Statistical charts and graphs
- 🔍 Advanced filtering and search
- 📧 Expense reports via email
- 💾 Data export (CSV/PDF)
- 📱 Mobile app
- 🔔 Budget alerts
- 💡 AI-powered expense categorization

## License

This project is open source and available under the MIT License.

## Support

For issues or questions, please check the Laravel documentation at https://laravel.com/docs

---

**Happy Expense Tracking!** 💰
