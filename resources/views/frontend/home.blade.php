@extends('layouts.frontend')

@section('title', 'SMPS IT Ishlahul Ummah Prabumulih - Membina Generasi Qur\'ani, Cerdas & Berakhlak Mulia')

@section('content')
{{-- ========================================================
     SECTION #0: HERO SLIDER (Royal Indigo & Electric Blue)
     ======================================================== --}}
<section class="relative bg-slate-950 overflow-hidden" x-data="{
    activeSlide: 0,
    slides: {{ Js::from($heroSlides) }},
    autoSlide() {
        setInterval(() => {
            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
        }, 6500);
    }
}" x-init="autoSlide()">
    {{-- Banner Images & Content --}}
    <div class="relative h-[440px] sm:h-[480px] lg:h-[520px] w-full overflow-hidden">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" 
                 x-transition:enter="transition ease-out duration-700" 
                 x-transition:enter-start="opacity-0 scale-105" 
                 x-transition:enter-end="opacity-100 scale-100" 
                 x-transition:leave="transition ease-in duration-500" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="absolute inset-0">
                
                <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover object-center brightness-60">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-indigo-950/60 to-slate-950/40"></div>

                {{-- Konten Hero Rata Tengah --}}
                <div class="absolute inset-0 flex items-center justify-center pt-2 pb-14 sm:pb-14 px-2">
                    <div class="max-w-4xl mx-auto px-2 sm:px-6 text-center text-white space-y-2.5 sm:space-y-4 w-full">
                        <div class="flex justify-center">
                            <span class="inline-flex items-center justify-center px-3 sm:px-4 py-1 sm:py-1.5 rounded-full text-[10px] sm:text-xs font-black uppercase tracking-normal sm:tracking-widest bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 shadow-lg shadow-amber-500/30 max-w-[92%] sm:max-w-none text-center">
                                <i class="fa-solid fa-star text-[9px] mr-1.5 shrink-0"></i>
                                <span class="truncate sm:overflow-visible">SMPS IT Unggulan Kota Prabumulih • Terakreditasi B</span>
                            </span>
                        </div>
                        <h1 class="text-xl sm:text-3xl md:text-5xl lg:text-6xl font-black tracking-tight drop-shadow-2xl leading-snug sm:leading-tight px-1" x-text="slide.title"></h1>
                        <p class="text-xs sm:text-base md:text-lg text-indigo-100 font-medium max-w-2xl mx-auto drop-shadow line-clamp-3 sm:line-clamp-none px-2" x-text="slide.subtitle"></p>
                        <div class="pt-2 sm:pt-3 flex flex-col sm:flex-row items-center justify-center gap-2.5 sm:gap-3 w-full max-w-[270px] sm:max-w-md mx-auto">
                            <a :href="slide.btn_link" class="w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 hover:from-amber-500 hover:to-amber-700 text-slate-950 px-5 sm:px-8 py-2.5 sm:py-3.5 rounded-full font-black text-xs sm:text-sm shadow-xl shadow-amber-500/25 transition transform hover:scale-105">
                                <span x-text="slide.btn_text"></span>
                                <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                            </a>
                            <a href="{{ route('ppdb.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-indigo-600/90 hover:bg-indigo-600 text-white px-5 sm:px-8 py-2.5 sm:py-3 rounded-full font-bold text-xs sm:text-sm shadow-lg backdrop-blur-sm border border-indigo-400/30 transition transform hover:scale-105">
                                <i class="fa-solid fa-graduation-cap mr-2"></i>
                                <span>Info SPMB</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- Carousel Controls (Panah Samping - disembunyikan di layar mobile agar tidak menutupi teks) --}}
    <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length" class="hidden sm:flex absolute left-2 sm:left-6 top-1/2 -translate-y-1/2 bg-slate-900/70 hover:bg-indigo-600 text-white w-9 h-9 sm:w-11 sm:h-11 rounded-full items-center justify-center transition backdrop-blur z-20 shadow-lg border border-white/10" aria-label="Slide sebelumnya">
        <i class="fa-solid fa-chevron-left text-xs sm:text-sm" aria-hidden="true"></i>
    </button>
    <button @click="activeSlide = (activeSlide + 1) % slides.length" class="hidden sm:flex absolute right-2 sm:right-6 top-1/2 -translate-y-1/2 bg-slate-900/70 hover:bg-indigo-600 text-white w-9 h-9 sm:w-11 sm:h-11 rounded-full items-center justify-center transition backdrop-blur z-20 shadow-lg border border-white/10" aria-label="Slide berikutnya">
        <i class="fa-solid fa-chevron-right text-xs sm:text-sm" aria-hidden="true"></i>
    </button>

    {{-- Dots Pagination di Tengah --}}
    <div class="absolute bottom-8 sm:bottom-11 left-1/2 -translate-x-1/2 flex space-x-1.5 z-20">
        <template x-for="(slide, idx) in slides" :key="idx">
            <button @click="activeSlide = idx" class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center cursor-pointer" :aria-label="'Pilih slide ' + (idx + 1)">
                <span class="h-2 sm:h-2.5 rounded-full transition-all duration-300" :class="activeSlide === idx ? 'w-6 sm:w-7 bg-amber-400 shadow-md shadow-amber-400/50' : 'w-2 sm:w-2.5 bg-white/60 hover:bg-white'"></span>
            </button>
        </template>
    </div>
</section>

{{-- ========================================================
     SECTION: FLOATING QUICK ICONS / MENU UTAMA (8 Kartu Sekolah)
     ======================================================== --}}
