@extends('layouts.frontend')

@section('title', 'Formulir Pendaftaran PPDB ' . ($formSettings['year'] ?? '2026/2027') . ' - SMPS IT Ishlahul Ummah Prabumulih')
@section('meta_description', 'Formulir Pendaftaran Peserta Didik Baru (PPDB Online) SMPS IT Ishlahul Ummah Prabumulih Tahun Pelajaran ' . ($formSettings['year'] ?? '2026/2027') . '.')

@section('content')
<div class="bg-gray-50 py-10 sm:py-14 font-['Poppins',sans-serif]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        {{-- JIKA FORMULIR SEDANG DITUTUP SEMENTARA --}}
        @if(($formSettings['status'] ?? '1') === '0')
            <div class="bg-white rounded-3xl shadow-xl border border-slate-200/80 p-8 sm:p-12 text-center space-y-6">
                <div class="w-24 h-24 mx-auto rounded-3xl bg-amber-50 text-amber-600 flex items-center justify-center text-4xl shadow-inner">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="space-y-2">
                    <span class="inline-block bg-amber-100 text-amber-800 text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-wider">
                        Pemberitahuan SPMB
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        Pendaftaran Online Ditutup Sementara
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-600 max-w-lg mx-auto leading-relaxed pt-2">
                        {{ $formSettings['closed_message'] ?? 'Pendaftaran PPDB online saat ini sedang ditutup sementara atau kuota telah terpenuhi. Silakan hubungi panitia melalui WhatsApp untuk informasi gelombang berikutnya.' }}
                    </p>
                </div>

                @php
                    $cleanHotline = preg_replace('/[^0-9]/', '', (string) ($formSettings['hotline_phone'] ?? '085269908696'));
                    if (str_starts_with($cleanHotline, '0')) {
                        $cleanHotline = '62' . substr($cleanHotline, 1);
                    }
                @endphp
                <div class="pt-4 flex flex-wrap items-center justify-center gap-3">
                    <a href="https://wa.me/{{ $cleanHotline }}?text={{ urlencode('Assalamu\'alaikum Panitia PPDB SMPS IT Ishlahul Ummah, saya ingin menanyakan jadwal pendaftaran/kuota siswa baru.') }}" target="_blank" class="inline-flex items-center space-x-2 bg-indigo-600 hover:bg-indigo-700 text-white px-7 py-3.5 rounded-2xl text-xs sm:text-sm font-black transition shadow-lg shadow-indigo-600/25">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                        <span>Hubungi Panitia via WhatsApp</span>
                    </a>
                    <a href="{{ route('ppdb.index') }}" class="inline-flex items-center space-x-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-3.5 rounded-2xl text-xs sm:text-sm font-bold transition">
                        <i class="fa-solid fa-circle-info text-sm"></i>
                        <span>Lihat Informasi PPDB</span>
                    </a>
                </div>
            </div>

        @else

        {{-- FORM CONTAINER CARD --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-200/80 p-6 sm:p-10 space-y-8">
            
            {{-- HEADER LOGO & JUDUL --}}
            <div class="text-center space-y-4">
                <div class="w-24 h-24 sm:w-28 sm:h-28 mx-auto p-1 rounded-2xl flex items-center justify-center">
                    <img src="/uploads/logo-ishum-square.png" alt="Logo SMPS IT Ishlahul Ummah" class="h-full w-auto object-contain">
                </div>

                <div class="space-y-1">
                    <h1 class="text-lg sm:text-xl md:text-2xl font-black text-indigo-600 tracking-tight leading-snug">
                        Formulir Pendaftaran Peserta Didik Baru<br>
                        SMPS IT Ishlahul Ummah Prabumulih
                    </h1>
                    <p class="text-xs text-slate-500 max-w-md mx-auto">
                        Isi formulir dengan data yang sah dan lengkap. Tanda bintang (<span class="text-red-500 font-bold">*</span>) wajib diisi.
                    </p>
                </div>
            </div>

            {{-- KOTAK PENGUMUMAN / INFO ATAS FORM --}}
            @if(!empty($formSettings['announcement']))
                <div class="p-4 rounded-2xl bg-indigo-50/60 border border-indigo-200 text-emerald-900 text-xs flex items-start space-x-3 shadow-xs">
                    <div class="w-7 h-7 rounded-xl bg-emerald-200 text-indigo-600 flex items-center justify-center font-bold flex-shrink-0 mt-0.5">
                        <i class="fa-solid fa-bullhorn text-xs"></i>
                    </div>
                    <div class="leading-relaxed">
                        <strong class="block text-emerald-950 font-bold mb-0.5">Petunjuk &amp; Pengumuman Pendaftaran:</strong>
                        <span>{{ $formSettings['announcement'] }}</span>
                    </div>
                </div>
            @endif

            {{-- ERROR SUMMARY IF ANY --}}
            <div id="ppdb-ajax-error-box" class="hidden p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1.5 transition-all">
                <p class="font-bold flex items-center">
                    <i class="fa-solid fa-circle-exclamation mr-1.5 text-red-500"></i>
                    <span id="ppdb-ajax-error-title">Mohon periksa kembali isian formulir:</span>
                </p>
                <ul id="ppdb-ajax-error-list" class="list-disc list-inside space-y-0.5"></ul>
            </div>

            @if($errors->any())
                <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
                    <p class="font-bold flex items-center">
                        <i class="fa-solid fa-circle-exclamation mr-1.5 text-red-500"></i>
                        Mohon periksa kembali isian formulir:
                    </p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- NOTIFIKASI JALUR TERPILIH OTOMATIS --}}
            @if(request('jalur') || request('track'))
                <div class="p-3.5 sm:p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-950 flex items-center justify-between gap-3 shadow-xs">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-route"></i>
                        </div>
                        <div>
                            <span class="font-black text-emerald-900 block text-xs sm:text-sm">Jalur Pilihan: {{ request('jalur') ?? request('track') }}</span>
                            <span class="text-[11px] text-emerald-700">Jalur pendaftaran ini telah otomatis terpilih pada kolom formulir di bawah.</span>
                        </div>
                    </div>
                    <a href="{{ route('ppdb.index') }}" class="text-[11px] font-bold text-emerald-800 underline hover:text-emerald-950 shrink-0">
                        Ganti Jalur
                    </a>
                </div>
            @endif

            {{-- REGISTRATION FORM --}}
            <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs text-slate-700">
                @csrf

                @php
                    $sectionIndex = 1;
                @endphp

                @foreach($sections as $secKey => $secInfo)
                    @if(!empty($groupedFields[$secKey]) && count($groupedFields[$secKey]) > 0)
                        <div class="space-y-4 pt-4 border-t border-slate-100 first:border-t-0 first:pt-2">
                            <div class="pb-2 border-b border-indigo-100 flex items-center space-x-2">
                                <span class="w-6 h-6 rounded-lg bg-emerald-100 text-indigo-600 font-bold text-xs flex items-center justify-center">
                                    {{ $sectionIndex++ }}
                                </span>
                                <h2 class="text-sm font-black text-slate-800 uppercase tracking-wider flex items-center gap-2">
                                    <i class="{{ $secInfo['icon'] ?? 'fa-solid fa-folder' }} text-indigo-600"></i>
                                    <span>{{ $secInfo['name'] }}</span>
                                </h2>
                            </div>

                            @if($secKey === 'pilihan')
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
                                    @foreach($groupedFields[$secKey] as $f)
                                        @include('frontend.ppdb.partials.form_field', ['field' => $f])
                                    @endforeach
                                </div>
                            @elseif($secKey === 'berkas')
                                <div class="space-y-4">
                                    @foreach($groupedFields[$secKey] as $f)
                                        @include('frontend.ppdb.partials.form_field', ['field' => $f])
                                    @endforeach
                                </div>
                            @else
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                    @foreach($groupedFields[$secKey] as $f)
                                        @php
                                            $isFullWidth = in_array($f['type'], ['textarea']) || in_array($f['key'], ['full_name', 'address', 'father_address', 'mother_address', 'achievements']);
                                        @endphp
                                        <div class="{{ $isFullWidth ? 'sm:col-span-2' : '' }}">
                                            @include('frontend.ppdb.partials.form_field', ['field' => $f])
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach

                {{-- SUBMIT BUTTON --}}
                <div class="pt-8 pb-4 text-center space-y-3">
                    <button type="submit" id="ppdb-submit-btn" class="w-full sm:w-auto sm:min-w-[320px] max-w-full bg-gradient-to-r from-[#da251c] to-[#b91c1c] hover:from-[#b91c1c] hover:to-[#991c1c] text-white font-black text-sm sm:text-lg px-6 sm:px-10 py-4 rounded-2xl shadow-xl shadow-red-500/30 hover:shadow-2xl transition-all transform hover:-translate-y-1 cursor-pointer uppercase tracking-wider inline-flex items-center justify-center gap-3">
                        <i class="fa-solid fa-paper-plane text-lg sm:text-xl" id="ppdb-submit-icon"></i>
                        <span id="ppdb-submit-label">Kirim Formulir Pendaftaran</span>
                    </button>

                    {{-- UPLOAD PROGRESS BAR --}}
                    <div id="ppdb-progress-box" class="hidden max-w-sm mx-auto space-y-1.5 pt-1">
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                            <div id="ppdb-progress-bar" class="bg-indigo-600 h-2.5 rounded-full transition-all duration-300" style="width: 35%"></div>
                        </div>
                        <p id="ppdb-progress-status" class="text-[11px] text-slate-500 font-bold">
                            <i class="fa-solid fa-spinner fa-spin mr-1 text-indigo-600"></i>
                            <span id="ppdb-progress-text">Mengirim formulir pendaftaran & berkas...</span>
                        </p>
                    </div>

                    @if($formSettings['wa_confirm'])
                        <p class="text-xs text-slate-600 font-semibold mt-2">
                            <i class="fa-brands fa-whatsapp text-indigo-600 mr-1 text-sm"></i>
                            Setelah formulir dikirim, seluruh data pendaftaran akan otomatis diteruskan ke WhatsApp Panitia PPDB.
                        </p>
                    @endif
                </div>
            </form>

            {{-- FOOTER --}}
            <div class="pt-8 text-center border-t border-slate-100">
                <div class="flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-400 gap-2 text-center sm:text-left">
                    <span>PPDB SMPS IT Ishlahul Ummah Prabumulih</span>
                    <span>Hak Cipta Dilindungi Undang-Undang</span>
                </div>
            </div>

        </div>

        @endif

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ppdbForm = document.querySelector('form[action="{{ route('ppdb.store') }}"]');
        if (!ppdbForm) return;

        // In-memory file storage: Holds safe, detached File instances created from memory buffers
        // This permanently eliminates Android Chrome's net::ERR_UPLOAD_FILE_CHANGED bug.
        const safeFileMap = new Map();

        // Helper to format bytes cleanly
        function formatBytes(bytes) {
            if (!bytes || bytes === 0) return '0 B';
            const k = 1024;
            const sizes = ['B', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }

        // Process file: reads bytes immediately into memory buffer and compresses images via Canvas
        async function processFileToSafeBlob(file) {
            const isPdf = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');
            const isImage = file.type.startsWith('image/') || /\.(jpe?g|png|webp|bmp|gif)$/i.test(file.name);

            // 1. PDF File: Read raw bytes into memory buffer
            if (isPdf) {
                const buffer = await file.arrayBuffer();
                const safeBlob = new Blob([buffer], { type: 'application/pdf' });
                const safeFile = new File([safeBlob], file.name, {
                    type: 'application/pdf',
                    lastModified: Date.now()
                });
                return {
                    file: safeFile,
                    previewUrl: null,
                    isImage: false,
                    isPdf: true,
                    originalSize: file.size,
                    finalSize: safeFile.size
                };
            }

            // 2. Image File: Compress client-side with Canvas (resolves phone camera 10MB+ images)
            if (isImage) {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = new Image();
                        img.onload = function () {
                            const canvas = document.createElement('canvas');
                            let width = img.width;
                            let height = img.height;
                            const maxDimension = 1600;

                            if (width > maxDimension || height > maxDimension) {
                                if (width > height) {
                                    height = Math.round((height * maxDimension) / width);
                                    width = maxDimension;
                                } else {
                                    width = Math.round((width * maxDimension) / height);
                                    height = maxDimension;
                                }
                            }

                            canvas.width = width;
                            canvas.height = height;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0, width, height);

                            // Prefer WebP export if supported, otherwise JPEG
                            let targetMime = 'image/webp';
                            try {
                                const check = canvas.toDataURL('image/webp');
                                if (!check.startsWith('data:image/webp')) {
                                    targetMime = 'image/jpeg';
                                }
                            } catch (err) {
                                targetMime = 'image/jpeg';
                            }

                            const extension = targetMime === 'image/webp' ? '.webp' : '.jpg';
                            const baseName = file.name.replace(/\.[^.]+$/, '');
                            const outFileName = (baseName || 'foto') + extension;

                            canvas.toBlob(function (blob) {
                                if (!blob) {
                                    // Fallback if toBlob fails
                                    const fallbackFile = new File([e.target.result], file.name, {
                                        type: file.type || 'image/jpeg',
                                        lastModified: Date.now()
                                    });
                                    resolve({
                                        file: fallbackFile,
                                        previewUrl: e.target.result,
                                        isImage: true,
                                        isPdf: false,
                                        originalSize: file.size,
                                        finalSize: fallbackFile.size
                                    });
                                    return;
                                }

                                const safeFile = new File([blob], outFileName, {
                                    type: targetMime,
                                    lastModified: Date.now()
                                });

                                resolve({
                                    file: safeFile,
                                    previewUrl: URL.createObjectURL(blob),
                                    isImage: true,
                                    isPdf: false,
                                    originalSize: file.size,
                                    finalSize: safeFile.size
                                });
                            }, targetMime, 0.82);
                        };
                        img.onerror = () => {
                            // If image decoding fails, read as raw ArrayBuffer
                            file.arrayBuffer().then(buf => {
                                const safeBlob = new Blob([buf], { type: file.type || 'application/octet-stream' });
                                const safeFile = new File([safeBlob], file.name, { type: file.type, lastModified: Date.now() });
                                resolve({
                                    file: safeFile,
                                    previewUrl: null,
                                    isImage: false,
                                    isPdf: false,
                                    originalSize: file.size,
                                    finalSize: safeFile.size
                                });
                            }).catch(reject);
                        };
                        img.src = e.target.result;
                    };
                    reader.onerror = reject;
                    reader.readAsDataURL(file);
                });
            }

            // 3. Fallback for any other file type
            const buffer = await file.arrayBuffer();
            const safeBlob = new Blob([buffer], { type: file.type || 'application/octet-stream' });
            const safeFile = new File([safeBlob], file.name, {
                type: file.type || 'application/octet-stream',
                lastModified: Date.now()
            });
            return {
                file: safeFile,
                previewUrl: null,
                isImage: false,
                isPdf: false,
                originalSize: file.size,
                finalSize: safeFile.size
            };
        }

        // Attach listeners to all PPDB file inputs
        document.querySelectorAll('.ppdb-file-upload-wrapper').forEach(wrapper => {
            const fieldKey = wrapper.getAttribute('data-field-key');
            const fileInput = wrapper.querySelector('.ppdb-file-input');
            const previewBox = wrapper.querySelector('.ppdb-file-preview');
            const previewImg = wrapper.querySelector('.ppdb-preview-img');
            const previewIcon = wrapper.querySelector('.ppdb-preview-icon');
            const previewSpinner = wrapper.querySelector('.ppdb-preview-spinner');
            const fileNameEl = wrapper.querySelector('.ppdb-file-name');
            const fileSizeEl = wrapper.querySelector('.ppdb-file-size');
            const fileStatusEl = wrapper.querySelector('.ppdb-file-status');
            const removeBtn = wrapper.querySelector('.ppdb-remove-file');
            const errorMsgEl = wrapper.querySelector('.ppdb-field-error');

            if (!fileInput) return;

            fileInput.addEventListener('change', async function () {
                if (!this.files || this.files.length === 0) return;
                const file = this.files[0];

                // Clear previous errors
                if (errorMsgEl) {
                    errorMsgEl.textContent = '';
                    errorMsgEl.classList.add('hidden');
                }

                // Show preview container with loading spinner
                if (previewBox) previewBox.classList.remove('hidden');
                if (previewSpinner) previewSpinner.classList.remove('hidden');
                if (previewImg) previewImg.classList.add('hidden');
                if (previewIcon) previewIcon.classList.add('hidden');
                if (fileStatusEl) fileStatusEl.classList.add('hidden');
                if (fileNameEl) fileNameEl.textContent = file.name;
                if (fileSizeEl) fileSizeEl.textContent = 'Memproses berkas...';

                try {
                    const result = await processFileToSafeBlob(file);

                    // Save detached File into memory map
                    safeFileMap.set(fieldKey, result.file);

                    // Update UI preview
                    if (previewSpinner) previewSpinner.classList.add('hidden');
                    if (result.isImage && result.previewUrl) {
                        if (previewImg) {
                            previewImg.src = result.previewUrl;
                            previewImg.classList.remove('hidden');
                        }
                    } else if (result.isPdf) {
                        if (previewIcon) previewIcon.classList.remove('hidden');
                    } else {
                        if (previewIcon) {
                            previewIcon.className = 'ppdb-preview-icon fa-solid fa-file text-slate-500 text-2xl';
                            previewIcon.classList.remove('hidden');
                        }
                    }

                    if (fileNameEl) fileNameEl.textContent = result.file.name;
                    if (fileSizeEl) {
                        if (result.originalSize > result.finalSize && result.isImage) {
                            fileSizeEl.textContent = formatBytes(result.originalSize) + ' → ' + formatBytes(result.finalSize) + ' (Dioptimalkan)';
                        } else {
                            fileSizeEl.textContent = formatBytes(result.finalSize);
                        }
                    }
                    if (fileStatusEl) fileStatusEl.classList.remove('hidden');
                } catch (err) {
                    console.error('File process error:', err);
                    if (previewSpinner) previewSpinner.classList.add('hidden');
                    if (fileSizeEl) fileSizeEl.textContent = 'Gagal memproses file';
                    if (errorMsgEl) {
                        errorMsgEl.textContent = 'Gagal membaca berkas. Silakan pilih kembali file atau gunakan foto lain.';
                        errorMsgEl.classList.remove('hidden');
                    }
                }
            });

            if (removeBtn) {
                removeBtn.addEventListener('click', function () {
                    fileInput.value = '';
                    safeFileMap.delete(fieldKey);
                    if (previewBox) previewBox.classList.add('hidden');
                    if (previewImg) {
                        previewImg.src = '';
                        previewImg.classList.add('hidden');
                    }
                    if (previewIcon) previewIcon.classList.add('hidden');
                    if (errorMsgEl) {
                        errorMsgEl.textContent = '';
                        errorMsgEl.classList.add('hidden');
                    }
                });
            }
        });

        // Form Submission Interception via AJAX Fetch
        ppdbForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const submitBtn = document.getElementById('ppdb-submit-btn');
            const submitLabel = document.getElementById('ppdb-submit-label');
            const submitIcon = document.getElementById('ppdb-submit-icon');
            const progressBox = document.getElementById('ppdb-progress-box');
            const progressBar = document.getElementById('ppdb-progress-bar');
            const progressText = document.getElementById('ppdb-progress-text');
            const errorBox = document.getElementById('ppdb-ajax-error-box');
            const errorList = document.getElementById('ppdb-ajax-error-list');

            // Hide previous errors
            if (errorBox) errorBox.classList.add('hidden');
            if (errorList) errorList.innerHTML = '';
            document.querySelectorAll('.ppdb-field-error').forEach(el => {
                el.textContent = '';
                el.classList.add('hidden');
            });

            // Native HTML5 validation check
            if (!ppdbForm.checkValidity()) {
                ppdbForm.reportValidity();
                return;
            }

            // Ensure required file inputs have safe files in memory
            let missingRequiredFile = false;
            document.querySelectorAll('.ppdb-file-upload-wrapper').forEach(wrapper => {
                const key = wrapper.getAttribute('data-field-key');
                const fileInput = wrapper.querySelector('.ppdb-file-input');
                if (fileInput && fileInput.hasAttribute('required')) {
                    if (!safeFileMap.has(key) && (!fileInput.files || fileInput.files.length === 0)) {
                        missingRequiredFile = true;
                        const err = wrapper.querySelector('.ppdb-field-error');
                        if (err) {
                            err.textContent = 'Berkas ini wajib diunggah.';
                            err.classList.remove('hidden');
                        }
                    }
                }
            });

            if (missingRequiredFile) {
                if (errorBox) {
                    errorBox.classList.remove('hidden');
                    errorList.innerHTML = '<li>Silakan lengkapi berkas pendaftaran yang bertanda bintang (*).</li>';
                    errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                return;
            }

            // Disable submit button and show loading progress
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            }
            if (submitLabel) submitLabel.textContent = 'Sedang Mengunggah Formulir...';
            if (submitIcon) submitIcon.className = 'fa-solid fa-spinner fa-spin text-lg sm:text-xl';
            if (progressBox) progressBox.classList.remove('hidden');
            if (progressBar) progressBar.style.width = '35%';
            if (progressText) progressText.textContent = 'Menyiapkan berkas dan data pendaftaran...';

            try {
                // Build fresh FormData
                const formData = new FormData(ppdbForm);

                // Replace raw file inputs with safe detached File objects from memory
                safeFileMap.forEach((safeFile, key) => {
                    formData.set(key, safeFile);
                });

                if (progressBar) progressBar.style.width = '65%';
                if (progressText) progressText.textContent = 'Mengirim data ke sistem sekolah...';

                const response = await fetch(ppdbForm.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (progressBar) progressBar.style.width = '90%';

                const data = await response.json().catch(() => null);

                if (response.ok && data && data.success) {
                    if (progressBar) progressBar.style.width = '100%';
                    if (progressText) progressText.textContent = 'Pendaftaran Berhasil! Mengalihkan...';
                    if (submitLabel) submitLabel.textContent = 'Pendaftaran Berhasil!';
                    window.location.href = data.redirect_url;
                    return;
                }

                // If validation failed (HTTP 422)
                if (response.status === 422 && data) {
                    resetSubmitButton();
                    if (errorBox) {
                        errorBox.classList.remove('hidden');
                        let errHtml = '';
                        if (data.errors) {
                            Object.keys(data.errors).forEach(field => {
                                const msgs = data.errors[field];
                                msgs.forEach(m => {
                                    errHtml += `<li>${m}</li>`;
                                });
                                // Highlight specific field if present
                                const fieldWrapper = document.querySelector(`.ppdb-file-upload-wrapper[data-field-key="${field}"]`);
                                if (fieldWrapper) {
                                    const fieldErr = fieldWrapper.querySelector('.ppdb-field-error');
                                    if (fieldErr) {
                                        fieldErr.textContent = msgs[0];
                                        fieldErr.classList.remove('hidden');
                                    }
                                }
                            });
                        } else if (data.message) {
                            errHtml = `<li>${data.message}</li>`;
                        }
                        if (errorList) errorList.innerHTML = errHtml;
                        errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return;
                }

                // Any other server response error
                throw new Error(data && data.message ? data.message : 'Terjadi kendala saat menyimpan pendaftaran. Status: ' + response.status);

            } catch (err) {
                console.error('Submission failed:', err);
                resetSubmitButton();

                if (errorBox) {
                    errorBox.classList.remove('hidden');
                    if (errorList) {
                        errorList.innerHTML = `<li>Terjadi gangguan koneksi internet atau server saat mengirim berkas.</li>
                        <li><strong>Catatan:</strong> Seluruh isian data yang telah Anda ketik tetap aman. Silakan klik tombol <strong>Kirim Formulir Pendaftaran</strong> kembali.</li>`;
                    }
                    errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }

            function resetSubmitButton() {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                }
                if (submitLabel) submitLabel.textContent = 'Kirim Formulir Pendaftaran';
                if (submitIcon) submitIcon.className = 'fa-solid fa-paper-plane text-lg sm:text-xl';
                if (progressBox) progressBox.classList.add('hidden');
                if (progressBar) progressBar.style.width = '0%';
            }
        });
    });
</script>
@endsection
