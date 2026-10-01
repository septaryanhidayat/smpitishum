<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class EkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        if (Post::where('type', 'ekskul')->exists()) {
            return;
        }

        $ekskulItems = [
            [
                'title' => 'Pramuka SIT (Sekolah Islam Terpadu)',
                'slug' => 'pramuka-sit',
                'excerpt' => 'Kepanduan berkarakter Islam melatih kemandirian, kepemimpinan, dan kecintaan pada alam terbuka.',
                'featured_image' => '/uploads/activities-smpit-ishum.webp',
                'content' => '<p>Ekstrakurikuler Pramuka SIT (Satuan Komunitas Pramuka Sekolah Islam Terpadu) di SMPS IT Ishlahul Ummah merupakan wadah pembinaan karakter, kedisiplinan, kemandirian, dan kepemimpinan berlandaskan nilai-nilai Islam. Melalui kegiatan perkemahan, penjelajahan alam, tali temali, semaphore, dan bakti sosial, para santri dilatih untuk tangguh, siap menolong sesama, dan berjiwa ksatria.</p><p>Kegiatan rutin dilaksanakan setiap pekan dibimbing oleh para pembina berpengalaman dan tersertifikasi KMD/KML.</p>',
            ],
            [
                'title' => 'Robotika & Coding IT Club',
                'slug' => 'robotika-coding-it-club',
                'excerpt' => 'Pelatihan logika pemrograman dasar, perakitan mikrokontroler, dan persiapan olimpiade robotika.',
                'featured_image' => '/uploads/ishum/fasilitas_1274_Ruang-Lab-Komputer1.webp',
                'content' => '<p>Klub Robotika dan Pemrograman dirancang untuk mempersiapkan santri menghadapi era kecerdasan buatan (AI) dan teknologi digital. Siswa mempelajari algoritma logika pemrograman, dasar elektronika, perakitan sensor, pemrograman mikrokontroler Arduino/ESP32, hingga pembuatan robot mobile cerdas.</p><p>Klub ini aktif mengikuti berbagai kompetisi sains dan teknologi madrasah/sekolah tingkat provinsi hingga nasional.</p>',
            ],
            [
                'title' => 'Tahfidz & TTQ Club (Tartil Al-Qur\'an)',
                'slug' => 'tahfidz-ttq-club',
                'excerpt' => 'Pendalaman tajwid, makhorijul huruf, tilawah berirama, dan persiapan tasmi\' mutqin 2 juz.',
                'featured_image' => '/uploads/tahfidz-smpit-ishum.webp',
                'content' => '<p>Klub Tahsin dan Tahfidz Qur\'an (TTQ) berfokus pada pemantapan bacaan Al-Qur\'an berstandar riwayat Imam Hafsh, penguasaan matan Al-Jazariyah, perbaikan makharijul huruf, serta penguasaan seni tilawah berirama (Nahawand, Bayati, Hijaz, dll).</p><p>Klub ini mengantarkan para santri menuju ujian tasmi\' sekali duduk 2 juz mutqin serta ajang Musabaqah Tilawatil Qur\'an (MTQ) dan MHQ antarpelajar.</p>',
            ],
            [
                'title' => 'English & Arabic Public Speaking Club',
                'slug' => 'english-arabic-public-speaking-club',
                'excerpt' => 'Latihan percakapan bahasa asing aktif, pidato 3 bahasa, dan pembiasaan retorika dakwah.',
                'featured_image' => '/uploads/campus-smpit-ishum.webp',
                'content' => '<p>Membekali santri dengan kecakapan berbahasa internasional dan keberanian berbicara di depan publik (public speaking). Materi meliputi pidato (speech), debat bahasa Inggris, khitabah bahasa Arab, story telling islami, dan pembiasaan active daily conversation.</p><p>Siswa dilatih menjadi dai dan pemimpin muda berwawasan global yang mampu menyuarakan pesan kebaikan Islam kepada dunia.</p>',
            ],
            [
                'title' => 'Futsal & Olahraga Prestasi',
                'slug' => 'futsal-olahraga-prestasi',
                'excerpt' => 'Pembinaan kebugaran jasmani, teknik bermain futsal terpadu, dan kompetisi antarpelajar.',
                'featured_image' => '/uploads/activities-smpit-ishum.webp',
                'content' => '<p>Olahraga futsal dan kebugaran melatih fisik yang kuat (Qowiyyul Jismi), sportivitas, serta kerja sama tim solid. Didukung lapangan olahraga yang memadai, santri mendapatkan pembinaan teknik dasar dribbling, passing, formasi taktik bertanding, dan pola hidup sehat.</p><p>Tim futsal SMPS IT Ishlahul Ummah rutin menjuarai turnamen tingkat kota dan persahabatan antarsekolah Islam di Sumatera Selatan.</p>',
            ],
            [
                'title' => 'Seni Hadrah & Kaligrafi Islam',
                'slug' => 'seni-hadrah-kaligrafi-islam',
                'excerpt' => 'Pelatihan tabuhan rebana hadrah, vokal sholawat, dan seni lukis kaligrafi mushaf.',
                'featured_image' => '/uploads/ishum/fasilitas_1278_HALL-SIT-Ishlahul-Ummah_.webp',
                'content' => '<p>Wadah apresiasi seni budaya Islam yang menanamkan mahabbah (cinta) kepada Nabi Muhammad SAW melalui lantunan sholawat dan tabuhan rebana banjari/hadrah modern, serta mengasah kepekaan estetika melalui seni menulis khat kaligrafi indah (Khat Tsuluts, Naskhi, Riq\'ah).</p><p>Grup hadrah dan tim kaligrafi sering tampil dalam peringatan hari besar Islam, wisuda sekolah, dan festival kesenian Islam se-Sumatera Selatan.</p>',
            ],
        ];

        foreach ($ekskulItems as $idx => $e) {
            Post::updateOrCreate(
                ['slug' => $e['slug'], 'type' => 'ekskul'],
                array_merge($e, [
                    'type' => 'ekskul',
                    'status' => 'publish',
                    'author_id' => 1,
                    'published_at' => now()->subDays(6 - $idx),
                ])
            );
        }
    }
}
