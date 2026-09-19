@extends('layouts.frontend')

@section('title', 'SPMB / PPDB Online ' . ($settings['year'] ?? '2026/2027') . ' - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Penerimaan Peserta Didik Baru (PPDB/SPMB) SMPS IT Ishlahul Ummah Prabumulih Tahun Pelajaran ' . ($settings['year'] ?? '2026/2027') . '. Informasi lengkap jalur, syarat, alur, jadwal, biaya, dan formulir pendaftaran online.')

@section('content')
<div class="bg-gradient-to-b from-slate-50 via-indigo-50/20 to-white py-10 sm:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 sm:space-y-16">

        {{-- 1. HEADER BRAND & HERO TITLE --}}
        <div class="text-center space-y-4 reveal-fade-up max-w-4xl mx-auto">
            <div class="inline-block p-3 bg-white rounded-3xl shadow-md border border-indigo-100">
                <img src="/uploads/logo-ishum-square.png" alt="Logo SMPS IT Ishlahul Ummah" class="h-24 sm:h-28 w-auto object-contain mx-auto" onerror="this.src='/uploads/logo.png'">
            </div>
            <div>
                <div class="inline-flex items-center space-x-2 bg-emerald-100 text-emerald-800 px-4 py-1.5 rounded-full text-xs font-black mb-2 shadow-xs">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Pendaftaran Siswa Baru Telah Dibuka</span>
                </div>
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-slate-950 tracking-tight uppercase leading-tight">
                    SPMB SMPS IT ISHLAHUL UMMAH <br class="hidden sm:inline"><span class="text-indigo-700">KOTA PRABUMULIH</span>
                </h1>
                <p class="text-sm sm:text-base font-extrabold text-[#da251c] mt-2">
                    Tahun Pelajaran {{ $settings['year'] ?? '2027/2028' }} &bull; {{ $settings['wave'] ?? 'Gelombang Aktif' }}
                </p>
                @if(!empty($settings['promo']))
                    <div class="inline-block mt-2 bg-amber-400 text-slate-950 font-black text-xs sm:text-sm px-4 py-1.5 rounded-xl shadow-xs border border-amber-500">
                        <i class="fa-solid fa-tag mr-1.5 text-red-600"></i> {{ $settings['promo'] }}
                    </div>
                @endif
                <p class="text-xs sm:text-sm md:text-base text-slate-700 max-w-3xl mx-auto mt-3 font-medium leading-relaxed">
                    {{ $settings['tagline'] ?? "Mendidik Sepenuh Cinta. Mewujudkan generasi Qur'ani berkarakter tangguh, cerdas sains, mandiri, dan berwawasan global di bawah naungan JSIT Indonesia." }}
                </p>
            </div>

            {{-- CTA Quick Buttons --}}
            <div class="flex flex-col sm:flex-row flex-wrap items-center justify-center gap-3 pt-3">
                <a href="{{ route('ppdb.form') }}" class="w-full sm:w-auto justify-center text-center inline-flex items-center space-x-2 bg-[#da251c] hover:bg-[#b91c1c] text-white px-8 py-3.5 rounded-2xl text-xs sm:text-sm font-black transition shadow-lg shadow-red-500/25 transform hover:scale-105">
                    <i class="fa-solid fa-file-pen text-sm"></i>
                    <span>Isi Formulir Online</span>
                </a>
                @php
                    $cleanHotline = preg_replace('/[^0-9]/', '', (string) ($settings['hotline_phone'] ?? '085269908696'));
                    if (str_starts_with($cleanHotline, '0')) {
                        $cleanHotline = '62' . substr($cleanHotline, 1);
                    }
                @endphp
                <a href="https://wa.me/{{ $cleanHotline }}?text={{ urlencode('Assalamu\'alaikum Panitia PPDB SMPS IT Ishlahul Ummah Prabumulih, saya ingin konsultasi pendaftaran siswa baru.') }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto justify-center text-center inline-flex items-center space-x-2 bg-emerald-600 hover:bg-emerald-700 text-white px-7 py-3.5 rounded-2xl text-xs sm:text-sm font-bold transition shadow-md shadow-emerald-600/20">
                    <i class="fa-brands fa-whatsapp text-base"></i>
                    <span>Hotline WA ({{ $settings['hotline_phone'] ?? '0852-6990-8696' }})</span>
                </a>
                <a href="{{ route('home') }}" class="w-full sm:w-auto justify-center text-center inline-flex items-center space-x-2 bg-slate-900 hover:bg-black text-white px-6 py-3.5 rounded-2xl text-xs sm:text-sm font-bold transition shadow-sm">
                    <i class="fa-solid fa-house text-xs"></i>
                    <span>Beranda Sekolah</span>
                </a>
            </div>
        </div>

        {{-- 2. SEKSI JALUR PENDAFTARAN DINAMIS (TERBUKA, TANPA ACCORDION) --}}
        <section class="space-y-6">
            <div class="text-center max-w-3xl mx-auto">
                <span class="text-xs font-black uppercase tracking-widest text-indigo-600 bg-indigo-50 px-3.5 py-1.5 rounded-full border border-indigo-100">
                    <i class="fa-solid fa-layer-group mr-1.5"></i> Pilihan Jalur Masuk
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2.5 tracking-tight">
                    Jalur Pendaftaran Siswa Baru
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1">
                    Silakan pilih jalur pendaftaran yang sesuai dengan potensi, prestasi, dan kriteria calon peserta didik.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                @if(isset($tracks) && $tracks->count() > 0)
                    @foreach($tracks as $index => $track)
                        <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-xl border-2 border-slate-100 hover:border-indigo-400 transition-all duration-300 flex flex-col justify-between group">
                            <div class="space-y-3.5">
                                {{-- Top Header Card: Index & Quota --}}
                                <div class="flex items-center justify-between gap-2">
                                    <span class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-700 font-black text-xs flex items-center justify-center border border-indigo-100 group-hover:bg-indigo-600 group-hover:text-white transition">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="flex items-center gap-1.5 flex-wrap justify-end">
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-black bg-amber-400 text-slate-950 shadow-xs">
                                            Kuota {{ $track->percentage }}
                                        </span>
                                        @if(!empty($track->quota))
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700">
                                                {{ $track->quota }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Title --}}
                                <h3 class="text-lg font-black text-slate-900 group-hover:text-indigo-600 transition">
                                    {{ $track->name }}
                                </h3>

                                {{-- Cashback / Discount Pill --}}
                                @if(!empty($track->cashback_info))
                                    <div class="p-2.5 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-800 font-bold text-xs flex items-start gap-2">
                                        <i class="fa-solid fa-gift text-emerald-600 mt-0.5 flex-shrink-0"></i>
                                        <span>{{ $track->cashback_info }}</span>
                                    </div>
                                @endif

                                {{-- Description --}}
                                <div class="text-xs text-slate-700 font-medium leading-relaxed">
                                    {!! nl2br(e($track->description)) !!}
                                </div>
                            </div>

                            <div class="pt-4 mt-4 border-t border-slate-100">
                                <a href="{{ route('ppdb.form') }}" class="w-full inline-flex items-center justify-center space-x-2 bg-slate-100 group-hover:bg-indigo-600 text-slate-800 group-hover:text-white text-xs font-black py-2.5 rounded-xl transition duration-300">
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
                            ['title' => 'Jalur Mutasi Kerja', 'quota' => '5%', 'badge' => 'Keringanan Khusus Mutasi', 'desc' => 'Jalur bagi calon siswa pindahan atau orang tua/wali yang mengalami mutasi dinas/tugas kerja.'],
                            ['title' => 'Jalur Tahfidz Al-Qur\'an', 'quota' => '5%', 'badge' => 'Cashback Rp. 750.000 s/d Rp. 1.000.000', 'desc' => $settings['tahfidz'] ?? 'Jalur khusus penghafal Al-Qur\'an minimal 4-5 Juz dengan kuota 10 siswa.'],
                            ['title' => 'Jalur Alumni SMPIT Ishum', 'quota' => '25%', 'badge' => 'Potongan Biaya Rp. 1.000.000', 'desc' => $settings['alumni'] ?? 'Keringanan istimewa bagi lulusan SD IT Ishlahul Ummah 1 & 2 Prabumulih.'],
                            ['title' => 'Jalur Prestasi', 'quota' => '30%', 'badge' => 'Bebas Tes Akademik & Keringanan', 'desc' => $settings['prestasi'] ?? 'Jalur prestasi akademik (Peringkat 1-3) dan non-akademik (Sains, Olahraga, Seni) minimal tingkat kota.'],
                            ['title' => 'Jalur Reguler / Mandiri', 'quota' => '25%', 'badge' => 'Biaya Standar SPMB', 'desc' => $settings['mandiri'] ?? 'Jalur seleksi tes mandiri masuk SMP IT Ishlahul Ummah (TPA, Tahsin & Wawancara).'],
                        ];
                    @endphp
                    @foreach($fallbackTracks as $index => $ft)
                        <div class="bg-white rounded-3xl p-6 shadow-sm border-2 border-slate-100 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-700 font-black text-xs flex items-center justify-center">
                                        {{ $index + 1 }}
                                    </span>
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-black bg-amber-400 text-slate-950">
                                        Kuota {{ $ft['quota'] }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-black text-slate-900">{{ $ft['title'] }}</h3>
                                <div class="p-2 bg-emerald-50 rounded-xl text-emerald-800 font-bold text-xs">
                                    {{ $ft['badge'] }}
                                </div>
                                <p class="text-xs text-slate-600">{{ $ft['desc'] }}</p>
                            </div>
                            <div class="pt-4 mt-4 border-t border-slate-100">
                                <a href="{{ route('ppdb.form') }}" class="w-full inline-flex items-center justify-center space-x-2 bg-indigo-600 text-white text-xs font-bold py-2.5 rounded-xl">
                                    <span>Daftar Jalur Ini</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>

        {{-- 3. SEKSI ALUR & SYARAT PENDAFTARAN (OPEN 2-COLUMN BENTO GRID) --}}
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- KOLOM KIRI: ALUR PENDAFTARAN (5 LANGKAH TERBUKA) --}}
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border-2 border-indigo-100 space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                            Panduan Lengkap
                        </span>
                        <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-2">
                            Alur Pendaftaran SPMB
                        </h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-xl shadow-md shadow-indigo-600/20">
                        <i class="fa-solid fa-route"></i>
                    </div>
                </div>

                @php
                    $linesAlur = array_values(array_filter(array_map('trim', explode("\n", (string) ($settings['alur'] ?? '')))));
                @endphp
                <div class="space-y-4">
                    @if(count($linesAlur) > 0)
                        @foreach($linesAlur as $idx => $step)
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 transition group">
                                <div class="w-9 h-9 rounded-xl bg-indigo-600 text-white font-black text-xs flex items-center justify-center flex-shrink-0 shadow-sm group-hover:scale-110 transition">
                                    {{ $idx + 1 }}
                                </div>
                                <div class="text-xs sm:text-sm text-slate-800 font-medium leading-relaxed pt-1">
                                    {!! nl2br(e($step)) !!}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-xs text-slate-500">Informasi alur pendaftaran akan segera diperbarui.</p>
                    @endif
                </div>
            </div>

            {{-- KOLOM KANAN: SYARAT PENDAFTARAN (CHECKLIST TERBUKA) --}}
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border-2 border-indigo-100 space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-amber-700 bg-amber-50 px-3 py-1 rounded-full">
                            Kelengkapan Berkas
                        </span>
                        <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-2">
                            Syarat Pendaftaran
                        </h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500 text-slate-950 flex items-center justify-center text-xl shadow-md shadow-amber-500/20">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                </div>

                @php
                    $linesSyarat = array_values(array_filter(array_map('trim', explode("\n", (string) ($settings['syarat'] ?? '')))));
                @endphp
                <div class="space-y-3">
                    @if(count($linesSyarat) > 0)
                        @foreach($linesSyarat as $syarat)
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-sm mt-0.5 flex-shrink-0"></i>
                                <span class="text-xs sm:text-sm text-slate-800 font-medium leading-relaxed">
                                    {!! nl2br(e($syarat)) !!}
                                </span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-xs text-slate-500">Informasi syarat pendaftaran akan segera diperbarui.</p>
                    @endif
                </div>

                <div class="p-4 rounded-2xl bg-indigo-50/70 border border-indigo-100 text-xs text-indigo-950 space-y-1">
                    <span class="font-black text-indigo-700 flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-info"></i> Catatan Berkas:
                    </span>
                    <p class="text-indigo-900 leading-relaxed">
                        Seluruh berkas persyaratan dapat diunggah melalui formulir online atau diserahkan langsung ke sekretariat panitia saat observasi/wawancara.
                    </p>
                </div>
            </div>

        </section>

        {{-- 4. SEKSI PILIHAN PROGRAM (BOARDING ASRAMA VS FULL DAY SCHOOL) --}}
        <section class="space-y-6">
            <div class="text-center max-w-3xl mx-auto">
                <span class="text-xs font-black uppercase tracking-widest text-indigo-600 bg-indigo-50 px-3.5 py-1.5 rounded-full border border-indigo-100">
                    <i class="fa-solid fa-graduation-cap mr-1"></i> Sistem Pendidikan
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2 tracking-tight">
                    Pilihan Program Belajar
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1">
                    Dua pilihan kurikulum terpadu untuk membentuk karakter santri yang beriman, berilmu, dan berakhlak mulia.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Program Boarding --}}
                <div class="bg-gradient-to-br from-indigo-950 via-indigo-900 to-slate-900 text-white rounded-3xl p-7 sm:p-9 shadow-xl border-2 border-indigo-400/20 relative overflow-hidden flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3.5 py-1 rounded-full text-xs font-black bg-amber-400 text-slate-950 shadow-xs">
                                Pilihan Unggulan
                            </span>
                            <i class="fa-solid fa-hotel text-2xl text-amber-400"></i>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-black text-white">
                            Program Boarding (Asrama)
                        </h3>
                        <p class="text-xs sm:text-sm text-indigo-100 leading-relaxed font-medium">
                            Pembinaan karakter intensif 24 jam dengan bimbingan dewan asatidz/musyrif mukim.
                        </p>
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 text-xs sm:text-sm space-y-2">
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-amber-300"></i> Target hafalan Al-Qur'an mutqin 2 Juz & Tahsin bersanad</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-amber-300"></i> Kamar santri ber-AC / ventilasi nyaman dan sehat</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-amber-300"></i> Pembiasaan shalat berjamaah 5 waktu, tahajjud & dhuha</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-amber-300"></i> Makan bergizi 3x sehari & bimbingan belajar malam</div>
                        </div>
                    </div>
                    <div class="pt-5 mt-4 border-t border-white/10">
                        <span class="text-xs text-amber-300 font-bold flex items-center gap-2">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Lingkungan asrama islami yang aman dan terpantau CCTV</span>
                        </span>
                    </div>
                </div>

                {{-- Program Full Day --}}
                <div class="bg-white text-slate-900 rounded-3xl p-7 sm:p-9 shadow-sm border-2 border-indigo-100 flex flex-col justify-between hover:border-indigo-300 transition">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3.5 py-1 rounded-full text-xs font-black bg-indigo-50 text-indigo-700 border border-indigo-100">
                                Program Reguler
                            </span>
                            <i class="fa-solid fa-school text-2xl text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-black text-slate-900">
                            Program Full Day School
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-medium">
                            Pembelajaran kurikulum terpadu nasional & kekhasan SIT dari pagi hingga sore hari.
                        </p>
                        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200/80 text-xs sm:text-sm space-y-2 text-slate-800">
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Jam belajar terpadu pukul 07.15 s/d 15.30 WIB</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Shalat Zhuhur & Ashar berjamaah di masjid sekolah</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Kegiatan ekstrakurikuler bakat (Panahan, Pramuka, Sains, dll.)</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Tetap tinggal dan berkumpul bersama keluarga di rumah</div>
                        </div>
                    </div>
                    <div class="pt-5 mt-4 border-t border-slate-100">
                        <span class="text-xs text-indigo-600 font-bold flex items-center gap-2">
                            <i class="fa-solid fa-house-chimney-user"></i>
                            <span>Kombinasi ideal antara sekolah berkualitas dan kedekatan keluarga</span>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        {{-- 5. SEKSI JADWAL GELOMBANG, BIAYA, & PENGUMUMAN (OPEN 3-CARD ROW) --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- Card 1: Jadwal Gelombang --}}
            <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border-2 border-indigo-100 flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Jadwal Gelombang SPMB</h3>
                    <div class="text-xs text-slate-700 font-medium leading-relaxed whitespace-pre-line bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                        {!! nl2br(e($settings['jadwal_gelombang'] ?? "Gelombang 1: Oktober - Desember\nGelombang 2: Januari - April\nGelombang 3: Mei - Juli (Sisa Kuota)")) !!}
                    </div>
                </div>
                <p class="text-[11px] text-amber-700 font-bold mt-3">
                    * Pendaftaran ditutup sewaktu-waktu jika kuota penuh.
                </p>
            </div>

            {{-- Card 2: Rincian Biaya & Seragam --}}
            <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border-2 border-indigo-100 flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-shirt"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Biaya &amp; Paket Seragam</h3>
                    <div class="text-xs text-slate-700 font-medium leading-relaxed whitespace-pre-line bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                        {!! nl2br(e($settings['biaya'] ?? "Biaya Formulir: Rp 250.000,-\nPaket 4 Stel Seragam Lengkap + Atribut\nBiaya Orientasi (MPLS) & Kemah Kepemimpinan")) !!}
                    </div>
                </div>
                <p class="text-[11px] text-indigo-700 font-bold mt-3">
                    * Skema cicilan uang pangkal tersedia bagi yang memenuhi syarat.
                </p>
            </div>

            {{-- Card 3: Pengumuman & Daftar Ulang --}}
            <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border-2 border-indigo-100 flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Kelulusan &amp; Daftar Ulang</h3>
                    <div class="text-xs text-slate-700 font-medium leading-relaxed whitespace-pre-line bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                        {!! nl2br(e($settings['kelulusan'] ?? "Hasil seleksi diumumkan via website dan WhatsApp resmi.\nCalon siswa lulus wajib melakukan registrasi ulang.")) !!}
                    </div>
                </div>
                <p class="text-[11px] text-emerald-700 font-bold mt-3">
                    * Notifikasi dikirimkan otomatis kepada nomor WhatsApp orang tua.
                </p>
            </div>

        </section>

        {{-- 6. JAM OPERASIONAL & REKENING RESMI BSI --}}
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Jam Operasional --}}
            <div class="bg-white border-2 border-indigo-200 rounded-3xl p-6 sm:p-8 shadow-sm flex flex-col justify-between">
                <div class="space-y-3">
                    <span class="inline-block bg-indigo-700 text-white text-[10px] font-black px-3.5 py-1 rounded-full uppercase tracking-wider">
                        Layanan Terpadu
                    </span>
                    <h3 class="text-xl font-black text-slate-950 tracking-tight uppercase">
                        Jam Operasional &amp; Sekretariat
                    </h3>
                    <p class="text-xs font-bold text-indigo-600">
                        Tersedia Layanan Konsultasi Tatap Muka &amp; Online
                    </p>
                    <ul class="text-xs sm:text-sm text-slate-800 font-medium space-y-2.5 pt-2">
                        <li class="flex items-start space-x-2.5">
                            <i class="fa-regular fa-clock text-indigo-600 font-bold mt-0.5"></i>
                            <span>{{ $settings['operational_weekday'] ?? "Senin – Jum'at: Pukul 08.00 – 15.00 WIB" }}</span>
                        </li>
                        <li class="flex items-start space-x-2.5">
                            <i class="fa-regular fa-clock text-indigo-600 font-bold mt-0.5"></i>
                            <span>{{ $settings['operational_weekend'] ?? 'Sabtu: Pukul 08.00 – 12.00 WIB' }}</span>
                        </li>
                        <li class="flex items-start space-x-2.5">
                            <i class="fa-solid fa-location-dot text-[#da251c] font-bold mt-0.5"></i>
                            <span><strong>Sekretariat:</strong> {{ $settings['secretariat'] ?? 'Kompleks SMPS IT Ishum, Jl. Sadewa No. 45 RT 01 RW 04 Karang Raja, Kota Prabumulih' }}</span>
                        </li>
                    </ul>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-200">
                    <p class="text-xs text-slate-700 font-bold">Biaya Formulir: <strong class="text-indigo-600">{{ $settings['registration_fee'] ?? 'Rp 250.000,-' }}</strong></p>
                </div>
            </div>

            {{-- Rekening Resmi BSI --}}
            <div class="bg-gradient-to-br from-indigo-950 via-indigo-900 to-blue-950 text-white rounded-3xl p-6 sm:p-8 shadow-xl border-2 border-indigo-500/30 flex flex-col justify-between relative overflow-hidden" x-data="{ copied: false }">
                <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-amber-400/20 rounded-full blur-2xl pointer-events-none"></div>
                <div class="space-y-3.5 relative z-10">
                    <div class="flex items-center justify-between">
                        <span class="bg-amber-400 text-slate-950 text-[10px] font-black px-3.5 py-1 rounded-full uppercase tracking-wider shadow-xs">
                            Rekening Resmi SPMB
                        </span>
                        <span class="text-xs font-black text-amber-300 flex items-center gap-1.5">
                            <i class="fa-solid fa-building-columns"></i>
                            <span>{{ $settings['bank_name'] ?? 'Bank Syariah Indonesia (BSI)' }}</span>
                        </span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight">
                        Pembayaran Biaya Formulir ({{ $settings['registration_fee'] ?? 'Rp 250.000,-' }})
                    </h3>
                    <div class="bg-black/40 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-emerald-400/30 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-indigo-100 font-extrabold uppercase tracking-wider">Nomor Rekening:</span>
                            <span class="text-xs text-amber-300 font-black bg-emerald-900/80 px-2.5 py-0.5 rounded-lg border border-emerald-500/40">
                                Kode Bank: {{ $settings['bank_code'] ?? '451' }}
                            </span>
                        </div>
                        <div class="text-3xl sm:text-4xl font-black text-amber-300 font-mono tracking-wider drop-shadow-md">
                            {{ $settings['bank_account'] ?? '7011304251' }}
                        </div>
                        <div class="text-xs text-indigo-100 font-medium pt-1 flex items-center justify-between border-t border-white/10">
                            <span>Atas Nama:</span>
                            <strong class="text-white font-black text-sm uppercase">{{ $settings['bank_holder'] ?? 'YL. Fatmawati' }}</strong>
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-3 relative z-10 flex items-center justify-between gap-3">
                    <button 
                        @click="navigator.clipboard.writeText('{{ $settings['bank_account'] ?? '7011304251' }}'); copied = true; setTimeout(() => copied = false, 2500)"
                        class="inline-flex items-center space-x-2 bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs font-black px-5 py-3 rounded-xl transition shadow-lg shadow-amber-950/40 cursor-pointer flex-shrink-0">
                        <i class="fa-regular" :class="copied ? 'fa-check' : 'fa-copy'"></i>
                        <span x-text="copied ? 'Nomor Tersalin!' : 'Salin Nomor Rekening'"></span>
                    </button>
                    <span class="text-xs text-amber-300 font-extrabold flex items-center gap-1.5">
                        <i class="fa-solid fa-receipt"></i>
                        <span>Simpan bukti transfer</span>
                    </span>
                </div>
            </div>

        </section>

        {{-- 7. DOKUMENTASI FASILITAS KAMPUS RESMI ISHUM (3 FOTO BESAR BERKUALITAS) --}}
        <section class="bg-white rounded-3xl p-6 sm:p-10 shadow-sm border-2 border-slate-100 space-y-6">
            <div class="text-center max-w-3xl mx-auto">
                <span class="text-xs font-black uppercase tracking-widest text-indigo-600 bg-indigo-50 px-3.5 py-1.5 rounded-full border border-indigo-100">
                    <i class="fa-solid fa-camera mr-1"></i> Sarana &amp; Prasarana
                </span>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2">
                    Fasilitas Pembelajaran Modern
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 mt-1">
                    Lingkungan belajar asri, representatif, dan dilengkapi sarana penunjang kegiatan santri secara optimal.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 pt-2">
                {{-- Foto 1 --}}
                <div class="rounded-3xl overflow-hidden border-2 border-slate-100 shadow-sm group bg-slate-100">
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img src="{{ $settings['image_1'] }}" 
                             alt="Gedung & Fasilitas SMPS IT Ishum 1" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                             onerror="this.src='/uploads/fasilitas/fasilitas-gedung-utama.webp'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-90"></div>
                        <div class="absolute bottom-3 left-4 right-4 text-white">
                            <span class="text-[10px] uppercase tracking-wider text-amber-300 font-bold block">Fasilitas Kampus</span>
                            <h4 class="text-sm font-black drop-shadow">Gedung Utama &amp; Kelas Ber-AC</h4>
                        </div>
                    </div>
                </div>

                {{-- Foto 2 --}}
                <div class="rounded-3xl overflow-hidden border-2 border-slate-100 shadow-sm group bg-slate-100">
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img src="{{ $settings['image_2'] }}" 
                             alt="Ruang Kelas & Fasilitas Belajar 2" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                             onerror="this.src='/uploads/fasilitas/fasilitas-ruang-kelas.webp'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-90"></div>
                        <div class="absolute bottom-3 left-4 right-4 text-white">
                            <span class="text-[10px] uppercase tracking-wider text-amber-300 font-bold block">Ruang Belajar</span>
                            <h4 class="text-sm font-black drop-shadow">Suasana Kelas Nyaman &amp; Interaktif</h4>
                        </div>
                    </div>
                </div>

                {{-- Foto 3 --}}
                <div class="rounded-3xl overflow-hidden border-2 border-slate-100 shadow-sm group bg-slate-100">
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img src="{{ $settings['image_3'] }}" 
                             alt="Laboratorium & Hall Serbaguna 3" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                             onerror="this.src='/uploads/fasilitas/fasilitas-lab-ipa.webp'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-90"></div>
                        <div class="absolute bottom-3 left-4 right-4 text-white">
                            <span class="text-[10px] uppercase tracking-wider text-amber-300 font-bold block">Laboratorium &amp; Aula</span>
                            <h4 class="text-sm font-black drop-shadow">Lab Komputer, Sains &amp; Hall Serbaguna</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 8. VIDEO PROFIL RESMI SEKOLAH (JIKA ADA YOUTUBE ID) --}}
        @if(!empty($settings['youtube_id']))
            <section class="bg-white rounded-3xl p-6 sm:p-10 shadow-sm border-2 border-indigo-100 space-y-6">
                <div class="text-center max-w-2xl mx-auto">
                    <span class="text-xs font-black uppercase tracking-widest text-indigo-600 bg-indigo-50 px-3.5 py-1.5 rounded-full">
                        <i class="fa-solid fa-play-circle mr-1"></i> Video Profil
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2">
                        Mengenal SMPS IT Ishlahul Ummah
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1">Saksikan sekilas suasana pembiasaan adab dan kegiatan santri kami.</p>
                </div>

                <div class="relative w-full overflow-hidden rounded-3xl shadow-2xl border-4 border-slate-900 aspect-video max-w-4xl mx-auto bg-slate-950">
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full"
                        src="https://www.youtube.com/embed/{{ $settings['youtube_id'] }}?rel=0" 
                        title="{{ $settings['video_title'] ?? 'Video Profil SMPS IT Ishlahul Ummah Prabumulih' }}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
            </section>
        @endif

        {{-- 9. DUA ACTION CARD UTAMA (FORMULIR ONLINE & WHATSAPP) --}}
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
            
            {{-- Card Formulir --}}
            <a href="{{ route('ppdb.form') }}" class="group bg-gradient-to-br from-red-600 to-[#da251c] text-white p-8 sm:p-10 rounded-3xl shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                <div class="space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/15 backdrop-blur text-white flex items-center justify-center text-3xl shadow-inner">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-white">
                            Formulir Pendaftaran Online
                        </h3>
                        <p class="text-xs sm:text-sm text-red-100 font-medium mt-2 leading-relaxed">
                            Bapak/Ibu dapat mengisi data lengkap calon peserta didik secara online dari rumah melalui smartphone atau laptop.
                        </p>
                    </div>
                </div>
                <div class="pt-6 mt-6 border-t border-white/20">
                    <span class="inline-flex items-center space-x-2 bg-white text-red-700 hover:bg-slate-100 text-xs sm:text-sm font-black px-7 py-3 rounded-2xl shadow-md transition">
                        <i class="fa-solid fa-file-pen"></i>
                        <span>Isi Formulir Online Sekarang</span>
                    </span>
                </div>
            </a>

            {{-- Card WhatsApp --}}
            <a href="https://wa.me/{{ $cleanHotline }}?text={{ urlencode('Halo Panitia PPDB SMPS IT Ishlahul Ummah Prabumulih, saya ingin konsultasi mengenai pendaftaran siswa baru.') }}" target="_blank" rel="noopener noreferrer" class="group bg-gradient-to-br from-indigo-700 to-indigo-900 text-white p-8 sm:p-10 rounded-3xl shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                <div class="space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/15 backdrop-blur text-white flex items-center justify-center text-3xl shadow-inner">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-white">
                            Konsultasi &amp; Konfirmasi Pembayaran
                        </h3>
                        <p class="text-xs sm:text-sm text-indigo-100 font-medium mt-2 leading-relaxed">
                            Hubungi panitia penerimaan siswa baru untuk pertanyaan seputar syarat, program asrama, atau pengiriman bukti transfer formulir: <strong>{{ $settings['hotline_phone'] ?? '0852-6990-8696' }}</strong>
                        </p>
                    </div>
                </div>
                <div class="pt-6 mt-6 border-t border-white/20">
                    <span class="inline-flex items-center space-x-2 bg-emerald-500 hover:bg-emerald-400 text-slate-950 text-xs sm:text-sm font-black px-7 py-3 rounded-2xl shadow-md transition">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>Hubungi via WhatsApp</span>
                    </span>
                </div>
            </a>

        </section>

        {{-- 10. UCAPAN TERIMA KASIH & DOA PENUTUP --}}
        <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-sm border-2 border-slate-100 text-center space-y-4">
            <h3 class="text-xl sm:text-2xl font-black text-[#da251c] tracking-tight">
                {{ $settings['closing_title'] ?? 'Terima Kasih Sudah Mendaftar di SMPS IT Ishlahul Ummah Prabumulih' }}
            </h3>
            <p class="text-xs sm:text-sm font-semibold text-slate-700 max-w-2xl mx-auto leading-relaxed">
                {{ $settings['closing_desc'] ?? 'Semoga Ananda kelak bisa menjadi anak yang cerdas, sholeh/ah, berbakti kepada orang tua dan menjadi kebanggaan bagi agama, bangsa dan negara. Aamiin' }}
            </p>
            <div class="pt-4 border-t border-slate-100 text-xs font-bold text-indigo-700 tracking-wider uppercase">
                SMPS IT Ishlahul Ummah Prabumulih &bull; Anggota JSIT Indonesia
            </div>
        </div>

    </div>
</div>
@endsection
