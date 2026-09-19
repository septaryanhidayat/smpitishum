# 🚀 Panduan Deployment & Konfigurasi cPanel SMPS IT Ishlahul Ummah Prabumulih

Panduan lengkap untuk hosting cPanel akun **`berandad`** (Domain: `https://smpitishumpbm.sch.id`).

---

## ⚡ 1. Solusi PHP 8.4 via `.htaccess` (Tanpa MultiPHP / Select PHP)

Jika server cPanel Anda default-nya PHP 8.1 dan MultiPHP / Select PHP sering gagal, Anda dapat **memaksa web server (Apache/LiteSpeed) menggunakan PHP 8.4** langsung dari file `.htaccess`.

Baris berikut sudah dipasang di `.htaccess` (root repositori) dan `public/.htaccess`:

```apache
# php -- BEGIN cPanel-generated handler, do not edit
# Set the “ea-php84” package as the default “PHP” programming language.
<IfModule mime_module>
  AddHandler application/x-httpd-ea-php84 .php .php8 .phtml
</IfModule>
# php -- END cPanel-generated handler, do not edit
```

### ⚠️ Catatan Penting Tipe Server cPanel:
1. **Jika hosting menggunakan EasyApache 4 (standar cPanel)**:
   Handler `application/x-httpd-ea-php84` di atas akan langsung mengaktifkan PHP 8.4.
2. **Jika hosting menggunakan CloudLinux (PHP Selector)**:
   Ganti tulisan `ea-php84` menjadi `alt-php84`:
   ```apache
   <IfModule mime_module>
     AddHandler application/x-httpd-alt-php84 .php .php8 .phtml
   </IfModule>
   ```
3. **Jika server hosting belum menginstall PHP 8.4**:
   Laravel di website ini kompatibel dengan PHP 8.2 & PHP 8.3. Cukup ubah ke `ea-php83` atau `alt-php83`.

### 🔍 Cara Cek Versi PHP Aktif Secara Real-Time:
Buka di browser:
👉 **`https://smpitishumpbm.sch.id/check.php`**
Halaman ini akan menampilkan secara transparan versi PHP yang sedang dieksekusi oleh web server Apache, lokasi document root, serta status koneksi database.

---

## 🗄️ 2. Konfigurasi File `.env` Produksi di cPanel

Salin konfigurasi berikut ke file `.env` di folder repositori `/home/berandad/repositories/smpitishum/.env`:

```env
# ==============================================================================
# ENVIRONMENT SETTINGS - SMPS IT ISHLAHUL UMMAH PRABUMULIH (CPANEL PRODUCTION)
# ==============================================================================
APP_NAME="SMPS IT Ishlahul Ummah Prabumulih"
APP_ENV=production
APP_KEY=base64:/pHX1Fa5FrzEUD5baFuzVKajWGQ4oUjuO53ytzrw2ac=
APP_DEBUG=false
APP_URL=https://smpitishumpbm.sch.id

APP_LOCALE=id
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=id_ID

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

# ==============================================================================
# DATABASE CPANEL (MySQL di cPanel)
# ==============================================================================
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=berandad_db_smpitishum
DB_USERNAME=berandad_admin_smpitishum
DB_PASSWORD=P4l3mb4ng123!

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=public
QUEUE_CONNECTION=sync

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="admin@smpitishumpbm.sch.id"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

# cPanel Setup Helper Secret Token
CPANEL_SETUP_TOKEN=SmpItIshum2026Setup
```

---

## 🚀 3. Git™ Version Control & Deployment di cPanel

Berdasarkan pengaturan Git di cPanel Anda:
* **Repository Path**: `/home/berandad/repositories/smpitishum`
* **Remote URL**: `https://github.com/septaryanhidayat/smpitishum.git`
* **Branch**: `main`

