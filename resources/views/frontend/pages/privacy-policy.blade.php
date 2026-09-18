@extends('layouts.frontend')

@section('title', 'Kebijakan Privasi - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Kebijakan Privasi resmi Website SMPS IT Ishlahul Ummah Prabumulih yang menjelaskan pengelolaan dan perlindungan data pengunjung, siswa, dan orang tua.')

@section('content')
{{-- HERO HEADER --}}
<div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 border-b border-indigo-500/20 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-xs text-indigo-200 mb-3 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <span class="text-amber-300 font-semibold">Kebijakan Privasi</span>
        </nav>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Kebijakan Privasi (Privacy Policy)</h1>
        <p class="text-sm text-indigo-100 mt-2 font-light max-w-2xl">
            Komitmen transparansi dan perlindungan privasi data setiap pengunjung situs resmi SMPS IT Ishlahul Ummah Prabumulih.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <article class="bg-white rounded-3xl p-8 sm:p-12 shadow-xl border border-gray-100 reveal-fade-up space-y-8">
        
        {{-- META INFO DOKUMEN --}}
        <div class="border-b border-gray-100 pb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold text-orange-500 uppercase tracking-wider block">Dokumen Resmi</span>
                <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 mt-1">Kebijakan Privasi Website</h2>
                <p class="text-xs text-gray-500 mt-1">Website Resmi SMPS IT Ishlahul Ummah Prabumulih</p>
            </div>
            <div class="bg-indigo-50/60 text-indigo-600 px-4 py-2 rounded-xl text-xs font-bold border border-indigo-200">
                Terbit: 2026
            </div>
        </div>

        {{-- 9 PASAL KEBIJAKAN PRIVASI --}}
        <div class="prose-content text-gray-700 text-sm sm:text-base leading-relaxed space-y-8">
            @if(!empty($page->content) && strlen(trim(strip_tags($page->content))) > 50)
                {!! $page->content !!}
            @else
                <section class="space-y-2">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center space-x-2">
                        <span class="w-7 h-7 rounded-lg bg-indigo-600 text-white inline-flex items-center justify-center text-xs font-bold mr-2">1</span>
                        <span>Pendahuluan</span>
                    </h3>
                    <p>
                        SMPS IT Ishlahul Ummah Prabumulih menghargai privasi setiap pengunjung website resmi kami. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat mengakses dan menggunakan layanan di website kami.
                    </p>
                    <p>
                        Dengan mengunjungi website ini, Anda menyetujui praktik yang dijelaskan dalam Kebijakan Privasi ini.
                    </p>
                </section>

                <section class="space-y-2">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center space-x-2">
                        <span class="w-7 h-7 rounded-lg bg-indigo-600 text-white inline-flex items-center justify-center text-xs font-bold mr-2">2</span>
                        <span>Informasi yang Kami Kumpulkan</span>
                    </h3>
                    <p>Kami dapat mengumpulkan informasi dari pengunjung, baik secara langsung maupun tidak langsung, termasuk:</p>
                    <ul class="list-disc list-inside space-y-1.5 pl-2">
                        <li><strong>Informasi pribadi:</strong> seperti nama, alamat email, nomor telepon/WhatsApp orang tua atau calon siswa yang diberikan saat mengisi formulir kontak atau pendaftaran PPDB online.</li>
                        <li><strong>Informasi non-pribadi:</strong> seperti alamat IP, jenis perangkat, peramban (browser) yang digunakan, serta statistik kunjungan halaman.</li>
                    </ul>
                </section>

                <section class="space-y-2">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center space-x-2">
                        <span class="w-7 h-7 rounded-lg bg-indigo-600 text-white inline-flex items-center justify-center text-xs font-bold mr-2">3</span>
                        <span>Penggunaan Informasi</span>
                    </h3>
                    <p>Informasi yang kami kumpulkan digunakan untuk keperluan:</p>
                    <ul class="list-disc list-inside space-y-1.5 pl-2">
                        <li>Menyediakan informasi dan layanan terkait proses PPDB dan akademik sekolah.</li>
                        <li>Menjawab pertanyaan, konsultasi, atau pesan yang dikirimkan melalui formulir kontak.</li>
                        <li>Mengirimkan informasi pengumuman akademik, jadwal seleksi, dan kegiatan sekolah.</li>
                        <li>Meningkatkan kualitas konten serta keandalan layanan website sekolah.</li>
                    </ul>
                </section>

                <section class="space-y-2">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center space-x-2">
                        <span class="w-7 h-7 rounded-lg bg-indigo-600 text-white inline-flex items-center justify-center text-xs font-bold mr-2">4</span>
                        <span>Perlindungan Informasi</span>
                    </h3>
                    <p>
                        Kami berkomitmen menjaga keamanan informasi pribadi pengunjung. Website ini menggunakan langkah-langkah teknis dan administratif yang wajar untuk mencegah akses, pengubahan, atau pengungkapan tanpa izin.
                    </p>
                </section>

                <section class="space-y-2">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center space-x-2">
                        <span class="w-7 h-7 rounded-lg bg-indigo-600 text-white inline-flex items-center justify-center text-xs font-bold mr-2">5</span>
                        <span>Penggunaan Cookies</span>
                    </h3>
                    <p>
                        Website ini dapat menggunakan cookies untuk meningkatkan kenyamanan penjelajahan dan menyimpan preferensi sesi pengunjung. Anda dapat menonaktifkan cookies melalui pengaturan peramban Anda sewaktu-waktu.
                    </p>
                </section>

                <section class="space-y-2">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center space-x-2">
                        <span class="w-7 h-7 rounded-lg bg-indigo-600 text-white inline-flex items-center justify-center text-xs font-bold mr-2">6</span>
                        <span>Tautan ke Situs Pihak Ketiga</span>
                    </h3>
                    <p>
                        Website kami dapat memuat tautan ke situs eksternal yang tidak dikelola langsung oleh SMPS IT Ishlahul Ummah Prabumulih. Kami tidak bertanggung jawab atas isi maupun kebijakan privasi dari situs-situs pihak ketiga tersebut.
                    </p>
                </section>

                <section class="space-y-2">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center space-x-2">
                        <span class="w-7 h-7 rounded-lg bg-indigo-600 text-white inline-flex items-center justify-center text-xs font-bold mr-2">7</span>
                        <span>Hak Pengunjung</span>
                    </h3>
                    <p>
                        Anda memiliki hak untuk meminta akses, koreksi, atau penghapusan atas data pribadi yang pernah Anda kirimkan kepada kami melalui formulir kontak.
                    </p>
                </section>

                <section class="space-y-2">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center space-x-2">
                        <span class="w-7 h-7 rounded-lg bg-indigo-600 text-white inline-flex items-center justify-center text-xs font-bold mr-2">8</span>
                        <span>Perubahan Kebijakan Privasi</span>
                    </h3>
                    <p>
                        SMPS IT Ishlahul Ummah Prabumulih berhak memperbarui Kebijakan Privasi ini sewaktu-waktu. Setiap perubahan akan langsung dipublikasikan di halaman ini dengan tanggal pembaruan yang jelas.
                    </p>
                </section>

                <section class="space-y-2 bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center space-x-2">
                        <span class="w-7 h-7 rounded-lg bg-indigo-600 text-white inline-flex items-center justify-center text-xs font-bold mr-2">9</span>
                        <span>Kontak Sekolah</span>
                    </h3>
                    <p>Jika Anda memiliki pertanyaan mengenai Kebijakan Privasi ini, silakan hubungi kami:</p>
                    <div class="text-xs sm:text-sm space-y-1 text-gray-600 mt-2">
                        <p>📧 Email: <strong>{{ $siteSettings['contact_email'] ?? 'smpitishlahulummah.2015@yahoo.com' }}</strong></p>
                        <p>📞 Telepon: <strong>{{ $siteSettings['contact_phone'] ?? '0852-6990-8696' }}</strong></p>
                        <p>📍 Alamat: {{ $siteSettings['contact_address'] ?? 'Jl. Lintas Timur Palembang-Prabumulih KM 35, Prabumulih, Sumatera Selatan' }}</p>
                    </div>
                </section>
            @endif
        </div>
    </article>
</div>
@endsection