<div x-data="{ showDownloadModal: false }" class="max-w-6xl mx-auto px-4 sm:px-6 relative z-30 -mt-8 sm:-mt-10 reveal-fade-up">
    <div class="bg-white rounded-3xl shadow-2xl border border-indigo-50 p-4 sm:p-6 md:p-7">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 mb-4 sm:mb-5 border-b border-gray-100">
            <div class="text-center sm:text-left">
                <h2 class="text-base sm:text-lg font-black text-gray-900 tracking-tight flex items-center justify-center sm:justify-start gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 inline-block animate-pulse"></span>
                    <span>Menu Utama Sekolah</span>
                </h2>
                <p class="text-xs text-gray-500 font-light mt-0.5">Akses cepat portal informasi dan layanan terpadu SMPS IT Ishlahul Ummah Prabumulih</p>
            </div>
            <div class="flex items-center justify-center sm:justify-end">
                <button @click="showDownloadModal = true" type="button" aria-label="Buka Pilihan Download" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black px-4 py-2 rounded-full transition shadow-md shadow-indigo-600/20 flex items-center space-x-1.5 cursor-pointer transform hover:scale-105 min-h-[40px]">
                    <i class="fa-solid fa-download text-[11px]" aria-hidden="true"></i>
                    <span>Download Berkas</span>
                </button>
            </div>
        </div>

        @php
            $dbQuickMenus = \App\Models\QuickMenu::active()->orderBy('order', 'asc')->take(8)->get();
            if ($dbQuickMenus->isEmpty()) {
                $quickMenus = collect([
                    (object)['name' => 'SPMB Online', 'icon' => 'fa-solid fa-graduation-cap', 'url' => route('ppdb.index'), 'is_image' => false],
                    (object)['name' => 'Profil Sekolah', 'icon' => 'fa-solid fa-school', 'url' => url('/tentang-kami'), 'is_image' => false],
                    (object)['name' => 'Dewan Guru', 'icon' => 'fa-solid fa-chalkboard-user', 'url' => route('dewan.index'), 'is_image' => false],
                    (object)['name' => 'Fasilitas', 'icon' => 'fa-solid fa-layer-group', 'url' => route('bidang.index'), 'is_image' => false],
                    (object)['name' => 'Unggulan', 'icon' => 'fa-solid fa-award', 'url' => route('dpc.index'), 'is_image' => false],
                    (object)['name' => 'Prestasi', 'icon' => 'fa-solid fa-trophy', 'url' => url('/prestasi'), 'is_image' => false],
                    (object)['name' => 'Ekskul', 'icon' => 'fa-solid fa-people-group', 'url' => url('/ekstrakurikuler'), 'is_image' => false],
                    (object)['name' => 'Kabar Sekolah', 'icon' => 'fa-solid fa-newspaper', 'url' => route('artikel.index'), 'is_image' => false],
                ]);
            } else {
                $quickMenus = $dbQuickMenus;
            }
        @endphp

        {{-- GRID QUICK MENUS: 4 Kolom di Mobile, 8 Kolom di Desktop --}}
        <div class="grid grid-cols-4 md:grid-cols-8 gap-2 sm:gap-3 md:gap-3.5 text-center justify-items-center">
            @foreach($quickMenus as $qm)
            <a href="{{ $qm->url }}" 
               class="group w-full flex flex-col items-center justify-between text-center p-2 sm:p-2.5 md:py-3.5 md:px-1 rounded-2xl border border-slate-100 hover:border-indigo-300 bg-white hover:bg-indigo-50/50 shadow-xs hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 min-h-[88px] sm:min-h-[98px] md:min-h-[105px]" 
               aria-label="Menu {{ $qm->name }}">
                <div class="w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center mx-auto mb-1.5 sm:mb-2 shadow-xs border border-indigo-100 group-hover:bg-indigo-600 group-hover:text-white group-hover:scale-110 transition-all duration-300">
                    @if(!empty($qm->is_image) && $qm->is_image)
                        <img src="{{ $qm->icon }}" alt="Ikon {{ $qm->name }}" class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 object-contain group-hover:scale-105 transition" onerror="this.src='/uploads/logo-ishum-square.webp'">
                    @else
                        <i class="{{ $qm->icon }} text-lg sm:text-xl md:text-2xl transition-colors duration-300" aria-hidden="true"></i>
                    @endif
                </div>
                <span class="text-[10px] sm:text-[11px] md:text-xs font-bold text-slate-800 group-hover:text-indigo-700 text-center leading-tight line-clamp-2 break-words w-full tracking-tight px-0.5 min-h-[24px] sm:min-h-[28px] flex items-center justify-center">
                    {{ $qm->name }}
                </span>
            </a>
            @endforeach
        </div>
    </div>

    {{-- POPUP MODAL DOWNLOAD --}}
    <div x-show="showDownloadModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="showDownloadModal = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-xs"
         style="display: none;">
         
        <div class="fixed inset-0" @click="showDownloadModal = false"></div>

        <div x-show="showDownloadModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-white rounded-3xl shadow-2xl max-w-2xl w-full p-6 sm:p-8 border border-indigo-100 z-10">

            <button @click="showDownloadModal = false" type="button" class="absolute top-4 right-4 sm:top-5 sm:right-5 w-9 h-9 rounded-lg bg-slate-900 text-white hover:bg-black transition flex items-center justify-center shadow-md cursor-pointer" aria-label="Tutup Pilihan Download">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>

            <div class="text-center mb-6">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl mx-auto mb-2.5">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-black text-gray-900">
                    Pusat Unduhan SMPS IT Ishlahul Ummah Prabumulih
                </h3>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                    Silakan unduh brosur SPMB, formulir pendaftaran, modul siswa, dan pedoman resmi
                </p>
                <div class="w-12 h-1 bg-amber-400 mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mb-6">
                <a href="{{ route('download.index') }}" class="flex items-center p-4 rounded-2xl border border-gray-200 hover:border-indigo-600 hover:bg-indigo-50/40 transition group shadow-xs">
                    <div class="w-11 h-11 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-lg mr-3.5 flex-shrink-0 group-hover:scale-105 transition">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 group-hover:text-indigo-700 transition">Brosur &amp; Formulir SPMB</h4>
                        <p class="text-[11px] text-gray-500 leading-tight mt-0.5">Syarat registrasi, rincian biaya, &amp; jadwal</p>
                    </div>
                </a>

                <a href="{{ route('download.ebook') }}" class="flex items-center p-4 rounded-2xl border border-gray-200 hover:border-indigo-600 hover:bg-indigo-50/40 transition group shadow-xs">
                    <div class="w-11 h-11 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg mr-3.5 flex-shrink-0 group-hover:scale-105 transition">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 group-hover:text-indigo-700 transition">E-Library &amp; Modul Ajar</h4>
                        <p class="text-[11px] text-gray-500 leading-tight mt-0.5">Modul tahfidz 2 juz &amp; materi kurikulum</p>
                    </div>
                </a>

                <a href="{{ route('download.hymne-mars') }}" class="flex items-center p-4 rounded-2xl border border-gray-200 hover:border-indigo-600 hover:bg-indigo-50/40 transition group shadow-xs">
                    <div class="w-11 h-11 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg mr-3.5 flex-shrink-0 group-hover:scale-105 transition">
                        <i class="fa-solid fa-music"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 group-hover:text-indigo-700 transition">Mars JSIT Indonesia</h4>
                        <p class="text-[11px] text-gray-500 leading-tight mt-0.5">Lirik dan audio resmi pembangkit semangat</p>
                    </div>
                </a>

                <a href="{{ route('download.logo') }}" class="flex items-center p-4 rounded-2xl border border-gray-200 hover:border-indigo-600 hover:bg-indigo-50/40 transition group shadow-xs">
                    <div class="w-11 h-11 rounded-xl bg-emerald-100 text-indigo-700 flex items-center justify-center text-lg mr-3.5 flex-shrink-0 group-hover:scale-105 transition">
                        <i class="fa-solid fa-image"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 group-hover:text-indigo-700 transition">Logo Resmi SMPS IT</h4>
                        <p class="text-[11px] text-gray-500 leading-tight mt-0.5">File logo resolusi tinggi PNG &amp; SVG</p>
                    </div>
                </a>
            </div>

            <div class="text-center pt-2 border-t border-gray-100">
                <button @click="showDownloadModal = false" type="button" class="text-xs font-semibold text-gray-500 hover:text-gray-800 transition">
                    Kembali ke Beranda
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ========================================================
     FEATURED BANNER: SPMB GELOMBANG EXCLUSIVE & CLASS MEETING
     (Palet Warna Sesuai File Warna.png: Royal Indigo, Electric Blue & Gold)
     ======================================================== --}}
