@extends('layouts.frontend')

@section('title', $item->title . ' - Ekstrakurikuler SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', Str::limit(strip_tags($item->content), 155))

@section('content')
<div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 border-b border-indigo-500/20 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-xs text-indigo-200 mb-3 flex items-center space-x-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('ekskul.index') }}" class="hover:text-white transition">Ekstrakurikuler &amp; Club</a>
            <span>/</span>
            <span class="text-amber-300 font-semibold truncate max-w-xs">{{ $item->title }}</span>
        </nav>
        <span class="inline-flex items-center space-x-1.5 bg-amber-400 text-slate-950 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-2">
            <i class="fa-solid fa-people-group text-xs"></i>
            <span>Club Ekstrakurikuler</span>
        </span>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight max-w-4xl text-white">
            {{ $item->title }}
        </h1>
        <div class="flex items-center space-x-4 text-xs text-indigo-200 mt-3">
            <span class="flex items-center space-x-1.5">
                <i class="fa-solid fa-circle-check text-emerald-400"></i>
                <span>Aktif Setiap Pekan</span>
            </span>
            <span>•</span>
            <span class="flex items-center space-x-1.5">
                <i class="fa-solid fa-school text-amber-400"></i>
                <span>SMPS IT Ishlahul Ummah Prabumulih</span>
            </span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        {{-- MAIN CONTENT --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm space-y-6">
                @php
                    $thumb = $item->featured_image;
                    if (!$thumb) {
                        $t = strtolower($item->title);
                        if (str_contains($t, 'basket') || str_contains($t, 'badminton') || str_contains($t, 'futsal') || str_contains($t, 'atletik')) {
                            $thumb = '/uploads/activities-smpit-ishum.webp';
                        } elseif (str_contains($t, 'digital') || str_contains($t, 'grafis') || str_contains($t, 'robotika') || str_contains($t, 'coding')) {
                            $thumb = '/uploads/ishum/fasilitas_1274_Ruang-Lab-Komputer1.webp';
                        } elseif (str_contains($t, 'sains') || str_contains($t, 'matematika')) {
                            $thumb = '/uploads/ishum/fasilitas_1275_R.-Lab-IPA.webp';
                        } elseif (str_contains($t, 'tari') || str_contains($t, 'ansambel') || str_contains($t, 'vocal') || str_contains($t, 'hadrah') || str_contains($t, 'kriya') || str_contains($t, 'cerita') || str_contains($t, 'dongeng') || str_contains($t, 'pantomim')) {
                            $thumb = '/uploads/ishum/fasilitas_1278_HALL-SIT-Ishlahul-Ummah_.webp';
                        } elseif (str_contains($t, 'tahfidz') || str_contains($t, 'da\'i') || str_contains($t, 'dai')) {
                            $thumb = '/uploads/tahfidz-smpit-ishum.webp';
                        } else {
                            $thumb = '/uploads/campus-smpit-ishum.webp';
                        }
                    }
                    $hasContent = !empty(trim(strip_tags($item->content)));
                @endphp

                <div class="rounded-2xl overflow-hidden shadow-md bg-gray-100 max-h-[460px]">
                    <img src="{{ $thumb }}" alt="{{ $item->title }}" class="w-full h-full object-cover" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                </div>

                @if($hasContent)
                    <div class="prose max-w-none text-gray-700 leading-relaxed text-sm sm:text-base space-y-4 font-light">
                        {!! $item->content !!}
                    </div>
                @else
                    <div class="prose max-w-none text-gray-700 leading-relaxed text-sm sm:text-base space-y-4 font-light">
                        <p>Ekstrakurikuler <strong>{{ $item->title }}</strong> di <strong>SMPS IT Ishlahul Ummah Prabumulih</strong> merupakan salah satu program pengembangan diri yang dirancang untuk memfasilitasi minat, bakat, kreativitas, dan potensi siswa.</p>
                        <p>Melalui bimbingan pembina dan asatidz yang berkompeten, para siswa diajak untuk mengasah keterampilan teknis, sportivitas, kekompakan tim, kemandirian, dan disiplin tinggi berlandaskan akhlakul karimah.</p>
                        <p>Informasi jadwal pertemuan rutin, silabus kegiatan, dan persiapan lomba akan disampaikan secara berkala melalui pengumuman resmi sekolah.</p>
                    </div>
                @endif

                {{-- HIGHLIGHT KEUNGGULAN KLUB --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6 border-t border-gray-100">
                    <div class="bg-indigo-50/60 p-4 rounded-2xl border border-indigo-100 text-center">
                        <i class="fa-solid fa-chalkboard-user text-indigo-600 text-xl mb-1.5 block"></i>
                        <span class="text-xs font-bold text-gray-900 block">Pembina Berpengalaman</span>
                        <span class="text-[11px] text-gray-500">Guru &amp; instruktur profesional</span>
                    </div>
                    <div class="bg-amber-50/60 p-4 rounded-2xl border border-amber-100 text-center">
                        <i class="fa-solid fa-trophy text-amber-500 text-xl mb-1.5 block"></i>
                        <span class="text-xs font-bold text-gray-900 block">Ajang Perlombaan</span>
                        <span class="text-[11px] text-gray-500">Persiapan kompetisi berkala</span>
                    </div>
                    <div class="bg-emerald-50/60 p-4 rounded-2xl border border-emerald-100 text-center">
                        <i class="fa-solid fa-heart-circle-check text-emerald-600 text-xl mb-1.5 block"></i>
                        <span class="text-xs font-bold text-gray-900 block">Karakter Qur'ani</span>
                        <span class="text-[11px] text-gray-500">Bina adab &amp; persaudaraan</span>
                    </div>
                </div>

                {{-- SHARE BUTTONS --}}
                <div class="pt-6 border-t border-gray-100 flex flex-wrap items-center justify-between gap-4">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Bagikan Informasi Ini:</span>
                    <div class="flex items-center space-x-2">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($item->title . ' - Ekstrakurikuler SMPS IT Ishum: ' . url()->current()) }}" target="_blank" class="w-9 h-9 rounded-full bg-emerald-500 text-white flex items-center justify-center text-sm hover:bg-emerald-600 transition shadow-sm" title="Bagikan ke WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm hover:bg-blue-700 transition shadow-sm" title="Bagikan ke Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6">
            {{-- Action Box --}}
            <div class="bg-gradient-to-br from-indigo-950 via-indigo-900 to-blue-900 rounded-3xl p-6 text-white shadow-xl space-y-4">
                <span class="text-[10px] font-bold text-amber-300 uppercase tracking-wider block">Pendaftaran Siswa</span>
                <h3 class="text-lg font-black text-white leading-snug">Ingin Ikut Bergabung dalam Kegiatan Ini?</h3>
                <p class="text-xs text-indigo-100 font-light leading-relaxed">
                    Setiap siswa SMPS IT Ishlahul Ummah dapat memilih ekstrakurikuler wajib &amp; pilihan sesuai minat, bakat, serta potensi terbaiknya.
                </p>
                <div class="pt-2 space-y-2">
                    <a href="{{ route('ppdb.index') }}" class="block w-full text-center bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-slate-950 font-extrabold text-xs py-3 rounded-xl shadow-md transition">
                        <i class="fa-solid fa-graduation-cap mr-1.5"></i> Daftar SPMB Siswa Baru
                    </a>
                    <a href="{{ route('hubungi') }}" class="block w-full text-center bg-white/10 hover:bg-white/20 text-white text-xs py-2.5 rounded-xl font-semibold transition">
                        <i class="fa-solid fa-circle-question mr-1.5"></i> Tanya Informasi Ekskul
                    </a>
                </div>
            </div>

            {{-- Other Ekstrakurikuler --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 text-base border-b border-gray-100 pb-3 flex items-center space-x-2">
                    <i class="fa-solid fa-people-group text-indigo-600"></i>
                    <span>Ekstrakurikuler Lainnya</span>
                </h3>
                <div class="space-y-3">
                    @forelse($otherEkskul as $oEks)
                        <a href="{{ route('ekskul.show', $oEks->slug) }}" class="flex items-center space-x-3 group p-2 rounded-xl hover:bg-indigo-50/60 transition">
                            <div class="w-14 h-14 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 shadow-sm">
                                <img src="{{ $oEks->featured_image ?: '/uploads/campus-smpit-ishum.webp' }}" alt="{{ $oEks->title }}" class="w-full h-full object-cover group-hover:scale-105 transition" onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-bold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 leading-snug">
                                    {{ $oEks->title }}
                                </h4>
                                <span class="text-[10px] text-amber-600 font-semibold mt-1 inline-flex items-center">
                                    <span>Lihat Detail</span>
                                    <i class="fa-solid fa-arrow-right ml-1 text-[8px]"></i>
                                </span>
                            </div>
                        </a>
                    @empty
                        <p class="text-xs text-gray-400 py-3 text-center">Belum ada ekstrakurikuler lain.</p>
                    @endforelse
                </div>
                <div class="pt-3 border-t border-gray-100 text-center">
                    <a href="{{ route('ekskul.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition inline-flex items-center">
                        <span>Lihat Semua Ekstrakurikuler</span>
                        <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
