<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Setting;
use App\Services\WebpService;
use Illuminate\Http\Request;

class AdminHeroController extends Controller
{
    public function __construct(protected WebpService $webpService) {}

    /**
     * Default slides fallback
     */
    protected function getDefaultSlides(): array
    {
        return [
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
    }

    /**
     * Display the Hero Slider configuration page.
     */
    public function index()
    {
        $raw = Setting::get('hero_slides');
        $slides = [];

        if ($raw) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded) && ! empty($decoded)) {
                $slides = $decoded;
            }
        }

        if (empty($slides)) {
            $slides = $this->getDefaultSlides();
        }

        return view('admin.hero.index', compact('slides'));
    }

    /**
     * Update the Hero Slider configuration.
     */
    public function update(Request $request)
    {
        $request->validate([
            'slides' => 'required|array|min:1|max:6',
            'slides.*.title' => 'required|string|max:255',
            'slides.*.subtitle' => 'nullable|string|max:500',
            'slides.*.badge' => 'nullable|string|max:100',
            'slides.*.btn_text' => 'nullable|string|max:100',
            'slides.*.btn_link' => 'nullable|string|max:255',
            'slides.*.btn_target' => 'nullable|string|in:_self,_blank',
            'slides.*.btn2_text' => 'nullable|string|max:100',
            'slides.*.btn2_link' => 'nullable|string|max:255',
            'slides.*.btn2_target' => 'nullable|string|in:_self,_blank',
            'slides.*.image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $inputSlides = $request->input('slides', []);
        $cleanSlides = [];

        foreach ($inputSlides as $index => $slideData) {
            $currentImage = $slideData['existing_image'] ?? '/uploads/campus-smpit-ishum.webp';

            // Check if user uploaded a new image file for this slide
            if ($request->hasFile("slides.{$index}.image_file")) {
                $converted = $this->webpService->processUploadedFile(
                    $request->file("slides.{$index}.image_file"),
                    'hero',
                    85,
                    1920
                );
                if ($converted['success']) {
                    $currentImage = $converted['url'];
                }
            } elseif (! empty($slideData['image_url'])) {
                $currentImage = trim($slideData['image_url']);
            }

            $cleanSlides[] = [
                'active' => isset($slideData['active']) && ($slideData['active'] === '1' || $slideData['active'] === 1 || $slideData['active'] === true),
                'badge' => trim($slideData['badge'] ?? 'SMPS IT Unggulan Kota Prabumulih • Terakreditasi B'),
                'title' => trim($slideData['title'] ?? ''),
                'subtitle' => trim($slideData['subtitle'] ?? ''),
                'image' => $currentImage,
                'btn_text' => trim($slideData['btn_text'] ?? ''),
                'btn_link' => trim($slideData['btn_link'] ?? '#'),
                'btn_target' => $slideData['btn_target'] ?? '_self',
                'btn2_active' => isset($slideData['btn2_active']) && ($slideData['btn2_active'] === '1' || $slideData['btn2_active'] === 1 || $slideData['btn2_active'] === true),
                'btn2_text' => trim($slideData['btn2_text'] ?? ''),
                'btn2_link' => trim($slideData['btn2_link'] ?? '/ppdb'),
                'btn2_target' => $slideData['btn2_target'] ?? '_self',
            ];
        }

        Setting::set(
            'hero_slides',
            json_encode($cleanSlides, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'hero'
        );

        ActivityLog::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name ?? 'Admin',
            'action' => 'hero_settings_update',
            'description' => 'Memperbarui pengaturan Banner Hero Slider Beranda ('.count($cleanSlides).' slide dikonfigurasi)',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.hero.index')->with('success', 'Banner Hero Slider berhasil diperbarui dan disimpan!');
    }
}
