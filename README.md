# ImpactGuru Mini CRM – Internship Project

## Company
ImpactGuru

## Project Title
ImpactGuru Mini CRM – Customer & Order Management System

## Developer
Name: Bharati Jain  
Email: bharatijain802@gmail.com  

## Overview 
This project is a Mini CRM system built using Laravel as part of the ImpactGuru Internship assignment.

The system helps manage:
- Customers
- Orders
- User roles (Admin & Staff)
- Order statuses
- Dashboard analytics
- Data export (CSV/PDF)

It demonstrates practical use of Laravel authentication, Blade UI, Eloquent ORM, routing, validation, and role-based access control.

## Modules Implemented

### Authentication
- Login / Logout
- Role-based access (Admin / Staff)

### Dashboard
- Total customers
- Total orders
- Revenue summary
- Recent customers list
- Export customers list as PDF/CSV File

### Customer Management
- Add customer
- Edit customer
- Delete customer
- Profile image upload

### Orders Management
The Orders module allows Admin users to:

- Add new orders
- View all orders
- Edit order details
- Delete orders
- Search orders by product name
- Export orders as CSV/PDF file

Each order includes:
- Customer name
- Product name
- Quantity
- Price
- Status (default: Pending)

### Role Permissions
#### Admin:
- Full access
- Can add/edit/delete customers
- Can export orders as pdf/csv file

#### Staff:
- Read-only access
- Can view dashboard
- Cannot modify records

## Tech Stack

- Laravel
- PHP
- MySQL
- Blade
- Bootstrap / Tailwind
- GitHub

## Screenshots

### 1. Login Page
![Login Page](screenshots/login_page.png)
*Sample credentials: admin@example.com / password*

### 2. Dashboard
![Dashboard](Screenshots/dashboard.png)
*Shows total customers, total orders, revenue summary, and recent customers.*

### 3. Customer Management
![Customer List](Screenshots/customers_list.png)
*List of customers with add, edit, delete, and profile image upload options.*

### 4. Orders Management
![Orders List](Screenshots/order_list.png)
*Shows orders with product names, quantities, prices, statuses, and search.*

### 5. Export Feature
![Exported Document](Screenshots/export_feature.png)
*Demonstrates CSV/PDF export functionality.*


## How to Run the Project

```bash
git clone <repo-link>
cd project-folder
composer install
npm install
php artisan key:generate
php artisan migrate
php artisan serve
