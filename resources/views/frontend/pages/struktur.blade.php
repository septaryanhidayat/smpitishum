@extends('layouts.frontend')

@section('title', 'Struktur Organisasi - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Bagan struktur organisasi dan manajemen SMPS IT Ishlahul Ummah Prabumulih.')

@section('content')
{{-- HERO HEADER --}}
<div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 border-b border-indigo-500/20 text-white py-10 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
        <nav class="text-xs text-indigo-200 mb-3 flex items-center justify-center sm:justify-start space-x-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span>Profil</span>
            <span>/</span>
            <span class="text-amber-300 font-semibold">Struktur Organisasi</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">Struktur Organisasi Sekolah</h1>
        <p class="text-xs sm:text-sm text-indigo-100 mt-2 font-light max-w-2xl mx-auto sm:mx-0">
            Susunan manajemen kepemimpinan dan organisasi SMPS IT Ishlahul Ummah Prabumulih.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-8 sm:py-14 space-y-12 sm:space-y-16">
    
    {{-- SEKSI 1: STRUKTUR ORGANISASI SEKOLAH (KOSONGKAN JIKA TIDAK ADA NAMA2 RESMI / DATA DARI DB) --}}
    <section class="bg-white p-5 sm:p-8 md:p-12 rounded-3xl shadow-xl border border-gray-100 reveal-fade-up">
        <div class="text-center max-w-2xl mx-auto mb-8">
            <span class="text-xs font-bold text-[#da251c] uppercase tracking-wider block">Bagan Organisasi</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">
                Struktur Organisasi Sekolah
            </h2>
            <div class="w-16 h-1 bg-indigo-600 mx-auto rounded-full mt-3"></div>
        </div>

        @if(!empty($page?->content) && trim(strip_tags($page->content)) !== '')
            <div class="prose-content max-w-4xl mx-auto text-gray-700 text-left sm:text-justify text-xs sm:text-base leading-relaxed bg-slate-50/70 p-5 sm:p-10 rounded-2xl border border-slate-100">
                {!! $page->content !!}
            </div>
        @else
            <div class="max-w-md mx-auto text-center py-8 sm:py-12 px-4 space-y-4">
                <div class="w-16 h-16 rounded-2xl bg-indigo-50/60 text-indigo-600 flex items-center justify-center text-3xl mx-auto shadow-inner">
                    <i class="fa-solid fa-sitemap"></i>
                </div>
                <h3 class="font-bold text-gray-800 text-base">Bagan Struktur Organisasi</h3>
                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed font-light">
                    Susunan bagan dan formatur struktur organisasi SMPS IT Ishlahul Ummah Prabumulih saat ini sedang dalam proses pembaruan data resmi.
                </p>
            </div>
        @endif
    </section>

    {{-- SEKSI 2: FASILITAS & SARANA PRASARANA SEKOLAH --}}
    <section class="bg-white p-5 sm:p-8 md:p-12 rounded-3xl shadow-xl border border-gray-100 reveal-fade-up">
        <div class="flex flex-col sm:flex-row items-center sm:items-center justify-between gap-4 mb-8 text-center sm:text-left">
            <div>
                <span class="text-xs font-bold text-[#da251c] uppercase tracking-wider block">Sarana &amp; Prasarana Sekolah</span>
                <h2 class="text-xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">Fasilitas Unggulan SMPS IT Ishlahul Ummah Prabumulih</h2>
            </div>
            <a href="{{ route('bidang.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center text-xs font-bold text-indigo-600 hover:text-[#da251c] flex-shrink-0 transition">
                <span>Lihat Selengkapnya</span>
                <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($bidangs as $b)
                <a href="{{ route('bidang.show', $b->slug) }}" class="rounded-2xl border border-gray-100 hover:border-indigo-600 hover:shadow-xl transition group bg-white overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="h-44 w-full overflow-hidden bg-slate-100 relative">
                            <img src="{{ $b->thumbnail_url }}" alt="{{ $b->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                            <span class="absolute top-3 left-3 bg-indigo-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow">
                                Fasilitas Sekolah
                            </span>
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-sm sm:text-base text-gray-900 group-hover:text-indigo-600 transition">{{ $b->name }}</h3>
                            <p class="text-xs text-gray-500 mt-1.5 line-clamp-2 leading-relaxed font-light">{{ Str::limit(strip_tags($b->description), 80) }}</p>
                        </div>
                    </div>
                    <div class="px-5 pb-4 pt-2 border-t border-gray-50 flex items-center justify-between text-xs text-indigo-600 font-bold">
                        <span>Rincian Fasilitas</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition"></i>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-8 text-gray-400">
                    Belum ada data fasilitas.
                </div>
            @endforelse
        </div>
    </section>

    {{-- SEKSI 3: PROGRAM UNGGULAN SEKOLAH --}}
    <section class="bg-white p-5 sm:p-8 md:p-12 rounded-3xl shadow-xl border border-gray-100 reveal-fade-up">
        <div class="flex flex-col sm:flex-row items-center sm:items-center justify-between gap-4 mb-8 text-center sm:text-left">
            <div>
                <span class="text-xs font-bold text-[#da251c] uppercase tracking-wider block">Kurikulum &amp; Karakter</span>
                <h2 class="text-xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">
                    Program Unggulan Siswa Ishum
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1 font-light">Mengasah kecakapan santri menjadi pribadi cerdas, mandiri, dan berjiwa pelopor.</p>
            </div>
            <a href="{{ route('dpc.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center text-xs font-bold text-indigo-600 hover:text-[#da251c] flex-shrink-0 transition">
                <span>Lihat Semua Program</span>
                <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @forelse($dpcs->take(8) as $dpc)
                <div class="rounded-2xl border border-gray-100 bg-white hover:border-indigo-600 hover:shadow-lg transition overflow-hidden group flex flex-col justify-between">
                    <div>
                        <div class="h-32 w-full overflow-hidden bg-slate-100 relative">
                            <img src="{{ $dpc->thumbnail_url }}" alt="{{ $dpc->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.src='/uploads/tahfidz-ishum.webp'">
                        </div>
                        <div class="p-4 space-y-1">
                            <span class="text-[10px] font-bold text-indigo-600 block truncate uppercase tracking-wider">{{ $dpc->address ?: 'Program Unggulan' }}</span>
                            <h3 class="font-bold text-xs sm:text-sm text-gray-900 group-hover:text-indigo-600 transition line-clamp-1">{{ $dpc->name }}</h3>
                            <p class="text-[11px] text-gray-500 line-clamp-2 leading-relaxed font-light">{{ Str::limit(strip_tags($dpc->description), 65) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8 text-gray-400">
                    Belum ada data program.
                </div>
            @endforelse
        </div>
    </section>

</div>
@endsection
