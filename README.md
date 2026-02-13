# 🛒 Marketplace Junior Web Developer

[![Laravel Version](https://img.shields.io/badge/Laravel-v11.x-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Aplikasi Marketplace sederhana yang dibangun untuk memenuhi standar kompetensi Junior Web Developer. Proyek ini mencakup fitur manajemen produk, kategori, stok, hingga sistem pemesanan otomatis.

## ✨ Fitur Utama
* [cite_start]**Autentikasi Keamanan**: Login & Register untuk akses Dashboard Admin[cite: 387, 394].
* [cite_start]**CRUD Produk & Kategori**: Manajemen data produk lengkap dengan kategori berelasi[cite: 529, 756].
* [cite_start]**Sistem Upload Gambar**: Integrasi penyimpanan gambar produk ke local storage[cite: 579, 639].
* [cite_start]**Manajemen Stok Pintar**: Fitur penambahan stok instan dan pengurangan otomatis saat pesanan masuk[cite: 1169, 1313].
* [cite_start]**Dashboard Admin Modern**: Menggunakan template AdminLTE untuk navigasi yang user-friendly[cite: 41].
* [cite_start]**Portal Marketplace**: Halaman depan (Landing Page) bagi pembeli untuk melihat katalog produk[cite: 1225].

## 🛠️ Tech Stack
* [cite_start]**Backend**: Laravel 11 [cite: 15]
* [cite_start]**Database**: MySQL / MariaDB [cite: 35]
* [cite_start]**Frontend**: Blade Templating, Bootstrap 5, AdminLTE [cite: 6, 222]
* [cite_start]**Tools**: Composer, XAMPP [cite: 3, 5]

## 🚀 Cara Instalasi

1. **Clone Repositori**
   ```bash
   git clone [https://github.com/username/ujikom-app.git](https://github.com/username/ujikom-app.git)
   cd ujikom-app

2. **Instal Dependensi**
   ```bash
   composer install

3. **Konfigurasi Environment Salin .env.example menjadi .env dan sesuaikan pengaturan database:**
   ```bash
    DB_DATABASE=ujikom-app
    DB_USERNAME=root    
    DB_PASSWORD=

4. **Konfigurasi Environment Salin .env.example menjadi .env dan sesuaikan pengaturan database:**
   ```bash
   php artisan migrate
   php artisan db:seed --class=UserSeeder

5. **Link Storage Buat tautan simbolis untuk folder gambar:**
   ```bash
   php artisan storage:link

6. **Jalankan Aplikasi:**
   ```bash
    php artisan serve

    Akses di: http://127.0.0.1:8000

🔐 Akun Demo (Admin)
Email: admin@gmail.com 
Password: admin123

Dibuat dengan ❤️ untuk program pelatihan Junior Web Developer 2026.