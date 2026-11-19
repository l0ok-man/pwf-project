# Sistem Informasi Perpustakaan

Aplikasi manajemen perpustakaan berbasis web menggunakan Laravel 13.43.0.

## Tim Pengembang

- **Lookman** - Auth, User Management
- **Naya** - Category, Book, Member Management
- **Nabil** - Borrowing, Dashboard, Integration

## Tech Stack

- Laravel 13.43.0
- PHP 8.3+
- MySQL/PostgreSQL
- Bootstrap 5.3

## Fitur

### Authentication

- Login dengan role-based access (Admin & Petugas)
- Logout dengan session invalidation

### User Management (Admin Only)

- CRUD User
- Role assignment (Admin/Petugas)
- Password management

### Category Management

- CRUD Kategori Buku
- Relasi dengan buku

### Book Management

- CRUD Buku
- Tracking stok & stok tersedia
- ISBN validation
- Relasi dengan kategori

### Member Management

- CRUD Member perpustakaan
- Data kontak lengkap

### Borrowing Management

- Catat peminjaman buku
- Return buku otomatis update stok
- Deteksi overdue
- History peminjaman

### Dashboard

- Statistik total buku, kategori, member
- Peminjaman aktif & overdue count
- 5 peminjaman terbaru

## Requirements

- PHP >= 8.3
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (optional, untuk asset compilation)

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/l0ok-man/pwf-project.git
cd pwf-project
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` dan sesuaikan database config:

```env
DB_CONNECTION=???
DB_HOST=???
DB_PORT=???
DB_DATABASE=???
DB_USERNAME=???
DB_PASSWORD=???
```

### 4. Database Migration & Seeding

```bash
php artisan migrate
php artisan db:seed
```

### 5. Run Application

```bash
php artisan serve
```

Akses: `http://localhost:8000`

## Default Accounts

### Admin

- Email: `admin@gmail.com`
- Password: `password`

### Petugas

- Email: `petugas@gmail.com`
- Password: `password`

## Testing

```bash
php artisan test
```

Tests tersedia untuk:

- AuthTest
- UserTest
- CategoryTest
- BookTest
- MemberTest
- BorrowingTest

## Database Structure

### Tables

- `users` - User & authentication
- `categories` - Kategori buku
- `books` - Data buku & stok
- `members` - Member perpustakaan
- `borrowings` - Transaksi peminjaman

### Key Relations

- Book belongsTo Category
- Borrowing belongsTo Book, Member, User
- Book hasMany Borrowings
- Member hasMany Borrowings
- User hasMany Borrowings

## Workflow

### Peminjaman Buku

1. Petugas pilih buku (cek stok tersedia)
2. Pilih member
3. Tentukan tanggal tempo
4. Sistem catat peminjaman & kurangi `available_stock`

### Pengembalian Buku

1. Petugas klik tombol "Kembalikan" di daftar peminjaman
2. Sistem update status jadi "returned"
3. Sistem tambah `available_stock` buku

## API Routes

```
GET  /login              - Login page
POST /login              - Login process
POST /logout             - Logout

GET  /dashboard          - Dashboard

GET  /users              - List users (Admin)
GET  /users/create       - Create user form (Admin)
POST /users              - Store user (Admin)
GET  /users/{id}/edit    - Edit user form (Admin)
PUT  /users/{id}         - Update user (Admin)
DELETE /users/{id}       - Delete user (Admin)

GET  /categories         - List categories
GET  /categories/create  - Create category form
POST /categories         - Store category
GET  /categories/{id}/edit - Edit category form
PUT  /categories/{id}    - Update category
DELETE /categories/{id}  - Delete category

GET  /books              - List books
GET  /books/create       - Create book form
POST /books              - Store book
GET  /books/{id}/edit    - Edit book form
PUT  /books/{id}         - Update book
DELETE /books/{id}       - Delete book

GET  /members            - List members
GET  /members/create     - Create member form
POST /members            - Store member
GET  /members/{id}/edit  - Edit member form
PUT  /members/{id}       - Update member
DELETE /members/{id}     - Delete member

GET  /borrowings         - List borrowings
GET  /borrowings/create  - Create borrowing form
POST /borrowings         - Store borrowing
PATCH /borrowings/{id}/return - Return book
```

## Catatan Development

- Laravel 13.43.0 menggunakan PHP 8 attributes untuk model properties (`#[Fillable]`, `#[Hidden]`)
- Factory menggunakan sintaks modern dengan `fake()` helper
- Migration timestamps menggunakan format YYYY_MM_DD_HHMMSS
- Pagination default: 10 items per page
- Validation messages dalam Bahasa Indonesia

## Troubleshooting

### Migration Error

```bash
php artisan migrate:fresh --seed
```

### Cache Clear

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Permission Error (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
```

## License

Tugas Pemrograman Web Framework - Sistem Informasi

https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExMTgxYnZocGRhaHV3NGVuYmVlMW00dWtmNzBub2Q4NGVuM21jaGs2cCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/3oKIPnAiaMCws8nOsE/giphy.gif
