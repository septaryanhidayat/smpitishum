# SMPS IT Ishlahul Ummah Prabumulih - Website Resmi Sekolah

Website resmi profil dan portal informasi **SMPS IT Ishlahul Ummah Prabumulih** (SMP IT Ishum), dibangun menggunakan Laravel 12 dan Tailwind CSS v4 dengan arsitektur modern, responsif, dan elegan selaras dengan identitas JSIT Indonesia.

## 🎓 Identitas & Tema
- **Warna Dominan**: Royal Indigo (`#312e81` / `#4338ca`) & Electric Blue (`#2563eb`)
- **Aksen**: Radiant Gold (`#f59e0b` / `#d97706`) & Clean Slate
- **Visi**: Mewujudkan Lembaga Islam Terpadu yang Mencetak Generasi Terbaik, Berkepribadian Islami, Berakhlak Mulia, Cerdas, Berprestasi, dan Berwawasan Global.
- **Kepala Sekolah**: Anita Carlyna, S.IP., M.Pd., Gr

## 🚀 Fitur Utama
1. **Beranda Interaktif**:
   - Hero Slider & Sambutan Kepala Sekolah
   - Quick Access Menu & Counter Statistik Akademik
   - Program Unggulan (Tahfidz 2 Juz Mutqin, Sains & Riset MIPA, Bilingual English & Arabic, Karakter Qur'ani JSIT)
   - Dewan Guru & Tenaga Kependidikan (GTK)
   - Galeri Kegiatan & Fasilitas Kampus Terpadu
   - Berita, Prestasi & Pengumuman Resmi
   - Testimonial Wali Santri & Alumni
   - Live Visitor Counter (Pengunjung Online & Total Kunjungan)
2. **Halaman Profil Lengkap**:
   - Sambutan Kepala Sekolah
   - Profil Sekolah, Akreditasi B, & Sarana Prasarana
   - Visi, Misi, & Tujuan Pendidikan
   - Sejarah Pendirian & Nilai Luhur
   - Struktur Organisasi & Yayasan Ishlahul Ummah
3. **Portal Informasi & Download**:
   - Modul Ajar & E-Book Santri
   - Hymne & Mars JSIT Indonesia
   - Pedoman & Panduan Akademik
   - Unduhan Logo Resmi & Format Transparan High Resolution
4. **SPMB Online & Donasi**:
   - Alur & Formulir SPMB Gelombang Exclusive
   - Promo Cashback 1 Juta Alumni SDIT Ishum
   - Portal Infaq Pembangunan & Beasiswa Tahfidz

## 🛠️ Tech Stack
- **Framework Backend**: Laravel 12 (PHP 8.4)
- **Frontend / Styling**: Blade Components, Tailwind CSS v4, FontAwesome 6, Alpine.js
- **Database**: SQLite (Development) / MySQL (Production cPanel)
- **Testing**: Pest PHP

## 💻 Instalasi Lokal

```bash
# Clone repository
git clone https://github.com/septaryanhidayat/smpitishum.git
cd smpitishum

# Install dependensi PHP & JavaScript
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Migrasi & Seeder Data Sekolah
php artisan migrate:fresh --seed

# Build asset frontend
npm run build

# Jalankan server lokal
php artisan serve
```

---
Dikelola dengan bangga oleh **SMPS IT Ishlahul Ummah Prabumulih**.
