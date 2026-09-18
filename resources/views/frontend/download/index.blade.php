@extends('layouts.frontend')

@section('title', 'Pusat Unduhan & Dokumen Siswa - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Pusat unduhan formulir PPDB, kalender akademik, modul pembelajaran siswa, buku panduan kurikulum, dan logo resmi SMPS IT Ishlahul Ummah Prabumulih.')

@section('content')
{{-- HERO HEADER --}}
<div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 border-b border-indigo-500/20 text-white py-10 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
        <nav class="text-xs text-indigo-200 mb-3 flex items-center justify-center sm:justify-start space-x-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-amber-300 font-semibold">Download</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">Pusat Download Dokumen & Modul</h1>
        <p class="text-xs sm:text-sm text-indigo-100 mt-2 font-light max-w-2xl mx-auto sm:mx-0">
            Unduh formulir pendaftaran PPDB, modul pembelajaran tahfidz & sains, kalender akademik, dan aset logo resmi SMPS IT Ishlahul Ummah Prabumulih.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-8 sm:py-14 space-y-8 sm:space-y-12">
    
    {{-- QUICK CATEGORIES TABS --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 reveal-fade-up">
        <a href="{{ route('download.index') }}" class="p-3 sm:p-4 rounded-2xl border-2 border-indigo-600 bg-indigo-50/60 text-indigo-600 font-bold text-xs sm:text-sm flex items-center justify-center space-x-1.5 sm:space-x-2 shadow-sm text-center">
            <i class="fa-solid fa-folder-open text-xs sm:text-sm"></i>
            <span>Semua Berkas</span>
        </a>
        <a href="{{ route('download.ebook') }}" class="p-3 sm:p-4 rounded-2xl border border-gray-200 bg-white hover:border-indigo-600 hover:text-indigo-600 font-semibold text-xs sm:text-sm flex items-center justify-center space-x-1.5 sm:space-x-2 transition shadow-sm text-center">
            <i class="fa-solid fa-book text-xs sm:text-sm"></i>
            <span>Modul & E-Book</span>
        </a>
        <a href="{{ route('download.hymne-mars') }}" class="p-3 sm:p-4 rounded-2xl border border-gray-200 bg-white hover:border-indigo-600 hover:text-indigo-600 font-semibold text-xs sm:text-sm flex items-center justify-center space-x-1.5 sm:space-x-2 transition shadow-sm text-center">
            <i class="fa-solid fa-music text-xs sm:text-sm"></i>
            <span>Hymne & Mars</span>
        </a>
        <a href="{{ route('download.logo') }}" class="p-3 sm:p-4 rounded-2xl border border-gray-200 bg-white hover:border-indigo-600 hover:text-indigo-600 font-semibold text-xs sm:text-sm flex items-center justify-center space-x-1.5 sm:space-x-2 transition shadow-sm text-center">
            <i class="fa-solid fa-image text-xs sm:text-sm"></i>
            <span>Logo Resmi</span>
        </a>
    </div>

    {{-- DOWNLOADS TABLE --}}
    <div class="bg-white rounded-3xl p-4 sm:p-8 md:p-10 shadow-xl border border-gray-100 reveal-fade-up delay-1">
        <div class="flex flex-col sm:flex-row items-center sm:items-center justify-between gap-4 mb-6 text-center sm:text-left">
            <div>
                <span class="text-xs font-bold text-orange-500 uppercase tracking-wider block">Arsip Dokumen Akademik</span>
                <h2 class="text-lg sm:text-2xl font-extrabold text-gray-900 mt-1">Daftar Dokumen & Berkas Publik</h2>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="text-xs uppercase bg-gray-50 text-gray-500 font-bold border-b border-gray-100">
                    <tr>
                        <th class="py-3 px-4">Nama File / Dokumen</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4">Format</th>
                        <th class="py-3 px-4 text-center">Diunduh</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($downloads as $dl)
                        <tr class="hover:bg-indigo-50/50 transition">
                            <td class="py-4 px-4 font-bold text-gray-900 flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-indigo-600 flex items-center justify-center flex-shrink-0 text-base">
                                    @if(in_array(strtoupper($dl->file_type), ['MP3', 'WAV']))
                                        <i class="fa-solid fa-music"></i>
                                    @elseif(in_array(strtoupper($dl->file_type), ['PDF']))
                                        <i class="fa-solid fa-file-pdf"></i>
                                    @elseif(in_array(strtoupper($dl->file_type), ['PNG', 'JPG', 'WEBP', 'SVG']))
                                        <i class="fa-solid fa-file-image"></i>
                                    @else
                                        <i class="fa-solid fa-file"></i>
                                    @endif
                                </div>
                                <span class="leading-snug">{{ $dl->title }}</span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="text-xs bg-gray-100 px-2.5 py-1 rounded-full text-gray-600 font-medium">
                                    {{ $dl->category_type ?: 'Akademik' }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="text-xs font-bold text-orange-600">
                                    {{ strtoupper($dl->file_type ?: 'FILE') }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center text-xs text-gray-400">
                                {{ number_format($dl->download_count) }} kali
                            </td>
                            <td class="py-4 px-4 text-right">
                                <a href="{{ route('download.file', $dl->id) }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow transition">
                                    <i class="fa-solid fa-download mr-1.5"></i> Unduh
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-400">
                                <i class="fa-solid fa-box-open text-3xl text-gray-300 mb-2 block"></i>
                                <span>Belum ada file di kategori ini.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-6">
            {{ $downloads->links() }}
        </div>
    </div>

</div>
@endsection
