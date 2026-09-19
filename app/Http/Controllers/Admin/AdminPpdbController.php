<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\PpdbRegistration;
use App\Models\PpdbTrack;
use App\Models\Setting;
use App\Services\PpdbFormService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AdminPpdbController extends Controller
{
    public function index(Request $request)
    {
        $query = PpdbRegistration::latest();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%")
                    ->orWhere('previous_school', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $registrations = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => PpdbRegistration::count(),
            'pending' => PpdbRegistration::where('status', 'pending')->count(),
            'verified' => PpdbRegistration::where('status', 'verified')->count(),
            'accepted' => PpdbRegistration::where('status', 'accepted')->count(),
            'rejected' => PpdbRegistration::where('status', 'rejected')->count(),
        ];

        return view('admin.ppdb.index', compact('registrations', 'stats'));
    }

    public function show(PpdbRegistration $ppdb)
    {
        return view('admin.ppdb.show', compact('ppdb'));
    }

    public function updateStatus(Request $request, PpdbRegistration $ppdb)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,verified,accepted,rejected',
            'notes' => 'nullable|string|max:1000',
        ]);

        $ppdb->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'ppdb_status_update',
            'description' => "Memperbarui status pendaftaran {$ppdb->full_name} ({$ppdb->registration_number}) menjadi {$ppdb->status_label}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return back()->with('success', "Status pendaftaran {$ppdb->full_name} berhasil diperbarui.");
    }

    public function destroy(PpdbRegistration $ppdb)
    {
        $name = $ppdb->full_name;

        // Delete uploaded files if any
        if ($ppdb->birth_certificate_path && file_exists(public_path($ppdb->birth_certificate_path))) {
            @unlink(public_path($ppdb->birth_certificate_path));
        }
        if ($ppdb->payment_proof_path && file_exists(public_path($ppdb->payment_proof_path))) {
            @unlink(public_path($ppdb->payment_proof_path));
        }

        $ppdb->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'ppdb_delete',
            'description' => "Menghapus berkas pendaftaran calon siswa: {$name}",
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'status' => 'warning',
        ]);

        return redirect()->route('admin.ppdb.index')->with('success', "Data pendaftaran {$name} berhasil dihapus.");
    }

    public function print(PpdbRegistration $ppdb)
    {
        return view('admin.ppdb.print', compact('ppdb'));
    }

    /**
     * Display the PPDB Page Content & Dynamic Form Settings view.
     */
    public function content()
    {
        $settings = [
            'status' => Setting::get('ppdb_status', '1'),
            'year' => Setting::get('ppdb_year', '2027/2028'),
            'wave' => Setting::get('ppdb_wave', 'Gelombang 1 (Aktif)'),
            'promo' => Setting::get('ppdb_promo', 'Potongan Biaya Masuk Up to 50% OFF (*S&K berlaku)'),
            'tagline' => Setting::get('ppdb_tagline', "Mendidik Sepenuh Cinta. Mewujudkan generasi Qur'ani berkarakter tangguh, cerdas sains, mandiri, dan berwawasan global di bawah naungan JSIT Indonesia."),
            'youtube_id' => Setting::get('ppdb_youtube_id', 'IrPVG8CYjRc'),
            'video_title' => Setting::get('ppdb_video_title', 'Video Profil & Dokumentasi SMPS IT Ishum'),
            'video_desc' => Setting::get('ppdb_video_desc', 'Saksikan video profil dan aktivitas pembelajaran siswa kami secara visual.'),
            'operational_weekday' => Setting::get('ppdb_operational_weekday', "Senin – Jum'at: Pukul 08.00 – 15.00 WIB"),
            'operational_weekend' => Setting::get('ppdb_operational_weekend', 'Sabtu: Pukul 08.00 – 12.00 WIB'),
            'secretariat' => Setting::get('ppdb_secretariat', 'Kompleks SMPS IT Ishum, Jl. Sadewa RT 01 RW 04 Karang Raja'),
            'registration_fee' => Setting::get('ppdb_registration_fee', 'Rp 250.000,-'),
            'bank_name' => Setting::get('ppdb_bank_name', 'Bank Syariah Indonesia (BSI)'),
            'bank_code' => Setting::get('ppdb_bank_code', '451'),
            'bank_account' => Setting::get('ppdb_bank_account', '7011304251'),
            'bank_holder' => Setting::get('ppdb_bank_holder', 'YL. Fatmawati'),
            'hotline_phone' => Setting::get('ppdb_hotline_phone', '0852-6990-8696'),
            'hotline_name' => Setting::get('ppdb_hotline_name', 'Admin Hotline PPDB'),
            'hotline_2_phone' => Setting::get('ppdb_hotline_2_phone', '0853-7897-4396'),
            'hotline_2_name' => Setting::get('ppdb_hotline_2_name', 'Kepala Sekolah'),
            'alur' => Setting::get('ppdb_alur', "Siapkan berkas foto/scan bukti transfer biaya pendaftaran melalui Bank Syariah Indonesia (BSI) nomor rekening 7011304251 a.n. YL. Fatmawati.\nSiapkan berkas foto/scan akta kelahiran dan kartu keluarga.\nMengisi formulir PPDB secara online pada website resmi.\nKonfirmasi pengisian formulir kepada panitia melalui WhatsApp (0852-6990-8696).\nPendaftaran selesai dan berkas diverifikasi tim panitia untuk tahapan tes wawancara dan tahfidz."),
            'syarat' => Setting::get('ppdb_syarat', "Mengisi Formulir Pendaftaran online dengan data yang benar dan lengkap.\nMelampirkan bukti transfer biaya pendaftaran.\nMelampirkan scan/fotokopi Akta Kelahiran dan Kartu Keluarga (KK).\nMelampirkan fotokopi rapor SMP/MTs semester 1-5.\nPas foto terbaru calon siswa ukuran 3x4 berwarna."),
            'jadwal_gelombang' => Setting::get('ppdb_jadwal_gelombang', "Gelombang 1: Oktober s/d Desember (Diskon Biaya Masuk s/d 50%)\nGelombang 2: Januari s/d April\nGelombang 3: Mei s/d Juli (Khusus sisa kuota)\n* Pendaftaran akan ditutup otomatis apabila kuota per kelas telah terpenuhi."),
            'biaya' => Setting::get('ppdb_biaya', "Biaya Formulir Pendaftaran: Ditransfer ke rekening BSI sekolah 7011304251.\nPaket Seragam Sekolah (4 stel seragam lengkap + atribut dan jilbab/peci).\nBiaya Orientasi Siswa (MPLS) & Baitul Maqdis Leadership Camp.\nUntuk rincian lengkap uang pangkal dan SPP bulanan, hubungi langsung panitia PPDB."),
            'boarding' => Setting::get('ppdb_boarding', "Program Boarding (Asrama): Fasilitas asrama bersih, ber-AC/ventilasi sehat, makan 3x sehari, pendampingan tahfidz 24 jam bersama musyrif.\nProgram Full Day School: Pembelajaran terpadu hingga sore hari, shalat berjamaah, makan siang sehat, dan ekstrakurikuler."),
            'kelulusan' => Setting::get('ppdb_kelulusan', 'Hasil seleksi diumumkan melalui website resmi dan notifikasi WhatsApp kepada orang tua calon siswa. Calon Siswa yang dinyatakan lulus wajib melakukan daftar ulang sesuai jadwal yang ditentukan panitia.'),
            'closing_title' => Setting::get('ppdb_closing_title', 'Terima Kasih Sudah Mendaftar di SMPS IT Ishlahul Ummah Prabumulih'),
            'closing_desc' => Setting::get('ppdb_closing_desc', 'Semoga Ananda kelak bisa menjadi anak yang cerdas, sholeh/ah, berbakti kepada orang tua dan menjadi kebanggaan bagi agama, bangsa dan negara. Aamiin'),

            // FOTO DOKUMENTASI FASILITAS PPDB
            'image_1' => (! empty(Setting::get('ppdb_image_1')) && file_exists(public_path(ltrim(Setting::get('ppdb_image_1'), '/')))) ? Setting::get('ppdb_image_1') : '/uploads/fasilitas/fasilitas-gedung-utama.webp',
            'image_2' => (! empty(Setting::get('ppdb_image_2')) && file_exists(public_path(ltrim(Setting::get('ppdb_image_2'), '/')))) ? Setting::get('ppdb_image_2') : '/uploads/fasilitas/fasilitas-ruang-kelas.webp',
            'image_3' => (! empty(Setting::get('ppdb_image_3')) && file_exists(public_path(ltrim(Setting::get('ppdb_image_3'), '/')))) ? Setting::get('ppdb_image_3') : '/uploads/fasilitas/fasilitas-lab-ipa.webp',

            // BANNER SPMB BERANDA & HIGHLIGHT
            'banner_badge' => Setting::get('spmb_banner_badge', 'PENERIMAAN SISWA BARU GELOMBANG EXCLUSIVE'),
            'banner_title' => Setting::get('spmb_banner_title', 'SPMB Gelombang Exclusive & Class Meeting Semester Genap'),
            'banner_year' => Setting::get('spmb_banner_year', Setting::get('ppdb_year', '2027-2028')),
            'banner_desc' => Setting::get('spmb_banner_description', 'Bergabunglah bersama keluarga besar SMPS IT Ishlahul Ummah Prabumulih. Memadukan kurikulum terpadu nasional dengan pembiasaan adab Qur\'ani, target hafalan 2 juz mutqin, serta penguasaan bahasa asing & teknologi.'),
            'banner_card1_title' => Setting::get('spmb_banner_card1_title', 'KUOTA TERBATAS'),
            'banner_card1_desc' => Setting::get('spmb_banner_card1_desc', 'Hanya 24 Siswa'),
            'banner_card1_color' => Setting::get('spmb_banner_card1_color', '#f59e0b'),
            'banner_card2_title' => Setting::get('spmb_banner_card2_title', 'CASH BACK 1 JUTA'),
            'banner_card2_desc' => Setting::get('spmb_banner_card2_desc', 'Alumni SDIT Ishum 1 & 2'),
            'banner_card2_color' => Setting::get('spmb_banner_card2_color', '#f59e0b'),
            'banner_card3_title' => Setting::get('spmb_banner_card3_title', 'CLASS MEETING'),
            'banner_card3_desc' => Setting::get('spmb_banner_card3_desc', 'Mulai Rabu, 17 Juni'),
            'banner_card3_color' => Setting::get('spmb_banner_card3_color', '#f59e0b'),
            'banner_flyer_image' => Setting::get('spmb_banner_flyer_image', '/uploads/flyer-spmb-smpit-ishum.webp'),

            'banner_flyer_label' => Setting::get('spmb_banner_flyer_label', 'Pengumuman Resmi Sekolah'),
            'banner_btn_text' => Setting::get('spmb_banner_btn_text', 'Daftar SPMB Online'),
            'banner_btn_url' => Setting::get('spmb_banner_btn_url', '/ppdb'),
            'banner_contact_text' => Setting::get('spmb_banner_contact_text', 'Narahubung: 0852-6990-8696'),
            'banner_contact_phone' => Setting::get('spmb_banner_contact_phone', '0852-6990-8696'),

            // PENGATURAN & FLEKSIBILITAS FORMULIR ONLINE
            'form_status' => Setting::get('ppdb_form_status', '1'),
            'form_closed_message' => Setting::get('ppdb_form_closed_message', 'Pendaftaran PPDB online saat ini sedang ditutup sementara atau kuota telah terpenuhi. Silakan hubungi panitia melalui WhatsApp untuk informasi gelombang berikutnya.'),
            'form_announcement' => Setting::get('ppdb_form_announcement', 'Pastikan nomor WhatsApp yang diisi aktif untuk pengiriman kartu peserta ujian dan informasi jadwal seleksi.'),
            'form_wa_confirm' => Setting::get('ppdb_form_wa_confirm', '1'),
            'form_waves' => Setting::get('ppdb_form_waves', "Gelombang 1 (Early Bird)\nGelombang 2 (Reguler)\nGelombang 3 (Prestasi)"),
            'form_tracks' => Setting::get('ppdb_form_tracks', "Jalur First Brive (10%)\nJalur Mutasi Kerja (5%)\nJalur Tahfidz (5%)\nJalur Alumni (25%)\nJalur Prestasi (30%)\nJalur Reguler (25%)"),
            'form_programs' => Setting::get('ppdb_form_programs', "Boarding School (Asrama Siswa)\nFull Day School (Sekolah Terpadu)"),
            'form_require_payment' => Setting::get('ppdb_form_require_payment', '1'),
            'form_require_birth_cert' => Setting::get('ppdb_form_require_birth_cert', '1'),
            'form_nisn_rule' => Setting::get('ppdb_form_nisn_rule', 'optional'),
            'form_show_achievements' => Setting::get('ppdb_form_show_achievements', '1'),
            'form_show_hobbies' => Setting::get('ppdb_form_show_hobbies', '1'),
            'form_require_parent_income' => Setting::get('ppdb_form_require_parent_income', '1'),
        ];

        $schema = PpdbFormService::getSchema();
        $sections = PpdbFormService::getSections();
        $tracks = collect();
        try {
            if (Schema::hasTable('ppdb_tracks')) {
                $tracks = PpdbTrack::ordered()->get();
            }
        } catch (\Throwable $e) {
            $tracks = collect();
        }

        return view('admin.ppdb.content', compact('settings', 'schema', 'sections', 'tracks'));
    }

    /**
     * Update PPDB Page Content, SPMB Banner & Form Settings.
     */
    public function updateContent(Request $request)
    {
        $validated = $request->validate([
            'ppdb_status' => 'nullable|string',
            'ppdb_year' => 'required|string|max:100',
            'ppdb_wave' => 'nullable|string|max:100',
            'ppdb_promo' => 'nullable|string|max:255',
            'ppdb_tagline' => 'nullable|string|max:1000',
            'ppdb_youtube_id' => 'required|string|max:255',
            'ppdb_video_title' => 'nullable|string|max:255',
            'ppdb_video_desc' => 'nullable|string|max:500',
            'ppdb_operational_weekday' => 'required|string|max:255',
            'ppdb_operational_weekend' => 'required|string|max:255',
            'ppdb_secretariat' => 'required|string|max:500',
            'ppdb_registration_fee' => 'nullable|string|max:100',
            'ppdb_bank_name' => 'required|string|max:100',
            'ppdb_bank_code' => 'required|string|max:20',
            'ppdb_bank_account' => 'required|string|max:50',
            'ppdb_bank_holder' => 'required|string|max:100',
            'ppdb_hotline_phone' => 'required|string|max:50',
            'ppdb_hotline_name' => 'nullable|string|max:100',
            'ppdb_hotline_2_phone' => 'nullable|string|max:50',
            'ppdb_hotline_2_name' => 'nullable|string|max:100',
            'ppdb_alur' => 'nullable|string',
            'ppdb_syarat' => 'nullable|string',
            'ppdb_prestasi' => 'nullable|string',
            'ppdb_tahfidz' => 'nullable|string',
            'ppdb_alumni' => 'nullable|string',
            'ppdb_mandiri' => 'nullable|string',
            'ppdb_jadwal_gelombang' => 'nullable|string',
            'ppdb_biaya' => 'nullable|string',
            'ppdb_boarding' => 'nullable|string',
            'ppdb_kelulusan' => 'nullable|string',
            'ppdb_closing_title' => 'nullable|string|max:255',
            'ppdb_closing_desc' => 'nullable|string|max:1000',
            'ppdb_image_1' => 'nullable|string|max:255',
            'ppdb_image_2' => 'nullable|string|max:255',
            'ppdb_image_3' => 'nullable|string|max:255',

            // SPMB Banner Fields
            'spmb_banner_badge' => 'nullable|string|max:255',
            'spmb_banner_title' => 'nullable|string|max:255',
            'spmb_banner_year' => 'nullable|string|max:100',
            'spmb_banner_description' => 'nullable|string|max:1000',
            'spmb_banner_card1_title' => 'nullable|string|max:100',
            'spmb_banner_card1_desc' => 'nullable|string|max:100',
            'spmb_banner_card1_color' => 'nullable|string|max:30',
            'spmb_banner_card2_title' => 'nullable|string|max:100',
            'spmb_banner_card2_desc' => 'nullable|string|max:100',
            'spmb_banner_card2_color' => 'nullable|string|max:30',
            'spmb_banner_card3_title' => 'nullable|string|max:100',
            'spmb_banner_card3_desc' => 'nullable|string|max:100',
            'spmb_banner_card3_color' => 'nullable|string|max:30',
            'spmb_banner_flyer_image' => 'nullable|string|max:255',

            'spmb_banner_flyer_label' => 'nullable|string|max:100',
            'spmb_banner_btn_text' => 'nullable|string|max:100',
            'spmb_banner_btn_url' => 'nullable|string|max:255',
            'spmb_banner_contact_text' => 'nullable|string|max:100',
            'spmb_banner_contact_phone' => 'nullable|string|max:50',

            // Form settings
            'ppdb_form_status' => 'nullable|string',
            'ppdb_form_closed_message' => 'nullable|string',
            'ppdb_form_announcement' => 'nullable|string',
            'ppdb_form_wa_confirm' => 'nullable|string',
            'ppdb_form_waves' => 'nullable|string',
            'ppdb_form_tracks' => 'nullable|string',
            'ppdb_form_programs' => 'nullable|string',
            'ppdb_form_require_payment' => 'nullable|string',
            'ppdb_form_require_birth_cert' => 'nullable|string',
            'ppdb_form_nisn_rule' => 'nullable|string',
            'ppdb_form_show_achievements' => 'nullable|string',
            'ppdb_form_show_hobbies' => 'nullable|string',
            'ppdb_form_require_parent_income' => 'nullable|string',
        ]);

        // Extract YouTube ID if full URL provided
        $yt = $validated['ppdb_youtube_id'];
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/', $yt, $matches)) {
            $validated['ppdb_youtube_id'] = $matches[1];
        }

        // Handle SPMB Flyer upload if provided
        if ($request->hasFile('spmb_banner_flyer_file')) {
            $file = $request->file('spmb_banner_flyer_file');
            $fileName = 'flyer-spmb-'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $validated['spmb_banner_flyer_image'] = '/uploads/'.$fileName;
        }

        // Handle Facility Documentation Photos upload
        for ($i = 1; $i <= 3; $i++) {
            $fileInput = "ppdb_image_{$i}_file";
            if ($request->hasFile($fileInput)) {
                $file = $request->file($fileInput);
                $destDir = public_path('uploads/ishum');
                if (! file_exists($destDir)) {
                    mkdir($destDir, 0755, true);
                }
                $fileName = "fasilitas_ppdb_{$i}_".time().'.'.$file->getClientOriginalExtension();
                $file->move($destDir, $fileName);
                $validated["ppdb_image_{$i}"] = '/uploads/ishum/'.$fileName;
            }
        }

        // Keep year in sync if needed
        if (! empty($validated['spmb_banner_year']) && empty($validated['ppdb_year'])) {
            $validated['ppdb_year'] = $validated['spmb_banner_year'];
        }

        foreach ($validated as $key => $val) {
            Setting::set($key, $val ?? '', str_starts_with($key, 'spmb_') ? 'spmb' : 'ppdb');
        }

        // Synchronize legacy accordion track descriptions to PpdbTrack models if present
        try {
            if (Schema::hasTable('ppdb_tracks')) {
                if (! empty($validated['ppdb_tahfidz'])) {
                    PpdbTrack::where('slug', 'like', '%tahfidz%')->update(['description' => $validated['ppdb_tahfidz']]);
                }
                if (! empty($validated['ppdb_alumni'])) {
                    PpdbTrack::where('slug', 'like', '%alumni%')->update(['description' => $validated['ppdb_alumni']]);
                }
                if (! empty($validated['ppdb_prestasi'])) {
                    PpdbTrack::where('slug', 'like', '%prestasi%')->update(['description' => $validated['ppdb_prestasi']]);
                }
                if (! empty($validated['ppdb_mandiri'])) {
                    PpdbTrack::where('slug', 'like', '%reguler%')->orWhere('slug', 'like', '%mandiri%')->update(['description' => $validated['ppdb_mandiri']]);
                }
            }
        } catch (\Throwable $e) {
            // Silently ignore if table does not exist yet
        }

        // Handle dynamic fields batch update if submitted
        if ($request->has('fields') && is_array($request->input('fields'))) {
            $currentSchema = PpdbFormService::getSchema();
            $inputFields = $request->input('fields');

            foreach ($currentSchema as &$field) {
                $k = $field['key'];
                if (isset($inputFields[$k])) {
                    $item = $inputFields[$k];
                    $field['label'] = $item['label'] ?? $field['label'];
                    $field['placeholder'] = $item['placeholder'] ?? ($field['placeholder'] ?? '');
                    $field['required'] = ! empty($item['required']);
                    $field['enabled'] = ! empty($item['enabled']);
                    if (isset($item['options'])) {
                        if (is_array($item['options'])) {
                            $field['options'] = $item['options'];
                        } else {
                            $field['options'] = array_values(array_filter(array_map('trim', explode("\n", (string) $item['options']))));
                        }
                    }
                }
            }
            unset($field);
            PpdbFormService::saveSchema($currentSchema);
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name ?? 'Admin',
            'action' => 'ppdb_content_update',
            'description' => 'Memperbarui konten informasi PPDB, banner SPMB beranda, dan konfigurasi formulir online',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.ppdb.content')->with('success', 'Konten PPDB, Banner SPMB, dan pengaturan formulir berhasil disimpan!');
    }

    /**
     * Store new dynamic PPDB track.
     */
    public function storeTrack(Request $request)
    {
        if (! Schema::hasTable('ppdb_tracks')) {
            return back()->with('error', 'Tabel ppdb_tracks belum tersedia di database. Silakan jalankan migrasi database terlebih dahulu.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'nullable|string|max:50',
            'quota' => 'nullable|string|max:100',
            'cashback_info' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $maxOrder = PpdbTrack::max('order') ?? 0;

        $track = PpdbTrack::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']).'-'.time(),
            'percentage' => ! empty($validated['percentage']) ? $validated['percentage'] : '0%',
            'quota' => $validated['quota'] ?? null,
            'cashback_info' => $validated['cashback_info'] ?? null,
            'description' => $validated['description'] ?? '',
            'order' => $maxOrder + 1,
            'is_active' => $request->has('is_active') ? (bool) $request->input('is_active') : true,
        ]);

        $this->syncFormTracksSetting();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'ppdb_track_create',
            'description' => "Menambahkan Jalur PPDB: {$track->name} ({$track->percentage})",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.ppdb.content', ['tab' => 'jalur'])->with('success', "Jalur pendaftaran '{$track->name}' berhasil ditambahkan.");
    }

    /**
     * Update existing dynamic PPDB track.
     */
    public function updateTrack(Request $request, PpdbTrack $track)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'nullable|string|max:50',
            'quota' => 'nullable|string|max:100',
            'cashback_info' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $track->update([
            'name' => $validated['name'],
            'percentage' => ! empty($validated['percentage']) ? $validated['percentage'] : '0%',
            'quota' => $validated['quota'] ?? null,
            'cashback_info' => $validated['cashback_info'] ?? null,
            'description' => $validated['description'] ?? '',
            'is_active' => $request->has('is_active') ? (bool) $request->input('is_active') : false,
        ]);

        $this->syncFormTracksSetting();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'ppdb_track_update',
            'description' => "Memperbarui Jalur PPDB: {$track->name}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.ppdb.content', ['tab' => 'jalur'])->with('success', "Jalur pendaftaran '{$track->name}' berhasil diperbarui.");
    }

    /**
     * Delete dynamic PPDB track.
     */
    public function destroyTrack(Request $request, PpdbTrack $track)
    {
        $name = $track->name;
        $track->delete();

        $this->syncFormTracksSetting();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'ppdb_track_delete',
            'description' => "Menghapus Jalur PPDB: {$name}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'warning',
        ]);

        return redirect()->route('admin.ppdb.content', ['tab' => 'jalur'])->with('success', "Jalur pendaftaran '{$name}' berhasil dihapus.");
    }

    /**
     * Helper to synchronize active tracks with ppdb_form_tracks text setting.
     */
    protected function syncFormTracksSetting(): void
    {
        try {
            if (Schema::hasTable('ppdb_tracks')) {
                $activeTracks = PpdbTrack::active()->ordered()->get();
                if ($activeTracks->count() > 0) {
                    $formatted = $activeTracks->map(function ($t) {
                        return ! empty($t->percentage) && $t->percentage !== '0%' ? "{$t->name} ({$t->percentage})" : $t->name;
                    })->toArray();
                    Setting::set('ppdb_form_tracks', implode("\n", $formatted), 'ppdb');
                }
            }
        } catch (\Throwable $e) {
            // Ignore if table does not exist yet
        }
    }

    /**
     * Add a new dynamic field to PPDB online form.
     */
    public function addField(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'type' => 'required|in:text,number,date,select,textarea,tel,file',
            'section' => 'required|in:pilihan,siswa,ayah,ibu,berkas,tambahan',
            'required' => 'nullable',
            'options' => 'nullable|string',
            'placeholder' => 'nullable|string|max:255',
        ]);

        $newField = PpdbFormService::addField($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name ?? 'Admin',
            'action' => 'ppdb_field_add',
            'description' => "Menambahkan kolom isian formulir PPDB baru: {$newField['label']}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.ppdb.content', ['tab' => 'formulir'])->with('success', "Kolom isian '{$newField['label']}' berhasil ditambahkan ke formulir PPDB!");
    }

    /**
     * Delete / remove a dynamic field from PPDB online form.
     */
    public function deleteField(Request $request, string $key)
    {
        $deleted = PpdbFormService::deleteField($key);

        if ($deleted) {
            ActivityLog::create([
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name ?? 'Admin',
                'action' => 'ppdb_field_delete',
                'description' => "Menghapus kolom isian formulir PPDB: {$key}",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => 'info',
            ]);

            return redirect()->route('admin.ppdb.content', ['tab' => 'formulir'])->with('success', 'Kolom isian berhasil dihapus dari struktur formulir PPDB!');
        }

        return redirect()->route('admin.ppdb.content', ['tab' => 'formulir'])->with('error', 'Kolom tidak ditemukan atau gagal dihapus.');
    }

    /**
     * Reset form fields back to default schema.
     */
    public function resetFields(Request $request)
    {
        PpdbFormService::resetToDefault();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name ?? 'Admin',
            'action' => 'ppdb_field_reset',
            'description' => 'Mereset struktur kolom formulir PPDB kembali ke pengaturan standar.',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.ppdb.content', ['tab' => 'formulir'])->with('success', 'Struktur kolom formulir PPDB berhasil dikembalikan ke standar awal.');
    }

    /**
     * Export all PPDB registrations to Excel (CSV with UTF-8 BOM).
     */
    public function exportExcel()
    {
        $registrations = PpdbRegistration::latest()->get();
        $filename = 'Data_Pendaftar_SPMB_SMPS_IT_Ishlahul_Ummah_'.date('Ymd_His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        // Discover all extra field keys present across registrations
        $extraFieldKeys = [];
        foreach ($registrations as $r) {
            if (! empty($r->extra_fields) && is_array($r->extra_fields)) {
                foreach ($r->extra_fields as $k => $item) {
                    $label = is_array($item) ? ($item['label'] ?? $k) : $k;
                    $extraFieldKeys[$k] = $label;
                }
            }
        }

        $callback = function () use ($registrations, $extraFieldKeys) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            $csvHeaders = [
                'No',
                'No. Registrasi',
                'Tanggal Pendaftaran',
                'Status Berkas',
                'Gelombang',
                'Jalur Pendaftaran',
                'Program Pilihan',
                'Nama Lengkap',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Jenis Kelamin',
                'Alamat Domisili',
                'Tinggal Bersama',
                'Anak Ke',
                'Dari Bersaudara',
                'Asal Sekolah',
                'NISN',
                'Hobi',
                'Cita-cita',
                'Prestasi',
                'No. HP / WA Siswa',
                'Nama Ayah / Wali',
                'Pendidikan Ayah',
                'Pekerjaan Ayah',
                'Penghasilan Ayah',
                'No. HP Ayah',
                'Nama Ibu / Wali',
                'Pendidikan Ibu',
                'Pekerjaan Ibu',
                'Penghasilan Ibu',
                'No. HP Ibu',
                'Link Akta Kelahiran',
                'Link Bukti Pembayaran',
            ];

            foreach ($extraFieldKeys as $k => $label) {
                $csvHeaders[] = $label;
            }

            fputcsv($file, $csvHeaders, ';');

            $index = 1;
            foreach ($registrations as $r) {
                $row = [
                    $index++,
                    $r->registration_number,
                    $r->created_at ? $r->created_at->format('d/m/Y H:i') : '-',
                    $r->status_label,
                    $r->wave ?: 'Gelombang 1',
                    $r->track ?: 'Reguler',
                    $r->program_type ?: 'Boarding School',
                    $r->full_name,
                    $r->birth_place,
                    $r->birth_date ? date('d/m/Y', strtotime($r->birth_date)) : '-',
                    $r->gender,
                    $r->address,
                    $r->living_with,
                    $r->child_order,
                    $r->siblings_count,
                    $r->previous_school,
                    $r->nisn ?: '-',
                    $r->hobby ?: '-',
                    $r->ambition ?: '-',
                    $r->achievements ?: '-',
                    $r->phone,
                    $r->father_name,
                    $r->father_education,
                    $r->father_job,
                    $r->father_income,
                    $r->father_phone ?: '-',
                    $r->mother_name,
                    $r->mother_education,
                    $r->mother_job,
                    $r->mother_income,
                    $r->mother_phone ?: '-',
                    $r->birth_certificate_path ? url($r->birth_certificate_path) : '-',
                    $r->payment_proof_path ? url($r->payment_proof_path) : '-',
                ];

                foreach ($extraFieldKeys as $k => $label) {
                    $val = '-';
                    if (! empty($r->extra_fields[$k])) {
                        $item = $r->extra_fields[$k];
                        $val = is_array($item) ? ($item['value'] ?? '-') : $item;
                    }
                    $row[] = $val;
                }

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export / Print all PPDB registrations to PDF format.
     */
    public function exportPdf()
    {
        $registrations = PpdbRegistration::latest()->get();
        $stats = [
            'total' => PpdbRegistration::count(),
            'pending' => PpdbRegistration::where('status', 'pending')->count(),
            'verified' => PpdbRegistration::where('status', 'verified')->count(),
            'accepted' => PpdbRegistration::where('status', 'accepted')->count(),
            'rejected' => PpdbRegistration::where('status', 'rejected')->count(),
        ];

        return view('admin.ppdb.export_pdf', compact('registrations', 'stats'));
    }
}