<section class="py-12 sm:py-16 bg-gradient-to-b from-slate-50 via-indigo-50/30 to-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="relative bg-gradient-to-br from-indigo-950 via-indigo-900 to-blue-900 rounded-3xl sm:rounded-[32px] p-4 sm:p-8 lg:p-12 shadow-2xl text-white border border-indigo-400/20 overflow-hidden reveal-fade-up">
            {{-- Decorative glow circles --}}
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 lg:gap-12 items-center">
                {{-- Left: Flyer Visual Box --}}
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative group max-w-[260px] sm:max-w-xs md:max-w-sm w-full mx-auto">
                        <div class="absolute -inset-1 bg-gradient-to-r from-amber-400 via-blue-400 to-indigo-500 rounded-2xl blur-xs opacity-75 group-hover:opacity-100 transition duration-500"></div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-slate-900 border-2 border-white/20 aspect-[3/4]">
                            <img src="/uploads/flyer-spmb-smpit-ishum.png" alt="Flyer SPMB Gelombang Exclusive & Class Meeting Semester Genap SMP IT Ishlahul Ummah Prabumulih" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                            <div class="absolute bottom-2.5 left-2.5 right-2.5 bg-slate-950/85 backdrop-blur-md py-1.5 px-2.5 rounded-xl border border-white/10 text-center">
                                <span class="text-[10px] sm:text-[11px] font-black text-amber-300 uppercase tracking-wider">
                                    <i class="fa-solid fa-bullhorn mr-1"></i> Pengumuman Resmi Sekolah
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Informasi Detail & Action --}}
                <div class="lg:col-span-7 space-y-4 sm:space-y-5 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-full bg-amber-400/20 border border-amber-400/40 text-amber-300 text-[10px] sm:text-xs font-black uppercase tracking-wider max-w-[95%]">
                        <i class="fa-solid fa-certificate text-xs flex-shrink-0"></i>
                        <span class="truncate sm:overflow-visible">Penerimaan Santri Baru Gelombang Exclusive</span>
                    </div>

                    <h2 class="text-xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-snug">
                        SPMB Gelombang Exclusive &amp; Class Meeting Semester Genap
                    </h2>

                    <p class="text-xs sm:text-base text-indigo-100 leading-relaxed">
                        Bergabunglah bersama keluarga besar <strong>SMPS IT Ishlahul Ummah Prabumulih</strong>. Memadukan kurikulum terpadu nasional dengan pembiasaan adab Qur'ani, target hafalan 2 juz mutqin, serta penguasaan bahasa asing &amp; teknologi.
                    </p>

                    {{-- 3 Key Benefit Cards --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 sm:gap-3 pt-1 sm:pt-2">
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-3 sm:p-4 border border-white/10 text-center">
                            <div class="text-amber-400 text-lg sm:text-xl font-black mb-1">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <h4 class="text-[11px] sm:text-xs font-black uppercase tracking-wider text-white">KUOTA TERBATAS</h4>
                            <p class="text-xs text-amber-300 font-bold mt-0.5">Hanya 24 Santri</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-3 sm:p-4 border border-white/10 text-center">
                            <div class="text-amber-400 text-lg sm:text-xl font-black mb-1">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </div>
                            <h4 class="text-[11px] sm:text-xs font-black uppercase tracking-wider text-white">CASH BACK 1 JUTA</h4>
                            <p class="text-xs text-amber-300 font-bold mt-0.5">Alumni SDIT Ishum 1 &amp; 2</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-3 sm:p-4 border border-white/10 text-center">
                            <div class="text-amber-400 text-lg sm:text-xl font-black mb-1">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <h4 class="text-[11px] sm:text-xs font-black uppercase tracking-wider text-white">CLASS MEETING</h4>
                            <p class="text-xs text-amber-300 font-bold mt-0.5">Mulai Rabu, 17 Juni</p>
                        </div>
                    </div>

                    {{-- Action Hotline & Buttons --}}
                    <div class="pt-2 sm:pt-3 flex flex-col sm:flex-row items-center gap-2.5 sm:gap-3 justify-center lg:justify-start w-full">
                        <a href="{{ route('ppdb.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 hover:from-amber-500 hover:to-amber-700 text-slate-950 px-6 sm:px-8 py-3 sm:py-3.5 rounded-full font-black text-xs sm:text-sm shadow-xl shadow-amber-500/25 transition transform hover:scale-105">
                            <i class="fa-solid fa-graduation-cap mr-2"></i>
                            <span>Daftar SPMB Online</span>
                        </a>

                        <a href="https://wa.me/6285269908696?text=Halo%20Admin%20SMP%20IT%20Ishlahul%20Ummah%20Prabumulih,%20saya%20ingin%20informasi%20SPMB%20Gelombang%20Exclusive" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 sm:px-6 py-3 sm:py-3.5 rounded-full font-bold text-xs sm:text-sm shadow-lg transition transform hover:scale-105">
                            <i class="fa-brands fa-whatsapp text-base mr-2"></i>
                            <span>Narahubung: 0852-6990-8696</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #1: SAMBUTAN KEPALA SEKOLAH
     ======================================================== --}}
<section class="py-14 sm:py-20 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            {{-- Foto Kepala Sekolah --}}
            <div class="lg:col-span-5 reveal-fade-up delay-1">
                <div class="max-w-sm mx-auto">
                    <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-indigo-50 bg-gradient-to-b from-indigo-50 to-blue-100 aspect-[4/5] relative">
                        <img src="/uploads/dewan/kepala-sekolah.webp" alt="Kepala SMPS IT Ishlahul Ummah Prabumulih, Anita Carlyna, S.IP., M.Pd., Gr" class="w-full h-full object-cover object-center transform hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-indigo-950/80 via-transparent to-transparent flex items-end p-5">
                            <div class="text-white text-center w-full">
                                <span class="bg-amber-400 text-slate-950 font-black text-[10px] px-3 py-1 rounded-full uppercase tracking-wider">Kepala Sekolah</span>
                            </div>
                        </div>
                    </div>
                    <p class="font-black text-gray-900 text-lg sm:text-xl text-center mt-4 tracking-tight">
                        Anita Carlyna, S.IP., M.Pd., Gr
                    </p>
                    <p class="text-xs text-indigo-600 font-bold text-center">Kepala SMPS IT Ishlahul Ummah Prabumulih</p>
                </div>
            </div>

            {{-- Isi Sambutan --}}
            <div class="lg:col-span-7 space-y-4 reveal-fade-up delay-2 text-center lg:text-left">
                <div class="text-4xl sm:text-5xl text-indigo-200 flex justify-center lg:justify-start leading-none mb-1" aria-hidden="true">
                    <i class="fa-solid fa-quote-left"></i>
                </div>
                
                <h2 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">
                    Sambutan Kepala Sekolah
                </h2>

                <p class="text-xs sm:text-sm text-gray-700 leading-relaxed font-normal">
                    Assalamu'alaikum Warahmatullahi Wabarakatuh. Segala puji bagi Allah SWT yang senantiasa melimpahkan rahmat dan karunia-Nya kepada kita semua. Selamat datang di website resmi <strong>SMPS IT Ishlahul Ummah Prabumulih</strong>. 
                </p>
                <p class="text-xs sm:text-sm text-gray-700 leading-relaxed font-normal">
                    Sebagai sekolah Islam terpadu yang bernaung di bawah <strong>Yayasan Ishlahul Ummah Prabumulih</strong>, kami berkomitmen menyelenggarakan pendidikan bermutu tinggi yang memadukan keunggulan kurikulum nasional, penguatan karakter akhlakul karimah, target tahfidz Qur'an 2 juz mutqin, serta penguasaan sains dan bahasa global. Mari bersama mendidik generasi penerus yang sholih, cerdas, dan siap memimpin masa depan.
                </p>

                <div class="w-24 h-1 bg-indigo-600 mx-auto lg:mx-0 my-4 rounded-full"></div>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3 pt-2 w-full">
                    <a href="{{ route('page.sambutan') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-full font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition space-x-2">
                        <i class="fa-solid fa-book-open"></i>
                        <span>Sambutan Lengkap</span>
                    </a>
                    <a href="{{ route('page.visi-misi') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-slate-900 hover:bg-black text-white px-6 py-2.5 rounded-full font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition space-x-2">
                        <span>Visi &amp; Misi</span>
                        <i class="fa-regular fa-circle-dot"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #2: ARTIKEL & KABAR KAMPUS SEKOLAH
     ======================================================== --}}
