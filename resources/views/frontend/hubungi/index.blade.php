@extends('layouts.frontend')

@section('title', 'Hubungi Kami & Informasi PPDB - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Kontak resmi SMPS IT Ishlahul Ummah Prabumulih: Nomor telepon, WhatsApp humas PPDB, email resmi, alamat kampus, dan formulir pesan.')

@section('content')
{{-- HERO HEADER --}}
<div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 border-b border-indigo-500/20 text-white py-10 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
        <nav class="text-xs text-indigo-200 mb-3 flex items-center justify-center sm:justify-start space-x-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-amber-300 font-semibold">Hubungi Kami</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">Hubungi SMPS IT Ishlahul Ummah Prabumulih</h1>
        <p class="text-xs sm:text-sm text-indigo-100 mt-2 font-light max-w-2xl mx-auto sm:mx-0">
            Kami siap melayani pertanyaan seputar PPDB, kurikulum tahfidz & sains, program asrama, maupun kunjungan ke kampus.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-8 sm:py-14 space-y-10 sm:space-y-12">
    
    {{-- GOOGLE MAPS EMBED ATAS --}}
    <div class="rounded-3xl overflow-hidden shadow-xl border border-gray-100 h-64 sm:h-96 reveal-fade-up">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15935.918903337965!2d104.642145!3d-3.232491!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b9991cb45aaab%3A0x28dfaa3303668f80!2sPrabumulih%20Mulya%2C%20Prabumulih%2C%20Ogan%20Ilir%20Regency%2C%20South%20Sumatra!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    {{-- SUBTITLE --}}
    <div class="text-center max-w-2xl mx-auto reveal-fade-up">
        <span class="text-xs font-bold text-orange-500 uppercase tracking-wider block">Layanan Informasi & Konsultasi</span>
        <h2 class="text-xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">
            Silakan Hubungi Tim Humas & Layanan Sekolah Kami
        </h2>
        <div class="w-16 h-1 bg-indigo-600 mx-auto rounded-full mt-3"></div>
    </div>

    {{-- 4 ICON BOXES --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
        {{-- Box 1: Phone --}}
        <div class="bg-white p-5 sm:p-8 rounded-3xl shadow-md border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-1 space-y-4 reveal-fade-up text-center sm:text-left">
            <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-indigo-600 flex items-center justify-center text-2xl shadow-inner mx-auto sm:mx-0">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Telepon Kantor :</span>
                <a href="tel:{{ $siteSettings['contact_phone'] ?? '0852-6990-8696' }}" class="text-base font-extrabold text-gray-900 hover:text-indigo-600 transition mt-1 block">
                    {{ $siteSettings['contact_phone'] ?? '0852-6990-8696' }}
                </a>
                <p class="text-xs text-gray-500 mt-1">Layanan administrasi tata usaha pada jam kerja (07.30 - 16.00 WIB).</p>
            </div>
        </div>

        {{-- Box 2: Email --}}
        <div class="bg-white p-5 sm:p-8 rounded-3xl shadow-md border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-1 space-y-4 reveal-fade-up delay-1 text-center sm:text-left">
            <div class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl shadow-inner mx-auto sm:mx-0">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Email Resmi :</span>
                <a href="mailto:{{ $siteSettings['contact_email'] ?? 'smpitishlahulummah.2015@yahoo.com' }}" class="text-xs sm:text-sm font-extrabold text-gray-900 hover:text-indigo-600 transition mt-1 block break-all">
                    {{ $siteSettings['contact_email'] ?? 'smpitishlahulummah.2015@yahoo.com' }}
                </a>
                <p class="text-xs text-gray-500 mt-1">Surat-menyurat dan permohonan informasi akademik resmi.</p>
            </div>
        </div>

        {{-- Box 3: WhatsApp --}}
        @php
            $rawPhone = $siteSettings['contact_phone'] ?? '0852-6990-8696';
            $cleanWa = preg_replace('/[^0-9]/', '', $rawPhone);
            if (str_starts_with($cleanWa, '0')) {
                $cleanWa = '62' . substr($cleanWa, 1);
            }
        @endphp
        <div class="bg-white p-5 sm:p-8 rounded-3xl shadow-md border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-1 space-y-4 reveal-fade-up delay-2 text-center sm:text-left">
            <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-indigo-600 flex items-center justify-center text-2xl shadow-inner mx-auto sm:mx-0">
                <i class="fa-brands fa-whatsapp"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">WhatsApp PPDB :</span>
                <a href="https://wa.me/{{ $cleanWa }}" target="_blank" class="text-base font-extrabold text-gray-900 hover:text-indigo-600 transition mt-1 block">
                    {{ $rawPhone }}
                </a>
                <p class="text-xs text-gray-500 mt-1">Konsultasi cepat PPDB dan beasiswa siswa via chat.</p>
            </div>
        </div>

        {{-- Box 4: Address --}}
        <div class="bg-white p-5 sm:p-8 rounded-3xl shadow-md border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-1 space-y-4 reveal-fade-up delay-3 text-center sm:text-left">
            <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl shadow-inner mx-auto sm:mx-0">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Alamat Sekolah :</span>
                <p class="text-xs font-bold text-gray-900 mt-1 leading-relaxed">
                    {{ $siteSettings['contact_address'] ?? 'Jl. Lintas Timur Palembang-Prabumulih KM 35, Prabumulih, Sumatera Selatan' }}
                </p>
            </div>
        </div>
    </div>

    {{-- FORMULIR KONSULTASI / PESAN --}}
    <div class="bg-white p-5 sm:p-8 md:p-12 rounded-3xl shadow-xl border border-gray-100 max-w-3xl mx-auto reveal-fade-up">
        <div class="mb-8 text-center sm:text-left">
            <span class="text-xs font-bold text-orange-500 uppercase tracking-wider">Konsultasi & Informasi Online</span>
            <h3 class="text-2xl font-extrabold text-gray-900 mt-1">Formulir Pertanyaan & PPDB</h3>
            <p class="text-xs text-gray-500 mt-1">Kirimkan pertanyaan seputar pendaftaran siswa baru, fasilitas, atau kurikulum sekolah.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-indigo-50/60 border-l-4 border-emerald-500 p-4 rounded-r-xl">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check text-emerald-500 mr-2 text-sm"></i>
                    <p class="text-xs font-semibold text-indigo-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <form action="{{ route('feedback.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Honeypot field for anti-spam bot --}}
            <div class="hidden" style="display:none !important;" aria-hidden="true">
                <input type="text" name="_hp_security_check" value="" tabindex="-1" autocomplete="off">
            </div>

            <div>
                <label for="nama" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Nama Lengkap Orang Tua / Siswa *</label>
                <input type="text" name="nama" id="nama" required value="{{ old('nama') }}" placeholder="Tuliskan nama lengkap Anda..." class="w-full bg-gray-50 text-xs text-gray-800 rounded-xl px-4 py-3.5 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">
                @error('nama') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="nama@email.com" class="w-full bg-gray-50 text-xs text-gray-800 rounded-xl px-4 py-3.5 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">
                    @error('email') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="whatsapp" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Nomor WhatsApp / HP</label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}" placeholder="08xxxxxxxxxx" class="w-full bg-gray-50 text-xs text-gray-800 rounded-xl px-4 py-3.5 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">
                    @error('whatsapp') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="saran_kritik" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Pesan / Pertanyaan PPDB *</label>
                <textarea name="saran_kritik" id="saran_kritik" rows="5" required placeholder="Tuliskan pertanyaan atau pesan Anda dengan jelas..." class="w-full bg-gray-50 text-xs text-gray-800 rounded-xl px-4 py-3.5 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">{{ old('saran_kritik') }}</textarea>
                @error('saran_kritik') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-bold text-xs uppercase tracking-wider shadow-lg hover:shadow-xl transition flex items-center justify-center space-x-2">
                <i class="fa-solid fa-paper-plane text-sm"></i>
                <span>Kirimkan Pesan Pertanyaan</span>
            </button>
        </form>
    </div>

</div>
@endsection
