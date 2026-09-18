<?php

use App\Models\Category;
use App\Models\Download;
use App\Models\Dpc;
use App\Models\Post;
use Database\Seeders\DatabaseSeeder;

test('halaman program unggulan / dpc menampilkan program sekolah', function () {
    Dpc::create([
        'name' => 'Program Tahfidz Mutqin 30 Juz',
        'slug' => 'program-tahfidz-mutqin-30-juz',
        'head_name' => 'Ustadz Salman',
        'address' => 'Kurikulum Khusus Diniyah',
        'description' => 'Bimbingan intensif menghafal Al-Qur\'an.',
    ]);

    $response = $this->get(route('dpc.index'));

    $response->assertStatus(200);
    $response->assertSee('Program Tahfidz Mutqin 30 Juz');
    $response->assertDontSee('Ketua:');
});

test('halaman home menampilkan kabar sekolah dan showcase e-library', function () {
    $category = Category::firstOrCreate(['name' => 'Kabar Kampus'], ['slug' => 'kabar-kampus']);
    for ($i = 1; $i <= 6; $i++) {
        $post = Post::create([
            'title' => "Kabar Prestasi Sekolah $i",
            'slug' => "kabar-prestasi-sekolah-$i",
            'type' => 'post',
            'status' => 'publish',
            'content' => "Konten Berita Uji Coba $i",
            'excerpt' => "Cuplikan Berita Uji Coba $i",
            'published_at' => now(),
        ]);
        $post->categories()->attach($category->id);
    }

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('E-Library & Modul Siswa');
    $response->assertSee(route('download.ebook'));
    $response->assertSee('gtranslate_wrapper');
    $response->assertSee('back-to-top');
});

test('counter pengunjung bertambah pada setiap request get web', function () {
    $counterFile = storage_path('app/visitor_hits.txt');
    @unlink($counterFile);

    // Request 1: hits awal (0) di-increment jadi 1
    $this->get(route('home'));
    $hits1 = (int) file_get_contents($counterFile);
    expect($hits1)->toBe(1);

    // Request 2: hits di-increment lagi jadi 2
    $this->get(route('page.tentang-kami'));
    $hits2 = (int) file_get_contents($counterFile);
    expect($hits2)->toBe(2);

    // Request 3: hits di-increment lagi jadi 3
    $this->get(route('dpc.index'));
    $hits3 = (int) file_get_contents($counterFile);
    expect($hits3)->toBe(3);
});

test('halaman download ebook memuat tombol unduh modul', function () {
    Download::create([
        'title' => 'Panduan Mutqin Tahfidz & Ziyadah Qur\'an',
        'category_type' => 'E-Book',
        'file_path' => '/uploads/downloads/panduan-mutqin-tahfidz-ishum.pdf',
        'file_type' => 'PDF',
        'file_size' => '2.4 MB',
        'download_count' => 120,
        'cover_image' => '/uploads/covers/cover-tahfidz-mutqin.webp',
        'description' => 'Buku panduan kurikulum tahfidz mutqin.',
    ]);

    $response = $this->get(route('download.ebook'));

    $response->assertStatus(200);
    $response->assertSee('Panduan Mutqin Tahfidz');
    $response->assertSee('Download Modul (PDF)');
});

test('footer memuat live counter pengunjung dan copyright sekolah', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('SMPS IT Ishlahul Ummah Prabumulih');
    $response->assertSee('Pengunjung');
    $response->assertSee('Galeri');
    $response->assertSee('Kabar Sekolah');
});

test('dewan guru menampilkan ustadz fulan dan ustadzah fulanah dengan avatar abu-abu', function () {
    $this->seed(DatabaseSeeder::class);
    $response = $this->get(route('dewan.index'));

    $response->assertStatus(200);
    $response->assertSee('Anita Carlyna');
    $response->assertSee('Ustadz Fulan');
    $response->assertSee('Ustadzah Fulanah');
    $response->assertSee('avatar-ustadz.svg');
    $response->assertSee('avatar-ustadzah.svg');
});

test('galeri video dan beranda menampilkan video resmi youtube smp it ishum', function () {
    $this->seed(DatabaseSeeder::class);
    $responseVideo = $this->get(route('video.index'));
    $responseVideo->assertStatus(200);
    $responseVideo->assertSee('_ltiwpOmK1k');
    $responseVideo->assertSee('Mengenal Lebih Dekat Profil dan Visi SMP IT Ishlahul Ummah Prabumulih');
    $responseVideo->assertSee('https://www.youtube.com/@smpitishlahulummahprabumul6398');

    $responseHome = $this->get(route('home'));
    $responseHome->assertStatus(200);
    $responseHome->assertSee('Galeri Video Resmi YouTube');
    $responseHome->assertSee('_ltiwpOmK1k');
});
