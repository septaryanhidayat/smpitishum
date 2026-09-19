<?php

use App\Models\ActivityLog;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('unauthenticated users cannot access admin hero slider page', function () {
    $this->get('/admin/hero')->assertRedirect('/login');
});

test('admin can view hero slider settings page', function () {
    $admin = User::firstOrCreate(
        ['email' => 'admin_hero_test@smpitishumpbm.sch.id'],
        [
            'name' => 'Admin Hero Test',
            'password' => Hash::make('password123'),
        ]
    );

    $response = $this->actingAs($admin)->get('/admin/hero');
    $response->assertStatus(200);
    $response->assertSee('Pengaturan Banner Hero Slider Beranda');
    $response->assertSee('Slide #1');
    $response->assertSee('Gambar Latar Belakang');
    $response->assertSee('Tombol Utama');
    $response->assertSee('Tombol Kedua');
});

test('admin can update hero slider text, image, and buttons successfully', function () {
    $admin = User::firstOrCreate(
        ['email' => 'admin_hero_test@smpitishumpbm.sch.id'],
        [
            'name' => 'Admin Hero Test',
            'password' => Hash::make('password123'),
        ]
    );

    $slideData = [
        'slides' => [
            [
                'active' => '1',
                'badge' => 'SMP IT Unggulan Terdepan',
                'title' => 'Judul Kustom Banner Hero Slide 1',
                'subtitle' => 'Deskripsi Kustom Banner Hero Slide 1 yang baru diperbarui.',
                'existing_image' => '/uploads/campus-smpit-ishum.webp',
                'btn_text' => 'Klik Sambutan Baru',
                'btn_link' => '/sambutan-baru',
                'btn_target' => '_self',
                'btn2_active' => '1',
                'btn2_text' => 'Daftar SPMB Sekarang',
                'btn2_link' => '/ppdb-khusus',
                'btn2_target' => '_blank',
            ],
            [
                'active' => '1',
                'badge' => 'Tahfidz & Sains',
                'title' => 'Judul Kustom Banner Hero Slide 2',
                'subtitle' => 'Deskripsi Kustom Banner Hero Slide 2.',
                'existing_image' => '/uploads/activities-smpit-ishum.webp',
                'btn_text' => 'Lihat Profil',
                'btn_link' => '/profil-sekolah',
                'btn_target' => '_self',
                'btn2_active' => '0',
                'btn2_text' => 'Info SPMB',
                'btn2_link' => '/ppdb',
                'btn2_target' => '_self',
            ],
        ],
    ];

    $response = $this->actingAs($admin)->post('/admin/hero', $slideData);
    $response->assertRedirect('/admin/hero');
    $response->assertSessionHas('success');

    // Verify stored JSON in Setting
    $stored = json_decode(Setting::get('hero_slides'), true);
    expect($stored)->toBeArray();
    expect($stored[0]['title'])->toBe('Judul Kustom Banner Hero Slide 1');
    expect($stored[0]['badge'])->toBe('SMP IT Unggulan Terdepan');
    expect($stored[0]['btn_text'])->toBe('Klik Sambutan Baru');
    expect($stored[0]['btn_link'])->toBe('/sambutan-baru');
    expect($stored[0]['btn2_text'])->toBe('Daftar SPMB Sekarang');
    expect($stored[0]['btn2_link'])->toBe('/ppdb-khusus');

    // Verify ActivityLog
    $log = ActivityLog::where('action', 'hero_settings_update')->latest()->first();
    expect($log)->not->toBeNull();

    // Verify homepage renders updated content
    $homeResponse = $this->get('/');
    $homeResponse->assertStatus(200);
    $homeResponse->assertSee('Judul Kustom Banner Hero Slide 1');
    $homeResponse->assertSee('SMP IT Unggulan Terdepan');
    $homeResponse->assertSee('Klik Sambutan Baru');
    $homeResponse->assertSee('Daftar SPMB Sekarang');
});
