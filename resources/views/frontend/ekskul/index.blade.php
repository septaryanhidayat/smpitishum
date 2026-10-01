@extends('layouts.frontend')

@section('title', 'Ekstrakurikuler & Club - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Kegiatan ekstrakurikuler dan klub minat bakat di SMPS IT Ishlahul Ummah Prabumulih: Pramuka SIT, Robotika IT, Tahfidz TTQ, Seni Hadrah, Olahraga, dan Bahasa.')

@section('content')
<div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 border-b border-indigo-500/20 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-xs text-indigo-200 mb-3 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-amber-300 font-semibold">Ekstrakurikuler &amp; Club</span>
        </nav>
        <div class="flex items-center space-x-3.5">
            <div class="w-12 h-12 rounded-2xl bg-amber-400 text-slate-950 flex items-center justify-center font-bold text-2xl shadow-md">
                <i class="fa-solid fa-people-group"></i>
            </div>
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white">Ekstrakurikuler &amp; Club</h1>
                <p class="text-xs sm:text-sm text-indigo-100 mt-1 font-light">
                    Mengasah minat bakat, kepemimpinan, kemandirian, dan persaudaraan santri SMPS IT Ishlahul Ummah.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">

    <div class="text-center max-w-2xl mx-auto">
        <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider block">PENGEMBANGAN DIRI SISWA</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">
            Pilihan Klub &amp; Kegiatan Ekstrakurikuler
        </h2>
        <p class="text-xs sm:text-sm text-gray-500 font-normal mt-1">Wadah berprestasi, berkreasi, dan melatih kecakapan abad ke-21 yang berlandaskan akhlak Qur'ani</p>
        <div class="w-16 h-1 bg-amber-400 mx-auto rounded-full mt-3"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($ekskul as $idx => $item)
            <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group reveal-fade-up">
                <div class="relative h-56 overflow-hidden bg-gray-100">
                    <a href="{{ route('ekskul.show', $item->slug) }}" class="block w-full h-full">
                        <img src="{{ $item->featured_image ?: '/uploads/campus-smpit-ishum.webp' }}" alt="{{ $item->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                    </a>
                    <span class="absolute top-3 left-3 bg-indigo-600/90 backdrop-blur-xs text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-md flex items-center space-x-1.5">
                        <i class="fa-solid fa-star text-amber-300 text-xs"></i>
                        <span>Club Unggulan</span>
                    </span>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg sm:text-xl group-hover:text-indigo-600 transition leading-snug">
                            <a href="{{ route('ekskul.show', $item->slug) }}">
                                {{ $item->title }}
                            </a>
                        </h3>
                        <div class="prose text-xs sm:text-sm text-gray-600 mt-2 line-clamp-3 leading-relaxed font-light">
                            {!! strip_tags($item->content) !!}
                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500 font-medium inline-flex items-center">
                            <i class="fa-solid fa-circle-check text-emerald-500 mr-1.5 text-xs"></i> Aktif Setiap Pekan
                        </span>
                        <a href="{{ route('ekskul.show', $item->slug) }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition inline-flex items-center">
                            <span>Detail Klub</span>
                            <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-gray-100 shadow-sm space-y-3">
                <i class="fa-solid fa-people-group text-4xl text-gray-300 block"></i>
                <h3 class="text-base font-bold text-gray-700">Data Ekstrakurikuler Sedang Dipersiapkan</h3>
                <p class="text-xs text-gray-500 max-w-md mx-auto">Informasi detail kegiatan klub minat bakat sekolah akan segera ditampilkan di sini.</p>
            </div>
        @endforelse
    </div>

    {{-- BANNER KONSULTASI EKSKUL --}}
    <div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-1 text-center md:text-left">
            <span class="text-xs uppercase tracking-wider text-amber-300 font-bold block">Pusat Minat &amp; Bakat Santri</span>
            <h3 class="text-xl sm:text-2xl font-black">Tertarik dengan Pilihan Ekstrakurikuler di SMPS IT Ishum?</h3>
            <p class="text-xs sm:text-sm text-indigo-100 font-light">Daftarkan putra-putri Anda melalui SPMB Online atau hubungi guru pembina kami.</p>
        </div>
        <div class="flex items-center space-x-3 shrink-0">
            <a href="{{ route('ppdb.index') }}" class="bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-slate-950 px-5 py-3 rounded-full text-xs font-black shadow-lg transition">
                <i class="fa-solid fa-graduation-cap mr-1.5"></i> Daftar SPMB
            </a>
            <a href="{{ route('hubungi') }}" class="bg-white/10 hover:bg-white/20 text-white px-5 py-3 rounded-full text-xs font-bold transition">
                Hubungi Kami
            </a>
        </div>
    </div>

</div>
@endsection
