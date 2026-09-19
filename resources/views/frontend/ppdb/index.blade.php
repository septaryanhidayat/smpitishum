@extends('layouts.frontend')

@section('title', 'SPMB / PPDB Online ' . ($settings['year'] ?? '2026/2027') . ' - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Penerimaan Peserta Didik Baru (PPDB/SPMB) SMPS IT Ishlahul Ummah Prabumulih Tahun Pelajaran ' . ($settings['year'] ?? '2026/2027') . '. Informasi lengkap jalur pendaftaran, syarat berkas, alur, jadwal, biaya formulir, rekening resmi BSI, dan formulir pendaftaran online.')

@section('content')
@php
    $cleanHotline = preg_replace('/[^0-9]/', '', (string) ($settings['hotline_phone'] ?? '085269908696'));
    if (str_starts_with($cleanHotline, '0')) {
        $cleanHotline = '62' . substr($cleanHotline, 1);
    }
    $cleanHotline2 = preg_replace('/[^0-9]/', '', (string) ($settings['hotline_2_phone'] ?? '085378974396'));
    if (str_starts_with($cleanHotline2, '0')) {
        $cleanHotline2 = '62' . substr($cleanHotline2, 1);
    }
@endphp

<div class="bg-slate-50 text-slate-800 pb-16 sm:pb-20">

    {{-- ========================================================
         1. HERO HEADER (Ringkas, Hangat, & Ramah Orang Tua)
         ======================================================== --}}
    <section class="relative bg-gradient-to-b from-indigo-950 via-slate-900 to-indigo-900 text-white pt-8 pb-10 sm:pt-12 sm:pb-14 px-4 sm:px-6 overflow-hidden">
        {{-- Subtle background glow --}}
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-5xl mx-auto text-center space-y-4 relative z-10">
            {{-- Logo & Accreditation Pill --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <div class="w-16 h-16 sm:w-20 sm:h-20 p-2 bg-white/95 rounded-2xl shadow-lg flex items-center justify-center border border-white/20">
                    <img src="/uploads/logo-ishum-square.png" alt="Logo SMPS IT Ishlahul Ummah" class="max-h-full max-w-full object-contain" onerror="this.src='/uploads/logo.png'">
                </div>
                <div class="inline-flex items-center space-x-2 bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 px-3.5 py-1.5 rounded-full text-xs font-bold backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Penerimaan Siswa Baru Telah Dibuka</span>
                </div>
            </div>

            {{-- Title --}}
            <div class="space-y-1.5">
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight uppercase leading-tight">
                    SPMB SMPS IT ISHLAHUL UMMAH
                </h1>
                <p class="text-base sm:text-xl font-bold text-amber-300 tracking-wide">
                    KOTA PRABUMULIH &bull; PPDB ONLINE
                </p>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 rounded-full text-xs sm:text-sm font-semibold text-indigo-200">
                    <span>Tahun Pelajaran {{ $settings['year'] ?? '2026/2027' }}</span>
                    <span>&bull;</span>
                    <span class="text-amber-400 font-bold">{{ $settings['wave'] ?? 'Gelombang 1' }}</span>
                </div>
            </div>

            {{-- Promo Banner if filled --}}
            @if(!empty($settings['promo']))
                <div class="inline-block bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 font-black text-xs sm:text-sm px-4 py-1.5 rounded-xl shadow-md">
                    <i class="fa-solid fa-gift mr-1.5 text-red-600"></i> {{ $settings['promo'] }}
                </div>
            @endif

            {{-- Tagline --}}
            <p class="text-xs sm:text-sm text-indigo-100/90 max-w-2xl mx-auto font-medium leading-relaxed">
                {{ $settings['tagline'] ?? "Mendidik Sepenuh Cinta. Mewujudkan generasi Qur'ani berkarakter tangguh, cerdas sains, mandiri, dan berwawasan global di bawah naungan JSIT Indonesia." }}
            </p>

            {{-- Main Call To Action Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-2.5 sm:gap-3 pt-2">
                <a href="{{ route('ppdb.form') }}" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 bg-gradient-to-r from-[#da251c] to-red-600 hover:from-red-700 hover:to-rose-700 text-white px-7 py-3 rounded-2xl text-xs sm:text-sm font-black shadow-lg shadow-red-600/30 transition transform hover:scale-102">
                    <i class="fa-solid fa-file-signature text-base"></i>
                    <span>Isi Formulir Online Sekarang</span>
                </a>

                <a href="https://wa.me/{{ $cleanHotline }}?text={{ urlencode('Assalamu\'alaikum Panitia PPDB SMPS IT Ishlahul Ummah Prabumulih, saya ingin konsultasi pendaftaran siswa baru.') }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl text-xs sm:text-sm font-bold shadow-md shadow-emerald-600/20 transition transform hover:scale-102">
                    <i class="fa-brands fa-whatsapp text-base"></i>
                    <span>Tanya Panitia via WhatsApp</span>
                </a>

                <a href="#rekening" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 bg-white/10 hover:bg-white/20 text-white px-5 py-3 rounded-2xl text-xs sm:text-sm font-semibold border border-white/15 transition">
                    <i class="fa-solid fa-credit-card text-xs"></i>
                    <span>Info Rekening</span>
                </a>
            </div>
        </div>
    </section>

    {{-- ========================================================
         2. QUICK INFO RIBBON (4 Poin Ringkas & Jelas untuk Orang Tua)
         ======================================================== --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 -mt-5 sm:-mt-6 relative z-20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2.5 sm:gap-3">
            {{-- Box 1: Biaya Formulir --}}
            <div class="bg-white p-3 sm:p-4 rounded-2xl shadow-sm border border-slate-200/90 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 text-base">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Biaya Formulir</span>
                    <span class="text-xs sm:text-sm font-black text-slate-900">{{ $settings['registration_fee'] ?? 'Rp 250.000,-' }}</span>
                </div>
            </div>

            {{-- Box 2: Program --}}
            <div class="bg-white p-3 sm:p-4 rounded-2xl shadow-sm border border-slate-200/90 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 text-base">
                    <i class="fa-solid fa-hotel"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Sistem Belajar</span>
                    <span class="text-xs sm:text-sm font-black text-slate-900">Boarding & Full Day</span>
                </div>
            </div>

            {{-- Box 3: Periode --}}
            <div class="bg-white p-3 sm:p-4 rounded-2xl shadow-sm border border-slate-200/90 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 text-base">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Status Gelombang</span>
                    <span class="text-xs sm:text-sm font-black text-emerald-600">Gelombang 1 Aktif</span>
                </div>
            </div>

            {{-- Box 4: Layanan Hotline --}}
            <div class="bg-white p-3 sm:p-4 rounded-2xl shadow-sm border border-slate-200/90 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-rose-50 text-[#da251c] flex items-center justify-center shrink-0 text-base">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Layanan Konsultasi</span>
                    <a href="https://wa.me/{{ $cleanHotline }}" target="_blank" class="text-xs sm:text-sm font-black text-slate-900 hover:text-[#da251c] transition">
                        {{ $settings['hotline_phone'] ?? '0852-6990-8696' }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- WRAPPER KONTEN UTAMA DENGAN JARAK YANG LEBIH RAPI & KOMPAK --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 mt-8 sm:mt-10 space-y-8 sm:space-y-10">

        {{-- ========================================================
             3. PILIHAN JALUR PENDAFTARAN DINAMIS (KARTU BERSIH & JELAS)
             ======================================================== --}}
        <section class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2 border-b border-slate-200/80 pb-3">
                <div>
                    <div class="inline-flex items-center gap-1.5 text-xs font-extrabold text-[#da251c] uppercase tracking-wider">
                        <i class="fa-solid fa-route"></i>
                        <span>Pilihan Jalur Masuk</span>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">
                        Jalur Pendaftaran Santri Baru
                    </h2>
                </div>
                <p class="text-xs text-slate-500 max-w-md">
                    Pilih jalur pendaftaran yang sesuai dengan kualifikasi, potensi, dan kebutuhan calon santri.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5 sm:gap-4">
                @if(isset($tracks) && $tracks->count() > 0)
                    @foreach($tracks as $index => $track)
                        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 hover:border-indigo-400 shadow-2xs hover:shadow-md transition-all duration-200 flex flex-col justify-between group">
                            <div class="space-y-2.5">
                                {{-- Card Header: Nomor & Kuota --}}
                                <div class="flex items-center justify-between gap-2">
                                    <span class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-700 font-black text-xs flex items-center justify-center border border-indigo-100 group-hover:bg-indigo-600 group-hover:text-white transition">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="flex items-center gap-1 flex-wrap justify-end">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-black bg-amber-400 text-slate-950">
                                            Kuota {{ $track->percentage }}
                                        </span>
                                        @if(!empty($track->quota))
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600">
                                                {{ $track->quota }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Track Name --}}
                                <h3 class="text-base font-black text-slate-900 group-hover:text-indigo-600 transition">
                                    {{ $track->name }}
                                </h3>

                                {{-- Cashback / Benefit Pill if available --}}
                                @if(!empty($track->cashback_info))
                                    <div class="p-2 bg-emerald-50 border border-emerald-200/80 rounded-xl text-emerald-800 font-bold text-xs flex items-center gap-1.5">
                                        <i class="fa-solid fa-gift text-emerald-600 shrink-0"></i>
                                        <span>{{ $track->cashback_info }}</span>
                                    </div>
                                @endif

                                {{-- Description --}}
                                <div class="text-xs text-slate-600 font-normal leading-relaxed">
                                    {!! nl2br(e($track->description)) !!}
                                </div>
                            </div>

                            <div class="pt-3.5 mt-3 border-t border-slate-100">
                                <a href="{{ route('ppdb.form', ['jalur' => $track->name]) }}" class="w-full inline-flex items-center justify-center space-x-1.5 bg-slate-50 group-hover:bg-indigo-600 text-slate-700 group-hover:text-white text-xs font-bold py-2 px-3 rounded-xl transition duration-200">
                                    <span>Pilih Jalur Ini</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Default Fallback Cards if Tracks Empty --}}
                    @php
                        $fallbackTracks = [
                            ['title' => 'Jalur First Brive', 'quota' => '10%', 'badge' => 'Cashback & Prioritas', 'desc' => 'Jalur pendaftaran gelombang perdana dengan diskon dan kuota khusus untuk pendaftar awal.'],
                            ['title' => 'Jalur Mutasi Kerja', 'quota' => '5%', 'badge' => 'Keringanan Khusus Mutasi', 'desc' => 'Jalur bagi calon siswa pindahan atau orang tua/wali yang mengalami mutasi tugas kerja.'],
                            ['title' => 'Jalur Tahfidz Al-Qur\'an', 'quota' => '5%', 'badge' => 'Cashback s/d Rp 1.000.000', 'desc' => $settings['tahfidz'] ?? 'Jalur khusus penghafal Al-Qur\'an minimal 4-5 Juz dengan kuota terbatas.'],
                            ['title' => 'Jalur Alumni SDIT Ishum', 'quota' => '25%', 'badge' => 'Potongan Biaya Rp 1.000.000', 'desc' => $settings['alumni'] ?? 'Keringanan istimewa bagi lulusan SD IT Ishlahul Ummah 1 & 2 Prabumulih.'],
                            ['title' => 'Jalur Prestasi', 'quota' => '30%', 'badge' => 'Keringanan & Bebas Tes Tertentu', 'desc' => $settings['prestasi'] ?? 'Jalur prestasi akademik (Peringkat 1-3) dan non-akademik (Sains, Olahraga, Seni) min. tingkat kota.'],
                            ['title' => 'Jalur Reguler / Mandiri', 'quota' => '25%', 'badge' => 'Biaya Standar SPMB', 'desc' => $settings['mandiri'] ?? 'Jalur seleksi tes mandiri masuk SMP IT Ishlahul Ummah (TPA, Tahsin & Wawancara).'],
                        ];
                    @endphp
                    @foreach($fallbackTracks as $index => $ft)
                        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-2xs flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-700 font-black text-xs flex items-center justify-center">
                                        {{ $index + 1 }}
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black bg-amber-400 text-slate-950">
                                        Kuota {{ $ft['quota'] }}
                                    </span>
                                </div>
                                <h3 class="text-base font-black text-slate-900">{{ $ft['title'] }}</h3>
                                <div class="p-2 bg-emerald-50 rounded-xl text-emerald-800 font-bold text-xs">
                                    {{ $ft['badge'] }}
                                </div>
                                <p class="text-xs text-slate-600 leading-relaxed">{{ $ft['desc'] }}</p>
                            </div>
                            <div class="pt-3.5 mt-3 border-t border-slate-100">
                                <a href="{{ route('ppdb.form', ['jalur' => $ft['title']]) }}" class="w-full inline-flex items-center justify-center space-x-1.5 bg-indigo-600 text-white text-xs font-bold py-2 rounded-xl hover:bg-indigo-700 transition">
                                    <span>Pilih Jalur Ini</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>

        {{-- ========================================================
             4. ALUR & SYARAT PENDAFTARAN (4 LANGKAH JELAS & CHECKLIST)
             ======================================================== --}}
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
            
            {{-- KOLOM KIRI: 4 LANGKAH ALUR PENDAFTARAN (SANGAT MUDAH DIPAHAMI) --}}
            <div class="lg:col-span-7 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 shadow-xs border border-slate-200/80 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md">
                            Panduan Mudah
                        </span>
                        <h3 class="text-lg sm:text-xl font-black text-slate-900 mt-1">
                            Alur Pendaftaran (4 Langkah)
                        </h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-lg shadow-sm">
                        <i class="fa-solid fa-list-ol"></i>
                    </div>
                </div>

                @php
                    $linesAlur = array_values(array_filter(array_map('trim', explode("\n", (string) ($settings['alur'] ?? '')))));
                @endphp
                <div class="space-y-2.5">
                    @if(count($linesAlur) > 0)
                        @foreach($linesAlur as $idx => $step)
                            <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100/90 hover:border-indigo-200 transition">
                                <div class="w-7 h-7 rounded-lg bg-indigo-600 text-white font-black text-xs flex items-center justify-center shrink-0 mt-0.5">
                                    {{ $idx + 1 }}
                                </div>
                                <div class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                                    {!! nl2br(e($step)) !!}
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- Fallback 4 Langkah Standar Ramah Orang Tua --}}
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="w-7 h-7 rounded-lg bg-indigo-600 text-white font-black text-xs flex items-center justify-center shrink-0 mt-0.5">1</div>
                            <div class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                                <strong>Mengisi Formulir Online:</strong> Buka formulir PPDB pada website ini dan isi identitas calon santri beserta orang tua/wali.
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="w-7 h-7 rounded-lg bg-indigo-600 text-white font-black text-xs flex items-center justify-center shrink-0 mt-0.5">2</div>
                            <div class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                                <strong>Membayar Biaya Formulir:</strong> Transfer Rp 250.000 ke rekening resmi BSI 7011304251 a.n YL. Fatmawati dan simpan bukti transfer.
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="w-7 h-7 rounded-lg bg-indigo-600 text-white font-black text-xs flex items-center justify-center shrink-0 mt-0.5">3</div>
                            <div class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                                <strong>Observasi & Tes Pemetaan:</strong> Calon santri mengikuti tes membaca Al-Qur'an (Tahsin), tes potensi akademik dasar, dan wawancara.
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="w-7 h-7 rounded-lg bg-indigo-600 text-white font-black text-xs flex items-center justify-center shrink-0 mt-0.5">4</div>
                            <div class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                                <strong>Pengumuman & Daftar Ulang:</strong> Hasil seleksi diumumkan via WhatsApp dan calon santri melakukan registrasi ulang seragam & asrama.
                            </div>
                        </div>
                    @endif
                </div>

                <div class="pt-2">
                    <a href="{{ route('ppdb.form') }}" class="inline-flex items-center gap-1.5 text-xs font-black text-indigo-700 hover:text-indigo-900 transition">
                        <span>Lanjut ke Formulir Online</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            {{-- KOLOM KANAN: SYARAT DOKUMEN & BERKAS --}}
            <div class="lg:col-span-5 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 shadow-xs border border-slate-200/80 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md">
                            Kelengkapan Berkas
                        </span>
                        <h3 class="text-lg sm:text-xl font-black text-slate-900 mt-1">
                            Syarat Pendaftaran
                        </h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center text-lg shadow-sm">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                </div>

                @php
                    $linesSyarat = array_values(array_filter(array_map('trim', explode("\n", (string) ($settings['syarat'] ?? '')))));
                @endphp
                <div class="space-y-2">
                    @if(count($linesSyarat) > 0)
                        @foreach($linesSyarat as $syarat)
                            <div class="flex items-start gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-100/90 text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                                <span>{!! nl2br(e($syarat)) !!}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="flex items-start gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 font-medium">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                            <span>Mengisi formulir pendaftaran online dengan data akurat.</span>
                        </div>
                        <div class="flex items-start gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 font-medium">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                            <span>Bukti transfer biaya formulir Rp 250.000,-</span>
                        </div>
                        <div class="flex items-start gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 font-medium">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                            <span>Fotokopi Akta Kelahiran dan Kartu Keluarga (KK).</span>
                        </div>
                        <div class="flex items-start gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 font-medium">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                            <span>Pas foto santri 3x4 berwarna (terbaru).</span>
                        </div>
                    @endif
                </div>

                <div class="p-3 rounded-xl bg-amber-50/80 border border-amber-200/80 text-xs text-amber-950 space-y-1">
                    <span class="font-bold flex items-center gap-1.5 text-amber-800">
                        <i class="fa-solid fa-circle-info"></i> Catatan Berkas:
                    </span>
                    <p class="leading-relaxed text-[11px] sm:text-xs">
                        Berkas dapat diunggah melalui formulir online atau diserahkan langsung kepada panitia saat jadwal observasi tatap muka di sekolah.
                    </p>
                </div>
            </div>

        </section>

        {{-- ========================================================
             5. REKENING RESMI BSI & JAM LAYANAN SEKRETARIAT
             ======================================================== --}}
        <section id="rekening" class="grid grid-cols-1 md:grid-cols-12 gap-5 items-stretch">
            
            {{-- KARTU REKENING BSI RESMI (SALIN NOMOR 1-KLIK) --}}
            <div class="md:col-span-7 bg-gradient-to-br from-indigo-950 via-slate-900 to-indigo-900 text-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 shadow-lg border border-indigo-500/30 flex flex-col justify-between relative overflow-hidden" x-data="{ copied: false }">
                <div class="space-y-3.5 relative z-10">
                    <div class="flex items-center justify-between gap-2">
                        <span class="bg-amber-400 text-slate-950 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider">
                            Rekening Resmi PPDB
                        </span>
                        <span class="text-xs font-bold text-amber-300 flex items-center gap-1.5">
                            <i class="fa-solid fa-building-columns"></i>
                            <span>{{ $settings['bank_name'] ?? 'Bank Syariah Indonesia (BSI)' }}</span>
                        </span>
                    </div>

                    <div>
                        <h3 class="text-lg sm:text-xl font-black text-white">
                            Pembayaran Biaya Formulir ({{ $settings['registration_fee'] ?? 'Rp 250.000,-' }})
                        </h3>
                        <p class="text-xs text-indigo-200 mt-0.5">
                            Transfer biaya formulir secara aman langsung ke rekening resmi yayasan sekolah.
                        </p>
                    </div>

                    <div class="bg-black/40 backdrop-blur-sm rounded-2xl p-4 border border-emerald-400/30 space-y-1.5">
                        <div class="flex items-center justify-between text-xs text-indigo-200">
                            <span class="font-bold uppercase tracking-wider">Nomor Rekening:</span>
                            <span class="text-amber-300 font-mono font-bold bg-emerald-900/60 px-2 py-0.5 rounded border border-emerald-500/30 text-[11px]">
                                Kode BSI: {{ $settings['bank_code'] ?? '451' }}
                            </span>
                        </div>
                        <div class="text-2xl sm:text-3xl font-black text-amber-300 font-mono tracking-wider">
                            {{ $settings['bank_account'] ?? '7011304251' }}
                        </div>
                        <div class="text-xs text-indigo-100 pt-1 flex items-center justify-between border-t border-white/10">
                            <span>Atas Nama:</span>
                            <strong class="text-white font-bold uppercase">{{ $settings['bank_holder'] ?? 'YL. Fatmawati' }}</strong>
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-2 relative z-10 flex flex-wrap items-center justify-between gap-2.5">
                    <button 
                        @click="navigator.clipboard.writeText('{{ $settings['bank_account'] ?? '7011304251' }}'); copied = true; setTimeout(() => copied = false, 2500)"
                        class="inline-flex items-center space-x-2 bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs font-black px-4 py-2.5 rounded-xl transition shadow-md cursor-pointer shrink-0">
                        <i class="fa-regular" :class="copied ? 'fa-check text-emerald-700' : 'fa-copy'"></i>
                        <span x-text="copied ? 'Nomor Tersalin!' : 'Salin Nomor Rekening'"></span>
                    </button>
                    <span class="text-xs text-emerald-300 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Simpan bukti transfer untuk konfirmasi</span>
                    </span>
                </div>
            </div>

            {{-- JAM LAYANAN & SEKRETARIAT --}}
            <div class="md:col-span-5 bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 shadow-xs border border-slate-200/80 flex flex-col justify-between space-y-4">
                <div class="space-y-2.5">
                    <span class="inline-block bg-indigo-50 text-indigo-700 text-[10px] font-black px-2.5 py-1 rounded-md uppercase tracking-wider">
                        Sekretariat Panitia
                    </span>
                    <h3 class="text-lg font-black text-slate-900">
                        Jam Layanan & Alamat
                    </h3>
                    
                    <ul class="text-xs text-slate-700 font-medium space-y-2 pt-1">
                        <li class="flex items-start gap-2">
                            <i class="fa-regular fa-clock text-indigo-600 mt-0.5 shrink-0"></i>
                            <span>{{ $settings['operational_weekday'] ?? "Senin – Jum'at: 08.00 – 15.00 WIB" }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-regular fa-clock text-indigo-600 mt-0.5 shrink-0"></i>
                            <span>{{ $settings['operational_weekend'] ?? 'Sabtu: 08.00 – 12.00 WIB' }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-[#da251c] mt-0.5 shrink-0"></i>
                            <span>{{ $settings['secretariat'] ?? 'Kompleks SMPS IT Ishum, Jl. Sadewa RT 01 RW 04 Karang Raja, Prabumulih' }}</span>
                        </li>
                    </ul>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold block uppercase">Hotline PPDB</span>
                        <span class="text-xs font-black text-slate-800">{{ $settings['hotline_phone'] ?? '0852-6990-8696' }}</span>
                    </div>
                    <a href="https://wa.me/{{ $cleanHotline }}" target="_blank" class="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold rounded-xl transition inline-flex items-center gap-1.5">
                        <i class="fa-brands fa-whatsapp"></i> Chat WA
                    </a>
                </div>
            </div>

        </section>

        {{-- ========================================================
             6. PILIHAN SISTEM BELAJAR: BOARDING (ASRAMA) VS FULL DAY
             ======================================================== --}}
        <section class="space-y-4">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                    Sistem Pembelajaran
                </span>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">
                    Pilihan Program Belajar
                </h2>
                <p class="text-xs text-slate-500">
                    Dua pilihan kurikulum terpadu untuk membentuk karakter santri yang beriman, berilmu, dan berakhlak mulia.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                {{-- Card Boarding (Asrama) --}}
                <div class="bg-gradient-to-br from-indigo-950 via-indigo-900 to-slate-900 text-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 shadow-md border border-indigo-400/20 flex flex-col justify-between space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black bg-amber-400 text-slate-950">
                                Program Unggulan
                            </span>
                            <i class="fa-solid fa-hotel text-xl text-amber-400"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-black text-white">
                            Program Boarding (Asrama Santri)
                        </h3>
                        <p class="text-xs text-indigo-100 font-normal leading-relaxed">
                            Pembinaan karakter intensif 24 jam dengan bimbingan dewan asatidz/musyrif mukim.
                        </p>
                        <div class="bg-white/10 rounded-xl p-3 text-xs space-y-1.5">
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-amber-300 text-[11px]"></i> Target hafalan Al-Qur'an intensif & Tahsin bersanad</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-amber-300 text-[11px]"></i> Kamar santri ber-AC, bersih, dan ventilasi sehat</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-amber-300 text-[11px]"></i> Pembiasaan shalat berjamaah 5 waktu, tahajjud & dhuha</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-amber-300 text-[11px]"></i> Makan bergizi 3x sehari & belajar malam terarah</div>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-white/10 text-[11px] text-amber-300 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Lingkungan asrama islami yang aman & terpantau CCTV</span>
                    </div>
                </div>

                {{-- Card Full Day School --}}
                <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 shadow-xs border border-slate-200/80 flex flex-col justify-between space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black bg-indigo-50 text-indigo-700 border border-indigo-100">
                                Program Reguler
                            </span>
                            <i class="fa-solid fa-school text-xl text-indigo-600"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-black text-slate-900">
                            Program Full Day School
                        </h3>
                        <p class="text-xs text-slate-600 font-normal leading-relaxed">
                            Pembelajaran kurikulum terpadu nasional & kekhasan SIT dari pagi hingga sore hari.
                        </p>
                        <div class="bg-slate-50 rounded-xl p-3 text-xs space-y-1.5 text-slate-700">
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-[11px]"></i> Jam belajar terpadu 07.15 s/d 15.30 WIB</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-[11px]"></i> Shalat Zhuhur & Ashar berjamaah di masjid sekolah</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-[11px]"></i> Kegiatan ekstrakurikuler lengkap (Panahan, Futsal, Pramuka, dll)</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600 text-[11px]"></i> Tetap tinggal dan berkumpul bersama keluarga di rumah</div>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-slate-100 text-[11px] text-indigo-600 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-house-chimney-user"></i>
                        <span>Kombinasi ideal antara sekolah berkualitas & kedekatan keluarga</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- ========================================================
             7. FASILITAS KAMPUS & VIDEO PROFIL RESMI (NO BLACK VOID)
             ======================================================== --}}
        <section class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-7 shadow-xs border border-slate-200/80 space-y-5">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                    Sarana & Prasarana
                </span>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">
                    Fasilitas & Suasana Belajar
                </h2>
                <p class="text-xs text-slate-500">
                    Sarana penunjang kegiatan santri yang modern, representatif, asri, dan nyaman.
                </p>
            </div>

            {{-- 3 Foto Fasilitas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
                <div class="rounded-2xl overflow-hidden border border-slate-200/80 bg-slate-100 group">
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="{{ $settings['image_1'] }}" 
                             alt="Gedung Utama SMPS IT Ishum" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                             onerror="this.src='/uploads/fasilitas/fasilitas-gedung-utama.webp'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-2.5 left-3 right-3 text-white">
                            <span class="text-[9px] uppercase tracking-wider text-amber-300 font-bold block">Gedung Kampus</span>
                            <h4 class="text-xs font-black">Gedung Utama & Kelas Ber-AC</h4>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl overflow-hidden border border-slate-200/80 bg-slate-100 group">
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="{{ $settings['image_2'] }}" 
                             alt="Ruang Kelas SMPS IT Ishum" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                             onerror="this.src='/uploads/fasilitas/fasilitas-ruang-kelas.webp'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-2.5 left-3 right-3 text-white">
                            <span class="text-[9px] uppercase tracking-wider text-amber-300 font-bold block">Ruang Belajar</span>
                            <h4 class="text-xs font-black">Kelas Nyaman & Interaktif</h4>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl overflow-hidden border border-slate-200/80 bg-slate-100 group">
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="{{ $settings['image_3'] }}" 
                             alt="Laboratorium SMPS IT Ishum" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                             onerror="this.src='/uploads/fasilitas/fasilitas-lab-ipa.webp'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-2.5 left-3 right-3 text-white">
                            <span class="text-[9px] uppercase tracking-wider text-amber-300 font-bold block">Laboratorium</span>
                            <h4 class="text-xs font-black">Lab Komputer, IPA & Aula</h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Video Profil Resmi (Strict 16:9 Intrinsic Aspect Ratio - ZERO BLACK VOID) --}}
            @if(!empty($settings['youtube_id']))
                <div class="pt-3 border-t border-slate-100">
                    <div class="text-center max-w-lg mx-auto mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 block">Video Profil Sekolah</span>
                        <h3 class="text-sm sm:text-base font-black text-slate-900">
                            {{ $settings['video_title'] ?? 'Mengenal Lebih Dekat SMPS IT Ishlahul Ummah' }}
                        </h3>
                    </div>

                    <div class="max-w-3xl mx-auto rounded-2xl overflow-hidden shadow-md border border-slate-200 bg-black">
                        <div style="position: relative; width: 100%; padding-top: 56.25%;">
                            <iframe 
                                src="https://www.youtube.com/embed/{{ $settings['youtube_id'] }}?rel=0" 
                                title="{{ $settings['video_title'] ?? 'Video Profil SMPS IT Ishlahul Ummah Prabumulih' }}" 
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        {{-- ========================================================
             8. DUA KARTU AKSI UTAMA (FORMULIR & WHATSAPP)
             ======================================================== --}}
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Tombol Daftar Online --}}
            <a href="{{ route('ppdb.form') }}" class="group bg-gradient-to-br from-red-600 to-[#da251c] text-white p-5 sm:p-7 rounded-2xl sm:rounded-3xl shadow-md hover:shadow-xl transition flex flex-col justify-between">
                <div class="space-y-2">
                    <div class="w-11 h-11 rounded-xl bg-white/20 text-white flex items-center justify-center text-xl">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-black text-white">
                        Formulir Pendaftaran Online
                    </h3>
                    <p class="text-xs text-red-100 leading-relaxed font-normal">
                        Bapak/Ibu dapat mengisi data lengkap calon santri secara mandiri dari smartphone atau komputer kapan saja.
                    </p>
                </div>
                <div class="pt-4 mt-3 border-t border-white/20">
                    <span class="inline-flex items-center gap-1.5 bg-white text-[#da251c] text-xs font-black px-5 py-2.5 rounded-xl shadow-xs">
                        <i class="fa-solid fa-file-pen"></i>
                        <span>Isi Formulir Sekarang</span>
                    </span>
                </div>
            </a>

            {{-- Tombol Konsultasi WhatsApp --}}
            <a href="https://wa.me/{{ $cleanHotline }}?text={{ urlencode('Halo Panitia PPDB SMPS IT Ishlahul Ummah Prabumulih, saya ingin konsultasi pendaftaran siswa baru.') }}" target="_blank" rel="noopener noreferrer" class="group bg-gradient-to-br from-emerald-600 to-teal-700 text-white p-5 sm:p-7 rounded-2xl sm:rounded-3xl shadow-md hover:shadow-xl transition flex flex-col justify-between">
                <div class="space-y-2">
                    <div class="w-11 h-11 rounded-xl bg-white/20 text-white flex items-center justify-center text-xl">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-black text-white">
                        Konsultasi & Konfirmasi WhatsApp
                    </h3>
                    <p class="text-xs text-emerald-100 leading-relaxed font-normal">
                        Hubungi panitia penerimaan santri baru untuk informasi syarat, program asrama, atau pengiriman bukti transfer: <strong>{{ $settings['hotline_phone'] ?? '0852-6990-8696' }}</strong>
                    </p>
                </div>
                <div class="pt-4 mt-3 border-t border-white/20">
                    <span class="inline-flex items-center gap-1.5 bg-white text-emerald-800 text-xs font-black px-5 py-2.5 rounded-xl shadow-xs">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>Chat WhatsApp Panitia</span>
                    </span>
                </div>
            </a>
        </section>

        {{-- ========================================================
             9. UCAPAN TERIMA KASIH & PENUTUP RAMAH
             ======================================================== --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-2xs border border-slate-200/80 text-center space-y-2">
            <h3 class="text-base sm:text-lg font-black text-[#da251c]">
                {{ $settings['closing_title'] ?? 'Terima Kasih Sudah Mendaftar di SMPS IT Ishlahul Ummah Prabumulih' }}
            </h3>
            <p class="text-xs text-slate-600 max-w-xl mx-auto leading-relaxed">
                {{ $settings['closing_desc'] ?? 'Semoga Ananda kelak bisa menjadi anak yang cerdas, sholeh/ah, berbakti kepada orang tua dan menjadi kebanggaan bagi agama, bangsa dan negara. Aamiin' }}
            </p>
            <div class="pt-3 border-t border-slate-100 text-[11px] font-bold text-indigo-700 uppercase tracking-wider">
                SMPS IT Ishlahul Ummah Prabumulih &bull; Anggota JSIT Indonesia
            </div>
        </div>

    </div>

    {{-- ========================================================
         10. MOBILE BOTTOM STICKY ACTION BAR (Sangat Ramah Pengguna HP)
         ======================================================== --}}
    <div class="sm:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 p-2.5 px-4 flex items-center gap-2 shadow-2xl">
        <a href="https://wa.me/{{ $cleanHotline }}?text={{ urlencode('Assalamu\'alaikum Panitia PPDB SMPS IT Ishlahul Ummah Prabumulih, saya ingin konsultasi pendaftaran siswa baru.') }}" target="_blank" rel="noopener noreferrer" class="flex-1 inline-flex items-center justify-center gap-1.5 bg-emerald-600 text-white py-2.5 px-3 rounded-xl text-xs font-bold shadow-xs">
            <i class="fa-brands fa-whatsapp text-sm"></i>
            <span>Tanya WA</span>
        </a>
        <a href="{{ route('ppdb.form') }}" class="flex-1 inline-flex items-center justify-center gap-1.5 bg-[#da251c] text-white py-2.5 px-3 rounded-xl text-xs font-black shadow-xs">
            <i class="fa-solid fa-file-pen text-xs"></i>
            <span>Daftar Sekarang</span>
        </a>
    </div>

</div>
@endsection
