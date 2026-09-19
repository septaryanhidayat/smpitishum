@extends('layouts.admin')

@section('title', 'Pengaturan Banner Hero Slider')
@section('header_title', 'Banner Hero Slider')

@section('content')
<div class="max-w-5xl mx-auto space-y-6" x-data="{ activeTab: 0 }">

    {{-- HEADER & PRATINJAU --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-2.5">
                <span class="w-9 h-9 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-images"></i>
                </span>
                <span>Pengaturan Banner Hero Slider Beranda</span>
            </h2>
            <p class="text-xs text-slate-500 mt-1">Kelola gambar latar belakang, teks judul, subjudul, serta tulisan dan link tujuan tombol aksi pada carousel utama di bagian atas website.</p>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('home') }}" target="_blank" class="text-xs font-bold text-slate-700 hover:text-indigo-600 bg-white border border-slate-200 hover:bg-slate-50 px-4 py-2.5 rounded-xl transition flex items-center space-x-2 shadow-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-indigo-600"></i>
                <span>Lihat di Beranda</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center space-x-3 shadow-xs">
            <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold space-y-1 shadow-xs">
            <div class="font-bold flex items-center space-x-2">
                <i class="fa-solid fa-triangle-exclamation text-rose-600"></i>
                <span>Terdapat kesalahan pada input formulir:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-rose-700 pl-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- TAB NAVIGASI SLIDE --}}
        <div class="bg-white p-2.5 rounded-2xl shadow-xs border border-slate-200/80 flex flex-wrap gap-2">
            @foreach($slides as $index => $slide)
                <button type="button" 
                        @click="activeTab = {{ $index }}" 
                        :class="activeTab === {{ $index }} ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20 font-black' : 'bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold border border-slate-200/60'"
                        class="flex-1 min-w-[150px] px-4 py-2.5 rounded-xl text-xs flex items-center justify-between transition group">
                    <span class="flex items-center space-x-2">
                        <i class="fa-solid fa-layer-group text-[11px]" :class="activeTab === {{ $index }} ? 'text-amber-300' : 'text-slate-400'"></i>
                        <span>Slide #{{ $index + 1 }}</span>
                    </span>
                    <span class="text-[10px] px-2 py-0.5 rounded-full font-extrabold {{ !empty($slide['active']) ? 'bg-emerald-500/20 text-emerald-200 group-hover:text-emerald-700' : 'bg-slate-300 text-slate-600' }}"
                          :class="activeTab === {{ $index }} ? 'bg-white/20 text-white' : ''">
                        {{ !empty($slide['active']) ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </button>
            @endforeach
        </div>

        {{-- KONTEN SLIDE MASING-MASING --}}
        @foreach($slides as $index => $slide)
            <div x-show="activeTab === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-white rounded-3xl shadow-xs border border-slate-200/80 p-6 sm:p-8 space-y-8">
                
                {{-- STATUS TOGGLE & INFORMASI SLIDE --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 font-black flex items-center justify-center text-sm border border-indigo-100">
                            #{{ $index + 1 }}
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm">Status Tayang Slide #{{ $index + 1 }}</h4>
                            <p class="text-xs text-slate-500">Tentukan apakah slide ini aktif ditampilkan pada rotasi banner beranda.</p>
                        </div>
                    </div>

                    <label class="relative inline-flex items-center cursor-pointer select-none">
                        <input type="checkbox" name="slides[{{ $index }}][active]" value="1" {{ !empty($slide['active']) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        <span class="ml-2.5 text-xs font-bold text-slate-700">Aktifkan Slide Ini</span>
                    </label>
                </div>

                {{-- BACKGROUND BANNER & PREVIEW --}}
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            <i class="fa-solid fa-image text-indigo-600 mr-1.5"></i>
                            Gambar Latar Belakang (Background Banner)
                        </label>
                        <span class="text-[11px] text-slate-400 font-semibold">Rekomendasi rasio 16:9 (1920x1080 px atau 1376x768 px)</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                        {{-- Preview Box --}}
                        <div class="md:col-span-6 space-y-2">
                            <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-950 border-2 border-slate-200 shadow-md group">
                                <img id="heroPreviewImg_{{ $index }}" 
                                     src="{{ asset($slide['image'] ?? '/uploads/campus-smpit-ishum.webp') }}" 
                                     alt="Preview Banner Slide {{ $index + 1 }}" 
                                     class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500"
                                     onerror="this.src='/uploads/campus-smpit-ishum.webp'">
                                
                                {{-- Overlay preview badge & title --}}
                                <div class="absolute inset-0 bg-slate-950/40 p-4 flex flex-col justify-end text-white pointer-events-none">
                                    <span class="text-[9px] bg-amber-400 text-slate-950 font-black px-2 py-0.5 rounded-full inline-block self-start mb-1 truncate max-w-full">
                                        {{ $slide['badge'] ?? 'Badge Emas' }}
                                    </span>
                                    <h5 class="text-xs font-black drop-shadow line-clamp-1">
                                        {{ $slide['title'] ?? 'Judul Banner Slide' }}
                                    </h5>
                                </div>
                            </div>
                            <p class="text-[11px] text-slate-500 flex items-center justify-between">
                                <span class="truncate">File saat ini: <code class="text-indigo-600 font-bold">{{ $slide['image'] ?? '-' }}</code></span>
                            </p>
                        </div>

                        {{-- Upload Inputs --}}
                        <div class="md:col-span-6 space-y-4">
                            <input type="hidden" name="slides[{{ $index }}][existing_image]" value="{{ $slide['image'] ?? '/uploads/campus-smpit-ishum.webp' }}">

                            <div class="space-y-1.5">
                                <label for="slide_img_file_{{ $index }}" class="block text-xs font-bold text-slate-700">
                                    Unggah File Gambar Baru (Otomatis WebP)
                                </label>
                                <input type="file" 
                                       name="slides[{{ $index }}][image_file]" 
                                       id="slide_img_file_{{ $index }}" 
                                       accept="image/jpeg,image/png,image/jpg,image/webp" 
                                       class="slide-file-input w-full text-xs text-slate-700 font-medium file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-extrabold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 file:cursor-pointer transition border border-slate-200 rounded-xl"
                                       data-preview-target="heroPreviewImg_{{ $index }}">
                                <p class="text-[10px] text-slate-500">Mendukung format JPG, PNG, atau WebP (Maks. 5 MB). Gambar akan otomatis dikonversi dan dikompresi agar web tetap sangat cepat.</p>
                            </div>

                            <div class="space-y-1.5 pt-2 border-t border-slate-100">
                                <label for="slide_img_url_{{ $index }}" class="block text-xs font-bold text-slate-700">
                                    Atau Gunakan Jalur / URL Gambar
                                </label>
                                <input type="text" 
                                       name="slides[{{ $index }}][image_url]" 
                                       id="slide_img_url_{{ $index }}" 
                                       value="{{ $slide['image'] ?? '' }}" 
                                       placeholder="/uploads/nama-file.webp atau https://..." 
                                       class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KONTEN TEKS (BADGE, JUDUL, SUBJUDUL) --}}
                <div class="space-y-4 pt-6 border-t border-slate-100">
                    <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-heading text-indigo-600"></i>
                        Teks &amp; Judul Slide
                    </h4>

                    <div class="space-y-4">
                        {{-- Badge Emas --}}
                        <div>
                            <label for="slide_badge_{{ $index }}" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Teks Label Emas di Atas Judul
                            </label>
                            <input type="text" 
                                   name="slides[{{ $index }}][badge]" 
                                   id="slide_badge_{{ $index }}" 
                                   value="{{ old('slides.'.$index.'.badge', $slide['badge'] ?? 'SMPS IT Unggulan Kota Prabumulih • Terakreditasi B') }}" 
                                   placeholder="Contoh: SMPS IT Unggulan Kota Prabumulih • Terakreditasi B" 
                                   class="w-full bg-slate-50 text-xs font-semibold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        </div>

                        {{-- Judul Besar --}}
                        <div>
                            <label for="slide_title_{{ $index }}" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Judul Utama Banner <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   name="slides[{{ $index }}][title]" 
                                   id="slide_title_{{ $index }}" 
                                   required 
                                   value="{{ old('slides.'.$index.'.title', $slide['title'] ?? '') }}" 
                                   placeholder="Contoh: Selamat Datang di Website Resmi" 
                                   class="w-full bg-slate-50 text-sm font-bold rounded-xl px-4 py-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        </div>

                        {{-- Subjudul / Deskripsi --}}
                        <div>
                            <label for="slide_subtitle_{{ $index }}" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Subjudul / Deskripsi Kalimat Penjelas
                            </label>
                            <textarea name="slides[{{ $index }}][subtitle]" 
                                      id="slide_subtitle_{{ $index }}" 
                                      rows="2" 
                                      placeholder="Contoh: SMPS IT Ishlahul Ummah Prabumulih atau deskripsi singkat keunggulan..." 
                                      class="w-full bg-slate-50 text-xs font-medium rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ old('slides.'.$index.'.subtitle', $slide['subtitle'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- PENGATURAN TOMBOL AKSI 1 & 2 --}}
                <div class="space-y-6 pt-6 border-t border-slate-100">
                    <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-square-arrow-up-right text-indigo-600"></i>
                        Tombol Aksi Banner (Button Call-to-Action)
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- TOMBOL UTAMA (KUNING EMAS) --}}
                        <div class="p-5 rounded-2xl bg-amber-500/5 border border-amber-300/60 space-y-4">
                            <div class="flex items-center justify-between pb-2 border-b border-amber-200/50">
                                <div class="flex items-center space-x-2">
                                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                    <h5 class="text-xs font-extrabold text-slate-900">Tombol Utama (Kuning Emas)</h5>
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 bg-amber-100 px-2 py-0.5 rounded-md">Primer</span>
                            </div>

                            <div>
                                <label for="slide_btn_text_{{ $index }}" class="block text-xs font-bold text-slate-700 mb-1">
                                    Tulisan / Teks Tombol
                                </label>
                                <input type="text" 
                                       name="slides[{{ $index }}][btn_text]" 
                                       id="slide_btn_text_{{ $index }}" 
                                       value="{{ old('slides.'.$index.'.btn_text', $slide['btn_text'] ?? 'Sambutan Kepala Sekolah') }}" 
                                       placeholder="Contoh: Sambutan Kepala Sekolah" 
                                       class="w-full bg-white text-xs font-semibold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            </div>

                            <div>
                                <label for="slide_btn_link_{{ $index }}" class="block text-xs font-bold text-slate-700 mb-1">
                                    Link / URL Tujuan Tombol
                                </label>
                                <input type="text" 
                                       name="slides[{{ $index }}][btn_link]" 
                                       id="slide_btn_link_{{ $index }}" 
                                       value="{{ old('slides.'.$index.'.btn_link', $slide['btn_link'] ?? '#') }}" 
                                       placeholder="Contoh: /sambutan-kepala-sekolah atau https://..." 
                                       class="w-full bg-white text-xs font-semibold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            </div>

                            <div>
                                <label for="slide_btn_target_{{ $index }}" class="block text-xs font-bold text-slate-700 mb-1">
                                    Target Jendela Pembukaan Link
                                </label>
                                <select name="slides[{{ $index }}][btn_target]" 
                                        id="slide_btn_target_{{ $index }}" 
                                        class="w-full bg-white text-xs font-semibold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                    <option value="_self" {{ ($slide['btn_target'] ?? '_self') === '_self' ? 'selected' : '' }}>Buka di Halaman yang Sama (_self)</option>
                                    <option value="_blank" {{ ($slide['btn_target'] ?? '') === '_blank' ? 'selected' : '' }}>Buka di Tab Baru (_blank)</option>
                                </select>
                            </div>
                        </div>

                        {{-- TOMBOL KEDUA (BIRU INDIGO / SPMB) --}}
                        <div class="p-5 rounded-2xl bg-indigo-50/50 border border-indigo-200 space-y-4">
                            <div class="flex items-center justify-between pb-2 border-b border-indigo-100">
                                <div class="flex items-center space-x-2">
                                    <span class="w-3 h-3 rounded-full bg-indigo-600"></span>
                                    <h5 class="text-xs font-extrabold text-slate-900">Tombol Kedua (Biru Indigo / SPMB)</h5>
                                </div>
                                
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input type="checkbox" name="slides[{{ $index }}][btn2_active]" value="1" {{ !isset($slide['btn2_active']) || $slide['btn2_active'] ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                                    <span class="ml-2 text-[11px] font-bold text-slate-700">Tampilkan</span>
                                </label>
                            </div>

                            <div>
                                <label for="slide_btn2_text_{{ $index }}" class="block text-xs font-bold text-slate-700 mb-1">
                                    Tulisan / Teks Tombol
                                </label>
                                <input type="text" 
                                       name="slides[{{ $index }}][btn2_text]" 
                                       id="slide_btn2_text_{{ $index }}" 
                                       value="{{ old('slides.'.$index.'.btn2_text', $slide['btn2_text'] ?? 'Info SPMB') }}" 
                                       placeholder="Contoh: Info SPMB atau Hubungi Kami" 
                                       class="w-full bg-white text-xs font-semibold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            </div>

                            <div>
                                <label for="slide_btn2_link_{{ $index }}" class="block text-xs font-bold text-slate-700 mb-1">
                                    Link / URL Tujuan Tombol
                                </label>
                                <input type="text" 
                                       name="slides[{{ $index }}][btn2_link]" 
                                       id="slide_btn2_link_{{ $index }}" 
                                       value="{{ old('slides.'.$index.'.btn2_link', $slide['btn2_link'] ?? '/ppdb') }}" 
                                       placeholder="Contoh: /ppdb atau https://..." 
                                       class="w-full bg-white text-xs font-semibold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            </div>

                            <div>
                                <label for="slide_btn2_target_{{ $index }}" class="block text-xs font-bold text-slate-700 mb-1">
                                    Target Jendela Pembukaan Link
                                </label>
                                <select name="slides[{{ $index }}][btn2_target]" 
                                        id="slide_btn2_target_{{ $index }}" 
                                        class="w-full bg-white text-xs font-semibold rounded-xl px-3.5 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                    <option value="_self" {{ ($slide['btn2_target'] ?? '_self') === '_self' ? 'selected' : '' }}>Buka di Halaman yang Sama (_self)</option>
                                    <option value="_blank" {{ ($slide['btn2_target'] ?? '') === '_blank' ? 'selected' : '' }}>Buka di Tab Baru (_blank)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach

        {{-- TOMBOL SIMPAN GLOBAL --}}
        <div class="sticky bottom-4 z-20 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-slate-200 flex items-center justify-between gap-4">
            <div class="text-xs text-slate-500 font-medium hidden sm:block">
                <i class="fa-solid fa-circle-info text-indigo-600 mr-1"></i>
                Perubahan pada semua slide akan langsung disimpan sekaligus.
            </div>

            <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white px-8 py-3.5 rounded-xl font-black text-xs shadow-lg shadow-indigo-600/30 transition transform hover:scale-[1.02] flex items-center justify-center space-x-2">
                <i class="fa-solid fa-floppy-disk text-sm"></i>
                <span>Simpan Semua Perubahan Banner Hero</span>
            </button>
        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview on file change
        const fileInputs = document.querySelectorAll('.slide-file-input');
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const targetId = this.getAttribute('data-preview-target');
                const previewImg = document.getElementById(targetId);
                if (previewImg && this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImg.src = event.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });
</script>
@endsection
