<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\AnggotaDewan;
use App\Models\Bidang;
use App\Models\Category;
use App\Models\Download;
use App\Models\Dpc;
use App\Models\Pengumuman;
use App\Models\Post;
use App\Models\QuickMenu;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Testimonial;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SchoolDataSeeder extends Seeder
{
    public function run(): void
    {
        $dataFile = __DIR__.'/data/ishum_data.json';
        $data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

        // 1. Settings SMPS IT Ishlahul Ummah Prabumulih
        $settings = [
            'site_name' => 'SMPS IT Ishlahul Ummah Prabumulih',
            'site_tagline' => 'Membina Generasi Qur\'ani, Cerdas, Berakhlak Mulia & Berprestasi Global',
            'site_description' => 'Official Website SMPS IT Ishlahul Ummah Prabumulih (SMP IT Ishum). Sekolah Menengah Pertama Islam Terpadu berakreditasi di Kota Prabumulih dengan kurikulum terpadu nasional dan pembinaan karakter Qur\'ani.',
            'contact_email' => 'smpitishlahulummah.2015@yahoo.com',
            'contact_phone' => '0852-6990-8696',
            'contact_whatsapp' => '0852-6990-8696',
            'contact_phone_alt' => '0853-7897-4396',
            'contact_address' => 'Jalan Sadewa No. 45 RT 01 RW 04 Kelurahan Karang Raja, Kecamatan Prabumulih Timur, Kota Prabumulih, Sumatera Selatan 31113',
            'social_facebook' => 'https://www.facebook.com/smpitishlahulummah.prabumulih?locale=sw_KE',
            'social_instagram' => 'https://www.instagram.com/smpitishlahulummahprabumulih/',
            'social_youtube' => 'https://www.youtube.com/@smpitishlahulummahprabumul6398',
            'social_tiktok' => 'https://www.tiktok.com/@smpitishlahulummahprabumulih',
            'google_maps_url' => 'https://maps.app.goo.gl/oN2gtn7TuTGELXJ86',
            'banner_daftar_url' => '/spmb',
            'banner_donasi_url' => '/donasi',
            'site_logo' => '/uploads/logo-ishum.png',
            'site_logo_square' => '/uploads/logo-ishum-square.png',
            'og_title' => 'SMPS IT Ishlahul Ummah Prabumulih',
            'og_description' => 'Official Website SMPS IT Ishlahul Ummah Prabumulih: Informasi SPMB Gelombang Exclusive, Berita & Prestasi, Profil Guru, Fasilitas, dan Program Tahfidz.',
            'og_image' => '/uploads/logo-ishum-square.png',
            'meta_keywords' => 'smps it ishlahul ummah prabumulih, smp it ishum, sekolah islam terpadu prabumulih, spmb smp it ishum, tahfidz prabumulih, jsit prabumulih',
            'npsn' => '69787455',
            'akreditasi' => 'B (Terakreditasi BAN-SM)',
            'no_sk_akreditasi' => '1036/BAN-SM/SK/2021',
            'sk_pendirian' => '2.16.72.04.001',
            'sk_izin' => '0876/DPMPTSP.V/IX/2023',
            'kepala_sekolah' => 'Anita Carlyna, S.IP., M.Pd., Gr',
            'spmb_promo_title' => 'SPMB Gelombang Exclusive',
            'spmb_promo_cashback' => 'Cash Back 1 Juta',
            'spmb_promo_quota' => '24 Siswa per Kelas',
            'spmb_promo_note' => '*Khusus Alumni SDIT Ishum dan SDIT Ishum 2',
            'donation_bank_1_name' => 'Bank Syariah Indonesia (BSI)',
            'donation_bank_1_code' => '451',
            'donation_bank_1_rekening' => '718-293-8401',
            'donation_bank_1_holder' => 'YAYASAN ISHLAHUL UMMAH PRABUMULIH',
            'donation_bank_2_name' => 'Bank Sumsel Babel Syariah',
            'donation_bank_2_code' => '120',
            'donation_bank_2_rekening' => '801-09-00123',
            'donation_bank_2_holder' => 'SMP IT ISHLAHUL UMMAH PRABUMULIH',
            'donation_confirm_phone' => '0852-6990-8696',
            'donation_confirm_text' => "Assalamu'alaikum Bendahara SMPS IT Ishlahul Ummah, saya telah menyalurkan infaq pembangunan.",
            'donation_intro_text' => 'Salurkan infaq pembangunan sarana pendidikan, beasiswa tahfidz Qur\'an, dan pengembangan kampus SMPS IT Ishlahul Ummah Prabumulih.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 2. Quick Menus (8 Menu Utama)
        $quickMenus = [
            ['name' => 'PPDB', 'url' => '/ppdb', 'icon' => 'fa-solid fa-graduation-cap', 'order' => 1],
            ['name' => 'Profil', 'url' => '/tentang-kami', 'icon' => 'fa-solid fa-school', 'order' => 2],
            ['name' => 'Guru', 'url' => '/dewan-guru', 'icon' => 'fa-solid fa-chalkboard-user', 'order' => 3],
            ['name' => 'Fasilitas', 'url' => '/fasilitas', 'icon' => 'fa-solid fa-layer-group', 'order' => 4],
            ['name' => 'Unggulan', 'url' => '/unggulan', 'icon' => 'fa-solid fa-award', 'order' => 5],
            ['name' => 'Prestasi', 'url' => '/prestasi', 'icon' => 'fa-solid fa-trophy', 'order' => 6],
            ['name' => 'Ekskul', 'url' => '/ekstrakurikuler', 'icon' => 'fa-solid fa-people-group', 'order' => 7],
            ['name' => 'Berita', 'url' => '/artikel', 'icon' => 'fa-solid fa-newspaper', 'order' => 8],
        ];

        QuickMenu::truncate();
        foreach ($quickMenus as $qm) {
            QuickMenu::create(array_merge($qm, ['is_active' => true]));
        }

        // 3. Dewan Guru & GTK
        AnggotaDewan::truncate();
        $gurus = $data['gurus'] ?? [
            [
                'name' => 'Anita Carlyna, S.IP., M.Pd., Gr',
                'slug' => 'anita-carlyna-sip-mpd-gr',
                'position' => 'Kepala Sekolah',
                'fraction' => 'Pimpinan Sekolah',
                'photo' => '/uploads/dewan/kepala-sekolah.webp',
                'profile_summary' => 'Kepala SMPS IT Ishlahul Ummah Prabumulih. Berkomitmen mendidik generasi Qur\'ani yang cerdas, berakhlak mulia, dan berprestasi global.',
                'education' => 'S1 Ilmu Administrasi Negara, S2 Manajemen Pendidikan, Gr',
                'order' => 1,
            ],
        ];

        foreach ($gurus as $g) {
            AnggotaDewan::create($g);
        }

        // 4. Fasilitas Sekolah (Bidangs)
        Bidang::truncate();
        $facilities = $data['facilities'] ?? [];
        foreach ($facilities as $fac) {
            Bidang::create(array_merge($fac, [
                'address' => 'Kampus SMPS IT Ishlahul Ummah Prabumulih',
                'phone' => '0852-6990-8696',
                'email' => 'smpitishlahulummah.2015@yahoo.com',
            ]));
        }

        // 5. Program Unggulan (Dpcs)
        $programs = [
            [
                'name' => 'Program Tahfidz 2 Juz Mutqin & Hadits',
                'slug' => 'program-tahfidz-2-juz-mutqin',
                'address' => 'Kurikulum Khusus Keislaman',
                'description' => 'Bimbingan intensif membaca Al-Qur\'an dengan tartil, tahsin bersanad, dan hafalan mutqin minimal 2 juz serta 12 hadits pilihan.',
                'order' => 1,
            ],
            [
                'name' => 'Bina Pribadi Islam (BPI) & Karakter Islami',
                'slug' => 'bina-pribadi-islam-bpi',
                'address' => 'Pembinaan Karakter Siswa',
                'description' => 'Halaqah pekanan pembinaan adab, pembiasaan ibadah yaumiyah, dzikir ma\'tsurat, serta penanaman akhlaqul karimah.',
                'order' => 2,
            ],
            [
                'name' => 'Kurikulum Terpadu JSIT & Kurikulum Merdeka',
                'slug' => 'kurikulum-terpadu-jsit-merdeka',
                'address' => 'Integrasi Nilai Islam & Sains',
                'description' => 'Memadukan standar capaian Kurikulum Merdeka Nasional dengan nilai-nilai Islam Terpadu berstandar JSIT Indonesia.',
                'order' => 3,
            ],
            [
                'name' => 'Program Belajar Bersama Maestro & Riset Sains',
                'slug' => 'belajar-bersama-maestro-riset',
                'address' => 'Pengembangan Akademik & Potensi',
                'description' => 'Eksplorasi bakat seni, budaya, sains dan teknologi langsung bersama tokoh dan pakar di bidangnya.',
                'order' => 4,
            ],
            [
                'name' => 'IU Safar & Outing Class Edukatif',
                'slug' => 'iu-safar-outing-class',
                'address' => 'Outdoor Learning & Wawasan',
                'description' => 'Pembelajaran luar kelas berbasis observasi alam, studi kampus, renang, dan rekreasi edukatif untuk memperluas cakrawala siswa.',
                'order' => 5,
            ],
            [
                'name' => 'IU Berkhidmat (Bakti Sosial Masyarakat)',
                'slug' => 'iu-berkhidmat-bakti-sosial',
                'address' => 'Kepedulian Sosial & Dakwah',
                'description' => 'Kiprah nyata siswa dalam melayani dan memberikan kontribusi positif bagi masyarakat di Kota Prabumulih.',
                'order' => 6,
            ],
        ];

        Dpc::truncate();
        foreach ($programs as $prog) {
            Dpc::create($prog);
        }

        // 6. Categories & Tags
        DB::table('post_category')->delete();
        DB::table('post_tag')->delete();

        $categoriesMap = [
            'berita' => 'Berita',
            'prestasi-siswa' => 'Prestasi Siswa',
            'akademik-riset' => 'Akademik & Riset',
            'tahfidz-keislaman' => 'Tahfidz & Keislaman',
            'kesiswaan-ekskul' => 'Kesiswaan & Ekskul',
            'kabar-kampus' => 'Kabar Kampus',
            'opini' => 'Opini & Artikel',
        ];

        $categoryModels = [];
        foreach ($categoriesMap as $slug => $catName) {
            $categoryModels[$slug] = Category::updateOrCreate(
                ['slug' => $slug],
                ['name' => $catName, 'description' => 'Kategori '.$catName]
            );
        }

        $tagNames = [
            'ppdb' => 'PPDB',
            'tahfidz' => 'Tahfidz',
            'prestasi' => 'Prestasi',
            'juara' => 'Juara',
            'jsit' => 'JSIT',
            'outing-class' => 'Outing Class',
            'safar' => 'IU Safar',
            'berkhidmat' => 'IU Berkhidmat',
            'ekskul' => 'Ekskul',
            'prabumulih' => 'Prabumulih',
        ];

        $tagModels = [];
        foreach ($tagNames as $slug => $tName) {
            $tagModels[$slug] = Tag::updateOrCreate(
                ['slug' => $slug],
                ['name' => $tName]
            );
        }

        // 7. Video YouTube
        Video::truncate();
        $videos = $data['videos'] ?? [];
        foreach ($videos as $idx => $v) {
            Video::create(array_merge($v, [
                'created_at' => now()->subMinutes($idx * 5),
                'updated_at' => now()->subMinutes($idx * 5),
            ]));
        }

        // 8. Pengumuman
        Pengumuman::truncate();
        $pengumumen = $data['pengumumen'] ?? [];
        foreach ($pengumumen as $an) {
            Pengumuman::create($an);
        }

        // 9. Agenda Sekolah
        Agenda::truncate();
        $agendas = $data['agendas'] ?? [];
        foreach ($agendas as $ag) {
            Agenda::create($ag);
        }

        // 10. Testimonials
        Testimonial::truncate();
        $testimonials = $data['testimonials'] ?? [];
        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }

        // 11. Downloads (Buku, Dokumen & Media)
        Download::truncate();
        $localDownloads = [
            [
                'title' => "Panduan Kurikulum Tahfidz Al-Qur'an 2 Juz SMPS IT Ishlahul Ummah",
                'description' => 'Modul resmi kurikulum tahfidz mutqin SMPS IT Ishlahul Ummah Prabumulih berbasis standar JSIT Indonesia.',
                'category_type' => 'E-Book',
                'file_path' => '/uploads/downloads/panduan-mutqin-tahfidz-ishum.pdf',
                'cover_image' => '/uploads/covers/cover-tahfidz-mutqin.webp',
                'file_type' => 'PDF',
                'file_size' => '9.0 KB',
                'download_count' => 342,
            ],
            [
                'title' => 'Buku Saku Adab & 10 Karakter (Muwashofat) Siswa JSIT',
                'description' => 'Pedoman pembiasaan akhlak islami, adab kepada guru dan orang tua, tata tertib siswa asrama dan sekolah.',
                'category_type' => 'E-Book',
                'file_path' => '/uploads/downloads/buku-saku-adab-karakter-siswa.pdf',
                'cover_image' => '/uploads/covers/cover-karakter-siswa.webp',
                'file_type' => 'PDF',
                'file_size' => '6.9 KB',
                'download_count' => 284,
            ],
            [
                'title' => 'Petunjuk Praktikum Laboratorium IPA Terpadu SMPS IT Ishum',
                'description' => 'Pedoman eksperimen laboratorium biologi dan fisika untuk siswa kelas VII-IX SMPS IT Ishlahul Ummah.',
                'category_type' => 'E-Book',
                'file_path' => '/uploads/downloads/petunjuk-praktikum-sains-terpadu.pdf',
                'cover_image' => '/uploads/covers/cover-praktikum-sains.webp',
                'file_type' => 'PDF',
                'file_size' => '6.6 KB',
                'download_count' => 195,
            ],
            [
                'title' => "Kurikulum Pembinaan Da'i Muda, Khitabah & Public Speaking",
                'description' => 'Kumpulan materi public speaking, retorika dakwah 3 bahasa (Indonesia, Arab, Inggris), dan sistematika kultum.',
                'category_type' => 'E-Book',
                'file_path' => '/uploads/downloads/kurikulum-pembinaan-dai-muda.pdf',
                'cover_image' => '/uploads/covers/cover-dai-muda.webp',
                'file_type' => 'PDF',
                'file_size' => '6.5 KB',
                'download_count' => 210,
            ],
            [
                'title' => 'Buku Saku Kosakata Harian Bilingual Bahasa Arab & Inggris Siswa',
                'description' => 'Modul percakapan bilingual harian asrama dan lingkungan sekolah untuk mempercepat penguasaan active speaking.',
                'category_type' => 'E-Book',
                'file_path' => '/uploads/downloads/buku-saku-kosakata-bilingual.pdf',
                'cover_image' => '/uploads/covers/cover-bilingual-arab-inggris.webp',
                'file_type' => 'PDF',
                'file_size' => '6.6 KB',
                'download_count' => 312,
            ],
            [
                'title' => 'Panduan Sukses Asesmen Nasional & Masuk Sekolah Lanjutan Unggulan Favorit',
                'description' => 'Strategi sukses menembus sekolah lanjutan favorit impian, pembedahan materi literasi dan numerasi Asesmen Nasional.',
                'category_type' => 'E-Book',
                'file_path' => '/uploads/downloads/panduan-sukses-snbt-ptn.pdf',
                'cover_image' => '/uploads/covers/cover-sukses-snbt.webp',
                'file_type' => 'PDF',
                'file_size' => '6.6 KB',
                'download_count' => 450,
            ],

            [
                'title' => 'Logo Resmi SMPS IT Ishlahul Ummah Prabumulih (High Resolution)',
                'description' => 'File logo resmi SMPS IT Ishlahul Ummah Prabumulih format PNG transparan.',
                'category_type' => 'Logo',
                'file_path' => '/uploads/logo-ishum.png',
                'file_type' => 'PNG',
                'file_size' => '120 KB',
                'download_count' => 780,
            ],
            [
                'title' => 'Logo Lambang Ishlahul Ummah Square HD',
                'description' => 'Logo lambang persegi SMPS IT Ishlahul Ummah Prabumulih format PNG.',
                'category_type' => 'Logo',
                'file_path' => '/uploads/logo-ishum-square.png',
                'file_type' => 'PNG',
                'file_size' => '85 KB',
                'download_count' => 315,
            ],
        ];

        foreach ($localDownloads as $dw) {
            Download::create($dw);
        }

        // 12. Articles (Posts)
        Post::where('type', 'post')->delete();
        $articles = $data['articles'] ?? [];

        foreach ($articles as $postData) {
            $catSlug = $postData['category'] ?? 'kabar-kampus';
            unset($postData['category']);

            $post = Post::create(array_merge($postData, [
                'type' => 'post',
                'status' => 'publish',
            ]));

            if (isset($categoryModels[$catSlug])) {
                $post->categories()->sync([$categoryModels[$catSlug]->id]);
            }

            // Sync tags
            $selectedTags = collect($tagModels)->random(min(3, count($tagModels)))->pluck('id')->toArray();
            $post->tags()->sync($selectedTags);
        }

        // 13. Halaman Statis Resmi Sekolah
        Post::where('type', 'page')->delete();

        $officialPages = [
            [
                'slug' => 'sambutan-kepala-sekolah',
                'title' => 'Sambutan Kepala Sekolah SMPS IT Ishlahul Ummah Prabumulih',
                'excerpt' => 'Sambutan resmi Kepala Sekolah SMPS IT Ishlahul Ummah Prabumulih, Anita Carlyna, S.IP., M.Pd., Gr.',
                'featured_image' => '/uploads/dewan/kepala-sekolah.webp',
                'content' => <<<'HTML'
<p><strong>Bismillahirrohmanirrohim. Assalamu'alaikum Warahmatullahi Wabarakatuh.</strong></p>
<p>Segala puji dan syukur kita panjatkan kehadirat Allah SWT yang senantiasa melimpahkan rahmat, taufik, dan inayah-Nya kepada kita semua. Sholawat beriring salam senantiasa tercurah kepada junjungan alam Nabi Besar Muhammad SAW, para keluarga, sahabat, dan pengikutnya hingga akhir zaman.</p>
<p>Selamat datang di website resmi <strong>SMPS IT Ishlahul Ummah Prabumulih</strong>. Di era transformasi digital dan revolusi industri saat ini, kehadiran media informasi digital menjadi sarana vital untuk mempererat ukhuwah, menyajikan transparansi kegiatan sekolah, serta memberikan kemudahan akses informasi bagi para orang tua, siswa, dan masyarakat luas.</p>
<p>Sebagai Sekolah Menengah Pertama Islam Terpadu di bawah naungan <strong>Yayasan Ishlahul Ummah Prabumulih</strong>, kami berkomitmen menghadirkan pendidikan holistik yang memadukan keunggulan kurikulum nasional, penguatan adab Islami, target hafalan Al-Qur'an 2 juz mutqin, kompetensi sains-teknologi, dan pembiasaan bahasa asing (Arab dan Inggris).</p>
<p>Kami mengucapkan terima kasih yang sebesar-besarnya kepada Pembina dan Pengurus Yayasan Ishlahul Ummah, seluruh asatidz dan asatidzah, staf kependidikan, serta para wali murid yang senantiasa membersamai langkah kami dalam mendidik generasi terbaik umat. Mari bersama-sama kita wujudkan anak-anak yang sholih-sholihah, cerdas, berprestasi, dan berakhlakul karimah.</p>
<p><em>Wassalamu'alaikum Warahmatullahi Wabarakatuh.</em></p>
<p><strong>Kepala SMPS IT Ishlahul Ummah Prabumulih</strong><br>
<strong>Anita Carlyna, S.IP., M.Pd., Gr</strong></p>
HTML,
            ],
            [
                'slug' => 'visi-dan-misi',
                'title' => 'Visi dan Misi SMPS IT Ishlahul Ummah Prabumulih',
                'excerpt' => 'Visi, Misi, dan Tujuan penyelenggaraan pendidikan SMPS IT Ishlahul Ummah Prabumulih.',
                'featured_image' => '/uploads/logo-ishum.png',
                'content' => <<<'HTML'
<h3>VISI SEKOLAH</h3>
<blockquote class="text-xl font-bold text-school-primary my-4 p-4 border-l-4 border-school-primary bg-indigo-50/70 rounded-r-lg">
“MENJADI LEMBAGA ISLAM TERPADU YANG MENCETAK GENERASI TERBAIK, BERKEPRIBADIAN ISLAMI, BERAKHLAK MULIA, CERDAS, BERPRESTASI, DAN BERWAWASAN GLOBAL”
</blockquote>

<h3>MISI SEKOLAH</h3>
<ol class="list-decimal pl-6 space-y-2.5 text-gray-700">
    <li><strong>Unggul dalam Akhlakul Karimah:</strong> Menanamkan aqidah yang lurus, ibadah yang benar, dan akhlak mulia berlandaskan Al-Qur'an dan As-Sunnah.</li>
    <li><strong>Unggul Prestasi Akademik & Non-Akademik:</strong> Menyelenggarakan pembelajaran aktif, kreatif, dan menantang untuk meraih prestasi di tingkat kota, provinsi, dan nasional.</li>
    <li><strong>Berprestasi dalam Bahasa & MIPA:</strong> Membekali siswa dengan kecakapan berbahasa asing (Arab & Inggris) serta kemampuan sains dan nalar matematika.</li>
    <li><strong>Target Tahfidzul Qur'an:</strong> Membina kemampuan tahsin dan tahfidz Al-Qur'an dengan target minimal 2 juz mutqin serta hafalan 12 hadits pilihan.</li>
    <li><strong>Lingkungan Pendidikan Islami Profesional:</strong> Mewujudkan iklim sekolah yang kondusif, amanah, ramah anak, dan berbudaya Islami.</li>
</ol>

<h3 class="mt-8">TUJUAN PENDIDIKAN</h3>
<ul class="list-disc pl-6 space-y-2 text-gray-700">
    <li>Mencetak lulusan yang tertib dalam mendirikan sholat fardhu berjamaah dan gemar mengamalkan sunnah.</li>
    <li>Mencapai target hafalan minimal 2 juz Al-Qur'an (Juz 29 dan Juz 30) dengan tajwid tartil.</li>
    <li>Menghasilkan peserta didik yang berkarakter mandiri, santun, berpikir kritis, dan adaptif terhadap teknologi.</li>
    <li>Meraih prestasi gemilang dalam kompetisi sains, keolahragaan, seni Islam, dan baris-berbaris.</li>
    <li>Mempersiapkan siswa melanjutkan ke jenjang lanjutan/MA/Pesantren unggulan dengan bekal ilmu dan iman yang kokoh.</li>
</ul>
HTML,
            ],
            [
                'slug' => 'tentang-kami',
                'title' => 'Profil SMPS IT Ishlahul Ummah Prabumulih',
                'excerpt' => 'Profil resmi lembaga pendidikan SMPS IT Ishlahul Ummah Kota Prabumulih.',
                'featured_image' => '/uploads/campus-smpit-ishum.webp',
                'content' => <<<'HTML'
<h3>Profil Singkat Sekolah</h3>
<p><strong>SMPS IT Ishlahul Ummah Prabumulih</strong> adalah lembaga pendidikan formal tingkat menengah pertama berbasis Islam Terpadu di Kota Prabumulih, Sumatera Selatan, di bawah naungan <strong>Yayasan Ishlahul Ummah Prabumulih</strong>.</p>
<p>Berlokasi strategis di Jl. Sadewa No. 45 Kelurahan Karang Raja, sekolah ini memadukan kurikulum nasional Kementerian Pendidikan Dasar dan Menengah dengan kurikulum khas Sekolah Islam Terpadu (SIT). Dengan pendekatan holistik, siswa dibina kecerdasan spiritual (SQ), emosional (EQ), dan intelektualnya (IQ) secara seimbang.</p>

<h4 class="mt-6 font-bold text-gray-900">Identitas Sekolah</h4>
<table class="w-full text-left border-collapse my-4 text-sm">
    <tr class="border-b"><td class="py-2.5 font-semibold w-1/3 text-gray-800">Nama Resmi Sekolah</td><td class="py-2.5 text-gray-700">SMPS IT ISHLAHUL UMMAH PRABUMULIH</td></tr>
    <tr class="border-b"><td class="py-2.5 font-semibold text-gray-800">NPSN</td><td class="py-2.5 text-gray-700">69787455</td></tr>
    <tr class="border-b"><td class="py-2.5 font-semibold text-gray-800">Bentuk Pendidikan</td><td class="py-2.5 text-gray-700">SMP (Sekolah Menengah Pertama)</td></tr>
    <tr class="border-b"><td class="py-2.5 font-semibold text-gray-800">Status Sekolah</td><td class="py-2.5 text-gray-700">Swasta (Yayasan Ishlahul Ummah)</td></tr>
    <tr class="border-b"><td class="py-2.5 font-semibold text-gray-800">Akreditasi</td><td class="py-2.5 text-gray-700"><span class="inline-block px-2.5 py-0.5 rounded-full bg-indigo-100 text-school-primary font-bold text-xs">TERAKREDITASI B</span></td></tr>
    <tr class="border-b"><td class="py-2.5 font-semibold text-gray-800">Kepala Sekolah</td><td class="py-2.5 text-gray-700">Anita Carlyna, S.IP., M.Pd., Gr</td></tr>
    <tr class="border-b"><td class="py-2.5 font-semibold text-gray-800">Alamat Kampus</td><td class="py-2.5 text-gray-700">Jl. Sadewa No. 45 RT 01 RW 04, Kel. Karang Raja, Kec. Prabumulih Timur, Kota Prabumulih, Sumatera Selatan 31113</td></tr>
    <tr class="border-b"><td class="py-2.5 font-semibold text-gray-800">Telepon / WhatsApp</td><td class="py-2.5 text-gray-700">0852-6990-8696 / 0853-7897-4396</td></tr>
    <tr class="border-b"><td class="py-2.5 font-semibold text-gray-800">Email Resmi</td><td class="py-2.5 text-gray-700">smpitishlahulummah.2015@yahoo.com</td></tr>
</table>
HTML,
            ],
            [
                'slug' => 'sejarah',
                'title' => 'Sejarah SMPS IT Ishlahul Ummah Prabumulih',
                'excerpt' => 'Napak tilas perjalanan dan sejarah berdirinya SMPS IT Ishlahul Ummah di Kota Prabumulih.',
                'featured_image' => '/uploads/campus-smpit-ishum.webp',
                'content' => <<<'HTML'
<h3>Sejarah dan Latar Belakang Pendirian</h3>
<p><strong>SMPS IT Ishlahul Ummah Prabumulih</strong> didirikan di bawah naungan <strong>Yayasan Ishlahul Ummah Prabumulih</strong> sebagai wujud kepedulian terhadap pentingnya pendidikan generasi muda Islam yang seimbang antara ilmu pengetahuan umum dan pemahaman agama yang mendalam.</p>
<p>Berawal dari kesuksesan pembinaan di tingkat sekolah dasar (SDIT Ishlahul Ummah), masyarakat dan para wali murid mendambakan kelanjutan pendidikan tingkat pertama yang tetap mengusung nilai-nilai Qur'ani dan pembiasaan adab Islami. Maka berdirilah SMPS IT Ishlahul Ummah Prabumulih untuk melayani kebutuhan masyarakat Prabumulih dan sekitarnya.</p>
<p>Di bawah kepemimpinan <strong>Ibu Anita Carlyna, S.IP., M.Pd., Gr</strong> beserta jajaran dewan guru yang amanah dan kompeten, SMPS IT Ishlahul Ummah terus berinovasi dalam metode pembelajaran, sarana prasarana modern, pembinaan tahfidz 2 juz mutqin, serta prestasi siswa di berbagai ajang kejuaraan daerah dan nasional.</p>
HTML,
            ],
            [
                'slug' => 'struktur-organisasi',
                'title' => 'Struktur Organisasi SMPS IT Ishlahul Ummah Prabumulih',
                'excerpt' => 'Bagan kepemimpinan, yayasan, dan dewan guru SMPS IT Ishlahul Ummah Prabumulih.',
                'featured_image' => '/uploads/logo-ishum.png',
                'content' => <<<'HTML'
<h3>Struktur Manajemen Sekolah & Yayasan</h3>
<ul class="space-y-3 text-gray-800">
    <li><strong>Yayasan Penyelenggara:</strong> Yayasan Ishlahul Ummah Prabumulih</li>
    <li><strong>Kepala Sekolah:</strong> Anita Carlyna, S.IP., M.Pd., Gr</li>
    <li><strong>Wakil Kepala Sekolah Bidang Kurikulum:</strong> Ustadz Fulan, S.Pd.</li>
    <li><strong>Koordinator Bidang Kesiswaan &amp; Ekskul:</strong> Ustadz Fulan, S.Kom.</li>
    <li><strong>Koordinator Tahsin &amp; Tahfidz Al-Qur'an (TTQ):</strong> Ustadzah Fulanah, S.Pd.I</li>
    <li><strong>Koordinator BPI &amp; Bina Karakter:</strong> Ustadzah Fulanah, S.Si.</li>
    <li><strong>Dewan Guru &amp; Tenaga Kependidikan:</strong> Asatidz dan asatidzah profesional berdedikasi tinggi.</li>
</ul>
HTML,
            ],
            [
                'slug' => 'donasi',
                'title' => 'Infaq & Wakaf Pembangunan SMPS IT Ishlahul Ummah Prabumulih',
                'excerpt' => 'Salurkan infaq dan wakaf terbaik Anda untuk sarana pendidikan Islam dan beasiswa tahfidz di Kota Prabumulih.',
                'featured_image' => '/uploads/campus-smpit-ishum.webp',
                'content' => <<<'HTML'
<h3>Investasi Akhirat Melalui Pendidikan Islam</h3>
<p>Yayasan Ishlahul Ummah Prabumulih membuka kesempatan seluas-luasnya bagi kaum muslimin dan para dermawan untuk menyalurkan infaq dan sedekah jariyah. Dana yang terhimpun disalurkan untuk pengembangan fasilitas laboratorium, masjid kampus, ruang kelas digital, serta beasiswa pendidikan bagi siswa penghafal Al-Qur'an.</p>
HTML,
            ],
            [
                'slug' => 'e-book',
                'title' => 'E-Library & Modul Pembelajaran SMPS IT Ishum',
                'excerpt' => 'Kumpulan buku pelajaran, panduan kurikulum, dan modul e-library siswa SMPS IT Ishlahul Ummah.',
                'featured_image' => '/uploads/activities-smpit-ishum.webp',
                'content' => <<<'HTML'
<h3>Pusat E-Library & Buku Digital</h3>
<p>Daftar koleksi buku pelajaran Kurikulum Merdeka, modul tahfidz 2 juz, dan bacaan islami yang dapat diakses dan diunduh oleh civitas akademika SMPS IT Ishlahul Ummah Prabumulih.</p>
HTML,
            ],
            [
                'slug' => 'hymne-mars',
                'title' => 'Mars & Hymne Jaringan Sekolah Islam Terpadu',
                'excerpt' => 'Lagu mars dan hymne Sekolah Islam Terpadu kebanggaan SMPS IT Ishlahul Ummah Prabumulih.',
                'featured_image' => '/uploads/logo-ishum.png',
                'content' => <<<'HTML'
<h3>Mars JSIT Indonesia</h3>
<p class="italic text-gray-600">Membina tunas bangsa, beriman dan bertaqwa, cerdas berakhlak mulia...</p>
HTML,
            ],
            [
                'slug' => 'logo',
                'title' => 'Logo Resmi SMPS IT Ishlahul Ummah Prabumulih',
                'excerpt' => 'Makna filosofis lambang dan logo resmi SMPS IT Ishlahul Ummah Prabumulih.',
                'featured_image' => '/uploads/logo-ishum.png',
                'content' => <<<'HTML'
<h3>Filosofi Logo SMPS IT Ishlahul Ummah Prabumulih</h3>
<p>Logo SMPS IT Ishlahul Ummah Prabumulih memadukan lambang perisai keimanan, kubah masjid, Al-Qur'an terbuka, dan obor semangat menuju terwujudnya generasi Qur'ani yang cerdas dan berakhlakul karimah.</p>
HTML,
            ],
            [
                'slug' => 'hubungi',
                'title' => 'Kontak & Sekretariat SPMB SMPS IT Ishum',
                'excerpt' => 'Alamat dan kontak resmi sekretariat SMPS IT Ishlahul Ummah Prabumulih.',
                'featured_image' => '/uploads/campus-smpit-ishum.webp',
                'content' => <<<'HTML'
<h3>Sekretariat Sekolah & Panitia SPMB</h3>
<p>Silakan kunjungi kampus kami atau hubungi panitia SPMB untuk informasi pendaftaran peserta didik baru gelombang exclusive, jadwal seleksi, dan cashback 1 juta.</p>
<p><strong>Alamat Kampus:</strong> Jalan Sadewa No. 45 RT 01 RW 04 Kel. Karang Raja, Kec. Prabumulih Timur, Kota Prabumulih, Sumatera Selatan 31113.<br>
<strong>WhatsApp / Telp:</strong> 0852-6990-8696 / 0853-7897-4396<br>
<strong>Email:</strong> smpitishlahulummah.2015@yahoo.com</p>
HTML,
            ],
        ];

        foreach ($officialPages as $p) {
            Post::updateOrCreate(
                ['slug' => $p['slug']],
                array_merge($p, [
                    'type' => 'page',
                    'status' => 'publish',
                    'meta_title' => $p['title'],
                    'meta_description' => $p['excerpt'],
                ])
            );
        }

        // Galeri Foto Dokumentasi Sekolah SMPS IT Ishlahul Ummah Prabumulih
        Post::where('type', 'gallery')->delete();

        $galleryItems = [
            ['url' => '/uploads/galeri/galeri-kampus-terpadu.webp', 'title' => 'Gedung Kampus Terpadu SMPS IT Ishlahul Ummah'],
            ['url' => '/uploads/galeri/galeri-perpustakaan.webp', 'title' => 'Perpustakaan & Ruang Literasi Siswa Ishum'],
            ['url' => '/uploads/galeri/galeri-lab-sains.webp', 'title' => 'Laboratorium IPA & Eksperimen Sains Siswa'],
            ['url' => '/uploads/galeri/galeri-suasana-kelas.webp', 'title' => 'Suasana Belajar Interaktif & Nyaman di Kelas'],
            ['url' => '/uploads/galeri/galeri-wisuda-tahfidz.webp', 'title' => 'Wisuda Tahfidz & Munaqosah Al-Qur\'an Mutqin'],
            ['url' => '/uploads/galeri/galeri-panahan-pramuka.webp', 'title' => 'Ekstrakurikuler Panahan & Kepramukaan SIT'],
            ['url' => '/uploads/galeri/galeri-upacara-siswa.webp', 'title' => 'Upacara Bendera & Pembinaan Karakter Siswa'],
            ['url' => '/uploads/galeri/galeri-class-meeting.webp', 'title' => 'Semarak Class Meeting & Sportivitas Siswa'],
        ];

        foreach ($galleryItems as $idx => $g) {
            Post::create([
                'title' => $g['title'],
                'slug' => Str::slug($g['title']).'-'.($idx + 1),
                'type' => 'gallery',
                'status' => 'publish',
                'featured_image' => $g['url'],
                'content' => $g['title'],
                'author_id' => 1,
                'published_at' => now()->subMinutes(14 - $idx),
            ]);
        }
    }
}
