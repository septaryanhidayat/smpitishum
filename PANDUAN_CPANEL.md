# 🚀 Panduan Deployment Laravel SMPS IT Ishlahul Ummah Prabumulih ke cPanel

Panduan lengkap langkah demi langkah untuk mengunggah dan mengaktifkan website Laravel 12 (PHP 8.4) SMPS IT Ishlahul Ummah Prabumulih ke hosting cPanel dengan database MySQL.

---

## 📋 1. Persyaratan Server / Hosting cPanel & Solusi PHP

Website SMPS IT Ishlahul Ummah Prabumulih dibangun menggunakan Laravel modern yang membutuhkan PHP 8.2+ (direkomendasikan **PHP 8.4**).

### A. Solusi Web (Otomatis via `.htaccess`)
Web server (Apache / LiteSpeed) di cPanel dapat dipaksa menggunakan PHP 8.4 secara lokal untuk folder website Anda melalui file `.htaccess`. Baris berikut sudah terpasang di file `.htaccess` dan `public/.htaccess`:
```apache
<IfModule mime_module>
  AddHandler application/x-httpd-ea-php84 .php .php8 .phtml
</IfModule>
```
*Catatan:*
- Jika hosting Anda memakai **EasyApache 4**: handler di atas langsung mengaktifkan PHP 8.4.
- Jika hosting memakai **CloudLinux**: ubah `ea-php84` menjadi `alt-php84`.
- Jika server hosting hanya menyediakan maksimal PHP 8.3 atau 8.2, cukup ganti angkanya menjadi `ea-php83` atau `ea-php82`.

### B. Solusi Terminal cPanel (CLI / Artisan)
Untuk menjalankan perintah Laravel dengan PHP 8.4 di cPanel Terminal:
```bash
echo "alias php='/usr/local/bin/ea-php84'" >> ~/.bashrc
source ~/.bashrc
```

---

## 🗄️ 2. Persiapan Database MySQL

1. Buka cPanel dan pilih menu **MySQL® Databases**.
2. Buat database baru, contoh: `username_smpitishum`.
3. Buat pengguna MySQL baru, contoh: `username_ishumuser` dengan kata sandi yang kuat.
4. Hubungkan pengguna tersebut ke database dengan memberikan **All Privileges** (Semua Hak Akses).
5. Opsi Import Cepat:
   - Buka **phpMyAdmin**, pilih database yang baru dibuat, lalu pilih tab **Import**.
   - Unggah file `database/cpanel_school_mysql_dump.sql`.
   - Klik **Go** / **Kirim** untuk mengimpor seluruh skema dan data resmi.
   - Atau via Terminal cPanel:
     ```bash
     php artisan migrate --seed
     ```

---

## 🚀 3. Deployment Menggunakan cPanel Git™ Version Control

### Langkah Clone Repositori di cPanel:
1. Buka cPanel Anda dan klik menu **Git™ Version Control**.
2. Klik tombol **Create**.
3. Masukkan informasi repositori:
   - **Clone URL**: `https://github.com/septaryanhidayat/smpitishum.git`
   - **Repository Path**: `/home/username/smpitishum`
   - **Repository Name**: `smpitishum`
4. Klik tombol **Create**.

### Langkah Konfigurasi Awal (.env & Vendor):
1. Buka menu **Terminal** di cPanel Anda.
2. Masuk ke folder repositori:
   ```bash
   cd ~/smpitishum
   cp .env.example .env
   php artisan key:generate
   ```
3. Install dependensi:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
4. Hubungkan storage & optimasi cache:
   ```bash
   php artisan storage:link
   php artisan optimize
   ```

---

## 🔐 4. Akses Panel Admin Website

- **URL Login**: `https://domain-anda.com/login`
- **Email Administrator**: `admin@smpitishum.sch.id`
- **Password**: Password default seeder yang Anda tetapkan

---
Dikelola dengan bangga oleh **SMPS IT Ishlahul Ummah Prabumulih**.
