<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DownloadSeeder extends Seeder
{
    public function run(): void
    {
        $downloads = [
            [
                'title' => 'Logo Resmi SMPS IT Ishlahul Ummah (Vector PNG Transparan)',
                'file_path' => '/uploads/logo-ishum.png',
                'file_type' => 'PNG',
                'category_type' => 'Aset Visual',
                'download_count' => 520,
            ],
            [
                'title' => 'Mars JSIT Indonesia - SMPS IT Ishlahul Ummah Prabumulih',
                'file_path' => '/uploads/mars-jsit.mp3',
                'file_type' => 'MP3',
                'category_type' => 'Audio',
                'download_count' => 480,
            ],
            [
                'title' => 'Hymne JSIT - Membina Generasi Qur\'ani',
                'file_path' => '/uploads/hymne-jsit.mp3',
                'file_type' => 'MP3',
                'category_type' => 'Audio',
                'download_count' => 395,
            ],
            [
                'title' => 'Brosur & Panduan Pendaftaran SPMB TP 2026/2027',
                'file_path' => '/uploads/downloads/panduan-ppdb-ishum.pdf',
                'file_type' => 'PDF',
                'category_type' => 'E-Book',
                'download_count' => 840,
            ],
            [
                'title' => 'Buku Panduan Kurikulum Tahfidz Mutqin 2 Juz & Hadits',
                'file_path' => '/uploads/downloads/panduan-mutqin-tahfidz-ishum.pdf',
                'file_type' => 'PDF',
                'category_type' => 'E-Book',
                'download_count' => 650,
            ],
            [
                'title' => 'Modul Praktikum Laboratorium Sains IPA Terpadu Santri',
                'file_path' => '/uploads/downloads/petunjuk-praktikum-sains-terpadu.pdf',
                'file_type' => 'PDF',
                'category_type' => 'E-Book',
                'download_count' => 512,
            ],
            [
                'title' => 'Pedoman Karakter, Adab & Tata Tertib Santri Ishum',
                'file_path' => '/uploads/downloads/buku-saku-adab-karakter-santri.pdf',
                'file_type' => 'PDF',
                'category_type' => 'E-Book',
                'download_count' => 430,
            ],
            [
                'title' => 'Silabus Program Riset & Olimpiade Sains (OSN) Santri Ishum',
                'file_path' => '/uploads/downloads/kurikulum-pembinaan-dai-muda.pdf',
                'file_type' => 'PDF',
                'category_type' => 'E-Book',
                'download_count' => 380,
            ],
            [
                'title' => 'Panduan Ekstrakurikuler Panahan, Pramuka & Literasi Digital',
                'file_path' => '/uploads/downloads/buku-saku-kosakata-bilingual.pdf',
                'file_type' => 'PDF',
                'category_type' => 'E-Book',
                'download_count' => 290,
            ],
        ];

        DB::table('downloads')->truncate();

        foreach ($downloads as $dl) {
            DB::table('downloads')->insert([
                'title' => $dl['title'],
                'file_path' => $dl['file_path'],
                'file_type' => $dl['file_type'],
                'category_type' => $dl['category_type'],
                'download_count' => $dl['download_count'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
