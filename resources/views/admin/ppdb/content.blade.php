@extends('layouts.admin')

@section('title', 'Konten & Jalur PPDB')
@section('header_title', 'Konten & Jalur PPDB')

@section('content')
<div class="space-y-6" x-data="{ 
    currentTab: '{{ request('tab', 'jalur') }}', 
    showAddFieldModal: false, 
    newFieldType: 'text',
    activeCategory: 'all',
    searchQuery: '',
    expandedField: null,
    showAddTrackModal: false,
    showEditTrackModal: false,
    editTrackData: {
        id: null,
        name: '',
        percentage: '',
        quota: '',
        cashback_info: '',
        description: '',
        is_active: 1
    },
    openEditTrack(track) {
        this.editTrackData = {
            id: track.id,
            name: track.name || '',
            percentage: track.percentage || '',
            quota: track.quota || '',
            cashback_info: track.cashback_info || '',
            description: track.description || '',
            is_active: track.is_active ? 1 : 0
        };
        this.showEditTrackModal = true;
    }
}">

    {{-- TOP NAVIGATION TABS & ACTIONS (Rapi, Terstruktur & Responsif) --}}
    <div class="bg-white p-2 sm:p-2.5 rounded-2xl shadow-xs border border-slate-200/80 flex flex-col md:flex-row md:items-center justify-between gap-2.5">
        <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar py-0.5">
            <a href="{{ route('admin.ppdb.index') }}" class="px-3.5 py-2 rounded-xl font-bold text-xs transition whitespace-nowrap {{ request()->routeIs('admin.ppdb.index') ? 'bg-[#da251c] text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100' }}">
                <i class="fa-solid fa-users mr-1.5"></i> Data Pendaftar
            </a>
            <button type="button" @click="currentTab = 'jalur'" :class="currentTab === 'jalur' ? 'bg-[#da251c] text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'" class="px-3.5 py-2 rounded-xl font-bold text-xs transition cursor-pointer flex items-center space-x-1.5 whitespace-nowrap">
                <i class="fa-solid fa-route"></i>
                <span>Jalur PPDB</span>
                <span class="ml-1 px-1.5 py-0.2 rounded-full text-[10px] font-extrabold" :class="currentTab === 'jalur' ? 'bg-white/20 text-white' : 'bg-red-100 text-red-700'">{{ count($tracks) }}</span>
            </button>
            <button type="button" @click="currentTab = 'banner'" :class="currentTab === 'banner' ? 'bg-[#da251c] text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'" class="px-3.5 py-2 rounded-xl font-bold text-xs transition cursor-pointer flex items-center space-x-1.5 whitespace-nowrap">
                <i class="fa-solid fa-bullhorn"></i>
                <span>Banner SPMB</span>
            </button>
            <button type="button" @click="currentTab = 'konten'" :class="currentTab === 'konten' ? 'bg-[#da251c] text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'" class="px-3.5 py-2 rounded-xl font-bold text-xs transition cursor-pointer flex items-center space-x-1.5 whitespace-nowrap">
                <i class="fa-solid fa-sliders"></i>
                <span class="hidden sm:inline">Konten &amp; 10 Menu PPDB</span>
                <span class="sm:hidden">Konten</span>
            </button>
            <button type="button" @click="currentTab = 'formulir'" :class="currentTab === 'formulir' ? 'bg-[#da251c] text-white shadow-xs' : 'bg-slate-50 text-slate-700 hover:bg-slate-100'" class="px-3.5 py-2 rounded-xl font-bold text-xs transition cursor-pointer flex items-center space-x-1.5 whitespace-nowrap">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                <span class="hidden sm:inline">Kustomisasi Formulir Online</span>
                <span class="sm:hidden">Formulir</span>
            </button>
        </div>

        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('ppdb.index') }}" target="_blank" class="px-3.5 py-2 rounded-xl font-bold text-xs bg-slate-900 hover:bg-black text-white shadow-xs transition inline-flex items-center space-x-1.5">
                <i class="fa-solid fa-arrow-up-right-from-square text-slate-400"></i>
                <span>Lihat Web PPDB</span>
            </a>
        </div>
    </div>


    {{-- ========================================================
         TAB 1: MANAJEMEN JALUR PENDAFTARAN PPDB DINAMIS
         ======================================================== --}}
    <div x-show="currentTab === 'jalur'" class="space-y-6">
        <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-100">
                <div class="flex items-center space-x-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-red-100 text-[#da251c] flex items-center justify-center font-black text-xl shadow-xs">
                        <i class="fa-solid fa-route"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base sm:text-lg">Manajemen Jalur Pendaftaran PPDB Dinamis</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Kelola kuota, persentase diskon/keringanan, cashback, dan deskripsi syarat untuk setiap jalur. Semua jalur dapat diedit atau ditambah.</p>
                    </div>
                </div>

                {{-- TOMBOL TAMBAH JALUR BARU --}}
                <div class="flex items-center gap-2">
                    <button type="button" @click="showAddTrackModal = true" class="bg-gradient-to-r from-[#da251c] to-rose-600 hover:from-red-700 hover:to-rose-700 text-white text-xs font-black px-5 py-3 rounded-2xl shadow-md shadow-red-500/25 transition transform hover:scale-102 flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-plus text-sm"></i>
                        <span>Tambah Jalur Pendaftaran</span>
                    </button>
                </div>
            </div>

            {{-- SUMMARY ALOKASI PERSENTASE --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-200/70">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Total Jalur Terdaftar</span>
                    <span class="text-base sm:text-lg font-black text-slate-900">{{ count($tracks) }} Jalur</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Status Aktif</span>
                    <span class="text-base sm:text-lg font-black text-emerald-600">{{ $tracks->where('is_active', true)->count() }} Aktif</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Total Alokasi Persentase</span>
                    @php
                        $sumPercent = 0;
                        foreach ($tracks as $t) {
                            $sumPercent += (float) filter_var($t->percentage, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        }
                    @endphp
                    <span class="text-base sm:text-lg font-black text-indigo-700">{{ $sumPercent }}%</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Sinkronisasi Formulir</span>
                    <span class="text-xs font-bold text-slate-700 flex items-center gap-1 mt-1">
                        <i class="fa-solid fa-circle-check text-emerald-500"></i> Otomatis ke Dropdown
                    </span>
                </div>
            </div>

            {{-- LIST JALUR PPDB DALAM TABEL / KARTU RESPONSIVE --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 shadow-2xs">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-100/80 text-slate-700 text-[11px] font-black uppercase tracking-wider border-b border-slate-200">
                            <th class="py-3 px-4 w-12 text-center">#</th>
                            <th class="py-3 px-4">Nama Jalur</th>
                            <th class="py-3 px-4 text-center">Persentase</th>
                            <th class="py-3 px-4">Kuota &amp; Cashback</th>
                            <th class="py-3 px-4">Syarat &amp; Deskripsi</th>
                            <th class="py-3 px-4 text-center">Status</th>
                            <th class="py-3 px-4 text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($tracks as $index => $track)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3.5 px-4 text-center font-bold text-slate-400">
                                    {{ $index + 1 }}
                                </td>
                                <td class="py-3.5 px-4 font-extrabold text-slate-900">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-lg bg-red-50 text-[#da251c] flex items-center justify-center font-black text-xs shrink-0">
                                            <i class="fa-solid fa-award"></i>
                                        </div>
                                        <div>
                                            <span class="block text-slate-900 font-black">{{ $track->name }}</span>
                                            <span class="text-[10px] font-mono text-slate-400 font-normal">{{ $track->slug }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-black bg-amber-100 text-amber-900 border border-amber-300">
                                        {{ $track->percentage }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="space-y-1">
                                        @if(!empty($track->quota))
                                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-700 bg-slate-100 px-2 py-0.5 rounded-md">
                                                <i class="fa-solid fa-users text-slate-500 text-[10px]"></i>
                                                <span>{{ $track->quota }}</span>
                                            </span>
                                        @endif
                                        @if(!empty($track->cashback_info))
                                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                                                <i class="fa-solid fa-money-bill-wave text-emerald-600 text-[10px]"></i>
                                                <span>{{ $track->cashback_info }}</span>
                                            </span>
                                        @endif
                                        @if(empty($track->quota) && empty($track->cashback_info))
                                            <span class="text-slate-400 italic text-[11px]">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 max-w-xs text-slate-600 leading-relaxed text-[11px]">
                                    <p class="line-clamp-2">{{ $track->description ?: '-' }}</p>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    @if($track->is_active)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                                            <span>Aktif</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-slate-100 text-slate-600 border border-slate-300">
                                            <span>Nonaktif</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        {{-- Tombol Edit --}}
                                        <button type="button" @click="openEditTrack({{ json_encode($track) }})" class="p-2 rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-100 transition cursor-pointer" title="Edit Jalur">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.ppdb.tracks.destroy', $track) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jalur pendaftaran \'{{ addslashes($track->name) }}\'?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition cursor-pointer" title="Hapus Jalur">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-slate-500">
                                    <i class="fa-solid fa-route text-3xl text-slate-300 mb-2 block"></i>
                                    <span>Belum ada jalur pendaftaran yang ditambahkan. Silakan klik tombol <strong>Tambah Jalur Pendaftaran</strong> di atas.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ========================================================
         MAIN SETTINGS FORM (BANNER SPMB, KONTEN, 10 ACCORDION, FORM)
         ======================================================== --}}
    <form action="{{ route('admin.ppdb.content.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- ========================================================
             TAB 2: BANNER SPMB & HIGHLIGHT BERANDA
             ======================================================== --}}
        <div x-show="currentTab === 'banner'" class="space-y-6">
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
                <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-black text-lg">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">Pengaturan Banner SPMB &amp; Highlight Beranda</h3>
                        <p class="text-xs text-slate-500">Semua teks promosi, kuota, cashback, class meeting, tahun ajaran, dan flyer SPMB pada beranda dapat diubah di sini.</p>
                    </div>
                </div>

                {{-- GRID HEADER & DESKRIPSI BANNER --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Badge Promosi Atas</label>
                        <input type="text" name="spmb_banner_badge" value="{{ old('spmb_banner_badge', $settings['banner_badge']) }}" placeholder="PENERIMAAN SISWA BARU GELOMBANG EXCLUSIVE" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Utama Banner SPMB <span class="text-red-500">*</span></label>
                        <input type="text" name="spmb_banner_title" required value="{{ old('spmb_banner_title', $settings['banner_title']) }}" placeholder="SPMB Gelombang Exclusive & Class Meeting Semester Genap" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tahun Pelajaran Banner</label>
                        <input type="text" name="spmb_banner_year" value="{{ old('spmb_banner_year', $settings['banner_year']) }}" placeholder="Contoh: 2027-2028 atau 2027/2028" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Lengkap Banner SPMB</label>
                        <textarea name="spmb_banner_description" rows="3" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('spmb_banner_description', $settings['banner_desc']) }}</textarea>
                    </div>
                </div>

                {{-- 3 KARTU HIGHLIGHT (KUOTA, CASH BACK, CLASS MEETING) --}}
                <div class="pt-4 border-t border-slate-100">
                    <h4 class="font-extrabold text-slate-800 text-xs uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-id-card text-indigo-600"></i>
                        <span>3 Kotak Highlight Informasi Banner (Kuota, Cash Back, Class Meeting)</span>
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        {{-- Kartu 1: Kuota --}}
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 space-y-3">
                            <div class="flex items-center gap-2 text-indigo-700 font-bold text-xs">
                                <i class="fa-solid fa-users"></i>
                                <span>Kotak 1: Informasi Kuota</span>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Judul Kotak 1</label>
                                <input type="text" name="spmb_banner_card1_title" value="{{ old('spmb_banner_card1_title', $settings['banner_card1_title']) }}" placeholder="KUOTA TERBATAS" class="w-full bg-white text-xs font-bold rounded-xl px-3 py-2 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Deskripsi Kotak 1</label>
                                <input type="text" name="spmb_banner_card1_desc" value="{{ old('spmb_banner_card1_desc', $settings['banner_card1_desc']) }}" placeholder="Hanya 24 Siswa" class="w-full bg-white text-xs font-semibold rounded-xl px-3 py-2 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600" style="color: {{ old('spmb_banner_card1_color', $settings['banner_card1_color'] ?? '#f59e0b') }};">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1 flex items-center justify-between">
                                    <span>Pilihan Warna Teks Deskripsi</span>
                                    <span class="text-[10px] text-slate-400 font-normal">Hex / Picker</span>
                                </label>
                                <div class="flex items-center gap-2">
                                    <input type="color" name="spmb_banner_card1_color" value="{{ old('spmb_banner_card1_color', $settings['banner_card1_color'] ?? '#f59e0b') }}" onchange="this.nextElementSibling.value = this.value; this.closest('.space-y-3').querySelector('input[name=spmb_banner_card1_desc]').style.color = this.value" class="w-9 h-8 p-0.5 rounded-lg border border-slate-300 cursor-pointer bg-white shrink-0">
                                    <input type="text" oninput="this.previousElementSibling.value = this.value; this.closest('.space-y-3').querySelector('input[name=spmb_banner_card1_desc]').style.color = this.value" value="{{ old('spmb_banner_card1_color', $settings['banner_card1_color'] ?? '#f59e0b') }}" class="flex-1 bg-white text-xs font-mono rounded-xl px-2.5 py-1.5 border border-slate-200" placeholder="#f59e0b">
                                </div>
                                <div class="flex items-center gap-1.5 mt-2">
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#f59e0b'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#f59e0b'; p.querySelector('input[name=spmb_banner_card1_desc]').style.color='#f59e0b';" class="w-5 h-5 rounded-full bg-amber-500 border border-slate-300 cursor-pointer shadow-xs" title="Kuning Emas"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#10b981'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#10b981'; p.querySelector('input[name=spmb_banner_card1_desc]').style.color='#10b981';" class="w-5 h-5 rounded-full bg-emerald-500 border border-slate-300 cursor-pointer shadow-xs" title="Hijau Emerald"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#38bdf8'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#38bdf8'; p.querySelector('input[name=spmb_banner_card1_desc]').style.color='#38bdf8';" class="w-5 h-5 rounded-full bg-sky-400 border border-slate-300 cursor-pointer shadow-xs" title="Biru Muda"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#ef4444'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#ef4444'; p.querySelector('input[name=spmb_banner_card1_desc]').style.color='#ef4444';" class="w-5 h-5 rounded-full bg-red-500 border border-slate-300 cursor-pointer shadow-xs" title="Merah"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#ffffff'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#ffffff'; p.querySelector('input[name=spmb_banner_card1_desc]').style.color='#ffffff';" class="w-5 h-5 rounded-full bg-white border border-slate-300 cursor-pointer shadow-xs" title="Putih"></button>
                                </div>
                            </div>
                        </div>

                        {{-- Kartu 2: Cash Back --}}
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 space-y-3">
                            <div class="flex items-center gap-2 text-indigo-700 font-bold text-xs">
                                <i class="fa-solid fa-money-bill-wave"></i>
                                <span>Kotak 2: Informasi Cash Back</span>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Judul Kotak 2</label>
                                <input type="text" name="spmb_banner_card2_title" value="{{ old('spmb_banner_card2_title', $settings['banner_card2_title']) }}" placeholder="CASH BACK 1 JUTA" class="w-full bg-white text-xs font-bold rounded-xl px-3 py-2 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Deskripsi Kotak 2</label>
                                <input type="text" name="spmb_banner_card2_desc" value="{{ old('spmb_banner_card2_desc', $settings['banner_card2_desc']) }}" placeholder="Alumni SDIT Ishum 1 & 2" class="w-full bg-white text-xs font-semibold rounded-xl px-3 py-2 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600" style="color: {{ old('spmb_banner_card2_color', $settings['banner_card2_color'] ?? '#f59e0b') }};">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1 flex items-center justify-between">
                                    <span>Pilihan Warna Teks Deskripsi</span>
                                    <span class="text-[10px] text-slate-400 font-normal">Hex / Picker</span>
                                </label>
                                <div class="flex items-center gap-2">
                                    <input type="color" name="spmb_banner_card2_color" value="{{ old('spmb_banner_card2_color', $settings['banner_card2_color'] ?? '#f59e0b') }}" onchange="this.nextElementSibling.value = this.value; this.closest('.space-y-3').querySelector('input[name=spmb_banner_card2_desc]').style.color = this.value" class="w-9 h-8 p-0.5 rounded-lg border border-slate-300 cursor-pointer bg-white shrink-0">
                                    <input type="text" oninput="this.previousElementSibling.value = this.value; this.closest('.space-y-3').querySelector('input[name=spmb_banner_card2_desc]').style.color = this.value" value="{{ old('spmb_banner_card2_color', $settings['banner_card2_color'] ?? '#f59e0b') }}" class="flex-1 bg-white text-xs font-mono rounded-xl px-2.5 py-1.5 border border-slate-200" placeholder="#f59e0b">
                                </div>
                                <div class="flex items-center gap-1.5 mt-2">
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#f59e0b'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#f59e0b'; p.querySelector('input[name=spmb_banner_card2_desc]').style.color='#f59e0b';" class="w-5 h-5 rounded-full bg-amber-500 border border-slate-300 cursor-pointer shadow-xs" title="Kuning Emas"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#10b981'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#10b981'; p.querySelector('input[name=spmb_banner_card2_desc]').style.color='#10b981';" class="w-5 h-5 rounded-full bg-emerald-500 border border-slate-300 cursor-pointer shadow-xs" title="Hijau Emerald"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#38bdf8'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#38bdf8'; p.querySelector('input[name=spmb_banner_card2_desc]').style.color='#38bdf8';" class="w-5 h-5 rounded-full bg-sky-400 border border-slate-300 cursor-pointer shadow-xs" title="Biru Muda"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#ef4444'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#ef4444'; p.querySelector('input[name=spmb_banner_card2_desc]').style.color='#ef4444';" class="w-5 h-5 rounded-full bg-red-500 border border-slate-300 cursor-pointer shadow-xs" title="Merah"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#ffffff'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#ffffff'; p.querySelector('input[name=spmb_banner_card2_desc]').style.color='#ffffff';" class="w-5 h-5 rounded-full bg-white border border-slate-300 cursor-pointer shadow-xs" title="Putih"></button>
                                </div>
                            </div>
                        </div>

                        {{-- Kartu 3: Class Meeting --}}
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 space-y-3">
                            <div class="flex items-center gap-2 text-indigo-700 font-bold text-xs">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span>Kotak 3: Jadwal / Class Meeting</span>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Judul Kotak 3</label>
                                <input type="text" name="spmb_banner_card3_title" value="{{ old('spmb_banner_card3_title', $settings['banner_card3_title']) }}" placeholder="CLASS MEETING" class="w-full bg-white text-xs font-bold rounded-xl px-3 py-2 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Deskripsi Kotak 3</label>
                                <input type="text" name="spmb_banner_card3_desc" value="{{ old('spmb_banner_card3_desc', $settings['banner_card3_desc']) }}" placeholder="Mulai Rabu, 17 Juni" class="w-full bg-white text-xs font-semibold rounded-xl px-3 py-2 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600" style="color: {{ old('spmb_banner_card3_color', $settings['banner_card3_color'] ?? '#f59e0b') }};">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1 flex items-center justify-between">
                                    <span>Pilihan Warna Teks Deskripsi</span>
                                    <span class="text-[10px] text-slate-400 font-normal">Hex / Picker</span>
                                </label>
                                <div class="flex items-center gap-2">
                                    <input type="color" name="spmb_banner_card3_color" value="{{ old('spmb_banner_card3_color', $settings['banner_card3_color'] ?? '#f59e0b') }}" onchange="this.nextElementSibling.value = this.value; this.closest('.space-y-3').querySelector('input[name=spmb_banner_card3_desc]').style.color = this.value" class="w-9 h-8 p-0.5 rounded-lg border border-slate-300 cursor-pointer bg-white shrink-0">
                                    <input type="text" oninput="this.previousElementSibling.value = this.value; this.closest('.space-y-3').querySelector('input[name=spmb_banner_card3_desc]').style.color = this.value" value="{{ old('spmb_banner_card3_color', $settings['banner_card3_color'] ?? '#f59e0b') }}" class="flex-1 bg-white text-xs font-mono rounded-xl px-2.5 py-1.5 border border-slate-200" placeholder="#f59e0b">
                                </div>
                                <div class="flex items-center gap-1.5 mt-2">
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#f59e0b'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#f59e0b'; p.querySelector('input[name=spmb_banner_card3_desc]').style.color='#f59e0b';" class="w-5 h-5 rounded-full bg-amber-500 border border-slate-300 cursor-pointer shadow-xs" title="Kuning Emas"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#10b981'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#10b981'; p.querySelector('input[name=spmb_banner_card3_desc]').style.color='#10b981';" class="w-5 h-5 rounded-full bg-emerald-500 border border-slate-300 cursor-pointer shadow-xs" title="Hijau Emerald"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#38bdf8'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#38bdf8'; p.querySelector('input[name=spmb_banner_card3_desc]').style.color='#38bdf8';" class="w-5 h-5 rounded-full bg-sky-400 border border-slate-300 cursor-pointer shadow-xs" title="Biru Muda"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#ef4444'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#ef4444'; p.querySelector('input[name=spmb_banner_card3_desc]').style.color='#ef4444';" class="w-5 h-5 rounded-full bg-red-500 border border-slate-300 cursor-pointer shadow-xs" title="Merah"></button>
                                    <button type="button" onclick="const p=this.closest('.space-y-3'); p.querySelector('input[type=color]').value='#ffffff'; p.querySelector('input[type=text][class*=\'font-mono\']').value='#ffffff'; p.querySelector('input[name=spmb_banner_card3_desc]').style.color='#ffffff';" class="w-5 h-5 rounded-full bg-white border border-slate-300 cursor-pointer shadow-xs" title="Putih"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- BROSUR / FLYER & TOMBOL AKSI --}}
                <div class="pt-4 border-t border-slate-100 grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Upload Flyer / Brosur SPMB Beranda</label>
                        <div class="flex items-center gap-4">
                            @if(!empty($settings['banner_flyer_image']))
                                <div class="w-20 h-28 rounded-xl overflow-hidden border border-slate-200 bg-slate-100 shrink-0 shadow-xs">
                                    <img src="{{ $settings['banner_flyer_image'] }}" alt="Preview Flyer SPMB" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div class="flex-1 space-y-2">
                                <input type="file" name="spmb_banner_flyer_file" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                                <p class="text-[11px] text-slate-400">Format: JPG, PNG, WEBP (Rasio vertikal 3:4 atau poster). Maks 5 MB.</p>
                                <input type="text" name="spmb_banner_flyer_label" value="{{ old('spmb_banner_flyer_label', $settings['banner_flyer_label']) }}" placeholder="Pengumuman Resmi Sekolah" class="w-full bg-slate-50 text-xs font-medium rounded-xl px-3 py-2 border border-slate-200 focus:outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Teks Tombol Utama</label>
                                <input type="text" name="spmb_banner_btn_text" value="{{ old('spmb_banner_btn_text', $settings['banner_btn_text']) }}" placeholder="Daftar SPMB Online" class="w-full bg-slate-50 text-xs font-bold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">URL Tombol Daftar</label>
                                <input type="text" name="spmb_banner_btn_url" value="{{ old('spmb_banner_btn_url', $settings['banner_btn_url']) }}" placeholder="/ppdb" class="w-full bg-slate-50 text-xs font-bold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Teks Narahubung</label>
                                <input type="text" name="spmb_banner_contact_text" value="{{ old('spmb_banner_contact_text', $settings['banner_contact_text']) }}" placeholder="Narahubung: 0852-6990-8696" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">No WA Narahubung Banner</label>
                                <input type="text" name="spmb_banner_contact_phone" value="{{ old('spmb_banner_contact_phone', $settings['banner_contact_phone']) }}" placeholder="0852-6990-8696" class="w-full bg-slate-50 text-xs font-bold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ========================================================
             TAB 3: PENGATURAN KONTEN & 10 MENU PPDB
             ======================================================== --}}
        <div x-show="currentTab === 'konten'" class="space-y-8">

            {{-- SECTION 1: STATUS & HERO PPDB --}}
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
                <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-indigo-600 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">1. Status Gelombang &amp; Hero PPDB</h3>
                        <p class="text-xs text-slate-500">Atur periode penerimaan, tahun ajaran, nominal formulir, dan teks promo utama.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tahun Pelajaran <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_year" required value="{{ old('ppdb_year', $settings['year']) }}" placeholder="Contoh: 2027/2028" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Gelombang Aktif</label>
                        <input type="text" name="ppdb_wave" value="{{ old('ppdb_wave', $settings['wave']) }}" placeholder="Contoh: Gelombang 1 (Aktif)" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nominal Biaya Formulir <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_registration_fee" required value="{{ old('ppdb_registration_fee', $settings['registration_fee']) }}" placeholder="Contoh: Rp 250.000,-" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Badge Promo / Potongan Biaya</label>
                        <input type="text" name="ppdb_promo" value="{{ old('ppdb_promo', $settings['promo']) }}" placeholder="Contoh: Potongan Biaya Masuk Up to 50% OFF (*S&K berlaku)" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Singkat SPMB PPDB</label>
                        <textarea name="ppdb_tagline" rows="2" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ old('ppdb_tagline', $settings['tagline']) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: VIDEO PROFIL YOUTUBE --}}
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
                <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center font-bold text-lg">
                        <i class="fa-brands fa-youtube"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">2. Video Profil YouTube Halaman PPDB</h3>
                        <p class="text-xs text-slate-500">Video resmi yang disematkan (embed) pada halaman informasi PPDB.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">YouTube Video ID atau URL Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_youtube_id" required value="{{ old('ppdb_youtube_id', $settings['youtube_id']) }}" placeholder="Contoh: IrPVG8CYjRc atau https://www.youtube.com/watch?v=IrPVG8CYjRc" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Teks Video</label>
                        <input type="text" name="ppdb_video_title" value="{{ old('ppdb_video_title', $settings['video_title']) }}" placeholder="Video Profil & Dokumentasi SMPS IT Ishum" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                </div>
            </div>

            {{-- SECTION 3: FOTO DOKUMENTASI FASILITAS HALAMAN PPDB --}}
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
                <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">3. Foto Dokumentasi Fasilitas di Halaman PPDB</h3>
                        <p class="text-xs text-slate-500">3 foto fasilitas/kegiatan yang tampil di bagian bawah halaman PPDB (Gerbang, Gedung, Hall, dsb).</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @for($i = 1; $i <= 3; $i++)
                        @php
                            $imgKey = "image_{$i}";
                            $currentImg = $settings[$imgKey] ?? '';
                        @endphp
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 space-y-3">
                            <span class="text-xs font-black text-slate-800 block">Foto Fasilitas #{{ $i }}</span>
                            @if(!empty($currentImg))
                                <div class="w-full h-36 rounded-xl overflow-hidden border border-slate-200 bg-white shadow-2xs">
                                    <img src="{{ $currentImg }}" alt="Fasilitas {{ $i }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div>
                                <input type="file" name="ppdb_image_{{ $i }}_file" accept="image/*" class="w-full text-xs text-slate-600 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                                <p class="text-[10px] text-slate-400 mt-1">Format: JPG, PNG, WEBP. Maks 5 MB.</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            {{-- SECTION 4: JAM OPERASIONAL & SEKRETARIAT --}}
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
                <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-indigo-600 flex items-center justify-center font-bold text-lg">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">4. Jam Operasional SPMB &amp; Sekretariat</h3>
                        <p class="text-xs text-slate-500">Jadwal layanan pendaftaran offline dan alamat sekretariat panitia.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Hari Kerja (Senin - Jum'at) <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_operational_weekday" required value="{{ old('ppdb_operational_weekday', $settings['operational_weekday']) }}" placeholder="Senin – Jum'at: Pukul 08.00 – 15.00 WIB" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Hari Sabtu <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_operational_weekend" required value="{{ old('ppdb_operational_weekend', $settings['operational_weekend']) }}" placeholder="Sabtu: Pukul 08.00 – 12.00 WIB" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Sekretariat SPMB <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_secretariat" required value="{{ old('ppdb_secretariat', $settings['secretariat']) }}" placeholder="Kompleks SMPS IT Ishum, Jl. Sadewa RT 01 RW 04 Karang Raja" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                </div>
            </div>

            {{-- SECTION 5: REKENING PEMBAYARAN FORMULIR --}}
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
                <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">5. Rekening Pembayaran Biaya Formulir</h3>
                        <p class="text-xs text-slate-500">Rekening tujuan transfer biaya formulir pendaftaran PPDB.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Bank <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_bank_name" required value="{{ old('ppdb_bank_name', $settings['bank_name']) }}" placeholder="Bank Syariah Indonesia (BSI)" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kode Bank <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_bank_code" required value="{{ old('ppdb_bank_code', $settings['bank_code']) }}" placeholder="451" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor Rekening <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_bank_account" required value="{{ old('ppdb_bank_account', $settings['bank_account']) }}" placeholder="7011304251" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Atas Nama Rekening <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_bank_holder" required value="{{ old('ppdb_bank_holder', $settings['bank_holder']) }}" placeholder="YL. Fatmawati" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                </div>
            </div>

            {{-- SECTION 6: KONTAK HOTLINE WHATSAPP --}}
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
                <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-green-100 text-indigo-600 flex items-center justify-center font-bold text-lg">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">6. Kontak WhatsApp Panitia PPDB</h3>
                        <p class="text-xs text-slate-500">Nomor admin dan panitia yang menerima forwarding pendaftaran calon siswa.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor WhatsApp Admin Utama <span class="text-red-500">*</span></label>
                        <input type="text" name="ppdb_hotline_phone" required value="{{ old('ppdb_hotline_phone', $settings['hotline_phone']) }}" placeholder="0852-6990-8696" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Label Kontak Utama</label>
                        <input type="text" name="ppdb_hotline_name" value="{{ old('ppdb_hotline_name', $settings['hotline_name']) }}" placeholder="Admin Hotline PPDB" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor WhatsApp CS 2 / Kepala Sekolah</label>
                        <input type="text" name="ppdb_hotline_2_phone" value="{{ old('ppdb_hotline_2_phone', $settings['hotline_2_phone']) }}" placeholder="0822-8157-3615" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Label Kontak 2</label>
                        <input type="text" name="ppdb_hotline_2_name" value="{{ old('ppdb_hotline_2_name', $settings['hotline_2_name']) }}" placeholder="Ust. Agi (Kepala Sekolah)" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                </div>
            </div>

            {{-- SECTION 7: KONTEN LENGKAP 10 ACCORDION MENU PPDB --}}
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
                <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">7. Seluruh 10 Menu Accordion Informasi PPDB</h3>
                        <p class="text-xs text-slate-500">Semua isi teks accordion pada halaman informasi PPDB dapat diedit di sini secara lengkap.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- KOLOM KIRI (6 MENU) --}}
                    <div class="space-y-5">
                        <div class="p-3 bg-indigo-50/60 text-indigo-600 rounded-xl text-xs font-black uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-columns"></i>
                            <span>Kolom Kiri (Jalur &amp; Persyaratan)</span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">1. Alur Pendaftaran</label>
                            <textarea name="ppdb_alur" rows="4" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_alur', $settings['alur']) }}</textarea>
                            <p class="text-[10px] text-slate-400 mt-1">Gunakan baris baru untuk memisahkan setiap tahapan alur.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">2. Syarat Pendaftaran</label>
                            <textarea name="ppdb_syarat" rows="4" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_syarat', $settings['syarat']) }}</textarea>
                            <p class="text-[10px] text-slate-400 mt-1">Gunakan baris baru untuk memisahkan setiap poin syarat berkas.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">3. Jalur Prestasi &amp; Keringanan</label>
                            <textarea name="ppdb_prestasi" rows="4" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_prestasi', $settings['prestasi'] ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">4. Jalur Hafizh Al-Qur'an (Tahfidz)</label>
                            <textarea name="ppdb_tahfidz" rows="4" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_tahfidz', $settings['tahfidz'] ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">5. Jalur Alumni SMPIT Ishum</label>
                            <textarea name="ppdb_alumni" rows="4" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_alumni', $settings['alumni'] ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">6. Jalur Reguler / Tes Mandiri</label>
                            <textarea name="ppdb_mandiri" rows="4" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_mandiri', $settings['mandiri'] ?? '') }}</textarea>
                        </div>
                    </div>

                    {{-- KOLOM KANAN (4 MENU) --}}
                    <div class="space-y-5">
                        <div class="p-3 bg-indigo-50/60 text-indigo-600 rounded-xl text-xs font-black uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-columns"></i>
                            <span>Kolom Kanan (Jadwal &amp; Biaya)</span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">7. Jadwal Gelombang PPDB</label>
                            <textarea name="ppdb_jadwal_gelombang" rows="5" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_jadwal_gelombang', $settings['jadwal_gelombang']) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">8. Rincian Biaya &amp; Fasilitas Seragam</label>
                            <textarea name="ppdb_biaya" rows="5" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_biaya', $settings['biaya']) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">9. Pilihan Program: Boarding (Asrama) &amp; Full Day</label>
                            <textarea name="ppdb_boarding" rows="5" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_boarding', $settings['boarding']) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">10. Pengumuman Kelulusan &amp; Daftar Ulang</label>
                            <textarea name="ppdb_kelulusan" rows="5" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_kelulusan', $settings['kelulusan']) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 8: UCAPAN PENUTUP & DOA --}}
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
                <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-hands-praying"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">8. Pesan Penutup &amp; Doa Harapan</h3>
                        <p class="text-xs text-slate-500">Teks ucapan terima kasih dan doa yang tampil di bagian bawah halaman PPDB.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Ucapan Penutup</label>
                        <input type="text" name="ppdb_closing_title" value="{{ old('ppdb_closing_title', $settings['closing_title']) }}" class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Isi Doa &amp; Harapan</label>
                        <textarea name="ppdb_closing_desc" rows="3" class="w-full bg-slate-50 text-xs rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ old('ppdb_closing_desc', $settings['closing_desc']) }}</textarea>
                    </div>
                </div>
            </div>

        </div>

        {{-- ========================================================
             TAB 4: PENGATURAN & KUSTOMISASI FORMULIR ONLINE
             ======================================================== --}}
        <div x-show="currentTab === 'formulir'" class="space-y-6" style="display: none;">

            {{-- 1. STATUS & PENGUMUMAN FORMULIR --}}
            <div class="bg-white p-5 sm:p-6 rounded-3xl shadow-xs border border-slate-200/80 space-y-4">
                <div class="flex items-center space-x-3 pb-3 border-b border-slate-100">
                    <div class="w-8 h-8 rounded-xl bg-emerald-100 text-indigo-600 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-power-off"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm sm:text-base">1. Status Penerimaan &amp; Pengumuman Formulir</h3>
                        <p class="text-xs text-slate-500">Kontrol cepat buka/tutup pendaftaran online dan notifikasi untuk calon pendaftar.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status Formulir PPDB Online</label>
                        <select name="ppdb_form_status" class="w-full bg-slate-50 text-xs font-bold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="1" {{ ($settings['form_status'] ?? '1') === '1' ? 'selected' : '' }}>🟢 BUKA PENDAFTARAN (Formulir Aktif Dapat Diisi)</option>
                            <option value="0" {{ ($settings['form_status'] ?? '1') === '0' ? 'selected' : '' }}>🔴 TUTUP PENDAFTARAN (Tampilkan Pemberitahuan Tutup)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Konfirmasi WhatsApp Otomatis</label>
                        <select name="ppdb_form_wa_confirm" class="w-full bg-slate-50 text-xs font-bold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="1" {{ ($settings['form_wa_confirm'] ?? '1') === '1' ? 'selected' : '' }}>🟢 Aktif (Arahkan otomatis ke WA Panitia setelah submit)</option>
                            <option value="0" {{ ($settings['form_wa_confirm'] ?? '1') === '0' ? 'selected' : '' }}>⚪ Simpan di Database Saja (Tanpa redirect WhatsApp)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Pesan Saat Formulir Ditutup</label>
                        <textarea name="ppdb_form_closed_message" rows="2" class="w-full bg-slate-50 text-xs rounded-xl p-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ old('ppdb_form_closed_message', $settings['form_closed_message']) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kotak Pengumuman / Info di Atas Formulir</label>
                        <textarea name="ppdb_form_announcement" rows="2" class="w-full bg-slate-50 text-xs rounded-xl p-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ old('ppdb_form_announcement', $settings['form_announcement']) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- 2. PENGATUR STRUKTUR KOLOM ISIAN FORMULIR --}}
            <div class="bg-white rounded-3xl shadow-xs border border-slate-200/80 overflow-hidden space-y-0">
                <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-gradient-to-r from-white to-slate-50/60">
                    <div>
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-sm">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                            <h3 class="font-extrabold text-slate-900 text-base">2. Struktur &amp; Kolom Isian Formulir Online</h3>
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-extrabold bg-indigo-50/60 text-indigo-600 border border-indigo-200">
                                {{ count($schema) }} Kolom
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Atur nama judul isian, tampilkan/sembunyikan kolom, atau tentukan kolom yang wajib diisi calon pendaftar.</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="showAddFieldModal = true" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-xs transition flex items-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-plus-circle"></i>
                            <span>Tambah Kolom Baru</span>
                        </button>
                        <button type="button" onclick="if(confirm('Apakah Anda yakin ingin mengembalikan seluruh kolom formulir ke susunan standar awal sekolah?')) { document.getElementById('resetFieldsForm').submit(); }" class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-3.5 py-2.5 rounded-xl transition flex items-center gap-1.5 cursor-pointer" title="Reset ke Standar">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span class="hidden sm:inline">Reset Standar</span>
                        </button>
                    </div>
                </div>

                {{-- Filter Kategori Tabs & Search Bar --}}
                <div class="p-4 bg-slate-50/70 border-b border-slate-100 space-y-3">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar pb-1 sm:pb-0">
                            <button type="button" @click="activeCategory = 'all'" :class="activeCategory === 'all' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="px-3 py-1.5 rounded-xl text-xs font-bold transition shrink-0 cursor-pointer">
                                Semua ({{ count($schema) }})
                            </button>
                            @foreach($sections as $sKey => $sInfo)
                                @php
                                    $countInSec = collect($schema)->where('section', $sKey)->count();
                                @endphp
                                <button type="button" @click="activeCategory = '{{ $sKey }}'" :class="activeCategory === '{{ $sKey }}' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="px-3 py-1.5 rounded-xl text-xs font-bold transition shrink-0 cursor-pointer flex items-center gap-1.5">
                                    <i class="{{ $sInfo['icon'] }} text-[10px]"></i>
                                    <span>{{ $sInfo['name'] }}</span>
                                    <span class="text-[10px] opacity-80 font-normal">({{ $countInSec }})</span>
                                </button>
                            @endforeach
                        </div>

                        <div class="relative w-full sm:w-64 shrink-0">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" x-model="searchQuery" placeholder="Cari nama kolom..." class="w-full bg-white text-xs rounded-xl pl-8 pr-3 py-1.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        </div>
                    </div>
                </div>

                {{-- Field List Rows --}}
                <div class="divide-y divide-slate-100">
                    @foreach($schema as $f)
                        @php
                            $isCustom = empty($f['is_system']);
                            $secKey = $f['section'] ?? 'tambahan';
                            $secInfo = $sections[$secKey] ?? ['name' => 'Lainnya', 'icon' => 'fa-solid fa-folder', 'color' => 'bg-slate-100 text-slate-700'];
                            $typeMeta = match($f['type']) {
                                'select' => ['label' => 'Pilihan', 'icon' => 'fa-solid fa-list', 'color' => 'bg-blue-50 text-blue-700 border-blue-200'],
                                'file' => ['label' => 'Upload File', 'icon' => 'fa-solid fa-paperclip', 'color' => 'bg-amber-50 text-amber-700 border-amber-200'],
                                'date' => ['label' => 'Tanggal', 'icon' => 'fa-solid fa-calendar', 'color' => 'bg-indigo-50 text-indigo-700 border-indigo-200'],
                                'number' => ['label' => 'Angka', 'icon' => 'fa-solid fa-hashtag', 'color' => 'bg-cyan-50 text-cyan-700 border-cyan-200'],
                                'textarea' => ['label' => 'Paragraf', 'icon' => 'fa-solid fa-align-left', 'color' => 'bg-indigo-50 text-indigo-700 border-indigo-200'],
                                'tel' => ['label' => 'Telepon/WA', 'icon' => 'fa-solid fa-phone', 'color' => 'bg-teal-50 text-teal-700 border-teal-200'],
                                default => ['label' => 'Teks', 'icon' => 'fa-solid fa-font', 'color' => 'bg-slate-100 text-slate-700 border-slate-200'],
                            };
                            $labelSafe = strtolower(addcslashes($f['label'], "'\r\n\\"));
                            $keySafe = strtolower(addcslashes($f['key'], "'\r\n\\"));
                        @endphp
                        <div x-show="(activeCategory === 'all' || activeCategory === '{{ $secKey }}') && (!searchQuery || '{{ $labelSafe }}'.includes(searchQuery.toLowerCase()) || '{{ $keySafe }}'.includes(searchQuery.toLowerCase()))" 
                             class="p-4 sm:px-6 hover:bg-slate-50/80 transition space-y-3"
                             :class="{ 'bg-slate-50/90': expandedField === '{{ $f['key'] }}' }">
                            
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                                <div class="flex items-center gap-3 flex-1 min-w-0">
                                    <span class="w-8 h-8 rounded-xl shrink-0 flex items-center justify-center text-xs font-bold border {{ $typeMeta['color'] }}" title="Tipe: {{ $typeMeta['label'] }}">
                                        <i class="{{ $typeMeta['icon'] }}"></i>
                                    </span>

                                    <div class="flex-1 min-w-0 flex flex-wrap items-center gap-2">
                                        <input type="text" name="fields[{{ $f['key'] }}][label]" value="{{ $f['label'] }}" 
                                               class="bg-slate-50 hover:bg-white focus:bg-white text-xs sm:text-sm font-bold text-slate-800 rounded-lg px-2.5 py-1.5 border border-slate-200 focus:border-indigo-600 focus:outline-none focus:ring-1 focus:ring-indigo-600 transition w-full sm:w-72 max-w-full"
                                               title="Klik untuk mengubah label/judul isian">
                                        
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md border uppercase {{ $typeMeta['color'] }}">
                                            {{ $typeMeta['label'] }}
                                        </span>

                                        @if($isCustom)
                                            <span class="text-[10px] font-black px-2 py-0.5 rounded-md bg-purple-100 text-purple-700 border border-purple-200">
                                                Kustom
                                            </span>
                                        @endif

                                        <span class="text-[10px] text-slate-400 font-mono hidden lg:inline">
                                            {{ $f['key'] }}
                                        </span>

                                        <span class="text-[10px] text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md hidden sm:inline-flex items-center gap-1">
                                            <i class="{{ $secInfo['icon'] }} text-[9px] text-slate-400"></i>
                                            <span>{{ $secInfo['name'] }}</span>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 sm:gap-3 shrink-0 pl-11 md:pl-0">
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer select-none bg-white hover:bg-slate-50 px-2.5 py-1.5 rounded-xl border border-slate-200 shadow-2xs transition text-xs font-semibold text-slate-700">
                                        <input type="checkbox" name="fields[{{ $f['key'] }}][enabled]" value="1" {{ !empty($f['enabled']) ? 'checked' : '' }} class="w-3.5 h-3.5 rounded text-indigo-600 focus:ring-indigo-600 border-slate-300">
                                        <span>Tampil</span>
                                    </label>

                                    <label class="inline-flex items-center gap-1.5 cursor-pointer select-none bg-white hover:bg-slate-50 px-2.5 py-1.5 rounded-xl border border-slate-200 shadow-2xs transition text-xs font-semibold text-slate-700">
                                        <input type="checkbox" name="fields[{{ $f['key'] }}][required]" value="1" {{ !empty($f['required']) ? 'checked' : '' }} class="w-3.5 h-3.5 rounded text-red-600 focus:ring-red-500 border-slate-300">
                                        <span>Wajib <span class="text-red-500 font-bold">*</span></span>
                                    </label>

                                    <button type="button" @click="expandedField = (expandedField === '{{ $f['key'] }}' ? null : '{{ $f['key'] }}')" 
                                            :class="expandedField === '{{ $f['key'] }}' ? 'bg-slate-800 text-white' : 'bg-slate-100 hover:bg-slate-200 text-slate-600'" 
                                            class="p-1.5 px-2 rounded-xl text-xs font-bold transition cursor-pointer flex items-center gap-1"
                                            title="Pengaturan Placeholder / Opsi Dropdown">
                                        <i class="fa-solid fa-gear text-[11px]"></i>
                                        <i class="fa-solid fa-chevron-down text-[9px] transition" :class="expandedField === '{{ $f['key'] }}' ? 'rotate-180' : ''"></i>
                                    </button>

                                    <button type="button" onclick="if(confirm('Hapus kolom \'{{ addslashes($f['label']) }}\' dari formulir PPDB?')) { document.getElementById('deleteFieldForm').action = '{{ route('admin.ppdb.fields.delete', $f['key']) }}'; document.getElementById('deleteFieldForm').submit(); }" 
                                            class="text-slate-400 hover:text-red-600 p-1.5 rounded-xl hover:bg-red-50 transition cursor-pointer text-xs" 
                                            title="Hapus Kolom Ini">
                                        <i class="fa-solid fa-trash-can text-[11px]"></i>
                                    </button>
                                </div>
                            </div>

                            <div x-show="expandedField === '{{ $f['key'] }}'" class="pt-3 pb-2 px-4 bg-white rounded-2xl border border-slate-200 space-y-3 mt-2 shadow-inner">
                                <div class="grid grid-cols-1 {{ $f['type'] === 'select' ? 'md:grid-cols-2' : '' }} gap-3">
                                    @if($f['type'] !== 'file' && $f['type'] !== 'select')
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                                                Teks Bantuan / Placeholder
                                            </label>
                                            <input type="text" name="fields[{{ $f['key'] }}][placeholder]" value="{{ $f['placeholder'] ?? '' }}" placeholder="Contoh teks bantuan saat kosong..." class="w-full bg-slate-50 text-xs rounded-xl px-3 py-2 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                        </div>
                                    @endif

                                    @if($f['type'] === 'file')
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                                                Petunjuk Upload Dokumen
                                            </label>
                                            <input type="text" name="fields[{{ $f['key'] }}][placeholder]" value="{{ $f['placeholder'] ?? '' }}" placeholder="Format JPG, PNG, atau PDF (Maks 5 MB)" class="w-full bg-slate-50 text-xs rounded-xl px-3 py-2 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                        </div>
                                    @endif

                                    @if($f['type'] === 'select')
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                                                Placeholder Pilihan Awal
                                            </label>
                                            <input type="text" name="fields[{{ $f['key'] }}][placeholder]" value="{{ $f['placeholder'] ?? '' }}" placeholder="Pilih salah satu..." class="w-full bg-slate-50 text-xs rounded-xl px-3 py-2 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                        </div>

                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">
                                                Daftar Pilihan Dropdown <span class="text-indigo-700 font-bold">(1 baris = 1 opsi)</span>
                                            </label>
                                            <textarea name="fields[{{ $f['key'] }}][options]" rows="4" class="w-full bg-slate-50 text-xs font-mono rounded-xl p-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ implode("\n", $f['options'] ?? []) }}</textarea>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 3. ACCORDION PENGATURAN LANJUTAN --}}
            <details class="group bg-white rounded-3xl shadow-xs border border-slate-200/80 overflow-hidden">
                <summary class="p-5 sm:p-6 flex items-center justify-between font-extrabold text-slate-800 text-sm cursor-pointer hover:bg-slate-50 transition select-none">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-sliders"></i>
                        </span>
                        <div>
                            <span class="block">3. Pengaturan Lanjutan (Opsi Teks Gelombang, Jalur &amp; Program)</span>
                            <span class="text-xs font-normal text-slate-500">Klik untuk melihat atau mengubah daftar opsi teks gelombang, jalur masuk, dan program belajar.</span>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-down text-slate-400 group-open:rotate-180 transition"></i>
                </summary>

                <div class="p-6 pt-2 border-t border-slate-100 space-y-6 bg-slate-50/50">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Pilihan Gelombang <span class="text-indigo-700 font-bold">(1 baris = 1 opsi)</span>
                            </label>
                            <textarea name="ppdb_form_waves" rows="5" class="w-full bg-white text-xs font-semibold rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_form_waves', $settings['form_waves']) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Pilihan Jalur Masuk Cadangan <span class="text-indigo-700 font-bold">(1 baris = 1 opsi)</span>
                            </label>
                            <textarea name="ppdb_form_tracks" rows="5" class="w-full bg-white text-xs font-semibold rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_form_tracks', $settings['form_tracks']) }}</textarea>
                            <p class="text-[10px] text-slate-400 mt-1">Disinkronkan otomatis dari Tab Jalur PPDB Dinamis.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Pilihan Program Belajar <span class="text-indigo-700 font-bold">(1 baris = 1 opsi)</span>
                            </label>
                            <textarea name="ppdb_form_programs" rows="5" class="w-full bg-white text-xs font-semibold rounded-xl p-3.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 leading-relaxed">{{ old('ppdb_form_programs', $settings['form_programs']) }}</textarea>
                        </div>
                    </div>

                    <input type="hidden" name="ppdb_form_require_payment" value="{{ $settings['form_require_payment'] ?? '1' }}">
                    <input type="hidden" name="ppdb_form_require_birth_cert" value="{{ $settings['form_require_birth_cert'] ?? '1' }}">
                    <input type="hidden" name="ppdb_form_nisn_rule" value="{{ $settings['form_nisn_rule'] ?? 'optional' }}">
                    <input type="hidden" name="ppdb_form_show_achievements" value="{{ $settings['form_show_achievements'] ?? '1' }}">
                    <input type="hidden" name="ppdb_form_show_hobbies" value="{{ $settings['form_show_hobbies'] ?? '1' }}">
                    <input type="hidden" name="ppdb_form_require_parent_income" value="{{ $settings['form_require_parent_income'] ?? '1' }}">
                </div>
            </details>

        </div>

        {{-- SUBMIT BAR STICKY UNTUK TAB BANNER, KONTEN & FORMULIR --}}
        <div x-show="currentTab !== 'jalur'" class="sticky bottom-4 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-slate-200 flex items-center justify-between z-20">
            <div class="text-xs text-slate-500 flex items-center gap-1.5">
                <i class="fa-solid fa-circle-check text-indigo-600"></i>
                <span>Semua perubahan konten, banner, dan formulir langsung diterapkan ke halaman website.</span>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.ppdb.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold transition">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black text-xs sm:text-sm px-8 py-3 rounded-xl shadow-lg shadow-indigo-600/25 transition cursor-pointer flex items-center space-x-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Pengaturan</span>
                </button>
            </div>
        </div>

    </form>

    {{-- ========================================================
         MODAL: TAMBAH JALUR PPDB BARU (DINAMIS DENGAN ICON PLUS)
         ======================================================== --}}
    <div x-show="showAddTrackModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" @click="showAddTrackModal = false"></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 space-y-6" @click.away="showAddTrackModal = false">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-red-100 text-[#da251c] flex items-center justify-center font-bold text-lg">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-slate-900 text-base">Tambah Jalur Pendaftaran Baru</h3>
                            <p class="text-xs text-slate-500">Jalur pendaftaran baru akan otomatis muncul di web PPDB dan formulir.</p>
                        </div>
                    </div>
                    <button type="button" @click="showAddTrackModal = false" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form action="{{ route('admin.ppdb.tracks.store') }}" method="POST" class="space-y-4 text-xs">
                    @csrf

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Jalur Pendaftaran <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required placeholder="Contoh: Jalur Mitra Kerjasama, Jalur Yatim/Dhuafa..." class="w-full bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#da251c] text-xs font-semibold">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Persentase / Diskon</label>
                            <input type="text" name="percentage" placeholder="Contoh: 15% atau 20%" class="w-full bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#da251c] text-xs font-semibold">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kuota Siswa (Opsional)</label>
                            <input type="text" name="quota" placeholder="Contoh: Hanya 15 Siswa" class="w-full bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#da251c] text-xs">
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Info Cashback / Keringanan Biaya</label>
                        <input type="text" name="cashback_info" placeholder="Contoh: Potongan Biaya Uang Pangkal Rp 500.000,-" class="w-full bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#da251c] text-xs">
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi &amp; Syarat Khusus Jalur</label>
                        <textarea name="description" rows="3" placeholder="Jelaskan ketentuan, syarat berkas khusus, atau tahapan tes untuk jalur ini..." class="w-full bg-slate-50 rounded-xl p-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#da251c] text-xs leading-relaxed"></textarea>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-slate-800 block text-xs">Aktifkan Jalur Ini?</span>
                            <span class="text-[10px] text-slate-500">Jalur aktif akan muncul di halaman informasi dan dropdown pilihan formulir PPDB.</span>
                        </div>
                        <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded text-[#da251c] focus:ring-[#da251c] border-slate-300">
                    </div>

                    <div class="pt-4 flex items-center justify-end space-x-3 border-t border-slate-100">
                        <button type="button" @click="showAddTrackModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" class="bg-[#da251c] hover:bg-[#b91c1c] text-white font-bold text-xs px-6 py-2.5 rounded-xl shadow-md shadow-red-500/25 transition flex items-center space-x-2 cursor-pointer">
                            <i class="fa-solid fa-plus"></i>
                            <span>Simpan Jalur Baru</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ========================================================
         MODAL: EDIT JALUR PPDB DINAMIS
         ======================================================== --}}
    <div x-show="showEditTrackModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" @click="showEditTrackModal = false"></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 space-y-6" @click.away="showEditTrackModal = false">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-slate-900 text-base">Edit Jalur Pendaftaran PPDB</h3>
                            <p class="text-xs text-slate-500">Perbarui nama, persentase alokasi, kuota, atau syarat jalur.</p>
                        </div>
                    </div>
                    <button type="button" @click="showEditTrackModal = false" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form :action="'{{ url('admin/ppdb/tracks') }}/' + editTrackData.id" method="POST" class="space-y-4 text-xs">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Jalur Pendaftaran <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required x-model="editTrackData.name" class="w-full bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 text-xs font-semibold">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Persentase / Diskon</label>
                            <input type="text" name="percentage" x-model="editTrackData.percentage" placeholder="Contoh: 10%" class="w-full bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 text-xs font-semibold">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kuota Siswa (Opsional)</label>
                            <input type="text" name="quota" x-model="editTrackData.quota" placeholder="Contoh: Hanya 24 Siswa" class="w-full bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 text-xs">
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Info Cashback / Keringanan Biaya</label>
                        <input type="text" name="cashback_info" x-model="editTrackData.cashback_info" placeholder="Contoh: Cashback Rp 1.000.000" class="w-full bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 text-xs">
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi &amp; Syarat Khusus Jalur</label>
                        <textarea name="description" rows="4" x-model="editTrackData.description" class="w-full bg-slate-50 rounded-xl p-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 text-xs leading-relaxed"></textarea>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-slate-800 block text-xs">Aktifkan Jalur Ini?</span>
                            <span class="text-[10px] text-slate-500">Jika aktif, jalur ini muncul di web PPDB dan formulir pendaftaran.</span>
                        </div>
                        <input type="checkbox" name="is_active" value="1" :checked="editTrackData.is_active == 1" class="w-5 h-5 rounded text-blue-600 focus:ring-blue-600 border-slate-300">
                    </div>

                    <div class="pt-4 flex items-center justify-end space-x-3 border-t border-slate-100">
                        <button type="button" @click="showEditTrackModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs px-6 py-2.5 rounded-xl shadow-md shadow-blue-600/25 transition flex items-center space-x-2 cursor-pointer">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Simpan Perubahan Jalur</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- HIDDEN FORM UNTUK DELETE FIELD --}}
    <form id="deleteFieldForm" method="POST" action="" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    {{-- HIDDEN FORM UNTUK RESET FIELDS --}}
    <form id="resetFieldsForm" method="POST" action="{{ route('admin.ppdb.fields.reset') }}" style="display: none;">
        @csrf
    </form>

    {{-- MODAL TAMBAH KOLOM ISIAN BARU --}}
    <div x-show="showAddFieldModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" @click="showAddFieldModal = false"></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 space-y-6" @click.away="showAddFieldModal = false">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-indigo-600 flex items-center justify-center font-bold text-lg">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-slate-900 text-base">Tambah Kolom Isian Baru</h3>
                            <p class="text-xs text-slate-500">Buat kolom kustom baru untuk formulir PPDB online.</p>
                        </div>
                    </div>
                    <button type="button" @click="showAddFieldModal = false" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form action="{{ route('admin.ppdb.fields.add') }}" method="POST" class="space-y-4 text-xs">
                    @csrf

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama / Label Kolom <span class="text-red-500">*</span></label>
                        <input type="text" name="label" required placeholder="Contoh: Nomor Kartu Keluarga, Ukuran Baju, dsb..." class="w-full bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 text-xs font-semibold">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori / Bagian <span class="text-red-500">*</span></label>
                            <select name="section" required class="w-full bg-slate-50 rounded-xl px-3 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 text-xs font-semibold">
                                @foreach($sections as $sKey => $sInfo)
                                    <option value="{{ $sKey }}">{{ $sInfo['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tipe Input <span class="text-red-500">*</span></label>
                            <select name="type" x-model="newFieldType" required class="w-full bg-slate-50 rounded-xl px-3 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 text-xs font-semibold">
                                <option value="text">Teks Pendek</option>
                                <option value="number">Angka / Nomor</option>
                                <option value="date">Tanggal</option>
                                <option value="select">Pilihan Dropdown (Select)</option>
                                <option value="textarea">Teks Panjang (Paragraf)</option>
                                <option value="tel">Nomor Telepon / WA</option>
                                <option value="file">Upload Berkas / File</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Placeholder / Petunjuk Isian</label>
                        <input type="text" name="placeholder" placeholder="Contoh: Masukkan 16 digit no KK..." class="w-full bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 text-xs">
                    </div>

                    <div x-show="newFieldType === 'select'" style="display: none;">
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Opsi Pilihan Dropdown <span class="text-indigo-700 font-normal">(1 baris = 1 opsi)</span> <span class="text-red-500">*</span>
                        </label>
                        <textarea name="options" rows="3" placeholder="Opsi 1&#10;Opsi 2&#10;Opsi 3" class="w-full bg-slate-50 font-mono rounded-xl p-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 text-xs"></textarea>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-slate-800 block text-xs">Wajib Diisi oleh Pendaftar?</span>
                            <span class="text-[10px] text-slate-500">Jika aktif, formulir tidak dapat dikirim sebelum kolom ini diisi.</span>
                        </div>
                        <input type="checkbox" name="required" value="1" class="w-5 h-5 rounded text-indigo-600 focus:ring-indigo-600 border-slate-300">
                    </div>

                    <div class="pt-4 flex items-center justify-end space-x-3 border-t border-slate-100">
                        <button type="button" @click="showAddFieldModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-bold transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs px-6 py-2.5 rounded-xl shadow-md shadow-indigo-600/25 transition flex items-center space-x-2 cursor-pointer">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambahkan Kolom</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