<section class="py-12 bg-slate-50 border-t border-gray-100 overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="mb-6 flex flex-col sm:flex-row items-center justify-between text-center sm:text-left gap-3 reveal-fade-up">
            <div>
                <h2 class="text-xl sm:text-2xl font-black text-gray-900 flex items-center justify-center sm:justify-start">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 mr-2" aria-hidden="true"></span>
                    Artikel &amp; Kabar Kampus
                </h2>
                <div class="w-12 h-1 bg-amber-400 mt-1 mx-auto sm:mx-0 rounded-full"></div>
            </div>
            <a href="{{ route('artikel.index') }}" aria-label="Lihat Semua Artikel dan Berita" class="text-xs sm:text-sm font-bold text-indigo-600 hover:text-indigo-800 transition flex items-center">
                Lihat Semua <i class="fa-solid fa-arrow-right ml-1.5 text-xs" aria-hidden="true"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            {{-- Big Headline Card --}}
            @if($featuredPost)
            <div class="lg:col-span-7 reveal-fade-up delay-1">
                <article class="bg-white rounded-3xl shadow-md overflow-hidden border border-gray-100 h-full flex flex-col group">
                    <div class="relative h-60 sm:h-80 overflow-hidden bg-gray-100">
                        <img src="{{ $featuredPost->featured_image_url }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                        @if($featuredPost->categories->isNotEmpty())
                        <span class="absolute top-3 left-3 bg-indigo-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">
                            {{ $featuredPost->categories->first()->name }}
                        </span>
                        @endif
                    </div>
                    <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                        <div class="space-y-2">
                            <div class="text-xs text-gray-600 flex items-center space-x-3">
                                <span><i class="fa-regular fa-calendar-check mr-1 text-indigo-600" aria-hidden="true"></i> {{ $featuredPost->published_at ? $featuredPost->published_at->translatedFormat('d F Y') : '-' }}</span>
                                <span><i class="fa-regular fa-eye mr-1 text-amber-500" aria-hidden="true"></i> {{ $featuredPost->views_count }} views</span>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2">
                                <a href="{{ route('artikel.show', $featuredPost->slug) }}">
                                    {{ $featuredPost->title }}
                                </a>
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-700 line-clamp-3 leading-relaxed">
                                {{ $featuredPost->excerpt }}
                            </p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs font-semibold text-indigo-600">SMPS IT Ishum</span>
                            <a href="{{ route('artikel.show', $featuredPost->slug) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            @endif

            {{-- 3 Side Posts --}}
            <div class="lg:col-span-5 space-y-4">
                @foreach($sidePosts as $index => $sp)
                <article class="bg-white rounded-2xl p-3 sm:p-4 shadow-sm border border-gray-100 hover:shadow-md transition flex items-center space-x-3 sm:space-x-4 group reveal-fade-up delay-{{ $index + 2 }}">
                    <div class="w-20 h-20 sm:w-28 sm:h-24 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                        <img src="{{ $sp->featured_image_url }}" alt="{{ $sp->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.src='/uploads/activities-smpit-ishum.webp'">
                    </div>
                    <div class="flex-1 min-w-0 space-y-1">
                        <div class="text-[11px] text-gray-500 flex items-center space-x-2">
                            <span><i class="fa-regular fa-clock mr-1 text-indigo-600"></i> {{ $sp->published_at ? $sp->published_at->translatedFormat('d M Y') : '' }}</span>
                        </div>
                        <h4 class="font-bold text-xs sm:text-sm text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 leading-snug">
                            <a href="{{ route('artikel.show', $sp->slug) }}">
                                {{ $sp->title }}
                            </a>
                        </h4>
                        <p class="text-[11px] text-gray-500 line-clamp-1">
                            {{ $sp->excerpt }}
                        </p>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #3: PRESTASI SANTRI SMPS IT ISHLAHUL UMMAH
     ======================================================== --}}
<section class="py-12 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-2xl mx-auto mb-8 reveal-fade-up">
            <span class="text-xs uppercase tracking-widest text-amber-500 font-bold block mb-1">Kebanggaan Sekolah</span>
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">
                Prestasi Santri SMPS IT
            </h2>
            <p class="text-xs sm:text-sm text-gray-700 mt-1 font-medium">
                Capaian membanggakan santri SMPS IT Ishlahul Ummah Prabumulih di bidang tahfidz, sains, bahasa, dan keolahragaan
            </p>
            <div class="w-16 h-1 bg-amber-400 mx-auto mt-2.5 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($fraksiPosts as $index => $post)
            <article class="flex flex-col group reveal-fade-up delay-{{ ($index % 4) + 1 }}">
                <div class="aspect-[16/10] overflow-hidden rounded-2xl bg-gray-100 shadow-sm relative">
                    <a href="{{ route('artikel.show', $post->slug) }}" class="block w-full h-full" aria-label="Baca berita: {{ $post->title }}">
                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.src='/uploads/activities-smpit-ishum.webp'">
                    </a>
                    <span class="absolute bottom-2.5 left-2.5 bg-slate-900/80 backdrop-blur-xs text-white text-[10px] font-bold px-2.5 py-0.5 rounded-md">
                        <i class="fa-solid fa-trophy text-amber-400 mr-1"></i> Prestasi
                    </span>
                </div>
                <div class="pt-3 flex-1 flex flex-col justify-between">
                    <h3 class="font-extrabold text-xs sm:text-sm text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 leading-snug">
                        <a href="{{ route('artikel.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <div class="text-[11px] sm:text-xs text-indigo-600 mt-1.5 font-medium">
                        {{ $post->published_at ? $post->published_at->translatedFormat('j F Y') : '' }}
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-8 reveal-fade-up">
            <a href="{{ route('artikel.index') }}?kategori=prestasi" aria-label="Lihat Semua Prestasi Santri" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs sm:text-sm px-7 py-2.5 rounded-full shadow-md transition">
                Lihat Semua Prestasi <i class="fa-solid fa-arrow-right ml-2 text-xs" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #4: AKADEMIK & KESISWAAN (2 Kolom)
     ======================================================== --}}
<section class="py-12 bg-slate-50 border-y border-gray-100 overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- KOLOM 1: AKADEMIK & KURIKULUM --}}
            <div class="bg-white p-5 sm:p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between reveal-fade-up delay-1">
                <div>
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-100">
                        <h2 class="text-lg font-black text-gray-900 flex items-center">
                            <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 mr-2" aria-hidden="true"></span>
                            Akademik &amp; Kurikulum Terpadu
                        </h2>
                        <span class="text-xs text-indigo-600 font-bold">Kurikulum Merdeka + JSIT</span>
                    </div>

                    <div class="space-y-3.5">
                        @foreach($nasionalPosts as $post)
                        <div class="flex items-start space-x-3 group">
                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 mt-0.5">
                                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 leading-snug">
                                    <a href="{{ route('artikel.show', $post->slug) }}">{{ $post->title }}</a>
                                </h4>
                                <span class="text-[11px] text-gray-500 mt-1 block">
                                    <i class="fa-regular fa-calendar mr-1"></i> {{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : '' }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-gray-100 text-right">
                    <a href="{{ route('artikel.index') }}?kategori=akademik" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition inline-flex items-center">
                        Selengkapnya <i class="fa-solid fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            {{-- KOLOM 2: KESISWAAN & ADAB SANTRI --}}
            <div class="bg-white p-5 sm:p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between reveal-fade-up delay-2">
                <div>
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-100">
                        <h2 class="text-lg font-black text-gray-900 flex items-center">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500 mr-2" aria-hidden="true"></span>
                            Kesiswaan &amp; Adab Santri
                        </h2>
                        <span class="text-xs text-amber-600 font-bold">10 Karakter Muwashofat</span>
                    </div>

                    <div class="space-y-3.5">
                        @foreach($daerahPosts as $post)
                        <div class="flex items-start space-x-3 group">
                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 mt-0.5">
                                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition" onerror="this.src='/uploads/tahfidz-smpit-ishum.webp'">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 leading-snug">
                                    <a href="{{ route('artikel.show', $post->slug) }}">{{ $post->title }}</a>
                                </h4>
                                <span class="text-[11px] text-gray-500 mt-1 block">
                                    <i class="fa-regular fa-calendar mr-1"></i> {{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : '' }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-gray-100 text-right">
                    <a href="{{ route('artikel.index') }}?kategori=kesiswaan" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition inline-flex items-center">
                        Selengkapnya <i class="fa-solid fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #5: PROGRAM UNGGULAN
     ======================================================== --}}
