@extends('layouts.frontend')

@section('title', 'Papan Pengumuman Resmi - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Kumpulan pengumuman resmi akademik, jadwal ujian, informasi PPDB, dan surat edaran SMPS IT Ishlahul Ummah Prabumulih.')

@section('content')
{{-- HERO HEADER --}}
<div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 border-b border-indigo-500/20 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-xs text-indigo-200 mb-3 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span>Informasi</span>
            <span>/</span>
            <span class="text-amber-300 font-semibold">Pengumuman</span>
        </nav>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Papan Pengumuman Sekolah</h1>
        <p class="text-sm text-indigo-100 mt-2 font-light max-w-2xl">
            Informasi penting, edaran akademik, jadwal kegiatan siswa, dan pengumuman resmi SMPS IT Ishlahul Ummah Prabumulih.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    
    <div class="text-center max-w-2xl mx-auto">
        <span class="text-xs font-bold text-orange-500 uppercase tracking-wider block">INFORMASI AKADEMIK</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">
            Pengumuman &amp; Surat Edaran Resmi
        </h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1 font-light">Kumpulan surat edaran resmi, kalender kegiatan, dan publikasi penting sekolah.</p>
        <div class="w-16 h-1 bg-indigo-600 mx-auto rounded-full mt-3"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($pengumuman as $idx => $item)
            <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-md hover:shadow-2xl transition transform hover:-translate-y-1.5 flex flex-col justify-between group reveal-fade-up delay-{{ $idx % 3 }}">
                <div>
                    {{-- FOTO BANNER PENGUMUMAN SEPERTI PROGRAM UNGGULAN --}}
                    <div class="h-48 sm:h-52 w-full overflow-hidden bg-slate-100 relative">
                        <img src="{{ $item->featured_image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.onerror=null; this.src='/uploads/campus-smpit-ishum.webp'">
                        
                        {{-- BADGE KATEGORI (TOP-LEFT) --}}
                        <span class="absolute top-3.5 left-3.5 bg-indigo-600 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-bullhorn text-[10px]"></i> Pengumuman
                        </span>

                        {{-- TANGGAL RILIS (TOP-RIGHT) --}}
                        <span class="absolute top-3.5 right-3.5 bg-white/95 backdrop-blur-sm text-gray-700 text-[10px] font-bold px-2.5 py-1 rounded-full shadow-md">
                            {{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : '' }}
                        </span>
                    </div>

                    <div class="p-6 sm:p-7 space-y-3">
                        <h3 class="text-lg sm:text-xl font-extrabold text-gray-900 group-hover:text-indigo-600 transition leading-snug line-clamp-2">
                            <a href="{{ route('pengumuman.show', $item->slug) }}">{{ $item->title }}</a>
                        </h3>

                        <div class="text-xs text-[#da251c] font-semibold flex items-center">
                            <i class="fa-solid fa-certificate text-[10px] mr-1.5"></i>
                            <span>Publikasi Resmi SMPS IT Ishum</span>
                        </div>

                        <p class="text-xs text-gray-500 line-clamp-3 leading-relaxed font-light">
                            {{ Str::limit(strip_tags($item->content), 120) }}
                        </p>
                    </div>
                </div>

                {{-- FOOTER KARTU --}}
                <div class="px-6 sm:px-7 pb-6 pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                    <a href="{{ route('pengumuman.show', $item->slug) }}" class="inline-flex items-center text-xs font-bold text-indigo-600 hover:text-orange-600 group/link">
                        <span>Rincian Pengumuman</span>
                        <i class="fa-solid fa-arrow-right ml-1.5 text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                    <div class="flex items-center space-x-1.5">
                        @if($item->file_attachment)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-rose-50 text-rose-700" title="Ada Berkas Lampiran">
                                <i class="fa-solid fa-file-pdf mr-1"></i> Lampiran
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 text-gray-400 bg-white rounded-3xl border border-gray-100">
                <i class="fa-solid fa-bullhorn text-4xl text-gray-300 mb-3 block"></i>
                <span>Belum ada pengumuman resmi yang dipublikasikan.</span>
            </div>
        @endforelse
    </div>

    <div class="pt-6">
        {{ $pengumuman->links() }}
    </div>
</div>
@endsection
