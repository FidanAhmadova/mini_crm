# Mini CRM

Laravel-based Customer Relationship Management system.

## Features

- ✅ Companies Management
- ✅ Customers Management  
- ✅ Deals Management
- ✅ Tasks Management
- ✅ Notes Management
- ✅ User Authentication (Breeze)
- ✅ RESTful API (v1) with Sanctum
- ✅ Gmail SMTP Integration
- ✅ Session Timeout (30 minutes)

## Tech Stack

- **Backend:** Laravel 11.x
- **Frontend:** Blade Templates + TailwindCSS
- **Database:** MySQL
- **Authentication:** Laravel Breeze + Sanctum

## Installation

```bash
# Clone repository
git clone https://github.com/FidanAhmadova/mini_crm.git
cd mini-crm

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_crm
DB_USERNAME=root
DB_PASSWORD=

# Configure Gmail SMTP in .env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=yourgmail@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls

# Run migrations and seeders
php artisan migrate
php artisan db:seed

# Start server
php artisan serve
```

## Usage

### Web Routes
- `/` - Welcome page
- `/dashboard` - Dashboard (auth required)
- `/companies` - Companies management
- `/customers` - Customers management
- `/deals` - Deals management
- `/tasks` - Tasks management
- `/notes` - Notes management

### API Routes (v1)
All API routes require authentication via Bearer token.

**Companies:**
```
GET    /api/v1/companies
POST   /api/v1/companies
GET    /api/v1/companies/{id}
PUT    /api/v1/companies/{id}
DELETE /api/v1/companies/{id}
```

**Customers:**
```
GET    /api/v1/customers
POST   /api/v1/customers
GET    /api/v1/customers/{id}
PUT    /api/v1/customers/{id}
DELETE /api/v1/customers/{id}
```

**Deals:**
```
GET    /api/v1/deals
POST   /api/v1/deals
GET    /api/v1/deals/{id}
PUT    /api/v1/deals/{id}
DELETE /api/v1/deals/{id}
```

**Tasks:**
```
GET    /api/v1/tasks
POST   /api/v1/tasks
GET    /api/v1/tasks/{id}
PUT    /api/v1/tasks/{id}
DELETE /api/v1/tasks/{id}
```

**Notes:**
```
GET    /api/v1/notes
POST   /api/v1/notes
GET    /api/v1/notes/{id}
PUT    /api/v1/notes/{id}
DELETE /api/v1/notes/{id}
```

## Testing

```bash
# Run tests
php artisan test

# Generate API token
php artisan tinker
>>> $user = App\Models\User::first();
>>> $user->createToken('api')->plainTextToken;
```

## Credentials

After seeding:
- Email: test@example.com
- Password: password

## License

MIT