<section class="py-12 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-2xl mx-auto mb-8 reveal-fade-up">
            <span class="text-xs uppercase tracking-widest text-indigo-600 font-bold block mb-1">Pilar Pendidikan Islam</span>
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">
                Program Unggulan SMPS IT
            </h2>
            <p class="text-xs sm:text-sm text-gray-700 mt-1 font-medium">
                Tahfidz Al-Qur'an 2 Juz Mutqin, Bilingual Arabic-English, Bina Prestasi Sains &amp; Kepemimpinan Santri
            </p>
            <div class="w-16 h-1 bg-indigo-600 mx-auto mt-2.5 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($senayanPosts as $index => $post)
            <article class="flex flex-col group reveal-fade-up delay-{{ ($index % 4) + 1 }}">
                <div class="aspect-[16/10] overflow-hidden rounded-2xl bg-gray-100 shadow-sm relative">
                    <a href="{{ route('artikel.show', $post->slug) }}" class="block w-full h-full" aria-label="Baca program: {{ $post->title }}">
                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.src='/uploads/tahfidz-smpit-ishum.webp'">
                    </a>
                </div>
                <div class="pt-3 flex-1 flex flex-col justify-between">
                    <h3 class="font-extrabold text-xs sm:text-sm text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 leading-snug">
                        <a href="{{ route('artikel.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <div class="text-[11px] sm:text-xs text-amber-600 mt-1.5 font-medium">
                        {{ $post->published_at ? $post->published_at->translatedFormat('j F Y') : '' }}
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-8 reveal-fade-up">
            <a href="{{ route('dpc.index') }}" aria-label="Lihat Semua Program Unggulan" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs sm:text-sm px-7 py-2.5 rounded-full shadow-md transition">
                Jelajahi Program Unggulan <i class="fa-solid fa-arrow-right ml-2 text-xs" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #6 - 9: DEWAN GURU & TENAGA KEPENDIDIKAN (GTK)
     ======================================================== --}}
<section class="py-12 bg-slate-50 border-t border-gray-100 overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-2xl mx-auto mb-8 reveal-fade-up">
            <span class="text-xs uppercase tracking-widest text-amber-500 font-bold block mb-1">Pendidik Berdedikasi</span>
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">
                Dewan Guru &amp; Tenaga Kependidikan
            </h2>
            <p class="text-xs sm:text-sm text-gray-600 mt-1">
                Para asatidz dan asatidzah berdedikasi tinggi yang membina dan mendidik santri dengan penuh keikhlasan
            </p>
            <div class="w-16 h-1 bg-indigo-600 mx-auto mt-2 rounded-full"></div>
        </div>

        {{-- DESKTOP VIEW --}}
        <div class="hidden md:grid md:grid-cols-4 gap-6">
            @foreach($dewan as $index => $d)
            <div class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 text-center group hover:shadow-xl transition transform hover:-translate-y-1 reveal-fade-up delay-{{ $index + 1 }}">
                <div class="h-64 rounded-2xl overflow-hidden mb-3 bg-gray-100 border border-gray-100">
                    <img src="{{ $d->photo_url }}" alt="Foto {{ $d->name }} - {{ $d->position }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-300" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                </div>
                <h3 class="font-black text-sm text-gray-900 group-hover:text-indigo-600 transition">
                    {{ $d->name }}
                </h3>
                <p class="text-xs text-indigo-600 mt-0.5 font-bold">
                    {{ $d->position }}
                </p>
            </div>
            @endforeach
        </div>

        {{-- MOBILE VIEW --}}
        <div class="grid md:hidden grid-cols-2 gap-3.5">
            @foreach($dewan as $index => $d)
            <div class="bg-white rounded-2xl p-2.5 shadow-sm border border-gray-100 text-center reveal-fade-up delay-{{ $index + 1 }}">
                <div class="h-44 rounded-xl overflow-hidden mb-2 bg-gray-100">
                    <img src="{{ $d->photo_url }}" alt="Foto {{ $d->name }} - {{ $d->position }}" class="w-full h-full object-cover object-top" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                </div>
                <h3 class="font-bold text-xs text-gray-900 leading-tight">
                    {{ $d->name }}
                </h3>
                <p class="text-[10px] text-indigo-600 mt-0.5 font-semibold">
                    {{ $d->position }}
                </p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8 reveal-fade-up">
            <a href="{{ route('dewan.index') }}" aria-label="Lihat Semua Dewan Guru" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs sm:text-sm px-6 py-2.5 rounded-full shadow-md transition">
                Lihat Semua Dewan Guru &amp; GTK <i class="fa-solid fa-arrow-right ml-2 text-xs" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #10: VIDEO KEGIATAN & YOUTUBE RESMI
     ======================================================== --}}
<section class="py-14 bg-slate-950 text-white overflow-hidden relative">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-10 reveal-fade-up">
            <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                Galeri Video Resmi YouTube
            </h2>
            <p class="text-xs sm:text-sm text-amber-400 mt-1 font-semibold">
                Dokumentasi Audio Visual Pembinaan &amp; Aktivitas Kampus SMPS IT Ishlahul Ummah Prabumulih
            </p>
            <div class="w-16 h-1 bg-amber-400 mx-auto mt-3 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($videos as $index => $v)
            <div class="bg-slate-900 rounded-3xl overflow-hidden shadow-xl border border-slate-800 group hover:border-indigo-500 transition reveal-fade-up delay-{{ ($index % 3) + 1 }}">
                <div class="aspect-video relative overflow-hidden bg-black">
                    @if(!empty($v->youtube_id))
                    <iframe class="w-full h-full" src="https://www.youtube-nocookie.com/embed/{{ $v->youtube_id }}" title="{{ $v->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-900 text-gray-500">
                        <i class="fa-brands fa-youtube text-4xl text-red-500"></i>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-xs sm:text-sm text-white group-hover:text-amber-400 transition line-clamp-2">
                        {{ $v->title }}
                    </h3>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10 reveal-fade-up">
            <a href="https://www.youtube.com/@smpitishlahulummahprabumul6398" target="_blank" class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white text-xs sm:text-sm font-bold px-7 py-3 rounded-full shadow-lg transition">
                <i class="fa-brands fa-youtube mr-2 text-base"></i>
                <span>Subscribe Channel YouTube Resmi</span>
            </a>
        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #12: PENGUMUMAN & AGENDA SEKOLAH (2 Kolom)
     ======================================================== --}}
