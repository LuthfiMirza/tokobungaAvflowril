# 🌸 Avflowril - Toko Bunga Online

<div align="center">
  <img src="public/assets/images/logop1.jpg" alt="Avflowril Logo" width="200"/>
  
  [![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
  [![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
  [![Filament](https://img.shields.io/badge/Filament-3.3-orange.svg)](https://filamentphp.com)
  [![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
</div>

## 📖 Tentang Avflowril

**Avflowril** adalah platform e-commerce modern yang mengkhususkan diri dalam penjualan bucket bunga premium. Dibangun dengan teknologi Laravel terbaru, aplikasi ini menyediakan pengalaman berbelanja yang seamless dengan fitur-fitur canggih untuk manajemen produk, pesanan, dan tracking pengiriman.

### ✨ Fitur Utama

#### 🛍️ **E-Commerce Core**
- **Katalog Produk**: Tampilan produk yang menarik dengan kategori bucket bunga
- **Shopping Cart**: Keranjang belanja dengan AJAX real-time updates
- **Checkout System**: Proses checkout yang mudah dan aman
- **Payment Integration**: Sistem pembayaran terintegrasi
- **Order Management**: Manajemen pesanan lengkap

#### 👤 **User Management**
- **Authentication**: Login/Register dengan validasi keamanan
- **User Profile**: Profil pengguna dengan desain modern
- **Password Security**: Sistem keamanan password dengan strength meter
- **Order History**: Riwayat pesanan pengguna

#### 📦 **Order Tracking**
- **Real-time Tracking**: Pelacakan pesanan real-time
- **Status Updates**: Update status otomatis
- **Tracking API**: API untuk tracking eksternal
- **Notification System**: Notifikasi status pesanan

#### 🎨 **Modern UI/UX**
- **Responsive Design**: Desain responsif untuk semua perangkat
- **Modern Interface**: Interface yang clean dan user-friendly
- **Smooth Animations**: Animasi yang halus dan menarik
- **Professional Layout**: Layout profesional dengan konsistensi desain

#### ⚙️ **Admin Panel**
- **Filament Admin**: Panel admin modern dengan Filament
- **Product Management**: Manajemen produk lengkap
- **Order Management**: Kelola pesanan dan status
- **User Management**: Manajemen pengguna
- **Analytics Dashboard**: Dashboard analitik

## 🚀 Demo

🌐 **Live Demo**: [https://avflowril.com](https://github.com/LuthfiMirza/tokobungaAvflowril)

### 📱 Screenshots

<details>
<summary>Lihat Screenshots</summary>

#### Homepage
![Homepage](docs/screenshots/homepage.png)

#### Shop Page
![Shop](docs/screenshots/shop.png)

#### Cart Page
![Cart](docs/screenshots/cart.png)

#### Profile Page
![Profile](docs/screenshots/profile.png)

#### Admin Panel
![Admin](docs/screenshots/admin.png)

</details>

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 12.x** - PHP Framework
- **PHP 8.2+** - Programming Language
- **MySQL** - Database
- **Filament 3.3** - Admin Panel

### Frontend
- **Blade Templates** - Templating Engine
- **Bootstrap 5** - CSS Framework
- **jQuery** - JavaScript Library
- **FontAwesome** - Icons
- **CSS3 & HTML5** - Modern Web Standards

### Tools & Libraries
- **Composer** - PHP Dependency Manager
- **NPM** - Node Package Manager
- **Vite** - Build Tool
- **Laravel Tinker** - REPL

## 📋 Persyaratan Sistem

- **PHP**: >= 8.2
- **Composer**: >= 2.0
- **Node.js**: >= 16.x
- **NPM**: >= 8.x
- **MySQL**: >= 8.0
- **Apache/Nginx**: Web Server

## 🔧 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/LuthfiMirza/tokobungaAvflowril.git
cd tokobungaAvflowril
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=avflowril_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Migration & Seeding

```bash
# Create database tables
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 6. Storage Link

```bash
# Create storage symbolic link
php artisan storage:link
```

### 7. Build Assets

```bash
# Build frontend assets
npm run build

# Or for development
npm run dev
```

### 8. Start Development Server

```bash
# Start Laravel development server
php artisan serve

# The application will be available at http://localhost:8000
```

## 🎯 Penggunaan

### Akses Aplikasi

- **Frontend**: `http://localhost:8000`
- **Admin Panel**: `http://localhost:8000/admin`

### Default Accounts

#### Admin Account
```
Email: admin@avflowril.com
Password: admin123
```

#### Customer Account
```
Email: customer@avflowril.com
Password: customer123
```

### Fitur Testing

#### Test Cart Functionality
```
URL: http://localhost:8000/test/add-to-cart
```
Menambahkan produk sample ke keranjang untuk testing.

#### Debug Checkout
```
URL: http://localhost:8000/checkout/debug
```
Debug informasi checkout dan session.

## 📁 Struktur Proyek

```
avflowril/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php
│   │   ├── CartController.php
│   │   ├── CheckoutController.php
│   │   ├── HomeController.php
│   │   ├── OrderTrackingController.php
│   │   └── ShopController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── OrderTracking.php
│   │   └── CartItem.php
│   └── Services/
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   ├── cart/
│   │   ├── checkout/
│   │   ├── orders/
│   │   ├── partials/
│   │   └── layouts/
│   └── assets/
├── routes/
│   └── web.php
├── database/
│   ├── migrations/
│   └── seeders/
└── public/
    └── assets/
```

## 🔗 API Endpoints

### Public Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/` | Homepage |
| GET | `/shop` | Shop page |
| GET | `/about` | About page |
| GET | `/contact` | Contact page |
| GET | `/product/{id}` | Product details |
| GET | `/track-order` | Order tracking |

### Cart Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/cart` | View cart |
| POST | `/cart/add` | Add to cart |
| POST | `/cart/update` | Update cart |
| POST | `/cart/remove` | Remove from cart |
| POST | `/cart/clear` | Clear cart |

### Authentication Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/login` | Login form |
| POST | `/login` | Process login |
| GET | `/register` | Register form |
| POST | `/register` | Process registration |
| POST | `/logout` | Logout |

### Protected Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/profile` | User profile |
| PUT | `/profile` | Update profile |
| GET | `/checkout` | Checkout page |
| GET | `/my-orders` | User orders |

## 🎨 Customization

### Mengubah Tema

1. Edit file `resources/views/layouts/app.blade.php`
2. Modifikasi CSS di `public/assets/css/`
3. Sesuaikan warna brand di variabel CSS

### Menambah Fitur

1. Buat controller baru: `php artisan make:controller NamaController`
2. Buat model: `php artisan make:model NamaModel -m`
3. Tambahkan route di `routes/web.php`
4. Buat view di `resources/views/`

### Konfigurasi Payment Gateway

Edit file `config/services.php` untuk menambahkan konfigurasi payment:

```php
'midtrans' => [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
],
```

## 🧪 Testing

### Menjalankan Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=CartTest

# Run with coverage
php artisan test --coverage
```

### Test Categories

- **Unit Tests**: Testing individual components
- **Feature Tests**: Testing application features
- **Browser Tests**: End-to-end testing

## 📊 Performance

### Optimization Tips

1. **Cache Configuration**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

2. **Database Optimization**
```bash
php artisan optimize
```

3. **Asset Optimization**
```bash
npm run build
```

## 🔒 Security

### Security Features

- **CSRF Protection**: Laravel CSRF tokens
- **SQL Injection Prevention**: Eloquent ORM
- **XSS Protection**: Blade templating
- **Password Hashing**: Bcrypt hashing
- **Input Validation**: Form request validation

### Security Best Practices

1. Selalu update dependencies
2. Gunakan HTTPS di production
3. Set proper file permissions
4. Regular security audits

## 🚀 Deployment

### Production Deployment

1. **Server Requirements**
   - PHP 8.2+
   - MySQL 8.0+
   - Nginx/Apache
   - SSL Certificate

2. **Environment Setup**
```bash
# Set production environment
APP_ENV=production
APP_DEBUG=false
```

3. **Optimization**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Docker Deployment

```dockerfile
# Dockerfile example
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copy application
COPY . /var/www
WORKDIR /var/www

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

EXPOSE 9000
CMD ["php-fpm"]
```

## 🤝 Contributing

Kami menyambut kontribusi dari komunitas! Berikut cara berkontribusi:

### 1. Fork Repository

```bash
git fork https://github.com/LuthfiMirza/tokobungaAvflowril.git
```

### 2. Create Feature Branch

```bash
git checkout -b feature/amazing-feature
```

### 3. Commit Changes

```bash
git commit -m 'Add some amazing feature'
```

### 4. Push to Branch

```bash
git push origin feature/amazing-feature
```

### 5. Open Pull Request

Buat pull request dengan deskripsi yang jelas tentang perubahan yang dibuat.

### Coding Standards

- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add tests for new features
- Update documentation

## 📝 Changelog

### Version 1.0.0 (2024-01-15)
- ✨ Initial release
- 🛍️ Complete e-commerce functionality
- 👤 User authentication system
- 📦 Order tracking system
- 🎨 Modern responsive design
- ⚙️ Filament admin panel

### Version 1.1.0 (Coming Soon)
- 🔔 Push notifications
- 💳 Multiple payment gateways
- 📱 Mobile app API
- 🌐 Multi-language support

## 📞 Support

### Bantuan & Dukungan

- **Email**: support@avflowril.com
- **GitHub Issues**: [Create Issue](https://github.com/LuthfiMirza/tokobungaAvflowril/issues)
- **Documentation**: [Wiki](https://github.com/LuthfiMirza/tokobungaAvflowril/wiki)

### FAQ

<details>
<summary>Bagaimana cara reset password?</summary>

1. Klik "Lupa Password" di halaman login
2. Masukkan email Anda
3. Cek email untuk link reset
4. Ikuti instruksi di email

</details>

<details>
<summary>Bagaimana cara menambah produk baru?</summary>

1. Login ke admin panel
2. Masuk ke menu "Products"
3. Klik "Create New Product"
4. Isi form dan upload gambar
5. Simpan produk

</details>

<details>
<summary>Bagaimana cara tracking pesanan?</summary>

1. Masuk ke halaman "Track Order"
2. Masukkan nomor pesanan
3. Lihat status real-time pesanan Anda

</details>

## 📄 License

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

```
MIT License

Copyright (c) 2024 Avflowril

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## 🙏 Acknowledgments

- **Laravel Team** - Framework yang luar biasa
- **Filament Team** - Admin panel yang powerful
- **Bootstrap Team** - CSS framework yang reliable
- **FontAwesome** - Icon library yang lengkap
- **Community Contributors** - Semua yang telah berkontribusi

---

<div align="center">
  <p>Dibuat dengan ❤️ oleh <a href="https://github.com/LuthfiMirza">Luthfi Mirza</a></p>
  <p>© 2024 Avflowril. All rights reserved.</p>
</div>

---

### 🌟 Star History

[![Star History Chart](https://api.star-history.com/svg?repos=LuthfiMirza/tokobungaAvflowril&type=Date)](https://star-history.com/#LuthfiMirza/tokobungaAvflowril&Date)

### 📈 Project Stats

![GitHub repo size](https://img.shields.io/github/repo-size/LuthfiMirza/tokobungaAvflowril)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/LuthfiMirza/tokobungaAvflowril)
![GitHub last commit](https://img.shields.io/github/last-commit/LuthfiMirza/tokobungaAvflowril)
![GitHub commit activity](https://img.shields.io/github/commit-activity/m/LuthfiMirza/tokobungaAvflowril)

---

**Happy Coding! 🚀**