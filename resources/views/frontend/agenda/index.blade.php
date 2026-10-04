@extends('layouts.frontend')

@section('title', 'Agenda Akademik & Kegiatan - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Jadwal dan kalender agenda kegiatan akademik, ujian, perlombaan, tasmi\' Qur\'an, dan ekstrakurikuler SMPS IT Ishlahul Ummah Prabumulih.')

@section('content')
{{-- HERO HEADER --}}
<div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 border-b border-indigo-500/20 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-xs text-indigo-200 mb-3 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span>Informasi</span>
            <span>/</span>
            <span class="text-amber-300 font-semibold">Agenda Kegiatan</span>
        </nav>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Agenda Akademik & Siswa</h1>
        <p class="text-sm text-indigo-100 mt-2 font-light max-w-2xl">
            Jadwal kegiatan belajar, agenda tasmi' Al-Qur'an, olimpiade sains, dan ekstrakurikuler SMPS IT Ishlahul Ummah Prabumulih.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
    
    <div class="text-center max-w-2xl mx-auto">
        <span class="text-xs font-bold text-orange-500 uppercase tracking-wider block">KALENDER AKADEMIK</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">
            Agenda Kegiatan Terjadwal
        </h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1 font-light">Informasi jadwal kegiatan, perlombaan, dan agenda resmi sekolah terpadu.</p>
        <div class="w-16 h-1 bg-indigo-600 mx-auto rounded-full mt-3"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($agendas as $idx => $agenda)
            <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-md hover:shadow-2xl transition transform hover:-translate-y-1.5 flex flex-col justify-between group reveal-fade-up delay-{{ $idx % 3 }}">
                <div>
                    {{-- FOTO BANNER AGENDA SEPERTI PROGRAM UNGGULAN --}}
                    <div class="h-48 sm:h-52 w-full overflow-hidden bg-slate-100 relative">
                        <img src="{{ $agenda->featured_image_url }}" alt="{{ $agenda->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.onerror=null; this.src='/uploads/activities-smpit-ishum.webp'">
                        
                        {{-- STATUS BADGE (TOP-LEFT) --}}
                        @php
                            $statusLabel = match($agenda->status) {
                                'upcoming' => 'Akan Datang',
                                'ongoing' => 'Sedang Berlangsung',
                                'completed' => 'Selesai',
                                default => 'Aktif',
                            };
                            $statusBg = match($agenda->status) {
                                'upcoming' => 'bg-indigo-600 text-white',
                                'ongoing' => 'bg-amber-500 text-white',
                                'completed' => 'bg-slate-700/90 text-white',
                                default => 'bg-emerald-600 text-white',
                            };
                        @endphp
                        <span class="absolute top-3.5 left-3.5 {{ $statusBg }} text-[10px] font-bold px-3 py-1 rounded-full shadow-md uppercase tracking-wider flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full {{ $agenda->status === 'ongoing' ? 'bg-amber-200 animate-ping' : 'bg-white' }}"></span>
                            {{ $statusLabel }}
                        </span>

                        {{-- DATE BADGE (TOP-RIGHT) --}}
                        <div class="absolute top-3.5 right-3.5 bg-white/95 backdrop-blur-sm border border-white/60 rounded-2xl px-3 py-1.5 text-center shadow-md">
                            <span class="block text-base font-extrabold text-indigo-700 leading-tight">
                                {{ $agenda->event_date ? $agenda->event_date->format('d') : '01' }}
                            </span>
                            <span class="block text-[10px] font-extrabold uppercase text-gray-700 leading-tight">
                                {{ $agenda->event_date ? $agenda->event_date->translatedFormat('M Y') : '2026' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 sm:p-7 space-y-3">
                        <h3 class="text-lg sm:text-xl font-extrabold text-gray-900 group-hover:text-indigo-600 transition leading-snug line-clamp-2">
                            <a href="{{ route('agenda.show', $agenda->slug) }}">{{ $agenda->title }}</a>
                        </h3>

                        {{-- WAKTU & TANGGAL LENGKAP --}}
                        <div class="text-xs text-indigo-600 font-semibold flex items-center">
                            <i class="fa-regular fa-calendar-days mr-2 text-xs flex-shrink-0"></i>
                            <span>{{ $agenda->event_date ? $agenda->event_date->translatedFormat('l, d F Y') : '-' }}</span>
                        </div>

                        {{-- LOKASI --}}
                        <div class="text-xs text-gray-600 flex items-center font-medium">
                            <i class="fa-solid fa-location-dot text-orange-500 mr-2 text-xs flex-shrink-0"></i>
                            <span class="line-clamp-1">{{ $agenda->location ?: 'Sekolah SMPS IT Ishlahul Ummah' }}</span>
                        </div>

                        {{-- RINGKASAN DESKRIPSI --}}
                        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed font-light">
                            {!! strip_tags($agenda->content) !!}
                        </p>
                    </div>
                </div>

                {{-- FOOTER KARTU --}}
                <div class="px-6 sm:px-7 pb-6 pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                    <a href="{{ route('agenda.show', $agenda->slug) }}" class="inline-flex items-center text-xs font-bold text-indigo-600 hover:text-orange-600 group/link">
                        <span>Detail Agenda</span>
                        <i class="fa-solid fa-arrow-right ml-1.5 text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                    <div class="flex items-center space-x-1.5">
                        @if($agenda->file_attachment)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-emerald-50 text-emerald-700" title="Ada Berkas Lampiran">
                                <i class="fa-solid fa-paperclip mr-1"></i> Berkas
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 text-gray-400 bg-white rounded-3xl border border-gray-100">
                <i class="fa-regular fa-calendar-xmark text-4xl text-gray-300 mb-3 block"></i>
                <span>Belum ada agenda kegiatan terbaru yang dijadwalkan.</span>
            </div>
        @endforelse
    </div>

    <div class="pt-6">
        {{ $agendas->links() }}
    </div>
</div>
@endsection