<section class="py-12 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- PENGUMUMAN --}}
            <div class="bg-slate-50 p-6 rounded-3xl border border-gray-100 flex flex-col justify-between reveal-fade-up delay-1">
                <div>
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-200">
                        <h2 class="text-lg font-black text-gray-900 flex items-center">
                            <i class="fa-solid fa-bullhorn text-indigo-600 mr-2"></i> Pengumuman Sekolah
                        </h2>
                        <a href="{{ route('pengumuman.index') }}" class="text-xs text-indigo-600 hover:underline font-bold">Semua</a>
                    </div>
                    <div class="space-y-3">
                        @forelse($announcements as $ann)
                        <div class="bg-white p-4 rounded-2xl border border-gray-100 hover:border-indigo-400 transition shadow-xs">
                            <span class="text-[10px] font-black text-amber-600 uppercase">{{ $ann->created_at ? $ann->created_at->translatedFormat('d F Y') : '-' }}</span>
                            <h4 class="text-xs sm:text-sm font-bold text-gray-900 hover:text-indigo-600 transition mt-1">
                                <a href="{{ route('pengumuman.show', $ann->slug) }}">{{ $ann->title }}</a>
                            </h4>
                        </div>
                        @empty
                        <div class="text-xs text-gray-500 py-4 text-center">Belum ada pengumuman baru.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- AGENDA AKADEMIK --}}
            <div class="bg-slate-50 p-6 rounded-3xl border border-gray-100 flex flex-col justify-between reveal-fade-up delay-2">
                <div>
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-200">
                        <h2 class="text-lg font-black text-gray-900 flex items-center">
                            <i class="fa-solid fa-calendar-days text-amber-500 mr-2"></i> Agenda Akademik
                        </h2>
                        <a href="{{ route('agenda.index') }}" class="text-xs text-amber-600 hover:underline font-bold">Semua</a>
                    </div>
                    <div class="space-y-3">
                        @forelse($agendas as $ag)
                        <div class="bg-white p-4 rounded-2xl border border-gray-100 hover:border-amber-400 transition flex items-start space-x-3.5 shadow-xs">
                            <div class="bg-indigo-50 text-indigo-700 rounded-xl p-2.5 text-center flex-shrink-0 w-14 border border-indigo-100">
                                <span class="block text-sm font-black">{{ $ag->event_date ? $ag->event_date->format('d') : '-' }}</span>
                                <span class="block text-[9px] uppercase font-bold">{{ $ag->event_date ? $ag->event_date->format('M') : '-' }}</span>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-gray-900 hover:text-indigo-600 transition">
                                    <a href="{{ route('agenda.show', $ag->slug) }}">{{ $ag->title }}</a>
                                </h4>
                                <p class="text-[11px] text-gray-500 mt-1">
                                    <i class="fa-solid fa-location-dot text-gray-400 mr-1"></i> {{ $ag->location ?? 'Kampus SMPS IT Ishum' }}
                                </p>
                            </div>
                        </div>
                        @empty
                        <div class="text-xs text-gray-500 py-4 text-center">Belum ada agenda terdekat.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #13: DOKUMENTASI & GALERI FOTO KEGIATAN SANTRI
     ======================================================== --}}
<section class="py-16 bg-slate-950 text-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-10 reveal-fade-up">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                Galeri Foto Santri
            </h2>
            <p class="text-xs sm:text-sm text-amber-400 font-bold tracking-wide mt-2">
                Dokumentasi Pembiasaan Karakter, Praktikum &amp; Aktivitas Kampus SMPS IT Ishlahul Ummah
            </p>
            <div class="w-12 h-1 bg-amber-400 mx-auto mt-2.5 rounded-full"></div>
        </div>

        <div class="space-y-6 sm:space-y-8">
            {{-- ROW 1: SLIDER BARIS ATAS --}}
            <div x-data="{
                current: 0,
                items: {{ Js::from($galleryRow1) }},
                perView: 1,
                timer: null,
                updatePerView() {
                    if (window.innerWidth < 640) {
                        this.perView = 1;
                    } else if (window.innerWidth < 1024) {
                        this.perView = 2;
                    } else {
                        this.perView = 3;
                    }
                },
                maxIndex() {
                    return Math.max(0, this.items.length - this.perView);
                },
                next() {
                    this.current = (this.current >= this.maxIndex()) ? 0 : this.current + 1;
                },
                prev() {
                    this.current = (this.current <= 0) ? this.maxIndex() : this.current - 1;
                },
                start() {
                    this.timer = setInterval(() => this.next(), 4000);
                },
                stop() {
                    clearInterval(this.timer);
                }
            }" x-init="updatePerView(); window.addEventListener('resize', () => updatePerView()); start()" @mouseenter="stop()" @mouseleave="start()" class="relative group/row1">
                
                <div class="overflow-hidden py-2 px-1">
                    <div class="flex transition-transform duration-700 ease-out" :style="'transform: translateX(-' + (current * (100 / perView)) + '%)'">
                        <template x-for="(item, idx) in items" :key="idx">
                            <div class="flex-shrink-0 px-1.5 sm:px-3" :style="'width: ' + (100 / perView) + '%'">
                                <div class="relative h-64 sm:h-80 md:h-96 lg:h-[380px] rounded-3xl overflow-hidden shadow-2xl bg-neutral-900 border border-neutral-800/80 group">
                                    <img :src="item.url" :alt="item.title" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-out" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-5">
                                        <span class="text-xs sm:text-sm font-bold text-white leading-snug drop-shadow-md" x-text="item.title"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <button @click="prev()" class="absolute left-1 sm:left-2 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-11 sm:h-11 rounded-full bg-slate-900/80 hover:bg-indigo-600 text-white flex items-center justify-center border border-white/20 shadow-2xl z-20 backdrop-blur-sm transition duration-200" aria-label="Foto sebelumnya">
                    <i class="fa-solid fa-chevron-left text-xs sm:text-sm"></i>
                </button>
                <button @click="next()" class="absolute right-1 sm:right-2 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-11 sm:h-11 rounded-full bg-slate-900/80 hover:bg-indigo-600 text-white flex items-center justify-center border border-white/20 shadow-2xl z-20 backdrop-blur-sm transition duration-200" aria-label="Foto berikutnya">
                    <i class="fa-solid fa-chevron-right text-xs sm:text-sm"></i>
                </button>
            </div>

            {{-- ROW 2: SLIDER BARIS BAWAH --}}
            <div x-data="{
                current: 0,
                items: {{ Js::from($galleryRow2) }},
                perView: 1,
                timer: null,
                updatePerView() {
                    if (window.innerWidth < 640) {
                        this.perView = 1;
                    } else if (window.innerWidth < 768) {
                        this.perView = 2;
                    } else if (window.innerWidth < 1024) {
                        this.perView = 3;
                    } else {
                        this.perView = 4;
                    }
                },
                maxIndex() {
                    return Math.max(0, this.items.length - this.perView);
                },
                next() {
                    this.current = (this.current >= this.maxIndex()) ? 0 : this.current + 1;
                },
                prev() {
                    this.current = (this.current <= 0) ? this.maxIndex() : this.current - 1;
                },
                start() {
                    this.timer = setInterval(() => this.next(), 4800);
                },
                stop() {
                    clearInterval(this.timer);
                }
            }" x-init="updatePerView(); window.addEventListener('resize', () => updatePerView()); start()" @mouseenter="stop()" @mouseleave="start()" class="relative group/row2">
                
                <div class="overflow-hidden py-2 px-1">
                    <div class="flex transition-transform duration-700 ease-out" :style="'transform: translateX(-' + (current * (100 / perView)) + '%)'">
                        <template x-for="(item, idx) in items" :key="idx">
                            <div class="flex-shrink-0 px-1.5 sm:px-2.5" :style="'width: ' + (100 / perView) + '%'">
                                <div class="relative h-52 sm:h-64 md:h-72 lg:h-80 rounded-2xl overflow-hidden shadow-xl bg-neutral-900 border border-neutral-800/80 group">
                                    <img :src="item.url" :alt="item.title" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-out" onerror="this.src='/uploads/activities-smpit-ishum.webp'">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                                        <span class="text-xs font-bold text-white leading-snug drop-shadow-md" x-text="item.title"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <button @click="prev()" class="absolute left-1 sm:left-2 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-slate-900/80 hover:bg-indigo-600 text-white flex items-center justify-center border border-white/20 shadow-2xl z-20 backdrop-blur-sm transition duration-200" aria-label="Foto sebelumnya">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <button @click="next()" class="absolute right-1 sm:right-2 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-slate-900/80 hover:bg-indigo-600 text-white flex items-center justify-center border border-white/20 shadow-2xl z-20 backdrop-blur-sm transition duration-200" aria-label="Foto berikutnya">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('galeri.index') }}" class="inline-flex items-center space-x-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs sm:text-sm font-black px-8 py-3.5 rounded-2xl shadow-xl transition transform hover:scale-105">
                <i class="fa-regular fa-images text-base"></i>
                <span>Lihat Semua Dokumentasi</span>
            </a>
        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #14: CALL TO ACTION BANNER (SPMB ONLINE)
     ======================================================== --}}
