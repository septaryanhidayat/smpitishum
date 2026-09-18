-- ==========================================================
-- SMPS IT ISHLAHUL UMMAH PRABUMULIH - DATABASE MYSQL EXPORT
-- Export Date: 2026-09-18 09:04:26
-- Compatible: MySQL 5.7+, MySQL 8.0+, MariaDB 10.3+
-- For cPanel phpMyAdmin Import & Git Deployments
-- ==========================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET NAMES utf8mb4;
SET time_zone = '+07:00';

-- --------------------------------------------------------
-- Table structure for table `activity_logs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `user_name` varchar(255) NULL DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `user_agent` longtext NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'info',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_created_at_index` (`created_at`),
  KEY `activity_logs_status_index` (`status`),
  KEY `activity_logs_action_index` (`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `agendas`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `agendas`;
CREATE TABLE `agendas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NULL DEFAULT NULL,
  `location` varchar(255) NULL DEFAULT NULL,
  `event_date` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'publish',
  `featured_image` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agendas_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `agendas`
INSERT INTO `agendas` (`id`, `title`, `slug`, `content`, `location`, `event_date`, `status`, `featured_image`, `created_at`, `updated_at`) VALUES
  (1, 'Pembukaan Class Meeting Semester Genap', 'pembukaan-class-meeting-semester-genap-2026', 'Upacara pembukaan dan dimulainya pertandingan Class Meeting Semester Genap seluruh santri putra dan putri.', 'Kampus SMP IT Ishlahul Ummah Prabumulih', '2026-06-17 08:00:00', 'publish', '/uploads/artikel/artikel-class-meeting.webp', '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (2, 'Pendaftaran SPMB Gelombang Exclusive', 'pendaftaran-spmb-gelombang-exclusive', 'Penerimaan peserta didik baru gelombang exclusive dengan kuota terbatas 24 siswa dan promo cashback 1 juta.', 'Kantor SPMB / Online via Website', '2026-06-25 08:00:00', 'publish', '/uploads/artikel/artikel-spmb-2026.webp', '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (3, 'Munaqosah & Ujian Tahfidz Al-Qur\'an', 'munaqosah-dan-ujian-tahfidz-al-quran', 'Pengujian kelayakan dan kemutqinan hafalan Al-Qur\'an 2 juz oleh dewan asatidz pembina TTQ.', 'Masjid Tholabul \'Ilmi Kampus Ishum', '2026-07-05 08:00:00', 'publish', '/uploads/artikel/artikel-wisuda-tahfidz.webp', '2026-09-18 09:03:58', '2026-09-18 09:03:58');

-- --------------------------------------------------------
-- Table structure for table `anggota_dewans`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `anggota_dewans`;
CREATE TABLE `anggota_dewans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `fraction` varchar(255) NULL DEFAULT 'Guru & Tenaga Kependidikan',
  `profile_summary` longtext NULL DEFAULT NULL,
  `education` longtext NULL DEFAULT NULL,
  `photo` varchar(255) NULL DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `anggota_dewans_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `anggota_dewans`
INSERT INTO `anggota_dewans` (`id`, `name`, `slug`, `position`, `fraction`, `profile_summary`, `education`, `photo`, `order`, `created_at`, `updated_at`) VALUES
  (1, 'Anita Carlyna, S.IP., M.Pd., Gr', 'anita-carlyna-sip-mpd-gr', 'Kepala Sekolah', 'Pimpinan Sekolah', 'Kepala SMPS IT Ishlahul Ummah Prabumulih. Berkomitmen mewujudkan generasi Qur\'ani yang berakhlak mulia, berprestasi dalam sains dan teknologi, mandiri, serta berwawasan global di bawah naungan JSIT Indonesia.', 'S1 Ilmu Administrasi Negara, Universitas Sriwijaya; S2 Manajemen Pendidikan, Universitas PGRI; Gr (Pendidikan Profesi Guru)', '/uploads/dewan/kepala-sekolah.webp', 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (2, 'Sesiana Giovani Lestari, S.Pd', 'sesiana-giovani-lestari-spd', 'Waka Kurikulum & Guru IPA', 'Guru IPA & Kurikulum', 'Tenaga pendidik profesional SMPS IT Ishlahul Ummah Prabumulih dalam bidang Ilmu Pengetahuan Alam dan koordinator integrasi Kurikulum Merdeka dengan kurikulum JSIT.', 'S1 Pendidikan Biologi, Universitas Muhammadiyah Palembang', '/uploads/dewan/guru-ipa.webp', 2, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (3, 'Nisa\'ul Istiqomah, S.T', 'nisaul-istiqomah-st', 'Guru Matematika & Pembimbing MIPA', 'Guru Matematika', 'Tenaga pendidik matematika dan pembimbing klub olimpiade sains santri SMPS IT Ishlahul Ummah Prabumulih.', 'S1 Teknik Kimia, Universitas Sriwijaya', '/uploads/dewan/guru-kelas.webp', 3, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (4, 'Herman Nurdiansyah, S.E', 'herman-nurdiansyah-se', 'Guru PAI, Hadits & PJOK', 'Guru PAI & Olahraga', 'Guru Pendidikan Agama Islam, Hadits, dan PJOK, aktif membina kedisiplinan, kepemimpinan, dan kebugaran jasmani santri.', 'STEI Al-Furqon', '/uploads/dewan/guru-pjok.webp', 4, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (5, 'Helen Azmi, S.Pd', 'helen-azmi-spd', 'Guru Tahsin & Tahfidz Al-Qur\'an (TTQ)', 'Guru TTQ & Keislaman', 'Pengampu program Tahsin dan Tahfidz Al-Qur\'an santri, membimbing hafalan mutqin minimal 2 juz serta tartil bacaan bersanad.', 'S1 Pendidikan Agama Islam, STAI Raudhatul Ulum', '/uploads/dewan/guru-tahfidz.webp', 5, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (6, 'Ahmad Fauzan, S.Pd.I', 'ahmad-fauzan-spdi', 'Guru Bahasa Arab & Pembina OSIS', 'Guru Bahasa Arab', 'Membina kompetensi percakapan Bahasa Arab harian dan memfasilitasi kegiatan kesiswaan serta kepemimpinan santri OSIS SMP IT.', 'S1 Pendidikan Bahasa Arab, UIN Raden Fatah', '/uploads/dewan/guru-bahasa.webp', 6, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (7, 'Sarah Ramadhani, S.Pd', 'sarah-ramadhani-spd', 'Guru Bahasa Inggris & Literasi', 'Guru Bahasa Inggris', 'Pengampu mata pelajaran Bahasa Inggris aktif dan pembina kegiatan English Club, storytelling, dan debat santri.', 'S1 Pendidikan Bahasa Inggris, Universitas Sriwijaya', '/uploads/dewan/guru-kelas.webp', 7, '2026-09-18 09:03:58', '2026-09-18 09:03:58');

-- --------------------------------------------------------
-- Table structure for table `bidangs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `bidangs`;
CREATE TABLE `bidangs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NULL DEFAULT NULL,
  `address` varchar(255) NULL DEFAULT NULL,
  `phone` varchar(255) NULL DEFAULT NULL,
  `email` varchar(255) NULL DEFAULT NULL,
  `website` varchar(255) NULL DEFAULT NULL,
  `icon` varchar(255) NULL DEFAULT NULL,
  `thumbnail` varchar(255) NULL DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bidangs_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `bidangs`
INSERT INTO `bidangs` (`id`, `name`, `slug`, `description`, `address`, `phone`, `email`, `website`, `icon`, `thumbnail`, `order`, `created_at`, `updated_at`) VALUES
  (1, 'Ruang Kelas Nyaman & Multimedia', 'ruang-kelas-nyaman-dan-multimedia', 'Ruang kelas representatif yang bersih, sejuk dengan pendingin udara (AC), dilengkapi proyektor LCD dan tata letak ergonomis untuk memaksimalkan fokus belajar.', 'Kampus SMPS IT Ishlahul Ummah Prabumulih', '0852-6990-8696', 'smpitishlahulummah.2015@yahoo.com', NULL, 'fa-solid fa-chalkboard-user', '/uploads/fasilitas/fasilitas-ruang-kelas.webp', 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (2, 'Perpustakaan & Pojok Literasi Digital', 'perpustakaan-dan-pojok-literasi-digital', 'Koleksi lengkap buku teks pelajaran, referensi ensiklopedia Islam, sastra ilmiah, komputer literasi digital, dan sudut baca nyaman untuk menumbuhkan gemar membaca.', 'Kampus SMPS IT Ishlahul Ummah Prabumulih', '0852-6990-8696', 'smpitishlahulummah.2015@yahoo.com', NULL, 'fa-solid fa-book-open', '/uploads/fasilitas/fasilitas-perpustakaan.webp', 2, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (3, 'Laboratorium IPA & Sains Terpadu', 'laboratorium-ipa-sains-terpadu', 'Fasilitas laboratorium lengkap untuk eksperimen biologi, fisika, dan kimia dasar, mendukung pembelajaran praktikum dan kelas olimpiade sains.', 'Kampus SMPS IT Ishlahul Ummah Prabumulih', '0852-6990-8696', 'smpitishlahulummah.2015@yahoo.com', NULL, 'fa-solid fa-flask-vial', '/uploads/fasilitas/fasilitas-lab-ipa.webp', 3, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (4, 'Masjid & Pusat Ibadah Kampus Ishum', 'masjid-dan-pusat-ibadah', 'Masjid kampus yang asri sebagai pusat ibadah sholat berjamaah, sholat dhuha, tadarus Al-Qur\'an, dan halaqah tahfidz santri.', 'Kampus SMPS IT Ishlahul Ummah Prabumulih', '0852-6990-8696', 'smpitishlahulummah.2015@yahoo.com', NULL, 'fa-solid fa-mosque', '/uploads/fasilitas/fasilitas-masjid.webp', 4, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (5, 'Lapangan Olahraga & Area Outbound', 'lapangan-olahraga-dan-outbound', 'Lapangan olahraga serbaguna untuk futsal, basket, voli, bulutangkis, serta arena latihan panahan (archery) dan kepanduan Pramuka SIT.', 'Kampus SMPS IT Ishlahul Ummah Prabumulih', '0852-6990-8696', 'smpitishlahulummah.2015@yahoo.com', NULL, 'fa-solid fa-volleyball', '/uploads/fasilitas/fasilitas-lapangan.webp', 5, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (6, 'Gedung Kampus Terpadu', 'gedung-kampus-terpadu', 'Kompleks gedung sekolah yang asri, aman, dan berpagar penuh dengan pos satpam 24 jam serta taman hijau yang mendukung kenyamanan belajar.', 'Kampus SMPS IT Ishlahul Ummah Prabumulih', '0852-6990-8696', 'smpitishlahulummah.2015@yahoo.com', NULL, 'fa-solid fa-school', '/uploads/fasilitas/fasilitas-gedung-utama.webp', 6, '2026-09-18 09:03:58', '2026-09-18 09:03:58');

-- --------------------------------------------------------
-- Table structure for table `cache`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cache_locks`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `categories`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NULL DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `categories`
INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `parent_id`, `created_at`, `updated_at`) VALUES
  (1, 'Berita', 'berita', 'Kategori Berita', NULL, '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (2, 'Prestasi Siswa', 'prestasi-siswa', 'Kategori Prestasi Siswa', NULL, '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (3, 'Akademik & Riset', 'akademik-riset', 'Kategori Akademik & Riset', NULL, '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (4, 'Tahfidz & Keislaman', 'tahfidz-keislaman', 'Kategori Tahfidz & Keislaman', NULL, '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (5, 'Kesiswaan & Ekskul', 'kesiswaan-ekskul', 'Kategori Kesiswaan & Ekskul', NULL, '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (6, 'Kabar Kampus', 'kabar-kampus', 'Kategori Kabar Kampus', NULL, '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (7, 'Opini & Artikel', 'opini', 'Kategori Opini & Artikel', NULL, '2026-09-18 05:05:31', '2026-09-18 05:05:31');

-- --------------------------------------------------------
-- Table structure for table `downloads`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `downloads`;
CREATE TABLE `downloads` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category_type` varchar(255) NOT NULL DEFAULT 'Dokumen',
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NULL DEFAULT NULL,
  `file_size` varchar(255) NULL DEFAULT NULL,
  `download_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` longtext NULL DEFAULT NULL,
  `cover_image` varchar(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `downloads`
INSERT INTO `downloads` (`id`, `title`, `category_type`, `file_path`, `file_type`, `file_size`, `download_count`, `created_at`, `updated_at`, `description`, `cover_image`) VALUES
  (1, 'Panduan Kurikulum Tahfidz Al-Qur\'an 2 Juz SMPS IT Ishlahul Ummah', 'E-Book', '/uploads/downloads/panduan-mutqin-tahfidz-ishum.pdf', 'PDF', '9.0 KB', 342, '2026-09-18 09:03:59', '2026-09-18 09:03:59', 'Modul resmi kurikulum tahfidz mutqin SMPS IT Ishlahul Ummah Prabumulih berbasis standar JSIT Indonesia.', '/uploads/covers/cover-tahfidz-mutqin.webp'),
  (2, 'Buku Saku Adab & 10 Karakter (Muwashofat) Santri JSIT', 'E-Book', '/uploads/downloads/buku-saku-adab-karakter-santri.pdf', 'PDF', '6.9 KB', 284, '2026-09-18 09:03:59', '2026-09-18 09:03:59', 'Pedoman pembiasaan akhlak islami, adab kepada guru dan orang tua, tata tertib santri asrama dan sekolah.', '/uploads/covers/cover-karakter-santri.webp'),
  (3, 'Petunjuk Praktikum Laboratorium IPA Terpadu SMPS IT Ishum', 'E-Book', '/uploads/downloads/petunjuk-praktikum-sains-terpadu.pdf', 'PDF', '6.6 KB', 195, '2026-09-18 09:03:59', '2026-09-18 09:03:59', 'Pedoman eksperimen laboratorium biologi dan fisika untuk siswa kelas VII-IX SMPS IT Ishlahul Ummah.', '/uploads/covers/cover-praktikum-sains.webp'),
  (4, 'Kurikulum Pembinaan Da\'i Muda, Khitabah & Public Speaking', 'E-Book', '/uploads/downloads/kurikulum-pembinaan-dai-muda.pdf', 'PDF', '6.5 KB', 210, '2026-09-18 09:03:59', '2026-09-18 09:03:59', 'Kumpulan materi public speaking, retorika dakwah 3 bahasa (Indonesia, Arab, Inggris), dan sistematika kultum.', '/uploads/covers/cover-dai-muda.webp'),
  (5, 'Buku Saku Kosakata Harian Bilingual Bahasa Arab & Inggris Santri', 'E-Book', '/uploads/downloads/buku-saku-kosakata-bilingual.pdf', 'PDF', '6.6 KB', 312, '2026-09-18 09:03:59', '2026-09-18 09:03:59', 'Modul percakapan bilingual harian asrama dan lingkungan sekolah untuk mempercepat penguasaan active speaking.', '/uploads/covers/cover-bilingual-arab-inggris.webp'),
  (6, 'Panduan Sukses Asesmen Nasional & Masuk Sekolah Lanjutan Unggulan Favorit', 'E-Book', '/uploads/downloads/panduan-sukses-snbt-ptn.pdf', 'PDF', '6.6 KB', 450, '2026-09-18 09:03:59', '2026-09-18 09:03:59', 'Strategi sukses menembus sekolah lanjutan favorit impian, pembedahan materi literasi dan numerasi Asesmen Nasional.', '/uploads/covers/cover-sukses-snbt.webp'),
  (7, 'Logo Resmi SMPS IT Ishlahul Ummah Prabumulih (High Resolution)', 'Logo', '/uploads/logo-ishum.png', 'PNG', '120 KB', 780, '2026-09-18 09:03:59', '2026-09-18 09:03:59', 'File logo resmi SMPS IT Ishlahul Ummah Prabumulih format PNG transparan.', NULL),
  (8, 'Logo Lambang Ishlahul Ummah Square HD', 'Logo', '/uploads/logo-ishum-square.png', 'PNG', '85 KB', 315, '2026-09-18 09:03:59', '2026-09-18 09:03:59', 'Logo lambang persegi SMPS IT Ishlahul Ummah Prabumulih format PNG.', NULL);

-- --------------------------------------------------------
-- Table structure for table `dpcs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `dpcs`;
CREATE TABLE `dpcs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NULL DEFAULT NULL,
  `head_name` varchar(255) NULL DEFAULT NULL,
  `address` varchar(255) NULL DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `thumbnail` varchar(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dpcs_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `dpcs`
INSERT INTO `dpcs` (`id`, `name`, `slug`, `description`, `head_name`, `address`, `order`, `created_at`, `updated_at`, `thumbnail`) VALUES
  (1, 'Program Tahfidz 2 Juz Mutqin & Hadits', 'program-tahfidz-2-juz-mutqin', 'Bimbingan intensif membaca Al-Qur\'an dengan tartil, tahsin bersanad, dan hafalan mutqin minimal 2 juz serta 12 hadits pilihan.', NULL, 'Kurikulum Khusus Keislaman', 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58', NULL),
  (2, 'Bina Pribadi Islam (BPI) & Karakter Islami', 'bina-pribadi-islam-bpi', 'Halaqah pekanan pembinaan adab, pembiasaan ibadah yaumiyah, dzikir ma\'tsurat, serta penanaman akhlaqul karimah.', NULL, 'Pembinaan Karakter Santri', 2, '2026-09-18 09:03:58', '2026-09-18 09:03:58', NULL),
  (3, 'Kurikulum Terpadu JSIT & Kurikulum Merdeka', 'kurikulum-terpadu-jsit-merdeka', 'Memadukan standar capaian Kurikulum Merdeka Nasional dengan nilai-nilai Islam Terpadu berstandar JSIT Indonesia.', NULL, 'Integrasi Nilai Islam & Sains', 3, '2026-09-18 09:03:58', '2026-09-18 09:03:58', NULL),
  (4, 'Program Belajar Bersama Maestro & Riset Sains', 'belajar-bersama-maestro-riset', 'Eksplorasi bakat seni, budaya, sains dan teknologi langsung bersama tokoh dan pakar di bidangnya.', NULL, 'Pengembangan Akademik & Potensi', 4, '2026-09-18 09:03:58', '2026-09-18 09:03:58', NULL),
  (5, 'IU Safar & Outing Class Edukatif', 'iu-safar-outing-class', 'Pembelajaran luar kelas berbasis observasi alam, studi kampus, renang, dan rekreasi edukatif untuk memperluas cakrawala siswa.', NULL, 'Outdoor Learning & Wawasan', 5, '2026-09-18 09:03:58', '2026-09-18 09:03:58', NULL),
  (6, 'IU Berkhidmat (Bakti Sosial Masyarakat)', 'iu-berkhidmat-bakti-sosial', 'Kiprah nyata santri dalam melayani dan memberikan kontribusi positif bagi masyarakat di Kota Prabumulih.', NULL, 'Kepedulian Sosial & Dakwah', 6, '2026-09-18 09:03:58', '2026-09-18 09:03:58', NULL);

-- --------------------------------------------------------
-- Table structure for table `failed_jobs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`, `queue`, `failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `feedbacks`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NULL DEFAULT NULL,
  `whatsapp` varchar(255) NULL DEFAULT NULL,
  `message` longtext NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `job_batches`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` longtext NULL DEFAULT NULL,
  `cancelled_at` int(11) NULL DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `jobs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` int(11) NOT NULL,
  `reserved_at` int(11) NULL DEFAULT NULL,
  `available_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `migrations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
  (1, '0001_01_01_000000_create_users_table', 1),
  (2, '0001_01_01_000001_create_cache_table', 1),
  (3, '0001_01_01_000002_create_jobs_table', 1),
  (4, '2026_09_05_000001_create_posts_and_taxonomies_tables', 1),
  (5, '2026_09_05_000002_create_cpt_tables', 1),
  (6, '2026_09_05_000003_add_role_and_avatar_to_users_table', 1),
  (7, '2026_09_05_000004_create_activity_logs_table', 1),
  (8, '2026_09_05_000004_create_quick_menus_table', 1),
  (9, '2026_09_05_000005_create_pages_table', 1),
  (10, '2026_09_07_000001_create_visitor_logs_table', 1),
  (11, '2026_09_12_071313_create_ppdb_registrations_table', 1),
  (12, '2026_09_12_074211_add_cover_and_description_to_downloads_table', 1),
  (13, '2026_09_12_090300_add_thumbnail_to_dpcs_table', 1),
  (14, '2026_09_12_091700_add_track_and_program_to_ppdb_registrations_table', 1),
  (15, '2026_09_12_093259_add_extra_fields_to_ppdb_registrations_table', 1),
  (16, '2026_09_12_113129_create_service_submissions_table', 1);

-- --------------------------------------------------------
-- Table structure for table `pages`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` longtext NULL DEFAULT NULL,
  `content` longtext NULL DEFAULT NULL,
  `image` varchar(255) NULL DEFAULT NULL,
  `meta_title` varchar(255) NULL DEFAULT NULL,
  `meta_description` longtext NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`),
  KEY `pages_slug_index` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `password_reset_tokens`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `pengumumen`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `pengumumen`;
CREATE TABLE `pengumumen` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NULL DEFAULT NULL,
  `file_attachment` varchar(255) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'publish',
  `featured_image` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengumumen_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `pengumumen`
INSERT INTO `pengumumen` (`id`, `title`, `slug`, `content`, `file_attachment`, `status`, `featured_image`, `created_at`, `updated_at`) VALUES
  (1, 'Informasi Resmi SPMB Gelombang Exclusive Tahun Ajaran Baru', 'informasi-resmi-spmb-gelombang-exclusive', 'Pendaftaran SPMB Gelombang Exclusive SMPS IT Ishlahul Ummah Prabumulih telah dibuka. Kuota hanya 24 kursi per kelas. Segera daftarkan putra-putri Anda melalui portal PPDB online kami atau hubungi WA: 0852-6990-8696.', '/uploads/downloads/panduan-ppdb-ishum.pdf', 'publish', '/uploads/artikel/artikel-spmb-2026.webp', '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (2, 'Jadwal & Tata Tertib Class Meeting Semester Genap', 'jadwal-dan-tata-tertib-class-meeting-semester-genap', 'Seluruh santri diwajibkan mengenakan seragam olahraga resmi sekolah dan menjaga sportivitas serta nilai-nilai ukhuwah selama kegiatan berlangsung.', NULL, 'publish', '/uploads/artikel/artikel-class-meeting.webp', '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (3, 'Prosedur Klaim Cash Back Rp 1.000.000,- Alumni SDIT Ishum 1 & 2', 'prosedur-klaim-cash-back-alumni-sdit-ishum', 'Bagi calon santri lulusan SDIT Ishlahul Ummah 1 dan SDIT Ishlahul Ummah 2, silakan melampirkan fotokopi ijazah/surat keterangan lulus saat verifikasi berkas pendaftaran.', NULL, 'publish', '/uploads/fasilitas/fasilitas-gedung-utama.webp', '2026-09-18 09:03:58', '2026-09-18 09:03:58');

-- --------------------------------------------------------
-- Table structure for table `post_category`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `post_category`;
CREATE TABLE `post_category` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`post_id`, `category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `post_category`
INSERT INTO `post_category` (`post_id`, `category_id`) VALUES
  (75, 6),
  (76, 6),
  (78, 6),
  (79, 6);

-- --------------------------------------------------------
-- Table structure for table `post_tag`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE `post_tag` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`post_id`, `tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `post_tag`
INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
  (75, 2),
  (75, 3),
  (75, 4),
  (76, 3),
  (76, 4),
  (76, 5),
  (77, 1),
  (77, 6),
  (77, 10),
  (78, 5),
  (78, 8),
  (78, 10),
  (79, 1),
  (79, 4),
  (79, 10),
  (80, 1),
  (80, 2),
  (80, 5);

-- --------------------------------------------------------
-- Table structure for table `posts`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NULL DEFAULT NULL,
  `excerpt` longtext NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'publish',
  `type` varchar(255) NOT NULL DEFAULT 'post',
  `featured_image` varchar(255) NULL DEFAULT NULL,
  `views_count` int(11) NOT NULL DEFAULT 0,
  `author_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) NULL DEFAULT NULL,
  `meta_description` longtext NULL DEFAULT NULL,
  `meta_keywords` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `posts`
INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `excerpt`, `status`, `type`, `featured_image`, `views_count`, `author_id`, `published_at`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
  (75, 'Class Meeting Semester Genap SMP IT Ishlahul Ummah Prabumulih: Semangat Sportivitas & Ukhuwah', 'class-meeting-semester-genap-smp-it-ishlahul-ummah-prabumulih', '<p>SMP IT Ishlahul Ummah Prabumulih kembali menggelar agenda akbar tahunan yaitu <strong>Class Meeting Semester Genap</strong> dengan tema mengobarkan semangat sportivitas, kekompakan, dan ukhuwah Islamiyah antarsantri.</p><p>Kegiatan yang dibuka secara resmi pada Rabu, 17 Juni 2026 ini mempertandingkan berbagai cabang perlombaan, mulai dari keolahragaan (futsal, bola voli, bulutangkis), seni Islam (lomba adzan, tilawatil Qur\'an, hadroh), hingga adu kecerdasan dalam cerdas cermat sains dan debat bahasa.</p><p>Kepala SMPS IT Ishlahul Ummah Prabumulih, <strong>Ibu Anita Carlyna, S.IP., M.Pd., Gr</strong>, menyampaikan bahwa Class Meeting ini bukan hanya sekadar ajang kompetisi, namun wahana pembentukan karakter pantang menyerah, kerja sama tim, dan kepemimpinan santri.</p>', 'Semarak Class Meeting Semester Genap SMP IT Ishlahul Ummah Prabumulih dengan berbagai cabang lomba olahraga, keislaman, dan unjuk kreativitas santri.', 'publish', 'post', '/uploads/artikel/artikel-class-meeting.webp', 1420, NULL, NULL, NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (76, 'SPMB Gelombang Exclusive SMPS IT Ishlahul Ummah Prabumulih Resmi Dibuka: Cash Back 1 Juta', 'spmb-gelombang-exclusive-smp-it-ishlahul-ummah-prabumulih', '<p>Kabar gembira bagi para orang tua dan calon santri di Kota Prabumulih dan sekitarnya! <strong>SMPS IT Ishlahul Ummah Prabumulih</strong> secara resmi membuka pendaftaran <strong>SPMB Gelombang Exclusive</strong> untuk tahun ajaran baru.</p><p>Pada gelombang exclusive ini, kuota yang disediakan sangat terbatas, yakni hanya <strong>24 orang per kelas</strong>, demi menjaga kualitas pembelajaran interaktif dan pendampingan tahfidz yang optimal. Selain itu, tersedia promo istimewa berupa <strong>Cash Back Rp 1.000.000,-</strong> khusus bagi alumni SDIT Ishum dan SDIT Ishum 2.</p><p>Pendaftaran dapat dilakukan secara online melalui website resmi atau langsung mengunjungi kampus SMPS IT Ishlahul Ummah di Jl. Sadewa No. 45 Karang Raja Prabumulih Timur. Info narahubung: +62 852-6990-8696 / +62 853-7897-4396.</p>', 'Penerimaan Peserta Didik Baru (SPMB) Gelombang Exclusive SMPS IT Ishlahul Ummah dibuka dengan kuota terbatas 24 orang dan cashback 1 juta.', 'publish', 'post', '/uploads/artikel/artikel-spmb-2026.webp', 2180, NULL, NULL, NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (77, 'SMP IT Ishlahul Ummah Prabumulih Raih Prestasi Gemilang dalam Olimpiade Sains & Kejuaraan Pelajar', 'smp-it-ishlahul-ummah-raih-prestasi-olimpiade-sains-pelajar', '<p>Santri SMP IT Ishlahul Ummah Prabumulih kembali menorehkan prestasi membanggakan pada ajang Olimpiade Sains dan Kejuaraan Pelajar tingkat Kota Prabumulih dan Provinsi Sumatera Selatan.</p><p>Prestasi ini merupakan buah dari pembinaan intensif di laboratorium sains dan kelas bimbingan MIPA oleh ustadz dan ustadzah pembina. Kepala SMPS IT Ishlahul Ummah, Ibu Anita Carlyna, S.IP., M.Pd., Gr, mengapresiasi dedikasi santri yang terus mengukir prestasi gemilang berlandaskan adab dan ilmu pengetahuan.</p>', 'Santri SMP IT Ishlahul Ummah Prabumulih torehkan prestasi membanggakan dalam ajang olimpiade sains dan kejuaraan tingkat pelajar.', 'publish', 'post', '/uploads/artikel/artikel-olimpiade-sains.webp', 1120, NULL, NULL, NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (78, 'Semarak Dakwah Ramadhan (SADARILAH) & Khatmil Qur\'an Santri SMP IT Ishlahul Ummah', 'semarak-dakwah-ramadhan-sadarilah-dan-khatmil-quran-smpit-ishum', '<p>Mengisi bulan suci Ramadhan dengan amalan terbaik, SMPS IT Ishlahul Ummah Prabumulih menggelar kegiatan tahunan <strong>SADARILAH (Semarak Dakwah Ramadhan Ishlahul Ummah)</strong> yang dipadukan dengan Khatmil Qur\'an dan bakti sosial Jum\'at Berbagi.</p><p>Seluruh santri berkumpul di masjid kampus untuk mengkhatamkan Al-Qur\'an bersama para ustaz dan ustazah, dilanjutkan dengan pendistribusian paket sembako dan takjil kepada warga di sekitar Kelurahan Karang Raja, Prabumulih Timur. Kegiatan ini melatih kepekaan sosial dan kepedulian santri sejak dini.</p>', 'Rangkaian kegiatan Semarak Dakwah Ramadhan (SADARILAH) dan Khatmil Qur\'an melatih kepedulian sosial santri SMP IT Ishlahul Ummah.', 'publish', 'post', '/uploads/artikel/artikel-wisuda-tahfidz.webp', 980, NULL, NULL, NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (79, 'English & Arabic Week: Membangun Lingkungan Berbahasa Asing Aktif di SMP IT Ishum', 'english-and-arabic-week-lingkungan-berbahasa-asing-aktif', '<p>Untuk membekali santri menghadapi era global, SMPS IT Ishlahul Ummah Prabumulih menerapkan program unggulan <strong>English & Arabic Week</strong>. Selama pekan bahasa, santri dan guru dibiasakan berkomunikasi dalam Bahasa Arab dan Bahasa Inggris pada aktivitas harian.</p><p>Program ini juga diisi dengan kompetisi pidato (khitabah), lomba bercerita (storytelling), debat, dan spelling bee yang diikuti dengan sangat antusias oleh seluruh siswa kelas VII hingga IX.</p>', 'Pekan Bahasa Arab dan Inggris di SMP IT Ishlahul Ummah Prabumulih tingkatkan rasa percaya diri santri berkomunikasi dalam bahasa internasional.', 'publish', 'post', '/uploads/artikel/artikel-literasi-digital.webp', 840, NULL, NULL, NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (80, 'Wisuda Tahfidz & Khotmil Qur\'an: Lahirkan Generasi Penghafal Al-Qur\'an Berprestasi', 'wisuda-tahfidz-dan-khotmil-quran-smp-it-ishlahul-ummah', '<p>Suasana haru dan khidmat menyelimuti wisuda tahfidz Al-Qur\'an SMPS IT Ishlahul Ummah Prabumulih. Puluhan santri berhasil menyelesaikan target hafalan minimal 2 juz mutqin lengkap dengan munaqosah tajwid dan makharijul huruf.</p><p>Kepala Sekolah, <strong>Ibu Anita Carlyna, S.IP., M.Pd., Gr</strong>, menyematkan selempang dan sertifikat tahfidz kepada para wisudawan dan wisudawati, didampingi oleh orang tua yang menitikkan air mata bahagia menyaksikan putra-putrinya memahkotai mereka dengan hafalan kalamullah.</p>', 'Prosesi wisuda tahfidz Al-Qur\'an SMPS IT Ishlahul Ummah Prabumulih meluluskan puluhan santri penghafal Qur\'an 2 juz mutqin.', 'publish', 'post', '/uploads/artikel/artikel-wisuda-tahfidz.webp', 1750, NULL, NULL, NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (81, 'Sambutan Kepala Sekolah SMPS IT Ishlahul Ummah Prabumulih', 'sambutan-kepala-sekolah', '<p><strong>Bismillahirrohmanirrohim. Assalamu\'alaikum Warahmatullahi Wabarakatuh.</strong></p>\n<p>Segala puji dan syukur kita panjatkan kehadirat Allah SWT yang senantiasa melimpahkan rahmat, taufik, dan inayah-Nya kepada kita semua. Sholawat beriring salam senantiasa tercurah kepada junjungan alam Nabi Besar Muhammad SAW, para keluarga, sahabat, dan pengikutnya hingga akhir zaman.</p>\n<p>Selamat datang di website resmi <strong>SMPS IT Ishlahul Ummah Prabumulih</strong>. Di era transformasi digital dan revolusi industri saat ini, kehadiran media informasi digital menjadi sarana vital untuk mempererat ukhuwah, menyajikan transparansi kegiatan sekolah, serta memberikan kemudahan akses informasi bagi para orang tua, santri, dan masyarakat luas.</p>\n<p>Sebagai Sekolah Menengah Pertama Islam Terpadu di bawah naungan <strong>Yayasan Ishlahul Ummah Prabumulih</strong>, kami berkomitmen menghadirkan pendidikan holistik yang memadukan keunggulan kurikulum nasional, penguatan adab Islami, target hafalan Al-Qur\'an 2 juz mutqin, kompetensi sains-teknologi, dan pembiasaan bahasa asing (Arab dan Inggris).</p>\n<p>Kami mengucapkan terima kasih yang sebesar-besarnya kepada Pembina dan Pengurus Yayasan Ishlahul Ummah, seluruh asatidz dan asatidzah, staf kependidikan, serta para wali santri yang senantiasa membersamai langkah kami dalam mendidik generasi terbaik umat. Mari bersama-sama kita wujudkan anak-anak yang sholih-sholihah, cerdas, berprestasi, dan berakhlakul karimah.</p>\n<p><em>Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</em></p>\n<p><strong>Kepala SMPS IT Ishlahul Ummah Prabumulih</strong><br>\n<strong>Anita Carlyna, S.IP., M.Pd., Gr</strong></p>', 'Sambutan resmi Kepala Sekolah SMPS IT Ishlahul Ummah Prabumulih, Anita Carlyna, S.IP., M.Pd., Gr.', 'publish', 'page', '/uploads/dewan/kepala-sekolah.webp', '0', NULL, NULL, 'Sambutan Kepala Sekolah SMPS IT Ishlahul Ummah Prabumulih', 'Sambutan resmi Kepala Sekolah SMPS IT Ishlahul Ummah Prabumulih, Anita Carlyna, S.IP., M.Pd., Gr.', NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (82, 'Visi dan Misi SMPS IT Ishlahul Ummah Prabumulih', 'visi-dan-misi', '<h3>VISI SEKOLAH</h3>\n<blockquote class=\"text-xl font-bold text-school-primary my-4 p-4 border-l-4 border-school-primary bg-indigo-50/70 rounded-r-lg\">\n“MENJADI LEMBAGA ISLAM TERPADU YANG MENCETAK GENERASI TERBAIK, BERKEPRIBADIAN ISLAMI, BERAKHLAK MULIA, CERDAS, BERPRESTASI, DAN BERWAWASAN GLOBAL”\n</blockquote>\n\n<h3>MISI SEKOLAH</h3>\n<ol class=\"list-decimal pl-6 space-y-2.5 text-gray-700\">\n    <li><strong>Unggul dalam Akhlakul Karimah:</strong> Menanamkan aqidah yang lurus, ibadah yang benar, dan akhlak mulia berlandaskan Al-Qur\'an dan As-Sunnah.</li>\n    <li><strong>Unggul Prestasi Akademik & Non-Akademik:</strong> Menyelenggarakan pembelajaran aktif, kreatif, dan menantang untuk meraih prestasi di tingkat kota, provinsi, dan nasional.</li>\n    <li><strong>Berprestasi dalam Bahasa & MIPA:</strong> Membekali santri dengan kecakapan berbahasa asing (Arab & Inggris) serta kemampuan sains dan nalar matematika.</li>\n    <li><strong>Target Tahfidzul Qur\'an:</strong> Membina kemampuan tahsin dan tahfidz Al-Qur\'an dengan target minimal 2 juz mutqin serta hafalan 12 hadits pilihan.</li>\n    <li><strong>Lingkungan Pendidikan Islami Profesional:</strong> Mewujudkan iklim sekolah yang kondusif, amanah, ramah anak, dan berbudaya Islami.</li>\n</ol>\n\n<h3 class=\"mt-8\">TUJUAN PENDIDIKAN</h3>\n<ul class=\"list-disc pl-6 space-y-2 text-gray-700\">\n    <li>Mencetak lulusan yang tertib dalam mendirikan sholat fardhu berjamaah dan gemar mengamalkan sunnah.</li>\n    <li>Mencapai target hafalan minimal 2 juz Al-Qur\'an (Juz 29 dan Juz 30) dengan tajwid tartil.</li>\n    <li>Menghasilkan peserta didik yang berkarakter mandiri, santun, berpikir kritis, dan adaptif terhadap teknologi.</li>\n    <li>Meraih prestasi gemilang dalam kompetisi sains, keolahragaan, seni Islam, dan baris-berbaris.</li>\n    <li>Mempersiapkan santri melanjutkan ke jenjang lanjutan/MA/Pesantren unggulan dengan bekal ilmu dan iman yang kokoh.</li>\n</ul>', 'Visi, Misi, dan Tujuan penyelenggaraan pendidikan SMPS IT Ishlahul Ummah Prabumulih.', 'publish', 'page', '/uploads/logo-ishum.png', '0', NULL, NULL, 'Visi dan Misi SMPS IT Ishlahul Ummah Prabumulih', 'Visi, Misi, dan Tujuan penyelenggaraan pendidikan SMPS IT Ishlahul Ummah Prabumulih.', NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (83, 'Profil SMPS IT Ishlahul Ummah Prabumulih', 'tentang-kami', '<h3>Profil Singkat Sekolah</h3>\n<p><strong>SMPS IT Ishlahul Ummah Prabumulih</strong> adalah lembaga pendidikan formal tingkat menengah pertama berbasis Islam Terpadu di Kota Prabumulih, Sumatera Selatan, di bawah naungan <strong>Yayasan Ishlahul Ummah Prabumulih</strong>.</p>\n<p>Berlokasi strategis di Jl. Sadewa No. 45 Kelurahan Karang Raja, sekolah ini memadukan kurikulum nasional Kementerian Pendidikan Dasar dan Menengah dengan kurikulum khas Sekolah Islam Terpadu (SIT). Dengan pendekatan holistik, siswa dibina kecerdasan spiritual (SQ), emosional (EQ), dan intelektualnya (IQ) secara seimbang.</p>\n\n<h4 class=\"mt-6 font-bold text-gray-900\">Identitas Sekolah</h4>\n<table class=\"w-full text-left border-collapse my-4 text-sm\">\n    <tr class=\"border-b\"><td class=\"py-2.5 font-semibold w-1/3 text-gray-800\">Nama Resmi Sekolah</td><td class=\"py-2.5 text-gray-700\">SMPS IT ISHLAHUL UMMAH PRABUMULIH</td></tr>\n    <tr class=\"border-b\"><td class=\"py-2.5 font-semibold text-gray-800\">NPSN</td><td class=\"py-2.5 text-gray-700\">69787455</td></tr>\n    <tr class=\"border-b\"><td class=\"py-2.5 font-semibold text-gray-800\">Bentuk Pendidikan</td><td class=\"py-2.5 text-gray-700\">SMP (Sekolah Menengah Pertama)</td></tr>\n    <tr class=\"border-b\"><td class=\"py-2.5 font-semibold text-gray-800\">Status Sekolah</td><td class=\"py-2.5 text-gray-700\">Swasta (Yayasan Ishlahul Ummah)</td></tr>\n    <tr class=\"border-b\"><td class=\"py-2.5 font-semibold text-gray-800\">Akreditasi</td><td class=\"py-2.5 text-gray-700\"><span class=\"inline-block px-2.5 py-0.5 rounded-full bg-indigo-100 text-school-primary font-bold text-xs\">TERAKREDITASI B</span></td></tr>\n    <tr class=\"border-b\"><td class=\"py-2.5 font-semibold text-gray-800\">Kepala Sekolah</td><td class=\"py-2.5 text-gray-700\">Anita Carlyna, S.IP., M.Pd., Gr</td></tr>\n    <tr class=\"border-b\"><td class=\"py-2.5 font-semibold text-gray-800\">Alamat Kampus</td><td class=\"py-2.5 text-gray-700\">Jl. Sadewa No. 45 RT 01 RW 04, Kel. Karang Raja, Kec. Prabumulih Timur, Kota Prabumulih, Sumatera Selatan 31113</td></tr>\n    <tr class=\"border-b\"><td class=\"py-2.5 font-semibold text-gray-800\">Telepon / WhatsApp</td><td class=\"py-2.5 text-gray-700\">0852-6990-8696 / 0853-7897-4396</td></tr>\n    <tr class=\"border-b\"><td class=\"py-2.5 font-semibold text-gray-800\">Email Resmi</td><td class=\"py-2.5 text-gray-700\">smpitishlahulummah.2015@yahoo.com</td></tr>\n</table>', 'Profil resmi lembaga pendidikan SMPS IT Ishlahul Ummah Kota Prabumulih.', 'publish', 'page', '/uploads/campus-smpit-ishum.webp', '0', NULL, NULL, 'Profil SMPS IT Ishlahul Ummah Prabumulih', 'Profil resmi lembaga pendidikan SMPS IT Ishlahul Ummah Kota Prabumulih.', NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (84, 'Sejarah SMPS IT Ishlahul Ummah Prabumulih', 'sejarah', '<h3>Sejarah dan Latar Belakang Pendirian</h3>\n<p><strong>SMPS IT Ishlahul Ummah Prabumulih</strong> didirikan di bawah naungan <strong>Yayasan Ishlahul Ummah Prabumulih</strong> sebagai wujud kepedulian terhadap pentingnya pendidikan generasi muda Islam yang seimbang antara ilmu pengetahuan umum dan pemahaman agama yang mendalam.</p>\n<p>Berawal dari kesuksesan pembinaan di tingkat sekolah dasar (SDIT Ishlahul Ummah), masyarakat dan para wali santri mendambakan kelanjutan pendidikan tingkat pertama yang tetap mengusung nilai-nilai Qur\'ani dan pembiasaan adab Islami. Maka berdirilah SMPS IT Ishlahul Ummah Prabumulih untuk melayani kebutuhan masyarakat Prabumulih dan sekitarnya.</p>\n<p>Di bawah kepemimpinan <strong>Ibu Anita Carlyna, S.IP., M.Pd., Gr</strong> beserta jajaran dewan guru yang amanah dan kompeten, SMPS IT Ishlahul Ummah terus berinovasi dalam metode pembelajaran, sarana prasarana modern, pembinaan tahfidz 2 juz mutqin, serta prestasi siswa di berbagai ajang kejuaraan daerah dan nasional.</p>', 'Napak tilas perjalanan dan sejarah berdirinya SMPS IT Ishlahul Ummah di Kota Prabumulih.', 'publish', 'page', '/uploads/campus-smpit-ishum.webp', '0', NULL, NULL, 'Sejarah SMPS IT Ishlahul Ummah Prabumulih', 'Napak tilas perjalanan dan sejarah berdirinya SMPS IT Ishlahul Ummah di Kota Prabumulih.', NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (85, 'Struktur Organisasi SMPS IT Ishlahul Ummah Prabumulih', 'struktur-organisasi', '<h3>Struktur Manajemen Sekolah & Yayasan</h3>\n<ul class=\"space-y-3 text-gray-800\">\n    <li><strong>Yayasan Penyelenggara:</strong> Yayasan Ishlahul Ummah Prabumulih</li>\n    <li><strong>Kepala Sekolah:</strong> Anita Carlyna, S.IP., M.Pd., Gr</li>\n    <li><strong>Wakil Kepala Sekolah Bidang Kurikulum:</strong> Sesiana Giovani Lestari, S.Pd</li>\n    <li><strong>Koordinator Bidang Kesiswaan & Ekskul:</strong> Ahmad Fauzan, S.Pd.I</li>\n    <li><strong>Koordinator Tahsin & Tahfidz Al-Qur\'an (TTQ):</strong> Helen Azmi, S.Pd</li>\n    <li><strong>Koordinator BPI & Bina Karakter:</strong> Nisa\'ul Istiqomah, S.T</li>\n    <li><strong>Dewan Guru & Tenaga Kependidikan:</strong> Guru-guru profesional lulusan universitas terkemuka.</li>\n</ul>', 'Bagan kepemimpinan, yayasan, dan dewan guru SMPS IT Ishlahul Ummah Prabumulih.', 'publish', 'page', '/uploads/logo-ishum.png', '0', NULL, NULL, 'Struktur Organisasi SMPS IT Ishlahul Ummah Prabumulih', 'Bagan kepemimpinan, yayasan, dan dewan guru SMPS IT Ishlahul Ummah Prabumulih.', NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (86, 'Infaq & Wakaf Pembangunan SMPS IT Ishlahul Ummah Prabumulih', 'donasi', '<h3>Investasi Akhirat Melalui Pendidikan Islam</h3>\n<p>Yayasan Ishlahul Ummah Prabumulih membuka kesempatan seluas-luasnya bagi kaum muslimin dan para dermawan untuk menyalurkan infaq dan sedekah jariyah. Dana yang terhimpun disalurkan untuk pengembangan fasilitas laboratorium, masjid kampus, ruang kelas digital, serta beasiswa pendidikan bagi santri penghafal Al-Qur\'an.</p>', 'Salurkan infaq dan wakaf terbaik Anda untuk sarana pendidikan Islam dan beasiswa tahfidz di Kota Prabumulih.', 'publish', 'page', '/uploads/campus-smpit-ishum.webp', '0', NULL, NULL, 'Infaq & Wakaf Pembangunan SMPS IT Ishlahul Ummah Prabumulih', 'Salurkan infaq dan wakaf terbaik Anda untuk sarana pendidikan Islam dan beasiswa tahfidz di Kota Prabumulih.', NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (87, 'E-Library & Modul Pembelajaran SMPS IT Ishum', 'e-book', '<h3>Pusat E-Library & Buku Digital</h3>\n<p>Daftar koleksi buku pelajaran Kurikulum Merdeka, modul tahfidz 2 juz, dan bacaan islami yang dapat diakses dan diunduh oleh civitas akademika SMPS IT Ishlahul Ummah Prabumulih.</p>', 'Kumpulan buku pelajaran, panduan kurikulum, dan modul e-library santri SMPS IT Ishlahul Ummah.', 'publish', 'page', '/uploads/activities-smpit-ishum.webp', '0', NULL, NULL, 'E-Library & Modul Pembelajaran SMPS IT Ishum', 'Kumpulan buku pelajaran, panduan kurikulum, dan modul e-library santri SMPS IT Ishlahul Ummah.', NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (88, 'Mars & Hymne Jaringan Sekolah Islam Terpadu', 'hymne-mars', '<h3>Mars JSIT Indonesia</h3>\n<p class=\"italic text-gray-600\">Membina tunas bangsa, beriman dan bertaqwa, cerdas berakhlak mulia...</p>', 'Lagu mars dan hymne Sekolah Islam Terpadu kebanggaan SMPS IT Ishlahul Ummah Prabumulih.', 'publish', 'page', '/uploads/logo-ishum.png', '0', NULL, NULL, 'Mars & Hymne Jaringan Sekolah Islam Terpadu', 'Lagu mars dan hymne Sekolah Islam Terpadu kebanggaan SMPS IT Ishlahul Ummah Prabumulih.', NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (89, 'Logo Resmi SMPS IT Ishlahul Ummah Prabumulih', 'logo', '<h3>Filosofi Logo SMPS IT Ishlahul Ummah Prabumulih</h3>\n<p>Logo SMPS IT Ishlahul Ummah Prabumulih memadukan lambang perisai keimanan, kubah masjid, Al-Qur\'an terbuka, dan obor semangat menuju terwujudnya generasi Qur\'ani yang cerdas dan berakhlakul karimah.</p>', 'Makna filosofis lambang dan logo resmi SMPS IT Ishlahul Ummah Prabumulih.', 'publish', 'page', '/uploads/logo-ishum.png', '0', NULL, NULL, 'Logo Resmi SMPS IT Ishlahul Ummah Prabumulih', 'Makna filosofis lambang dan logo resmi SMPS IT Ishlahul Ummah Prabumulih.', NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (90, 'Kontak & Sekretariat SPMB SMPS IT Ishum', 'hubungi', '<h3>Sekretariat Sekolah & Panitia SPMB</h3>\n<p>Silakan kunjungi kampus kami atau hubungi panitia SPMB untuk informasi pendaftaran peserta didik baru gelombang exclusive, jadwal seleksi, dan cashback 1 juta.</p>\n<p><strong>Alamat Kampus:</strong> Jalan Sadewa No. 45 RT 01 RW 04 Kel. Karang Raja, Kec. Prabumulih Timur, Kota Prabumulih, Sumatera Selatan 31113.<br>\n<strong>WhatsApp / Telp:</strong> 0852-6990-8696 / 0853-7897-4396<br>\n<strong>Email:</strong> smpitishlahulummah.2015@yahoo.com</p>', 'Alamat dan kontak resmi sekretariat SMPS IT Ishlahul Ummah Prabumulih.', 'publish', 'page', '/uploads/campus-smpit-ishum.webp', '0', NULL, NULL, 'Kontak & Sekretariat SPMB SMPS IT Ishum', 'Alamat dan kontak resmi sekretariat SMPS IT Ishlahul Ummah Prabumulih.', NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (91, 'Gedung Kampus Terpadu SMPS IT Ishlahul Ummah', 'gedung-kampus-terpadu-smps-it-ishlahul-ummah-1', 'Gedung Kampus Terpadu SMPS IT Ishlahul Ummah', NULL, 'publish', 'gallery', '/uploads/galeri/galeri-kampus-terpadu.webp', '0', 1, '2026-09-18 08:49:59', NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (92, 'Perpustakaan & Ruang Literasi Santri Ishum', 'perpustakaan-ruang-literasi-santri-ishum-2', 'Perpustakaan & Ruang Literasi Santri Ishum', NULL, 'publish', 'gallery', '/uploads/galeri/galeri-perpustakaan.webp', '0', 1, '2026-09-18 08:50:59', NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (93, 'Laboratorium IPA & Eksperimen Sains Santri', 'laboratorium-ipa-eksperimen-sains-santri-3', 'Laboratorium IPA & Eksperimen Sains Santri', NULL, 'publish', 'gallery', '/uploads/galeri/galeri-lab-sains.webp', '0', 1, '2026-09-18 08:51:59', NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (94, 'Suasana Belajar Interaktif & Nyaman di Kelas', 'suasana-belajar-interaktif-nyaman-di-kelas-4', 'Suasana Belajar Interaktif & Nyaman di Kelas', NULL, 'publish', 'gallery', '/uploads/galeri/galeri-suasana-kelas.webp', '0', 1, '2026-09-18 08:52:59', NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (95, 'Wisuda Tahfidz & Munaqosah Al-Qur\'an Mutqin', 'wisuda-tahfidz-munaqosah-al-quran-mutqin-5', 'Wisuda Tahfidz & Munaqosah Al-Qur\'an Mutqin', NULL, 'publish', 'gallery', '/uploads/galeri/galeri-wisuda-tahfidz.webp', '0', 1, '2026-09-18 08:53:59', NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (96, 'Ekstrakurikuler Panahan & Kepramukaan SIT', 'ekstrakurikuler-panahan-kepramukaan-sit-6', 'Ekstrakurikuler Panahan & Kepramukaan SIT', NULL, 'publish', 'gallery', '/uploads/galeri/galeri-panahan-pramuka.webp', '0', 1, '2026-09-18 08:54:59', NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (97, 'Upacara Bendera & Pembinaan Karakter Santri', 'upacara-bendera-pembinaan-karakter-santri-7', 'Upacara Bendera & Pembinaan Karakter Santri', NULL, 'publish', 'gallery', '/uploads/galeri/galeri-upacara-santri.webp', '0', 1, '2026-09-18 08:55:59', NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (98, 'Semarak Class Meeting & Sportivitas Santri', 'semarak-class-meeting-sportivitas-santri-8', 'Semarak Class Meeting & Sportivitas Santri', NULL, 'publish', 'gallery', '/uploads/galeri/galeri-class-meeting.webp', '0', 1, '2026-09-18 08:56:59', NULL, NULL, NULL, '2026-09-18 09:03:59', '2026-09-18 09:03:59');

-- --------------------------------------------------------
-- Table structure for table `ppdb_registrations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `ppdb_registrations`;
CREATE TABLE `ppdb_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `living_with` varchar(255) NOT NULL DEFAULT 'Orang Tua',
  `child_order` int(11) NULL DEFAULT NULL,
  `siblings_count` int(11) NULL DEFAULT NULL,
  `previous_school` varchar(255) NOT NULL,
  `nisn` varchar(255) NULL DEFAULT NULL,
  `hobby` varchar(255) NULL DEFAULT NULL,
  `favorite_subject` varchar(255) NULL DEFAULT NULL,
  `ambition` varchar(255) NULL DEFAULT NULL,
  `achievements` longtext NULL DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_birth_place` varchar(255) NULL DEFAULT NULL,
  `father_birth_date` date NULL DEFAULT NULL,
  `father_address` longtext NULL DEFAULT NULL,
  `father_education` varchar(255) NULL DEFAULT NULL,
  `father_job` varchar(255) NULL DEFAULT NULL,
  `father_income` varchar(255) NULL DEFAULT NULL,
  `father_phone` varchar(255) NULL DEFAULT NULL,
  `mother_name` varchar(255) NOT NULL,
  `mother_birth_place` varchar(255) NULL DEFAULT NULL,
  `mother_birth_date` date NULL DEFAULT NULL,
  `mother_address` longtext NULL DEFAULT NULL,
  `mother_education` varchar(255) NULL DEFAULT NULL,
  `mother_job` varchar(255) NULL DEFAULT NULL,
  `mother_income` varchar(255) NULL DEFAULT NULL,
  `mother_phone` varchar(255) NULL DEFAULT NULL,
  `birth_certificate_path` varchar(255) NULL DEFAULT NULL,
  `payment_proof_path` varchar(255) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `academic_year` varchar(255) NOT NULL DEFAULT '2026/2027',
  `notes` longtext NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `track` varchar(255) NULL DEFAULT NULL,
  `program_type` varchar(255) NULL DEFAULT NULL,
  `wave` varchar(255) NULL DEFAULT NULL,
  `extra_fields` longtext NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ppdb_registrations_registration_number_unique` (`registration_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `quick_menus`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `quick_menus`;
CREATE TABLE `quick_menus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `quick_menus`
INSERT INTO `quick_menus` (`id`, `name`, `icon`, `url`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
  (1, 'PPDB', 'fa-solid fa-graduation-cap', '/ppdb', 1, 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (2, 'Profil', 'fa-solid fa-school', '/tentang-kami', 2, 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (3, 'Guru', 'fa-solid fa-chalkboard-user', '/dewan-guru', 3, 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (4, 'Fasilitas', 'fa-solid fa-layer-group', '/fasilitas', 4, 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (5, 'Unggulan', 'fa-solid fa-award', '/unggulan', 5, 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (6, 'Prestasi', 'fa-solid fa-trophy', '/prestasi', 6, 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (7, 'Ekskul', 'fa-solid fa-people-group', '/ekstrakurikuler', 7, 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (8, 'Berita', 'fa-solid fa-newspaper', '/artikel', 8, 1, '2026-09-18 09:03:58', '2026-09-18 09:03:58');

-- --------------------------------------------------------
-- Table structure for table `service_submissions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `service_submissions`;
CREATE TABLE `service_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `agency` varchar(255) NOT NULL,
  `whatsapp` varchar(255) NOT NULL,
  `purpose` longtext NOT NULL,
  `letter_path` varchar(255) NULL DEFAULT NULL,
  `ktp_path` varchar(255) NULL DEFAULT NULL,
  `npwp_path` varchar(255) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `admin_notes` longtext NULL DEFAULT NULL,
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `user_agent` longtext NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_submissions_status_index` (`status`),
  KEY `service_submissions_service_type_index` (`service_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `sessions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `user_agent` longtext NULL DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_last_activity_index` (`last_activity`),
  KEY `sessions_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `sessions`
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
  ('Jsn5rjJiEV7V7Lm4iNIyoeDrEpRDLPicpHmtzcBH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJvdTJYVUhqTTdxQmRnbEZGWUtlY01vNDh2ZE1zcVNMbHcyUEhRa1BHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3NtcGl0aXNodW0udGVzdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1789707425),
  ('TTPJ9nEABUU50eBw5sI4iPodYKPWqh2XN6yTIn8V', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJIa1IxeW9mSDBQZEllc2hHWUNWQm1YZXYzMXpkUVhrWUFmN3FXWFZBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3NtcGl0aXNodW0udGVzdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1789712288),
  ('ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ4YUZPc05XZzJwSjk1c25kMnZ1ZEZCMERIdDVjbDVNdnQzRktkT1pEIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3NtcGl0aXNodW0udGVzdFwvc2FtYnV0YW4ta2VwYWxhLXNla29sYWgiLCJyb3V0ZSI6InBhZ2Uuc2FtYnV0YW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1789721225),
  ('QixdasB28n97lZUjm5yfqxMemNJOLxCZqbpE1sp7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJmalp4dmdIbkk5OERiTDA1RXFTcWpEQTRibFQzblBpRnFoUUo1dTlKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3NtcGl0aXNodW0udGVzdFwvdGVudGFuZy1rYW1pIiwicm91dGUiOiJwYWdlLnRlbnRhbmcta2FtaSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1789722177),
  ('8ioqQjQZjozQI4jmroxTA6fY46y7yZ3X546f1Tn5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI5THV0M1o1eElDelVSMFZjZXZ2NzVYZ2JTZnB1OGZjdkZ2MGpGd1pPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3NtcGl0aXNodW0udGVzdFwvc2FtYnV0YW4ta2VwYWxhLXNla29sYWgiLCJyb3V0ZSI6InBhZ2Uuc2FtYnV0YW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1789722177);

-- --------------------------------------------------------
-- Table structure for table `settings`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` longtext NULL DEFAULT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `settings`
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
  (1, 'site_name', 'SMPS IT Ishlahul Ummah Prabumulih', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (2, 'site_tagline', 'Membina Generasi Qur\'ani, Cerdas, Berakhlak Mulia & Berprestasi Global', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (3, 'site_description', 'Official Website SMPS IT Ishlahul Ummah Prabumulih (SMP IT Ishum). Sekolah Menengah Pertama Islam Terpadu berakreditasi di Kota Prabumulih dengan kurikulum terpadu nasional dan pembinaan karakter Qur\'ani.', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (4, 'contact_email', 'smpitishlahulummah.2015@yahoo.com', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (5, 'contact_phone', '0852-6990-8696', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (6, 'contact_whatsapp', '0852-6990-8696', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (7, 'contact_phone_alt', '0853-7897-4396', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (8, 'contact_address', 'Jalan Sadewa No. 45 RT 01 RW 04 Kelurahan Karang Raja, Kecamatan Prabumulih Timur, Kota Prabumulih, Sumatera Selatan 31113', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (9, 'social_facebook', 'https://www.facebook.com/smpitishlahulummah.prabumulih?locale=sw_KE', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (10, 'social_instagram', 'https://www.instagram.com/smpitishlahulummahprabumulih/', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (11, 'social_youtube', 'https://www.youtube.com/@smpitishlahulummahprabumul6398', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (12, 'social_tiktok', 'https://www.tiktok.com/@smpitishlahulummahprabumulih', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (13, 'google_maps_url', 'https://maps.app.goo.gl/oN2gtn7TuTGELXJ86', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (14, 'banner_daftar_url', '/spmb', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (15, 'banner_donasi_url', '/donasi', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (16, 'site_logo', '/uploads/logo-ishum.png', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (17, 'site_logo_square', '/uploads/logo-ishum-square.png', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (18, 'og_title', 'SMPS IT Ishlahul Ummah Prabumulih', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (19, 'og_description', 'Official Website SMPS IT Ishlahul Ummah Prabumulih: Informasi SPMB Gelombang Exclusive, Berita & Prestasi, Profil Guru, Fasilitas, dan Program Tahfidz.', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (20, 'og_image', '/uploads/campus-smpit-ishum.webp', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (21, 'meta_keywords', 'smps it ishlahul ummah prabumulih, smp it ishum, sekolah islam terpadu prabumulih, spmb smp it ishum, tahfidz prabumulih, jsit prabumulih', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (22, 'npsn', 69787455, 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (23, 'akreditasi', 'B (Terakreditasi BAN-SM)', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (24, 'no_sk_akreditasi', '1036/BAN-SM/SK/2021', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (25, 'sk_pendirian', '2.16.72.04.001', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (26, 'sk_izin', '0876/DPMPTSP.V/IX/2023', 'general', '2026-09-18 05:04:55', '2026-09-18 05:04:55'),
  (27, 'kepala_sekolah', 'Anita Carlyna, S.IP., M.Pd., Gr', 'general', '2026-09-18 05:04:56', '2026-09-18 09:03:58'),
  (28, 'spmb_promo_title', 'SPMB Gelombang Exclusive', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (29, 'spmb_promo_cashback', 'Cash Back 1 Juta', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (30, 'spmb_promo_quota', '24 Siswa per Kelas', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (31, 'spmb_promo_note', '*Khusus Alumni SDIT Ishum dan SDIT Ishum 2', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (32, 'donation_bank_1_name', 'Bank Syariah Indonesia (BSI)', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (33, 'donation_bank_1_code', 451, 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (34, 'donation_bank_1_rekening', '718-293-8401', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (35, 'donation_bank_1_holder', 'YAYASAN ISHLAHUL UMMAH PRABUMULIH', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (36, 'donation_bank_2_name', 'Bank Sumsel Babel Syariah', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (37, 'donation_bank_2_code', 120, 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (38, 'donation_bank_2_rekening', '801-09-00123', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (39, 'donation_bank_2_holder', 'SMP IT ISHLAHUL UMMAH PRABUMULIH', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (40, 'donation_confirm_phone', '0852-6990-8696', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (41, 'donation_confirm_text', 'Assalamu\'alaikum Bendahara SMPS IT Ishlahul Ummah, saya telah menyalurkan infaq pembangunan.', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56'),
  (42, 'donation_intro_text', 'Salurkan infaq pembangunan sarana pendidikan, beasiswa tahfidz Qur\'an, dan pengembangan kampus SMPS IT Ishlahul Ummah Prabumulih.', 'general', '2026-09-18 05:04:56', '2026-09-18 05:04:56');

-- --------------------------------------------------------
-- Table structure for table `tags`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `tags`
INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
  (1, 'PPDB', 'ppdb', '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (2, 'Tahfidz', 'tahfidz', '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (3, 'Prestasi', 'prestasi', '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (4, 'Juara', 'juara', '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (5, 'JSIT', 'jsit', '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (6, 'Outing Class', 'outing-class', '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (7, 'IU Safar', 'safar', '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (8, 'IU Berkhidmat', 'berkhidmat', '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (9, 'Ekskul', 'ekskul', '2026-09-18 05:05:31', '2026-09-18 05:05:31'),
  (10, 'Prabumulih', 'prabumulih', '2026-09-18 05:05:31', '2026-09-18 05:05:31');

-- --------------------------------------------------------
-- Table structure for table `testimonials`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `profession` varchar(255) NULL DEFAULT NULL,
  `content` longtext NOT NULL,
  `photo` varchar(255) NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `testimonials`
INSERT INTO `testimonials` (`id`, `name`, `profession`, `content`, `photo`, `status`, `created_at`, `updated_at`) VALUES
  (1, 'H. Bambang Irawan, S.E', 'Wali Santri Kelas VIII', 'Alhamdulillah, semenjak bersekolah di SMP IT Ishlahul Ummah Prabumulih, perkembangan ibadah dan akhlak anak saya meningkat drastis. Sholat 5 waktu tertib dan hafalannya terus bertambah mutqin.', '/uploads/testimoni/wali-santri-1.webp', 'publish', '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (2, 'Dra. Hj. Nuraini', 'Wali Santri Kelas IX', 'Sekolah Islam Terpadu terbaik di Prabumulih. Para ustaz dan ustazah membimbing anak-anak dengan penuh kasih sayang. Program bilingual dan pembiasaan adabnya sangat terasa manfaatnya.', '/uploads/testimoni/wali-santri-2.webp', 'publish', '2026-09-18 09:03:59', '2026-09-18 09:03:59'),
  (3, 'Fathir Rahman', 'Alumni SMP IT Ishum', 'Tiga tahun belajar di SMP IT Ishlahul Ummah memberikan fondasi yang sangat kokoh bagi saya, baik dalam hafalan Qur\'an, kemampuan sains, maupun kepemimpinan di jenjang pendidikan berikutnya.', '/uploads/testimoni/alumni-1.webp', 'publish', '2026-09-18 09:03:59', '2026-09-18 09:03:59');

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `avatar` varchar(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `avatar`) VALUES
  (1, 'Admin SMPS IT Ishlahul Ummah Prabumulih', 'admin@smpitishum.sch.id', NULL, '$2y$12$mpAwwSiZZLo3UOAqqlug9er36FM8bU.9lavUUBrWJDKblS5EqLlB6', NULL, '2026-09-18 05:04:55', '2026-09-18 09:03:58', 'admin', NULL);

-- --------------------------------------------------------
-- Table structure for table `videos`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `youtube_url` varchar(255) NOT NULL,
  `youtube_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `description` longtext NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `videos_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `videos`
INSERT INTO `videos` (`id`, `title`, `slug`, `youtube_url`, `youtube_id`, `description`, `created_at`, `updated_at`) VALUES
  (1, 'Profil Singkat SMPS IT Ishlahul Ummah Prabumulih', 'profil-singkat-smps-it-ishlahul-ummah-prabumulih', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ', 'Mengenal lebih dekat SMPS IT Ishlahul Ummah Prabumulih: fasilitas, kurikulum terpadu, dan pembinaan karakter generasi Qur\'ani.', '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (2, 'Dokumentasi Class Meeting & Semangat Ukhuwah Santri', 'dokumentasi-class-meeting-dan-semangat-ukhuwah-santri', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ', 'Rangkaian semarak Class Meeting Semester Genap SMP IT Ishlahul Ummah Prabumulih.', '2026-09-18 09:03:58', '2026-09-18 09:03:58'),
  (3, 'Tilawah Al-Qur\'an & Munaqosah Tahfidz Santri', 'tilawah-al-quran-dan-munaqosah-tahfidz-santri', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ', 'Gema lantunan ayat suci Al-Qur\'an santri SMPS IT Ishlahul Ummah pada program tahfidz mutqin.', '2026-09-18 09:03:58', '2026-09-18 09:03:58');

-- --------------------------------------------------------
-- Table structure for table `visitor_logs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `visitor_logs`;
CREATE TABLE `visitor_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NULL DEFAULT NULL,
  `session_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `user_agent` longtext NULL DEFAULT NULL,
  `device_type` varchar(255) NOT NULL DEFAULT 'Desktop',
  `browser` varchar(255) NULL DEFAULT NULL,
  `platform` varchar(255) NULL DEFAULT NULL,
  `referer` longtext NULL DEFAULT NULL,
  `referer_source` varchar(255) NULL DEFAULT NULL,
  `url` longtext NULL DEFAULT NULL,
  `path` varchar(255) NULL DEFAULT NULL,
  `page_title` varchar(255) NULL DEFAULT NULL,
  `country` varchar(255) NULL DEFAULT NULL,
  `country_code` varchar(255) NULL DEFAULT NULL,
  `city` varchar(255) NULL DEFAULT NULL,
  `region` varchar(255) NULL DEFAULT NULL,
  `is_bot` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visitor_logs_is_bot_index` (`is_bot`),
  KEY `visitor_logs_city_index` (`city`),
  KEY `visitor_logs_country_index` (`country`),
  KEY `visitor_logs_path_index` (`path`),
  KEY `visitor_logs_referer_source_index` (`referer_source`),
  KEY `visitor_logs_device_type_index` (`device_type`),
  KEY `visitor_logs_session_id_index` (`session_id`),
  KEY `visitor_logs_ip_address_index` (`ip_address`),
  KEY `visitor_logs_created_at_is_bot_index` (`created_at`, `is_bot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `visitor_logs`
INSERT INTO `visitor_logs` (`id`, `ip_address`, `session_id`, `user_agent`, `device_type`, `browser`, `platform`, `referer`, `referer_source`, `url`, `path`, `page_title`, `country`, `country_code`, `city`, `region`, `is_bot`, `created_at`, `updated_at`) VALUES
  (1, '127.0.0.1', 'Jsn5rjJiEV7V7Lm4iNIyoeDrEpRDLPicpHmtzcBH', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', '', 'Direct / Langsung', 'http://smpitishum.test', '/', 'Beranda', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 04:57:04', '2026-09-18 04:57:04'),
  (2, '127.0.0.1', 'TTPJ9nEABUU50eBw5sI4iPodYKPWqh2XN6yTIn8V', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', '', 'Direct / Langsung', 'http://smpitishum.test', '/', 'Beranda', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 06:18:08', '2026-09-18 06:18:08'),
  (3, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', '', 'Direct / Langsung', 'http://smpitishum.test', '/', 'Beranda', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:51:49', '2026-09-18 07:51:49'),
  (4, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/', 'Direct / Langsung', 'http://smpitishum.test/sambutan-kepala-sekolah', '/sambutan-kepala-sekolah', 'Sambutan Kepala Sekolah', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:57:33', '2026-09-18 07:57:33'),
  (5, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/sambutan-kepala-sekolah', 'Direct / Langsung', 'http://smpitishum.test/tentang-kami', '/tentang-kami', 'Profil & Tentang Kami', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:57:40', '2026-09-18 07:57:40'),
  (6, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/tentang-kami', 'Direct / Langsung', 'http://smpitishum.test/visi-dan-misi', '/visi-dan-misi', 'Visi & Misi Sekolah', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:57:47', '2026-09-18 07:57:47'),
  (7, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/visi-dan-misi', 'Direct / Langsung', 'http://smpitishum.test/sejarah', '/sejarah', 'Sejarah Sekolah', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:57:50', '2026-09-18 07:57:50'),
  (8, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/sejarah', 'Direct / Langsung', 'http://smpitishum.test/dewan-guru', '/dewan-guru', 'Dewan Guru & GTK', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:57:53', '2026-09-18 07:57:53'),
  (9, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/dewan-guru', 'Direct / Langsung', 'http://smpitishum.test/struktur-organisasi', '/struktur-organisasi', 'Struktur Organisasi', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:57:58', '2026-09-18 07:57:58'),
  (10, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/struktur-organisasi', 'Direct / Langsung', 'http://smpitishum.test/fasilitas', '/fasilitas', 'Fasilitas & Sarana Kampus', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:58:03', '2026-09-18 07:58:03'),
  (11, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/fasilitas', 'Direct / Langsung', 'http://smpitishum.test/artikel', '/artikel', 'Kabar & Berita Sekolah', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:58:05', '2026-09-18 07:58:05'),
  (12, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/artikel', 'Direct / Langsung', 'http://smpitishum.test/download', '/download', 'Pusat Unduhan Berkas', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:59:52', '2026-09-18 07:59:52'),
  (13, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/download', 'Direct / Langsung', 'http://smpitishum.test/layanan-terpadu', '/layanan-terpadu', 'Layanan Terpadu', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 07:59:57', '2026-09-18 07:59:57'),
  (14, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/layanan-terpadu', 'Direct / Langsung', 'http://smpitishum.test/download', '/download', 'Pusat Unduhan Berkas', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:00:01', '2026-09-18 08:00:01'),
  (15, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/layanan-terpadu', 'Direct / Langsung', 'http://smpitishum.test/download', '/download', 'Pusat Unduhan Berkas', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:13:44', '2026-09-18 08:13:44'),
  (16, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/download', 'Direct / Langsung', 'http://smpitishum.test', '/', 'Beranda', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:13:46', '2026-09-18 08:13:46'),
  (17, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/download', 'Direct / Langsung', 'http://smpitishum.test', '/', 'Beranda', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:22:33', '2026-09-18 08:22:33'),
  (18, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/', 'Direct / Langsung', 'http://smpitishum.test/sambutan-kepala-sekolah', '/sambutan-kepala-sekolah', 'Sambutan Kepala Sekolah', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:22:57', '2026-09-18 08:22:57'),
  (19, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/sambutan-kepala-sekolah', 'Direct / Langsung', 'http://smpitishum.test', '/', 'Beranda', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:23:01', '2026-09-18 08:23:01'),
  (20, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/', 'Direct / Langsung', 'http://smpitishum.test', '/', 'Beranda', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:28:53', '2026-09-18 08:28:53'),
  (21, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/', 'Direct / Langsung', 'http://smpitishum.test', '/', 'Beranda', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:29:33', '2026-09-18 08:29:33'),
  (22, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/', 'Direct / Langsung', 'http://smpitishum.test', '/', 'Beranda', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:32:47', '2026-09-18 08:32:47'),
  (23, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/', 'Direct / Langsung', 'http://smpitishum.test/sambutan-kepala-sekolah', '/sambutan-kepala-sekolah', 'Sambutan Kepala Sekolah', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:32:54', '2026-09-18 08:32:54'),
  (24, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/', 'Direct / Langsung', 'http://smpitishum.test/sambutan-kepala-sekolah', '/sambutan-kepala-sekolah', 'Sambutan Kepala Sekolah', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:45:26', '2026-09-18 08:45:26'),
  (25, '127.0.0.1', 'ZcPjwlIET6NThon7HaF2lQrWJOLZslIPt1PupoEZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', 'http://smpitishum.test/', 'Direct / Langsung', 'http://smpitishum.test/sambutan-kepala-sekolah', '/sambutan-kepala-sekolah', 'Sambutan Kepala Sekolah', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 08:47:05', '2026-09-18 08:47:05'),
  (26, '127.0.0.1', 'QixdasB28n97lZUjm5yfqxMemNJOLxCZqbpE1sp7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', '', 'Direct / Langsung', 'http://smpitishum.test/tentang-kami', '/tentang-kami', 'Profil & Tentang Kami', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 09:02:57', '2026-09-18 09:02:57'),
  (27, '127.0.0.1', '8ioqQjQZjozQI4jmroxTA6fY46y7yZ3X546f1Tn5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'Desktop', 'Chrome', 'Windows 10/11', '', 'Direct / Langsung', 'http://smpitishum.test/sambutan-kepala-sekolah', '/sambutan-kepala-sekolah', 'Sambutan Kepala Sekolah', 'Indonesia', 'ID', 'Lokal / Server', 'Sumatera Selatan', '0', '2026-09-18 09:02:57', '2026-09-18 09:02:57');

SET FOREIGN_KEY_CHECKS=1;
-- ==========================================================
-- END OF DUMP
-- ==========================================================
