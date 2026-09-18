@extends('layouts.frontend')

@section('title', 'Sambutan Kepala Sekolah - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Sambutan resmi Kepala Sekolah SMPS IT Ishlahul Ummah Prabumulih, Anita Carlyna, S.IP., M.Pd., Gr.')

@section('content')
{{-- HERO HEADER --}}
<div class="bg-gradient-to-r from-gray-900 to-[#00913e] text-white py-10 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
        <nav class="text-xs text-gray-300 mb-3 flex items-center justify-center sm:justify-start space-x-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span>Profil</span>
            <span>/</span>
            <span class="text-amber-400 font-bold">Sambutan Kepala Sekolah</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">Sambutan Kepala Sekolah</h1>
        <p class="text-xs sm:text-sm text-gray-200 mt-2 font-light">
            Pesan dan komitmen pembinaan karakter, iman, dan ilmu di SMPS IT Ishlahul Ummah Prabumulih.
        </p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-3 sm:px-6 lg:px-8 py-8 sm:py-14">
    <div class="bg-white rounded-3xl p-5 sm:p-8 md:p-12 shadow-xl border border-gray-100 reveal-fade-up">
        @php
            $kepsekPhoto = $kepsek?->photo ?: '/uploads/dewan/kepala-sekolah.webp';
            $kepsekName = $kepsek?->name ?: 'Anita Carlyna, S.IP., M.Pd., Gr';
            $kepsekPos = $kepsek?->position ?: 'Kepala Sekolah SMPS IT Ishlahul Ummah Prabumulih';
        @endphp

        {{-- PROFIL PIMPINAN HEADER --}}
        <div class="flex flex-col md:flex-row items-center gap-6 sm:gap-8 mb-8 pb-8 border-b border-gray-100 text-center md:text-left">
            <div class="w-44 h-52 sm:w-52 sm:h-60 rounded-2xl overflow-hidden shadow-lg border-4 border-white ring-4 ring-indigo-100 flex-shrink-0 bg-indigo-50 mx-auto md:mx-0">
                <img src="{{ asset($kepsekPhoto) }}" alt="{{ $kepsekName }} - {{ $kepsekPos }}" class="w-full h-full object-cover object-top" onerror="this.src='/uploads/logo-ishum-square.png'">
            </div>
            <div class="space-y-2 text-center md:text-left">
                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-bold px-3.5 py-1.5 rounded-full uppercase tracking-wider">
                    {{ $kepsekPos }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                    {{ $kepsekName }}
                </h2>
                <p class="text-xs sm:text-sm text-indigo-600 font-semibold">Pendidik Berpengalaman &amp; Praktisi Pendidikan Karakter Islami</p>
                <p class="text-xs sm:text-sm text-gray-600 italic pt-1">"Membina Generasi Qur'ani, Berakhlak Mulia, Cerdas, dan Siap Memimpin Peradaban Masa Depan."</p>
            </div>
        </div>

        {{-- KONTEN PIDATO RESMI (RATA PENUH & RAPI) --}}
        <div class="prose-content text-gray-800 text-xs sm:text-sm md:text-base leading-relaxed space-y-5 text-left sm:text-justify max-w-4xl mx-auto">
            @if(!empty($page->content) && strlen(trim(strip_tags($page->content))) > 30)
                {!! $page->content !!}
            @else
                <p class="font-semibold text-gray-900 text-sm sm:text-lg">Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>

                <p>Alhamdulillahirabbil'alamin, segala puji dan syukur senantiasa kita panjatkan ke hadirat Allah Subhanahu Wa Ta'ala atas limpahan rahmat, taufik, serta hidayah-Nya. Shalawat beriring salam semoga senantiasa tercurah kepada uswah hasanah kita, Nabi Muhammad Shallallahu 'Alaihi Wasallam, keluarga, sahabat, dan para pengikutnya hingga akhir zaman.</p>

                <p>Selamat datang di laman resmi <strong>SMPS IT Ishlahul Ummah Prabumulih</strong>. Website ini kami hadirkan sebagai media keterbukaan informasi, sarana komunikasi, dan etalase karya serta prestasi seluruh civitas akademika keluarga besar Ishum.</p>

                <p>Dunia pendidikan saat ini menghadapi tantangan globalisasi dan disrupsi teknologi yang sangat cepat. Oleh karena itu, SMPS IT Ishlahul Ummah Prabumulih berkomitmen memadukan <strong>Kurikulum Nasional (Kurikulum Merdeka)</strong> dengan <strong>Kurikulum Khusus Keislaman Terpadu</strong>, penguatan <strong>Tahfidzul Qur'an bersanad</strong>, penguasaan sains dan teknologi modern, serta pembinaan akhlakul karimah melalui sistem <em>Bina Pribadi Islam (BPI)</em>.</p>

                <p>Kami meyakini bahwa setiap anak memiliki potensi istimewa yang dianugerahkan Allah SWT. Tugas kami bersama para ustadz dan ustadzah yang berdedikasi adalah mendampingi, memantik potensi tersebut, dan membimbing mereka agar tumbuh menjadi generasi yang kokoh akidahnya, rajin ibadahnya, berakhlak mulia, cerdas inteleknya, serta berjiwa kepemimpinan.</p>

                <p>Kami mengucapkan terima kasih yang sebesar-besarnya kepada seluruh orang tua/wali murid atas amanah dan kepercayaan yang diberikan kepada kami. Mari bersama-sama bersinergi melahirkan generasi khaira ummah yang membanggakan keluarga, bangsa, dan agama.</p>

                <p class="font-semibold text-gray-900 pt-2">Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>

                <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center sm:items-center justify-between gap-4 text-center sm:text-left">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm sm:text-base">{{ strtoupper($kepsekName) }}</h3>
                        <p class="text-xs text-gray-500">{{ $kepsekPos }}</p>
                    </div>
                    <div class="inline-flex items-center space-x-2 bg-green-50 px-4 py-2 rounded-xl text-xs text-indigo-600 border border-green-200">
                        <i class="fa-solid fa-certificate text-[#da251c]"></i>
                        <span>Akreditasi A Unggul</span>
                    </div>
                </div>
            @endif
        </div>

        {{-- CTA DAFTAR SPMB --}}
        <div class="mt-10 pt-8 border-t border-gray-100 bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-900 rounded-2xl p-5 sm:p-8 text-white flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xl border border-indigo-500/30 text-center sm:text-left">
            <div>
                <h4 class="text-lg sm:text-xl font-extrabold text-white">Pendaftaran Siswa Baru (SPMB Online)</h4>
                <p class="text-xs sm:text-sm text-indigo-200 mt-1">Mari bergabung bersama keluarga besar SMPS IT Ishlahul Ummah Prabumulih. Gelombang exclusive kuota terbatas telah dibuka.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto flex-shrink-0">
                <a href="{{ route('ppdb.index') }}" class="w-full sm:w-auto justify-center text-center bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 hover:from-amber-500 hover:to-amber-700 text-slate-950 px-6 py-2.5 rounded-xl font-black text-xs shadow-lg transition flex items-center transform hover:scale-105">
                    <i class="fa-solid fa-graduation-cap mr-1.5"></i> Daftar SPMB Online
                </a>
                <a href="{{ route('hubungi') }}" class="w-full sm:w-auto justify-center text-center bg-white/10 hover:bg-white/20 text-white border border-white/20 px-5 py-2.5 rounded-xl font-bold text-xs shadow transition flex items-center">
                    <i class="fa-solid fa-phone mr-1.5 text-amber-400"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