<section class="relative bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-900 text-white py-12 px-4 sm:px-6 lg:px-8 overflow-hidden reveal-fade-up">
    <div class="max-w-6xl mx-auto relative z-10 flex flex-col lg:flex-row items-center justify-between gap-6 text-center lg:text-left">
        <div class="flex-1 min-w-0">
            <span class="inline-block bg-amber-400 text-slate-950 text-xs font-black px-3.5 py-1 rounded-full uppercase tracking-wider mb-2">
                SPMB GELOMBANG EXCLUSIVE
            </span>
            <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-white leading-tight">
                Daftar Sekarang di SMPS IT Ishlahul Ummah Prabumulih
            </h2>
            <p class="text-xs sm:text-sm text-indigo-100 mt-1 max-w-2xl">
                Wujudkan impian putra-putri Anda menjadi generasi berakhlak Qur'ani, cerdas, berdaya saing global, dan berprestasi. Kuota terbatas hanya 24 kursi per kelas!
            </p>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-end gap-3 w-full sm:w-auto">
            <a href="{{ route('ppdb.index') }}" aria-label="Daftar Sekarang SPMB Online" class="w-full sm:w-auto bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-700 text-slate-950 font-black text-xs sm:text-sm px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition min-h-[44px] flex items-center justify-center transform hover:scale-105">
                <span>Daftar SPMB Online</span>
                <i class="fa-solid fa-graduation-cap ml-2 text-slate-950"></i>
            </a>
            <a href="{{ route('download.index') }}" aria-label="Unduh Brosur Informasi" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm px-6 py-3 rounded-full border border-white/20 transition min-h-[44px] flex items-center justify-center">
                Unduh Brosur
            </a>
        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #15: E-LIBRARY & MODUL SISWA
     ======================================================== --}}
<section class="py-14 bg-slate-50 overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <div class="bg-[#0f172a] text-white rounded-3xl p-6 sm:p-10 border border-slate-800 shadow-2xl reveal-fade-up">
            
            <div class="text-center max-w-2xl mx-auto mb-8">
                <span class="text-xs uppercase tracking-widest text-amber-400 font-bold block mb-1">Sumber Belajar Terpadu</span>
                <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    E-Library &amp; Modul Pembelajaran
                </h2>
                <p class="text-xs sm:text-sm text-indigo-300 font-semibold mt-1">
                    Unduh Modul Kurikulum JSIT, Tahfidzul Qur'an &amp; Panduan Belajar Santri
                </p>
                <div class="w-16 h-1 bg-amber-400 mx-auto mt-2 rounded-full"></div>
            </div>

            <div x-data="{
                current: 0,
                items: {{ Js::from($ebooks) }},
                perView: 1,
                timer: null,
                updatePerView() {
                    if (window.innerWidth < 640) {
                        this.perView = 1;
                    } else if (window.innerWidth < 1024) {
                        this.perView = 2;
                    } else {
                        this.perView = 4;
                    }
                },
                maxIndex() {
                    return Math.max(0, this.items.length - this.perView);
                },
                next() {
                    if (this.current >= this.maxIndex()) {
                        this.current = 0;
                    } else {
                        this.current++;
                    }
                },
                prev() {
                    if (this.current <= 0) {
                        this.current = this.maxIndex();
                    } else {
                        this.current--;
                    }
                },
                start() {
                    this.timer = setInterval(() => this.next(), 3500);
                },
                stop() {
                    clearInterval(this.timer);
                }
            }" x-init="updatePerView(); window.addEventListener('resize', () => updatePerView()); start()" @mouseenter="stop()" @mouseleave="start()" class="relative px-1 sm:px-4">
                
                <div class="overflow-hidden py-3">
                    <div class="flex transition-transform duration-500 ease-out" :style="'transform: translateX(-' + (current * (100 / perView)) + '%)'">
                        <template x-for="(eb, idx) in items" :key="idx">
                            <div class="flex-shrink-0 px-2.5 sm:px-3" :style="'width: ' + (100 / perView) + '%'">
                                <a href="{{ route('download.ebook') }}" class="group block relative rounded-2xl overflow-hidden shadow-2xl bg-slate-900 border border-slate-800 transform hover:scale-104 transition duration-300 cursor-pointer h-72 sm:h-80 lg:h-96 w-full" :aria-label="'Unduh modul: ' + eb.title">
                                    <img :src="eb.cover" :alt="eb.title" class="w-full h-full object-cover object-center group-hover:scale-106 transition duration-500" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end justify-center p-3 text-center" aria-hidden="true">
                                        <span class="text-xs font-bold text-white truncate max-w-full" x-text="eb.title"></span>
                                    </div>
                                </a>
                            </div>
                        </template>
                    </div>
                </div>

                <button @click="prev()" class="absolute left-0 sm:left-1 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-11 sm:h-11 rounded-full bg-slate-900/80 hover:bg-indigo-600 text-white flex items-center justify-center transition border border-slate-700 shadow-2xl z-20" aria-label="Modul sebelumnya">
                    <i class="fa-solid fa-chevron-left text-xs sm:text-sm" aria-hidden="true"></i>
                </button>
                <button @click="next()" class="absolute right-0 sm:right-1 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-11 sm:h-11 rounded-full bg-slate-900/80 hover:bg-indigo-600 text-white flex items-center justify-center transition border border-slate-700 shadow-2xl z-20" aria-label="Modul berikutnya">
                    <i class="fa-solid fa-chevron-right text-xs sm:text-sm" aria-hidden="true"></i>
                </button>

                <div class="pt-6 flex justify-center">
                    <a href="{{ route('download.ebook') }}" aria-label="Akses Perpustakaan Digital SMPS IT Ishlahul Ummah Prabumulih" class="w-full sm:w-auto bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-slate-950 font-black text-xs sm:text-sm px-6 sm:px-8 py-3.5 rounded-2xl shadow-xl transition flex items-center justify-center space-x-2 transform hover:scale-105 min-h-[44px]">
                        <i class="fa-solid fa-download" aria-hidden="true"></i>
                        <span>Akses Semua Modul &amp; E-Book</span>
                    </a>
                </div>

            </div>

        </div>

    </div>
</section>

{{-- ========================================================
     SECTION #16: TESTIMONIAL ALUMNI & WALI SANTRI
     ======================================================== --}}
