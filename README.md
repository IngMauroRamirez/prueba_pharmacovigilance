# Pharmacovigilance Test

**Author:** Mauro Ramírez  
**Laravel Version:** 13.2.0  

---

## Project Description

This project implements a Pharmacovigilance module that allows identifying customers who purchased medications associated with a specific lot number within a defined date range and sending alert notifications.

The system includes authentication, medication search, orders retrieval, customer details, and alert logging.

---

## Setup Instructions

### 1. Clone repository
```bash
git clone https://github.com/IngMauroRamirez/prueba_pharmacovigilance.git
cd pharmacovigilance
```

### 2. Install dependencies
```bash
composer install
npm install
```

### 3. Enviroment configuration
Copy .env file:
```bash
cp .env.example .env
```

Create a database named:

```bash
pharmacovigilance
```

Using collation:

```bash
utf8mb4_unicode_ci
```

Then update your ``.env`` file with the following database configuration:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pharmacovigilance
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate application key
```bash
php artisan key:generate
```

### 5. Run migrations and seeders
```bash
php artisan migrate --seed
```
This will create the database schema and populate it with sample data.

### 6. Run development server
```bash
php artisan serve
```
Access the system at
```bash
http://127.0.0.1:8000/pharmacovigilance/login
```

### 7. Run Frontend assets
```bash
npm run dev
```

---

## API Endpoints
```bash
POST   /api/login
GET    /api/medications/search
GET    /api/orders/{id}/{lot_number}
GET    /api/customers/{id}
POST   /api/alerts/send
```

---

## Database Schema

Main entities:

- Users
- Customers
- Medications
- Orders
- Order_Items
- Alerts

Relationships:

- Orders belong to Customers
- Orders have many Order_Items
- Order_Items belong to Medications
- Alerts reference Customers and Orders

All schema definitions are implemented using Laravel migrations located in:

```bash
database/migrations
```

For more information see the image located in:

```bash
public/docs/db_schema.png
```

---

## Database Schema

The database structure dump is included in:

```bash
public/docs/pharmacovigilance_schema.sql
```

This file contains the schema definition without data.


---

## Sample Seed Data

Sample data is generated using Laravel seeders located in:

```bash
database/seeders
```

To generate sample data:

```bash
php artisan migrate:fresh --seed
```

---

## Design Decisions

### Blade + Auth Middleware

Blade views combined with Vue components were used instead of a full SPA to simplify session-based authentication. Blade allows direct use of Laravel's ``auth`` middleware, making it easier to protect routes without implementing token-based authentication. This approach reduces project complexity and complies with the requirement allowing session-based authentication. Additionally, the ``auth`` middleware ensures only authenticated users can access the pharmacovigilance module.

### DataTables via CDN

DataTables was integrated using CDN instead of installing via NPM to avoid increasing project build complexity. This approach allowed quick implementation of pagination without modifying Laravel build configuration. Since the goal was to meet pagination requirements, CDN provided a lightweight and efficient solution suitable for this technical test.

### Use of Eloquent ORM and Relationships

Eloquent ORM was used for database queries due to its native Laravel integration and ability to manage table relationships clearly and maintainably. Using relationships such as ``hasMany``, ``belongsTo``, and eager loading with ``with``, reduced manual SQL complexity and improved code readability. Additionally, eager loading prevented N+1 query issues and optimized performance when retrieving related orders, customers, and medications.

---

## Assumptions

### Seeder Usage for Sample Data

Seeders were used to generate sample data in order to optimize development time and avoid manually writing multiple insert statements. This allowed quick population of users, customers, medications, and orders required to test system functionality.

### Alert Sending Simulation

Email alert sending was simulated by generating an informational message indicating that the alert was sent. This simulation allowed storing alert records in the ``alerts`` table, fulfilling the functional requirement without configuring a real email service. The implemented functionality demonstrates the notification flow and audit logging.

### Pagination

Pagination is implemented using DataTables integrated via CDN.

### Logout Button

I implemented the logout button to more clearly illustrate the topic of login using the session-based authentication method.
