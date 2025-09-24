# Aplikasi Pembukuan Sekolah

---

## ⚙️ Persyaratan Sistem

-   PHP >= 8.2
-   Composer >= 2.x
-   Node.js >= 20.x
-   NPM >= 10.x
-   Laravel 12.x
-   Database: MySQL / MariaDB / PostgreSQL

---

## 📦 Instalasi Project

1. **Clone repository**

```bash
git clone https://github.com/mriefky11/projectPembukuan.git
```
cd projectPembukuan

2. **Install PHP dependencies**

composer install

3. **Install Node.js dependencies**

npm install

4. **Copy file environment**

cp .env.example .env

5. **Generate application key**

php artisan key:generate

6. **konfigurasi database di .env**

7. **Jalankan migrasi dan seeder**

php artisan migrate
php artisan db:seed --class=UserSeeder

## 💻 Jalankan Project

1. Menjalankan server Laravel
   php artisan serve

2. Menjalankan Vite (Tailwind + DaisyUI)
   npm run dev

3. Akses aplikasi di browser
   http://127.0.0.1:8000/login
