# MultiRental

MultiRental is a marketplace platform built with Laravel that allows users to rent and manage items through a modern web interface.

The system supports user profiles, marketplace listings, rentals, reviews, private messaging and administration tools.

---

## Features

### User system
- Registration and login
- User profiles
- Avatar upload
- Profile banner upload
- Profile editing
- User ratings and reviews

### Marketplace
- Create marketplace listings
- Edit listings
- Delete listings
- Browse marketplace
- Search by item name
- Filter by location
- Filter by availability status
- Item categories
- Item inventory management

### Rentals
- Rent marketplace items
- Return rented items
- Rental history
- Active rental tracking

### Reviews
- User review system
- Average rating calculation
- Review history

### Messaging
- Private conversations between users
- Conversation history
- Marketplace communication

### Administration
- Admin panel
- User management
- User banning
- Marketplace moderation
- Listing removal

---

## Technology Stack

Backend:
- Laravel
- PHP 8.4
- MySQL

Frontend:
- Blade
- Bootstrap 5

Infrastructure:
- Docker
- Docker Compose

---

## Installation

Clone repository:

```bash
git clone https://github.com/maciek-wroblewski/multi-rental-platform
```

Enter project folder:

```bash
cd multi-rental-platform
```

Copy environment file:

```bash
cp .env.example .env
```

Start Docker:

```bash
docker compose up -d --build
```

Install dependencies:

```bash
docker compose exec app composer install
```

Generate application key:

```bash
docker compose exec app php artisan key:generate
```

Run migrations:

```bash
docker compose exec app php artisan migrate
```

Seed database:

```bash
docker compose exec app php artisan db:seed
```

Create storage link:

```bash
docker compose exec app php artisan storage:link
```

Clear cache:

```bash
docker compose exec app php artisan optimize:clear
```

Application should now be available at:

```
http://localhost:8000
```

---

## Admin Access

Administrator privileges are controlled using:

```
users.is_admin
```

Example:

```bash
docker compose exec app php artisan tinker
```

```php
$user=App\Models\User::find(1);

$user->is_admin=true;

$user->save();
```

---

## Documentation

Technical documentation available here:

[MultiRental Technical Documentation](docs/MultiRental_Dokumentacja_Techniczna.pdf)

---

## Authors

- Maciej Wróblewski
- Paweł Miedziński
- Maksymilian Wojtkowski
