<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $defaultSlides = [
            [
                'active' => true,
                'badge' => 'SMPS IT Unggulan Kota Prabumulih • Terakreditasi B',
                'title' => 'Selamat Datang di Website Resmi',
                'subtitle' => 'SMPS IT Ishlahul Ummah Prabumulih',
                'image' => '/uploads/campus-smpit-ishum.webp',
                'btn_text' => 'Sambutan Kepala Sekolah',
                'btn_link' => '/sambutan-kepala-sekolah',
                'btn_target' => '_self',
                'btn2_active' => true,
                'btn2_text' => 'Info SPMB',
                'btn2_link' => '/ppdb',
                'btn2_target' => '_self',
            ],
            [
                'active' => true,
                'badge' => 'SMPS IT Unggulan Kota Prabumulih • Terakreditasi B',
                'title' => 'Membina Generasi Qur\'ani, Cerdas & Berakhlak Mulia',
                'subtitle' => 'Sekolah Menengah Pertama Islam Terpadu berakreditasi di Kota Prabumulih dengan Kurikulum Terpadu & Tahfidz Al-Qur\'an.',
                'image' => '/uploads/activities-smpit-ishum.webp',
                'btn_text' => 'Profil Singkat Sekolah',
                'btn_link' => '/tentang-kami',
                'btn_target' => '_self',
                'btn2_active' => true,
                'btn2_text' => 'Info SPMB',
                'btn2_link' => '/ppdb',
                'btn2_target' => '_self',
            ],
            [
                'active' => true,
                'badge' => 'SMPS IT Unggulan Kota Prabumulih • Terakreditasi B',
                'title' => 'SPMB Gelombang Exclusive TP Baru',
                'subtitle' => 'Kuota Terbatas Hanya 24 Orang & Promo Cash Back 1 Juta Alumni SDIT Ishum.',
                'image' => '/uploads/tahfidz-smpit-ishum.webp',
                'btn_text' => 'Daftar SPMB Online',
                'btn_link' => '/ppdb',
                'btn_target' => '_self',
                'btn2_active' => true,
                'btn2_text' => 'Info SPMB',
                'btn2_link' => '/ppdb',
                'btn2_target' => '_self',
            ],
        ];

        DB::table('settings')->updateOrInsert(
            ['key' => 'hero_slides'],
            [
                'value' => json_encode($defaultSlides, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'group' => 'hero',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->where('key', 'hero_slides')->delete();
    }
};