### Langkah Update & Deploy:
1. Buka menu **Git™ Version Control** di cPanel.
2. Klik tombol **Manage** pada repositori `smpitishum`.
3. Buka tab **Pull or Deploy**.
4. Klik tombol biru **Update from Remote** untuk menarik commit terbaru dari GitHub.
5. Klik tombol biru **Deploy HEAD Commit** untuk menjalankan proses deployment otomatis yang didefinisikan dalam `.cpanel.yml`.

### Otomasi File `.cpanel.yml`:
File `.cpanel.yml` terisolasi penuh dan aman:
- Hanya beroperasi 100% di dalam direktori repositori: `/home/berandad/repositories/smpitishum/`.
- **SAMA SEKALI TIDAK** menyentuh atau mengganggu folder `public_html` (web utama Anda tetap aman tanpa tersentuh).
- Mengatur izin akses direktori internal `storage/` dan `bootstrap/cache` ke `0775`.
- Mengatur direktori internal `public/` ke `0755`.
- Menyentuh (*touch*) file `public/index.php` untuk memicu reload cache server.

---

## 🛠️ 4. Tool Pembantu: cPanel Setup Helper

Untuk memudahkan operasional tanpa perlu terminal SSH:
Akses di browser:
👉 **`https://smpitishumpbm.sch.id/cpanel_setup.php?token=SmpItIshum2026Setup&action=status`**

Fitur 1-klik yang tersedia:
* **Perbaiki Izin Folder Storage** (`action=fix_storage`): Memastikan semua folder cache, session, view, dan log memiliki izin tulis (0775).
* **Ekstrak Vendor ZIP** (`action=extract_vendor`): Jika composer di terminal cPanel terbatas, Anda cukup meng-upload `vendor.zip` via File Manager lalu klik tombol ekstrak.
* **Jalankan Migrasi Database** (`action=migrate`): Menjalankan migrasi tabel database Laravel secara langsung.
* **Git Pull & Sync Otomatis** (`action=git_pull`): Melakukan pull git langsung dari browser.

---

## ⚡ 5. Update Database & Perintah Pull Terminal cPanel (Fitur Jalur PPDB Dinamis & Banner)

Untuk menerapkan pembaruan terbaru (Logo baru, Jalur PPDB Dinamis, CRUD Agenda & Pengumuman, Banner SPMB Editable, Reorganisasi Sidebar):

### A. Perintah Cepat di Terminal cPanel (Direkomendasikan):
Jalankan satu perintah berikut di terminal cPanel:
```bash
bash cpanel_pull.sh
```
Atau langkah manual via terminal:
```bash
# 1. Pindah ke folder repository
cd /home/berandad/repositories/smpitishum

# 2. Tarik update terbaru dari GitHub
git fetch origin main
git reset --hard origin/main

# 3. Jalankan migrasi database tabel ppdb_tracks
ea-php84 artisan migrate --force

# 4. (Opsional) Jalankan Seeder untuk mengisi data awal 6 jalur jika belum ada
ea-php84 artisan db:seed --class=SchoolDataSeeder --force

# 5. Bersihkan dan cache ulang aplikasi
ea-php84 artisan optimize:clear
ea-php84 artisan config:cache
ea-php84 artisan route:cache
ea-php84 artisan view:cache
ea-php84 artisan storage:link
touch public/index.php
```
*(Catatan: Jika menggunakan PHP default, ganti `ea-php84` dengan `php`)*

### B. Opsi Tanpa Terminal (via phpMyAdmin / cPanel UI):
1. **Via Git™ Version Control di cPanel**:
   - Masuk ke **Git™ Version Control** > **Manage** > **Pull or Deploy** > Klik **Update from Remote**.
