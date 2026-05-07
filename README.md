# 🛒 Marketplace Laravel

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**Aplikasi marketplace berbasis web yang dibangun dengan Laravel 12, dilengkapi panel Admin dan API untuk aplikasi mobile.**

[Fitur](#-fitur-utama) · [Instalasi](#-cara-instalasi) · [Penggunaan](#-cara-penggunaan) · [API](#-api-endpoints) · [Kontribusi](#-kontribusi)

</div>

---

## 📖 Tentang Proyek

Marketplace Laravel adalah aplikasi web full-stack yang menyediakan:

- **Panel Admin** berbasis web untuk mengelola produk, kategori, stok, dan memantau pesanan masuk.
- **REST API** dengan autentikasi Laravel Sanctum untuk integrasi aplikasi mobile (Flutter, dll).
- **Halaman Publik (Landing Page)** bagi pembeli untuk melihat katalog produk.

Proyek ini dibuat untuk memenuhi standar kompetensi **Junior Web Developer 2026**.

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|---|---|
| 🔐 **Autentikasi** | Login & Register dengan proteksi Middleware `IsAdmin` |
| 📦 **Manajemen Produk** | CRUD produk lengkap dengan upload gambar |
| 🗂️ **Manajemen Kategori** | CRUD kategori yang berelasi dengan produk |
| 📊 **Manajemen Stok** | Penambahan stok manual & pengurangan otomatis saat pesanan masuk |
| 🛍️ **Portal Pembeli** | Landing page publik untuk melihat katalog produk |
| 📋 **Order Management** | Panel daftar transaksi beserta detail pemesan |
| 📱 **REST API** | Endpoint untuk Login, Register, Produk, dan Order |

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Autentikasi API:** Laravel Sanctum
- **Database:** MySQL / MariaDB
- **Frontend:** Blade Templating, Bootstrap 5, AdminLTE
- **Tools:** Composer, XAMPP / Laragon

---

## ⚙️ Persyaratan Sistem

Sebelum memulai, pastikan komputer kamu sudah terinstal:

- [PHP](https://www.php.net/) versi **8.2 atau lebih baru**
- [Composer](https://getcomposer.org/) (package manager PHP)
- [MySQL](https://www.mysql.com/) atau MariaDB
- [Node.js & NPM](https://nodejs.org/) (untuk aset frontend)
- XAMPP, Laragon, atau server lokal sejenis

---

## 🚀 Cara Instalasi

Ikuti langkah-langkah berikut secara berurutan:

### 1. Clone Repositori

```bash
git clone https://github.com/ariefutsman/marketplace_laravel.git
cd marketplace_laravel
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Lalu buka file `.env` dan sesuaikan pengaturan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marketplace_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Jalankan Migrasi & Seeder

Perintah ini akan membuat tabel database dan mengisi data awal (termasuk akun admin):

```bash
php artisan migrate --seed
```

### 6. Buat Symbolic Link Storage

Langkah ini diperlukan agar gambar produk bisa tampil di browser:

```bash
php artisan storage:link
```

### 7. Install Dependensi Frontend (Opsional)

```bash
npm install
npm run build
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser dan akses: **http://127.0.0.1:8000**

---

## 🎯 Cara Penggunaan

### Akun Demo (Admin)

Setelah menjalankan seeder, kamu bisa langsung login dengan akun berikut:

| Field | Value |
|---|---|
| Email | `admin@gmail.com` |
| Password | `password` |

### Halaman Utama

| URL | Deskripsi |
|---|---|
| `http://127.0.0.1:8000` | Landing page untuk pembeli |
| `http://127.0.0.1:8000/login` | Halaman login admin |
| `http://127.0.0.1:8000/dashboard` | Panel Admin (perlu login) |

---

## 📡 API Endpoints

API ini menggunakan **Laravel Sanctum** untuk autentikasi berbasis token.

### Autentikasi

| Method | Endpoint | Deskripsi |
|---|---|---|
| `POST` | `/api/register` | Daftarkan pengguna baru |
| `POST` | `/api/login` | Login & dapatkan token |
| `POST` | `/api/logout` | Logout (hapus token) |

### Produk

| Method | Endpoint | Deskripsi |
|---|---|---|
| `GET` | `/api/products` | Ambil semua produk |
| `GET` | `/api/products/{id}` | Detail satu produk |

### Order

| Method | Endpoint | Deskripsi |
|---|---|---|
| `POST` | `/api/orders` | Buat pesanan baru |
| `GET` | `/api/orders` | Lihat riwayat pesanan |

> **Catatan:** Endpoint yang memerlukan autentikasi harus menyertakan header `Authorization: Bearer {token}`.

### Contoh Request (Login)

```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email": "admin@gmail.com", "password": "password"}'
```

---

## 🔌 Menjalankan untuk Perangkat Mobile

Jika kamu ingin mengakses API dari aplikasi mobile (Flutter, dll) di jaringan yang sama, jalankan server dengan IP lokal:

```bash
php artisan serve --host=IP_KOMPUTER_KAMU --port=8000
```

Ganti `IP_KOMPUTER_KAMU` dengan IP lokal komputer kamu (contoh: `192.168.1.10`). Cek IP kamu dengan perintah `ipconfig` (Windows) atau `ifconfig` (Mac/Linux).

---

## 📁 Struktur Direktori

```
marketplace_laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Logic untuk Web & API
│   │   └── Middleware/     # IsAdmin & autentikasi
│   └── Models/             # Model Eloquent (Product, Category, Order, dll)
├── database/
│   ├── migrations/         # Skema tabel database
│   └── seeders/            # Data awal (UserSeeder, dll)
├── resources/
│   └── views/              # Template Blade (Admin & Landing Page)
├── routes/
│   ├── web.php             # Rute halaman web
│   └── api.php             # Rute REST API
└── storage/
    └── app/public/         # Penyimpanan gambar produk
```

---

## 🤝 Kontribusi

Kontribusi sangat terbuka! Ikuti langkah berikut:

1. **Fork** repositori ini
2. Buat branch fitur baru: `git checkout -b fitur/nama-fitur`
3. Commit perubahan kamu: `git commit -m 'Menambahkan fitur baru'`
4. Push ke branch: `git push origin fitur/nama-fitur`
5. Buka **Pull Request**

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License**. Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

---

<div align="center">

Dibuat dengan ❤️ oleh **[ariefutsman](https://github.com/ariefutsman)** untuk program pelatihan Junior Web Developer 2026.

</div>
