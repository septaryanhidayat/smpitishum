@extends('layouts.frontend')

@section('title', 'Tentang Kami - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Mengenal profil, sejarah, visi misi, fasilitas, dewan guru, serta keunggulan SMPS IT Ishlahul Ummah Prabumulih Prabumulih.')

@section('content')
{{-- HERO HEADER & BREADCRUMB --}}
<div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 border-b border-indigo-500/20 text-white py-10 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left reveal-fade-up">
        <nav class="text-xs text-gray-300 mb-3 flex items-center justify-center sm:justify-start space-x-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span>Profil</span>
            <span>/</span>
            <span class="text-amber-400 font-semibold">Tentang Kami</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">Profil SMPS IT Ishlahul Ummah Prabumulih</h1>
        <p class="text-xs sm:text-sm text-gray-200 mt-2 font-light">
            Mengenal lebih dekat visi, nilai pendidikan Qur'ani, fasilitas, dan keunggulan civitas akademika Ishum.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-8 sm:py-14 space-y-12 sm:space-y-16">

    {{-- SEKSI 1: SAMBUTAN KEPALA SEKOLAH --}}
    <section class="bg-white rounded-3xl p-5 sm:p-8 md:p-12 shadow-xl border border-gray-100 reveal-fade-up">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-10 items-center">
            <div class="lg:col-span-4 flex justify-center">
                <div class="w-48 h-64 sm:w-64 sm:h-80 rounded-2xl overflow-hidden shadow-xl border-4 border-white ring-4 ring-indigo-100 bg-indigo-50 relative group">
                    <img src="/uploads/dewan/kepala-sekolah.webp" alt="Anita Carlyna, S.IP., M.Pd., Gr - Kepala Sekolah" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                    <div class="absolute bottom-3 left-3 right-3 text-white text-center sm:text-left">
                        <span class="block text-xs sm:text-sm font-extrabold">Anita Carlyna, S.IP., M.Pd., Gr</span>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-8 space-y-4 text-center lg:text-left">
                <div class="inline-flex items-center space-x-2 bg-indigo-100 text-indigo-800 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                    <i class="fa-solid fa-user-tie text-indigo-600"></i>
                    <span>Sambutan Pimpinan</span>
                </div>
                <h2 class="text-xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Mendidik Generasi Qur'ani Berprestasi
                </h2>
                <div class="w-16 h-1 bg-indigo-600 rounded-full mx-auto lg:mx-0"></div>
                <p class="text-gray-600 text-xs sm:text-base leading-relaxed text-left sm:text-justify">
                    Assalamu'alaikum Warahmatullahi Wabarakatuh. SMPS IT Ishlahul Ummah Prabumulih berdiri dengan tekad kuat menyajikan pendidikan menengah pertama yang seimbang antara kematangan spiritual, kemuliaan akhlak, dan keunggulan sains-teknologi. Kami meyakini bahwa generasi terbaik adalah generasi yang menjadikan Al-Qur'an sebagai pedoman hidup sekaligus terampil menguasai ilmu pengetahuan modern.
                </p>
                <p class="text-gray-600 text-xs sm:text-base leading-relaxed text-left sm:text-justify">
                    Dengan tenaga pendidik berkompeten, kurikulum terintegrasi JSIT dan nasional, sarana laboratorium modern, serta pembiasaan karakter Islami yang kondusif, kami berkomitmen mengantarkan setiap siswa menggapai masa depan mulia dan siap berprestasi ke jenjang pendidikan unggulan.
                </p>
                <div class="pt-4 flex justify-center lg:justify-start">
                    <a href="{{ route('page.sambutan') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl text-xs font-bold shadow-md hover:shadow-lg transition">
                        <span>Baca Sambutan Lengkap</span>
                        <i class="fa-solid fa-arrow-right ml-2 text-[11px]"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- SEKSI 2: SEJARAH SINGKAT SEKOLAH --}}
    <section class="bg-white rounded-3xl p-5 sm:p-8 md:p-12 shadow-xl border border-gray-100 reveal-fade-up">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-10 items-center">
            <div class="lg:col-span-7 space-y-4 order-2 lg:order-1 text-center lg:text-left">
                <div class="inline-flex items-center space-x-2 bg-orange-100 text-orange-800 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                    <i class="fa-solid fa-landmark"></i>
                    <span>Jejak Langkah</span>
                </div>
                <h2 class="text-xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Sejarah Berdirinya SMPS IT Ishlahul Ummah Prabumulih
                </h2>
                <span class="block text-xs sm:text-sm font-semibold text-[#da251c]">Komitmen Membangun Pendidikan Berkualitas</span>
                <div class="w-16 h-1 bg-[#da251c] rounded-full mx-auto lg:mx-0"></div>
                <p class="text-gray-600 text-xs sm:text-base leading-relaxed text-left sm:text-justify">
                    SMPS IT Ishlahul Ummah Prabumulih didirikan di Kabupaten Prabumulih atas inisiatif para tokoh pendidikan dan alim ulama yang mendambakan hadirnya institusi pendidikan menengah atas Islam terpadu yang bermutu tinggi, berwawasan global, namun tetap berakar kuat pada nilai-nilai tradisi keislaman.
                </p>
                <p class="text-gray-600 text-xs sm:text-base leading-relaxed text-left sm:text-justify">
                    Seiring berjalannya waktu, sekolah ini terus berkembang dengan fasilitas modern, akreditasi unggul, serta jejaring prestasi siswa yang menjuarai berbagai kompetisi sains nasional dan hafidz Qur'an hingga 30 juz.
                </p>
                <div class="pt-4 flex justify-center lg:justify-start">
                    <a href="{{ route('page.sejarah') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-gray-900 hover:bg-black text-white px-6 py-3 rounded-xl text-xs font-bold shadow-md hover:shadow-lg transition">
                        <span>Baca Sejarah Lengkap</span>
                        <i class="fa-solid fa-arrow-right ml-2 text-[11px]"></i>
                    </a>
                </div>
            </div>
            <div class="lg:col-span-5 order-1 lg:order-2 flex justify-center">
                <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 max-h-80 bg-gray-50 w-full">
                    <img src="/uploads/campus-smpit-ishum.webp" alt="Kampus SMPS IT Ishlahul Ummah Prabumulih" class="w-full h-full object-cover object-center">
                </div>
            </div>
        </div>
    </section>

    {{-- SEKSI 3: 3 QUICK CARDS (FASILITAS, AGENDA, DEWAN GURU) --}}
    <section class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Card 1: Fasilitas --}}
        <div class="bg-white rounded-3xl p-8 shadow-md border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col justify-between space-y-6 reveal-fade-up">
            <div class="space-y-4">
                <div class="w-16 h-16 rounded-2xl bg-green-100 text-indigo-600 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider block">Sarana Sekolah</span>
                <h3 class="text-xl font-extrabold text-gray-900">Fasilitas &amp; Laboratorium</h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Laboratorium sains, lab komputer multimedia, perpustakaan digital, masjid sekolah, sarana olahraga, dan asrama representatif.
                </p>
            </div>
            <div class="pt-4 border-t border-gray-100">
                <a href="{{ route('bidang.index') }}" class="inline-flex items-center text-xs font-bold text-indigo-600 hover:text-[#da251c]">
                    <span>Lihat Semua Fasilitas</span>
                    <i class="fa-solid fa-arrow-right ml-2 text-[10px]"></i>
                </a>
            </div>
        </div>

        {{-- Card 2: Agenda --}}
        <div class="bg-white rounded-3xl p-8 shadow-md border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col justify-between space-y-6 reveal-fade-up delay-1">
            <div class="space-y-4">
                <div class="w-16 h-16 rounded-2xl bg-orange-100 text-[#da251c] flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <span class="text-xs font-bold text-[#da251c] uppercase tracking-wider block">Kalender Pendidikan</span>
                <h3 class="text-xl font-extrabold text-gray-900">Agenda Akademik</h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Jadwal ujian, masa pendaftaran PPDB, wisuda tahfidz, kemah pramuka SIT, workshop sains, dan kegiatan kesiswaan.
                </p>
            </div>
            <div class="pt-4 border-t border-gray-100">
                <a href="{{ route('agenda.index') }}" class="inline-flex items-center text-xs font-bold text-[#da251c] hover:text-[#b91c1c]">
                    <span>Lihat Semua Agenda</span>
                    <i class="fa-solid fa-arrow-right ml-2 text-[10px]"></i>
                </a>
            </div>
        </div>

        {{-- Card 3: Dewan Guru --}}
        <div class="bg-white rounded-3xl p-8 shadow-md border border-gray-100 hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col justify-between space-y-6 reveal-fade-up delay-2">
            <div class="space-y-4">
                <div class="w-16 h-16 rounded-2xl bg-emerald-100 text-indigo-700 flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-wider block">Tenaga Pendidik</span>
                <h3 class="text-xl font-extrabold text-gray-900">Dewan Guru &amp; GTK</h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Para asatidz dan guru lulusan perguruan tinggi terkemuka dalam dan luar negeri yang berjiwa pendidik dan berakhlak mulia.
                </p>
            </div>
            <div class="pt-4 border-t border-gray-100">
                <a href="{{ route('dewan.index') }}" class="inline-flex items-center text-xs font-bold text-indigo-700 hover:text-indigo-800">
                    <span>Lihat Profil Pendidik</span>
                    <i class="fa-solid fa-arrow-right ml-2 text-[10px]"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- SEKSI 4: VISI DAN MISI --}}
    <section class="bg-white rounded-3xl p-8 sm:p-12 shadow-xl border border-gray-100 reveal-fade-up space-y-8">
        <div class="text-center max-w-2xl mx-auto">
            <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider block">Pedoman Pendidikan</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">
                Visi dan Misi SMPS IT Ishlahul Ummah Prabumulih
            </h2>
            <div class="w-16 h-1 bg-[#da251c] mx-auto rounded-full mt-3"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Card Visi --}}
            <div class="bg-gradient-to-br from-indigo-50/70 to-blue-50/70 p-8 rounded-3xl border border-indigo-100 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-base shadow">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900">Visi Sekolah</h3>
                    </div>
                    <blockquote class="text-sm sm:text-base text-gray-800 italic leading-relaxed border-l-4 border-indigo-600 pl-4 font-serif">
                        "Terwujudnya Generasi Qur'ani yang Berakhlak Mulia, Cerdas, Mandiri, Unggul dalam Sains dan Teknologi, serta Berwawasan Global."
                    </blockquote>
                </div>
                <div class="pt-2">
                    <a href="{{ route('page.visi-misi') }}" class="inline-flex items-center text-xs font-bold text-indigo-600 hover:underline">
                        <span>Baca Rincian Visi</span>
                        <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
                    </a>
                </div>
            </div>

            {{-- Card Misi --}}
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-8 rounded-3xl border border-gray-200 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gray-900 text-white flex items-center justify-center font-bold text-base shadow">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900">Misi Utama</h3>
                    </div>
                    <ol class="text-xs sm:text-sm text-gray-700 space-y-2 list-decimal list-inside leading-relaxed">
                        <li>Menyelenggarakan pembelajaran terpadu antara kurikulum nasional dan nilai-nilai Al-Qur'an.</li>
                        <li>Menumbuhkan kecintaan membaca, menghafal, dan mengamalkan Al-Qur'an dalam kehidupan sehari-hari.</li>
                        <li>Mengembangkan potensi akademik, riset sains, dan teknologi berbasis kecakapan abad ke-21.</li>
                        <li>Membina kepemimpinan, kemandirian siswa, dan kepedulian sosial melalui sistem boarding school.</li>
                    </ol>
                </div>
                <div class="pt-2">
                    <a href="{{ route('page.visi-misi') }}" class="inline-flex items-center text-xs font-bold text-gray-900 hover:text-indigo-600 transition">
                        <span>Baca Selengkapnya</span>
                        <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- SEKSI 5: TESTIMONIAL ALUMNI & WALI MURID --}}
    @if(isset($testimonials) && $testimonials->isNotEmpty())
    <section class="space-y-8 reveal-fade-up">
        <div class="text-center max-w-2xl mx-auto">
            <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider block">Aspirasi &amp; Testimoni</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">
                Komentar Alumni &amp; Orang Tua
            </h2>
            <p class="text-xs sm:text-sm text-gray-500 font-semibold mt-1">Pengalaman berharga belajar dan bertumbuh di SMPS IT Ishlahul Ummah Prabumulih</p>
            <div class="w-16 h-1 bg-[#da251c] mx-auto rounded-full mt-3"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($testimonials->take(4) as $testi)
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between space-y-4 hover:shadow-lg transition">
                    <div class="space-y-2">
                        <i class="fa-solid fa-quote-left text-2xl text-green-200"></i>
                        <p class="text-xs text-gray-600 italic leading-relaxed line-clamp-4">
                            "{{ $testi->content }}"
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left space-y-2 sm:space-y-0 sm:space-x-3 pt-3 border-t border-gray-50">
                        <div class="w-10 h-10 rounded-full bg-green-100 text-indigo-600 font-bold flex items-center justify-center flex-shrink-0 overflow-hidden text-sm mx-auto sm:mx-0">
                            <img src="{{ $testi->photo_url }}" alt="{{ $testi->name }}" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($testi->name) }}&background=0d6b38&color=fff'">
                        </div>
                        <div class="min-w-0">
                            <span class="block font-bold text-xs text-gray-900 text-center sm:text-left">{{ $testi->name }}</span>
                            <span class="block text-[11px] text-gray-400 text-center sm:text-left">{{ $testi->profession ?? 'Alumni / Wali Murid' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center pt-2">
            <a href="{{ route('testimonial.index') }}" class="inline-flex items-center text-xs font-bold text-indigo-600 hover:underline">
                <span>Lihat Seluruh Testimonial</span>
                <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
            </a>
        </div>
    </section>
    @endif

    {{-- SEKSI 6: GOOGLE MAPS KAMPUS --}}
    <section class="bg-white rounded-3xl p-5 sm:p-8 md:p-10 shadow-xl border border-gray-100 reveal-fade-up space-y-6">
        <div class="flex flex-col sm:flex-row items-center sm:items-center justify-between gap-4 text-center sm:text-left">
            <div>
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider block">Lokasi Sekolah</span>
                <h2 class="text-lg sm:text-2xl font-extrabold text-gray-900 mt-1">Alamat SMPS IT Ishlahul Ummah Prabumulih</h2>
                <p class="text-xs text-gray-500 mt-1">Jl. Lintas Timur KM 35, Kel. Prabumulih Indah, Kec. Kota Prabumulih, Sumatera Selatan 30662</p>
            </div>
            <a href="https://maps.google.com" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center text-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow transition flex-shrink-0">
                <i class="fa-solid fa-map-location-dot mr-2"></i> Buka Google Maps
            </a>
        </div>

        <div class="rounded-2xl overflow-hidden shadow-inner border border-gray-200 h-80 sm:h-96">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15935.918903337965!2d104.642145!3d-3.232491!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b9991cb45aaab%3A0x28dfaa3303668f80!2sPrabumulih%20Mulya%2C%20Prabumulih%2C%20Ogan%20Ilir%20Regency%2C%20South%20Sumatra!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

</div>
@endsection