2. **Eksekusi SQL via phpMyAdmin**:
   - Buka **phpMyAdmin** di cPanel, pilih database `berandad_smpitishum` (atau nama database yang Anda gunakan).
   - Klik tab **SQL**, lalu salin dan jalankan query berikut:
   ```sql
   CREATE TABLE IF NOT EXISTS `ppdb_tracks` (
     `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
     `name` varchar(255) NOT NULL,
     `slug` varchar(255) NOT NULL,
     `quota_percentage` int(11) DEFAULT 0,
     `discount_info` varchar(255) DEFAULT NULL,
     `description` text DEFAULT NULL,
     `requirements` longtext DEFAULT NULL,
     `order_index` int(11) NOT NULL DEFAULT 0,
     `is_active` tinyint(1) NOT NULL DEFAULT 1,
     `created_at` timestamp NULL DEFAULT NULL,
     `updated_at` timestamp NULL DEFAULT NULL,
     PRIMARY KEY (`id`),
     UNIQUE KEY `ppdb_tracks_slug_unique` (`slug`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

   INSERT IGNORE INTO `ppdb_tracks` (`id`, `name`, `slug`, `quota_percentage`, `discount_info`, `description`, `requirements`, `order_index`, `is_active`, `created_at`, `updated_at`) VALUES
   (1, 'Jalur First Brive', 'jalur-first-brive', 10, 'Cashback & Prioritas', 'Jalur pendaftaran gelombang perdana dengan diskon dan kuota khusus.', 'Fotokopi Raport Terakhir, Mengisi Formulir Online', 1, 1, NOW(), NOW()),
   (2, 'Jalur Mutasi Kerja', 'jalur-mutasi-kerja', 5, 'Keringanan Khusus Mutasi', 'Jalur bagi calon siswa pindahan atau orang tua/wali yang mengalami mutasi dinas/tugas kerja.', 'Surat Keputusan (SK) Mutasi Kerja Orang Tua/Wali, Fotokopi KK & Akta Kelahiran', 2, 1, NOW(), NOW()),
   (3, 'Jalur Tahfidz', 'jalur-tahfidz', 5, 'Cashback Rp. 750.000 s/d Rp. 1.000.000', 'Jalur khusus penghafal Al-Qur\'an dengan kuota 10 siswa.', 'Tahfidz minimal 4-5 Juz Cashback Rp. 750.000,-, Tahfidz >5 Juz Cashback Rp. 1.000.000,-. Mengikuti tes sima\'an tahfidz bersama dewan musyrif Al-Qur\'an Ishum.', 3, 1, NOW(), NOW()),
   (4, 'Jalur Alumni', 'jalur-alumni', 25, 'Potongan Uang Pangkal Rp. 1.000.000', 'Keringanan istimewa bagi lulusan SD IT Ishlahul Ummah 1 dan 2 Prabumulih (kuota 50 siswa).', 'Surat keterangan / Ijazah lulusan SD IT Ishlahul Ummah', 4, 1, NOW(), NOW()),
   (5, 'Jalur Prestasi', 'jalur-prestasi', 30, 'Bebas Tes Akademik & Keringanan Biaya', 'Jalur prestasi akademik (Juara Umum/Kelas 1-3 berturut-turut) dan non-akademik (Sains, Olahraga, Seni, Bahasa tingkat Kota/Provinsi/Nasional).', 'Sertifikat/Piagam Kejuaraan asli/legalisir, Nilai Rapor', 5, 1, NOW(), NOW()),
   (6, 'Jalur Reguler', 'jalur-reguler', 25, 'Biaya Standar SPMB', 'Jalur seleksi tes mandiri masuk SMP IT Ishlahul Ummah.', 'Tes Potensi Akademik (Matematika, Bahasa Indonesia, PAI), Tes Kemampuan Membaca Al-Qur\'an (Tahsin & Tajwid), Wawancara Komitmen Orang Tua & Siswa', 6, 1, NOW(), NOW());
   ```
3. Atau jalankan via web browser:
   - Akses: `https://smpitishumpbm.sch.id/cpanel_setup.php?token=SmpItIshum2026Setup&action=migrate`
