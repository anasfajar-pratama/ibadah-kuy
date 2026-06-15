# Panduan Instalasi ibadah-Kuy CMS

## Prasyarat

- PHP 8.2 atau lebih baru
- Composer 2.x
- Node.js 18+ dan npm/yarn
- MySQL 8.0 atau MariaDB 10.5+
- Ekstensi PHP: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `gd` atau `imagick`

---

## Langkah Instalasi Lokal

### 1. Extract & Masuk ke Folder Proyek

```bash
unzip ibadah-kuy.zip
cd ibadah-kuy
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Install Dependensi Node.js

```bash
npm install
```

### 4. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Buka file `.env` dan sesuaikan:

```env
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ibadah_kuy      # Ganti sesuai nama database Anda
DB_USERNAME=root             # Ganti sesuai username MySQL
DB_PASSWORD=                 # Isi password jika ada
```

### 5. Buat Database

Buka phpMyAdmin atau MySQL CLI, kemudian buat database:

```sql
CREATE DATABASE ibadah_kuy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Jalankan Migrasi & Seeder

```bash
php artisan migrate --seed
```

Perintah ini akan:
- Membuat semua tabel database
- Mengisi data contoh (paket, hotel, pembimbing, artikel, dll)
- Membuat akun admin default

### 7. Buat Symlink Storage

```bash
php artisan storage:link
```

### 8. Build Asset Frontend

```bash
npm run build
```

### 9. Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

---

## Akun Admin Default

| Field    | Value                    |
|----------|--------------------------|
| URL      | http://localhost:8000/admin |
| Email    | admin@ibadahkuy.com      |
| Password | Admin123!                |

> ⚠️ **PENTING**: Segera ganti password setelah login pertama kali!

---

## Deployment ke Hostinger Shared Hosting

### Persiapan

1. Pastikan Hostinger mendukung PHP 8.2 (cek di hPanel > PHP Configuration)
2. Aktifkan ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `gd`, `intl`, `fileinfo`

### Upload File

1. Upload **semua file proyek** ke folder `public_html/` (atau subdomain folder)
2. Pindahkan isi folder `public/` ke root `public_html/`
3. Edit `public_html/index.php`:

```php
// Ganti baris ini:
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// Menjadi (sesuaikan path):
require __DIR__.'/../ibadah-kuy/vendor/autoload.php';
$app = require_once __DIR__.'/../ibadah-kuy/bootstrap/app.php';
```

**Struktur folder di Hostinger:**
```
home/user/
├── ibadah-kuy/          ← Upload seluruh proyek di sini
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   └── vendor/
└── public_html/         ← Isi folder public/ diletakkan di sini
    ├── index.php
    ├── .htaccess
    └── build/
```

### Database di Hostinger

1. Buka **hPanel > MySQL Databases**
2. Buat database baru, catat nama, username, dan password
3. Update file `.env`:

```env
DB_HOST=127.0.0.1
DB_DATABASE=nama_database_hostinger
DB_USERNAME=username_mysql
DB_PASSWORD=password_mysql
```

4. Import database via phpMyAdmin atau jalankan migrasi lewat SSH:

```bash
php artisan migrate --seed
```

### Konfigurasi .htaccess

File `.htaccess` sudah disertakan di folder `public/`. Pastikan mod_rewrite aktif.

### Storage Permission

```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

---

## Fitur Admin Panel

Akses: `http://domain.com/admin`

| Menu | Keterangan |
|------|-----------|
| **Paket** | Kelola paket haji & umrah |
| **Hotel** | Data hotel Makkah & Madinah |
| **Pembimbing** | Profil pembimbing |
| **Jadwal** | Jadwal keberangkatan |
| **Data Jamaah** | Manajemen jamaah |
| **Artikel** | Konten blog & artikel |
| **Galeri** | Manajemen foto |
| **Testimoni** | Ulasan jamaah |
| **FAQ** | Pertanyaan & jawaban |
| **Banner** | Slider homepage |

---

## Fitur Kompresi Gambar Otomatis

Setiap gambar yang diupload melalui admin panel akan **dikompres otomatis**:

- Maksimal lebar: 1920px
- Maksimal tinggi: 1080px  
- Kualitas JPEG: 80%
- Thumbnail: 400x300px

Konfigurasi dapat diubah di file `.env`:

```env
IMAGE_MAX_WIDTH=1920
IMAGE_MAX_HEIGHT=1080
IMAGE_QUALITY=80
IMAGE_THUMBNAIL_WIDTH=400
IMAGE_THUMBNAIL_HEIGHT=300
```

---

## Troubleshooting

### Error "Class not found"
```bash
composer dump-autoload
php artisan cache:clear
php artisan config:clear
```

### Error "Storage permission denied"
```bash
chmod -R 775 storage/ bootstrap/cache/
```

### Gambar tidak muncul
```bash
php artisan storage:link
```

### Halaman 500 setelah deployment
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Teknologi yang Digunakan

- **Laravel 12** — PHP Framework
- **Filament v3** — Admin Panel
- **MySQL** — Database
- **Tailwind CSS** — Styling
- **Alpine.js** — JavaScript interaktivitas
- **Swiper.js** — Slider
- **Intervention Image** — Kompresi gambar otomatis
- **Vite** — Asset bundler

---

## Kontak Support

Email: admin@ibadahkuy.com  
WhatsApp: +62 812-3456-7890
