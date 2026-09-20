@extends('layouts.frontend')

@section('title', ($page?->meta_title ?: ($page?->title ?: 'Visi dan Misi')) . ' - ' . ($siteSettings['site_name'] ?? 'SMPS IT Ishlahul Ummah Prabumulih'))
@section('meta_description', $page?->meta_description ?: ($page?->excerpt ?: 'Visi dan Misi resmi SMPS IT Ishlahul Ummah Prabumulih: Membentuk generasi Qur\'ani, berakhlak mulia, dan unggul dalam sains teknologi.'))

@section('content')
{{-- HERO HEADER --}}
<div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 border-b border-indigo-500/20 text-white py-10 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
        <nav class="text-xs text-indigo-200 mb-3 flex items-center justify-center sm:justify-start space-x-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span>Profil</span>
            <span>/</span>
            <span class="text-amber-300 font-semibold">{{ $page?->title ?? 'Visi dan Misi' }}</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">{{ $page?->title ?? 'Visi & Misi Sekolah' }}</h1>
        <p class="text-xs sm:text-sm text-indigo-100 mt-2 font-light max-w-2xl mx-auto sm:mx-0">
            {{ $page?->excerpt ?: 'Arah dan komitmen luhur SMPS IT Ishlahul Ummah Prabumulih dalam membimbing generasi unggul berkarakter Qur\'ani dan berwawasan masa depan.' }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-8 sm:py-14">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-10">
        
        {{-- KOLOM UTAMA (2/3) --}}
        <div class="lg:col-span-8 space-y-8">
            <article class="bg-white rounded-3xl p-6 sm:p-10 md:p-12 shadow-xl border border-gray-100 reveal-fade-up space-y-6">
                <div class="border-b border-gray-100 pb-5">
                    <span class="text-xs font-bold text-orange-500 uppercase tracking-wider block">Falsafah Arah &amp; Komitmen</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">
                        {{ $page?->title ?? 'Visi & Misi Sekolah' }}
                    </h2>
                    <div class="w-16 h-1 bg-indigo-600 rounded-full mt-3"></div>
                </div>

                {{-- KONTEN DINAMIS DARI DATABASE / WYSIWYG ADMIN --}}
                <div class="prose-content text-gray-700 text-sm sm:text-base leading-relaxed space-y-6">
                    @if(!empty($page?->content) && strlen(trim(strip_tags($page?->content ?? ''))) > 10)
                        {!! $page?->content !!}
                    @else
                        <div class="bg-gradient-to-r from-emerald-50/90 to-amber-50/70 p-6 sm:p-8 rounded-2xl border-l-4 border-indigo-600 shadow-sm">
                            <h3 class="text-lg font-bold text-indigo-900 mb-2">Visi Sekolah</h3>
                            <p class="text-lg sm:text-xl font-bold text-gray-900 leading-relaxed font-serif italic">
                                “Terwujudnya Generasi Ishum yang Beraqidah Kokoh, Berakhlak Qur'ani, Unggul dalam Sains & Teknologi, serta Berwawasan Lingkungan dan Global.”
                            </p>
                        </div>
                        <div class="space-y-4 pt-4">
                            <h3 class="text-lg font-bold text-gray-900">Misi Sekolah</h3>
                            <ol class="list-decimal pl-6 space-y-2 text-gray-700">
                                <li>Menanamkan aqidah yang lurus, ibadah yang benar, dan akhlak mulia berlandaskan Al-Qur'an dan As-Sunnah.</li>
                                <li>Menyelenggarakan pembelajaran aktif, kreatif, dan menantang untuk meraih prestasi di tingkat kota, provinsi, dan nasional.</li>
                                <li>Membekali siswa dengan kecakapan berbahasa asing (Arab & Inggris) serta kemampuan sains dan nalar matematika.</li>
                                <li>Membina kemampuan tahsin dan tahfidz Al-Qur'an dengan target minimal 2 juz mutqin serta hafalan 12 hadits pilihan.</li>
                                <li>Mewujudkan iklim sekolah yang kondusif, amanah, ramah anak, dan berbudaya Islami.</li>
                            </ol>
                        </div>
                    @endif
                </div>
            </article>
        </div>

        {{-- SIDEBAR KANAN (1/3) --}}
        <div class="lg:col-span-4 space-y-8">
            
            {{-- WIDGET ARTIKEL & BERITA TERBARU --}}
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100 reveal-fade-up">
                <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
                    <h3 class="font-extrabold text-gray-900 text-base">Kabar Sekolah</h3>
                    <a href="{{ route('artikel.index') }}" class="text-xs font-bold text-indigo-600 hover:text-orange-500">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($latestPosts ?? [] as $lp)
                        <a href="{{ route('artikel.show', $lp->slug) }}" class="flex items-center space-x-3 group">
                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{ $lp->featured_image }}" alt="{{ $lp->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-800 group-hover:text-indigo-600 transition line-clamp-2 leading-snug">
                                    {{ $lp->title }}
                                </h4>
                                <span class="text-[11px] text-gray-400 block mt-1">
                                    {{ $lp->published_at ? $lp->published_at->translatedFormat('d M Y') : ($lp->created_at ? $lp->created_at->translatedFormat('d M Y') : '') }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <p class="text-xs text-gray-400 text-center py-4">Belum ada berita terbaru.</p>
                    @endforelse
                </div>
            </div>

            {{-- WIDGET AGENDA --}}
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100 reveal-fade-up delay-1">
                <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
                    <h3 class="font-extrabold text-gray-900 text-base">Agenda Terdekat</h3>
                    <a href="{{ route('agenda.index') }}" class="text-xs font-bold text-indigo-600 hover:text-orange-500">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($latestAgendas ?? [] as $la)
                        <a href="{{ route('agenda.show', $la->slug) }}" class="flex items-start space-x-3 group p-3 rounded-xl hover:bg-indigo-50/50 transition">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-indigo-600 flex flex-col items-center justify-center flex-shrink-0 font-bold text-xs">
                                <span class="text-sm font-extrabold leading-none">{{ $la->event_date ? $la->event_date->format('d') : '01' }}</span>
                                <span class="text-[9px] uppercase">{{ $la->event_date ? $la->event_date->translatedFormat('M') : 'SMP' }}</span>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-800 group-hover:text-indigo-600 transition line-clamp-2 leading-snug">
                                    {{ $la->title }}
                                </h4>
                                <span class="text-[11px] text-gray-400 block mt-1">
                                    <i class="fa-solid fa-location-dot mr-1 text-orange-400"></i> {{ $la->location ?: 'Kampus SMPS IT Ishlahul Ummah Prabumulih' }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <p class="text-xs text-gray-400 text-center py-4">Belum ada agenda terdekat.</p>
                    @endforelse
                </div>
            </div>

            {{-- CTA BANNER JOIN PPDB --}}
            <div class="bg-gradient-to-br from-indigo-950 via-indigo-900 to-blue-950 text-white p-6 sm:p-8 rounded-3xl shadow-xl space-y-4 text-center reveal-fade-up delay-2">
                <div class="w-14 h-14 rounded-2xl bg-red-500/20 text-red-400 flex items-center justify-center text-2xl mx-auto border border-red-500/30">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h3 class="text-xl font-extrabold">PPDB Telah Dibuka!</h3>
                <p class="text-xs text-indigo-100 leading-relaxed">
                    Wujudkan impian putra-putri Anda menjadi hafizh Qur'an yang cerdas sains bersama SMPS IT Ishlahul Ummah Prabumulih.
                </p>
                <div class="pt-2">
                    <a href="{{ route('ppdb.index') }}" class="block w-full bg-[#da251c] hover:bg-[#b91c1c] text-white py-3 rounded-xl font-bold text-xs shadow-lg transition">
                        Daftar PPDB Online
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