<section class="py-12 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-2xl mx-auto mb-8 reveal-fade-up">
            <span class="text-xs uppercase tracking-widest text-indigo-600 font-bold block mb-1">Kisah Inspiratif</span>
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">
                Testimoni Wali Santri &amp; Alumni
            </h2>
            <p class="text-xs sm:text-sm text-gray-600 mt-1">
                Kesan mendalam mengenai penguatan aqidah, tahfidz Al-Qur'an 2 juz mutqin, dan prestasi akademik di SMPS IT Ishlahul Ummah Prabumulih
            </p>
            <div class="w-16 h-1 bg-indigo-600 mx-auto mt-2 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($testimonials as $index => $t)
            <div class="bg-slate-50 p-5 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between reveal-fade-up delay-{{ $index + 1 }}">
                <div class="space-y-3">
                    <div class="text-amber-500 text-xl" aria-hidden="true">
                        <i class="fa-solid fa-quote-left"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-700 leading-relaxed italic line-clamp-4">
                        "{{ $t->content }}"
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-gray-200/60 flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left space-y-2 sm:space-y-0 sm:space-x-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-xs flex-shrink-0 mx-auto sm:mx-0">
                        <img src="{{ $t->photo_url }}" alt="Foto {{ $t->name }}" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($t->name) }}&background=4338ca&color=fff'">
                    </div>
                    <div class="min-w-0 w-full text-center sm:text-left">
                        <h3 class="font-bold text-xs text-gray-900 break-words leading-tight">{{ $t->name }}</h3>
                        <p class="text-[11px] text-indigo-600 font-semibold break-words mt-0.5">{{ $t->profession ?? 'Wali Santri / Alumni' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8 reveal-fade-up">
            <a href="{{ route('testimonial.index') }}" aria-label="Lihat Semua Testimonial" class="inline-flex items-center bg-slate-900 hover:bg-black text-white font-bold text-xs sm:text-sm px-6 py-2.5 rounded-full shadow transition">
                Lihat Semua Testimoni <i class="fa-solid fa-comments ml-2 text-xs" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

{{-- ========================================================
     SECTION #17: BOTTOM QUICK ACTION CARDS
     ======================================================== --}}
<section class="py-8 bg-slate-50 border-t border-gray-200 overflow-hidden" aria-label="Aksi dan Layanan Cepat">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <h2 class="sr-only">Aksi dan Layanan Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            
            <a href="{{ route('ppdb.index') }}" class="bg-white p-4 rounded-2xl border-t-4 border-indigo-600 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row items-center text-center sm:text-left space-y-2 sm:space-y-0 sm:space-x-3.5 group reveal-fade-up delay-1" aria-label="Pendaftaran SPMB Online SMPS IT Ishlahul Ummah Prabumulih">
                <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-700 flex items-center justify-center text-xl flex-shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition mx-auto sm:mx-0" aria-hidden="true">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-gray-900 group-hover:text-indigo-600 transition">SPMB Online SMPS IT</h3>
                    <p class="text-xs text-gray-600 mt-0.5">Pendaftaran santri baru gelombang exclusive</p>
                </div>
            </a>

            <a href="https://wa.me/6285269908696" target="_blank" class="bg-white p-4 rounded-2xl border-t-4 border-amber-500 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row items-center text-center sm:text-left space-y-2 sm:space-y-0 sm:space-x-3.5 group reveal-fade-up delay-2" aria-label="Hubungi Hotline Sekolah via WhatsApp">
                <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-xl flex-shrink-0 group-hover:bg-amber-500 group-hover:text-white transition mx-auto sm:mx-0" aria-hidden="true">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-gray-900 group-hover:text-amber-600 transition">Hotline WA: 0852-6990-8696</h3>
                    <p class="text-xs text-gray-600 mt-0.5">Layanan informasi SPMB &amp; kegiatan santri</p>
                </div>
            </a>

            <a href="{{ route('donasi') }}" class="bg-white p-4 rounded-2xl border-t-4 border-blue-600 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row items-center text-center sm:text-left space-y-2 sm:space-y-0 sm:space-x-3.5 group reveal-fade-up delay-3" aria-label="Infaq & Beasiswa Ishum">
                <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xl flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition mx-auto sm:mx-0" aria-hidden="true">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-gray-900 group-hover:text-blue-600 transition">Infaq &amp; Beasiswa Santri</h3>
                    <p class="text-xs text-gray-600 mt-0.5">Dukung sarana &amp; beasiswa penghafal Qur'an</p>
                </div>
            </a>

        </div>
    </div>
</section>

@if(($popupSettings['active'] ?? '0') === '1' && !empty($popupSettings['image']))
{{-- ========================================================
     HOMEPAGE PROMO POPUP BANNER MODAL
     ======================================================== --}}
<div id="ishumHomePopupModal" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/80 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
    <div id="ishumHomePopupCard" class="relative bg-white rounded-3xl shadow-2xl overflow-hidden max-w-sm sm:max-w-md w-full transform scale-95 transition-transform duration-300 border border-white/20">
        <button id="closeIshumHomePopupBtn" type="button" aria-label="Tutup Banner Promosi" class="absolute top-3 right-3 z-10 w-9 h-9 bg-black/60 hover:bg-black text-white rounded-full flex items-center justify-center backdrop-blur-md transition shadow-lg cursor-pointer">
            <i class="fa-solid fa-xmark text-base"></i>
        </button>

        <a href="{{ $popupSettings['link'] ?? '/ppdb' }}" target="{{ $popupSettings['target'] ?? '_self' }}" class="block overflow-hidden group">
            <img src="{{ asset($popupSettings['image']) }}" alt="{{ $popupSettings['title'] ?? 'SPMB SMPS IT Ishlahul Ummah' }}" class="w-full h-auto max-h-[70vh] object-contain sm:object-cover group-hover:scale-102 transition duration-500">
        </a>

        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-indigo-950 to-blue-950 text-white flex items-center justify-between gap-3">
            <div class="min-w-0">
                <p class="text-[11px] text-amber-400 font-bold uppercase tracking-wider truncate">
                    {{ $popupSettings['title'] ?? 'SPMB Gelombang Exclusive' }}
                </p>
                <p class="text-xs text-indigo-100 font-medium truncate">
                    {{ $popupSettings['subtitle'] ?? 'Kuota Terbatas 24 Kursi - Cashback 1 Juta Alumni' }}
                </p>
            </div>
            <a href="{{ $popupSettings['link'] ?? '/ppdb' }}" target="{{ $popupSettings['target'] ?? '_self' }}" class="shrink-0 bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 font-black text-xs px-4 py-2.5 rounded-xl shadow-md transition flex items-center space-x-1.5">
                <span>{{ $popupSettings['button_text'] ?? 'Daftar' }}</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('ishumHomePopupModal');
        const card = document.getElementById('ishumHomePopupCard');
        const closeBtn = document.getElementById('closeIshumHomePopupBtn');

        if (!modal) return;

        if (!sessionStorage.getItem('ishum_home_popup_closed')) {
            setTimeout(function () {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('opacity-100');
                card.classList.remove('scale-95');
                card.classList.add('scale-100');
            }, 600);
        }

        function closePopup() {
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.classList.remove('opacity-100');
            card.classList.add('scale-95');
            card.classList.remove('scale-100');
            sessionStorage.setItem('ishum_home_popup_closed', '1');
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closePopup);
        }

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                closePopup();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !modal.classList.contains('pointer-events-none')) {
                closePopup();
            }
        });
    });
</script>
@endif

@endsection
