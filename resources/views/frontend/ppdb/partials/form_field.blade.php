@php
    $key = $field['key'] ?? '';
    $label = $field['label'] ?? '';
    $type = $field['type'] ?? 'text';
    $required = !empty($field['required']);
    $placeholder = $field['placeholder'] ?? '';
    $options = $field['options'] ?? [];
@endphp

@if($type === 'select')
    <div>
        <label for="{{ $key }}" class="block font-bold text-slate-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @else
                <span class="text-slate-400 font-normal text-[11px]">(Opsional)</span>
            @endif
        </label>
        <select name="{{ $key }}" id="{{ $key }}" {{ $required ? 'required' : '' }} class="w-full bg-white text-xs rounded-xl px-4 py-2.5 border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
            <option value="">{{ $placeholder ?: 'Pilih ' . $label . '...' }}</option>
            @php
                $opts = $options;
                if ($key === 'track' && !empty($formSettings['tracks'])) {
                    $opts = $formSettings['tracks'];
                } elseif (empty($opts)) {
                    if ($key === 'wave') $opts = $formSettings['waves'] ?? [];
                    elseif ($key === 'track') $opts = $formSettings['tracks'] ?? [];
                    elseif ($key === 'program_type') $opts = $formSettings['programs'] ?? [];
                }

                $selectedVal = old($key, request($key, ($key === 'track' ? (request('jalur') ?? request('track')) : null)));
                $cleanSelected = !empty($selectedVal) ? strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '', (string)$selectedVal))) : '';
            @endphp
            @foreach($opts as $opt)
                @php
                    $cleanOpt = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '', (string)$opt)));
                    $isSelected = ($selectedVal == $opt) || 
                                  (!empty($cleanSelected) && (str_contains($cleanOpt, $cleanSelected) || str_contains($cleanSelected, $cleanOpt)));
                @endphp
                <option value="{{ $opt }}" {{ $isSelected ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
        </select>
        @error($key) <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

@elseif($type === 'textarea')
    <div>
        <label for="{{ $key }}" class="block font-bold text-slate-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @else
                <span class="text-slate-400 font-normal text-[11px]">(Opsional)</span>
            @endif
        </label>
        <textarea name="{{ $key }}" id="{{ $key }}" rows="3" {{ $required ? 'required' : '' }} placeholder="{{ $placeholder }}" class="w-full bg-white text-xs rounded-xl px-4 py-2.5 border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ old($key) }}</textarea>
        @error($key) <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

@elseif($type === 'file')
    <div class="ppdb-file-upload-wrapper" data-field-key="{{ $key }}">
        <label for="{{ $key }}" class="block font-bold text-slate-800 mb-1.5">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @else
                <span class="text-slate-400 font-normal text-[11px]">(Opsional)</span>
            @endif
        </label>
        <div class="p-4 bg-indigo-50/50 border-2 border-dashed border-indigo-300 rounded-2xl transition hover:border-indigo-600 hover:bg-indigo-50/60 relative">
            <input type="file" name="{{ $key }}" id="{{ $key }}" {{ $required ? 'required' : '' }} accept=".pdf,image/jpeg,image/png,image/webp,image/jpg" class="ppdb-file-input w-full text-xs text-slate-700 font-medium file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-extrabold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 file:cursor-pointer file:shadow-md transition">

            {{-- PREVIEW CONTAINER (MUNCUL OTOMATIS SETELAH FILE DIPILIH) --}}
            <div class="ppdb-file-preview hidden mt-3 p-3 bg-white rounded-xl border border-indigo-100 shadow-sm flex items-center justify-between gap-3">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="ppdb-thumb-box w-12 h-12 rounded-lg bg-indigo-50 border border-indigo-200 flex items-center justify-center shrink-0 overflow-hidden">
                        <img class="ppdb-preview-img hidden w-full h-full object-cover" alt="Preview">
                        <i class="ppdb-preview-icon fa-solid fa-file-pdf text-red-500 text-2xl hidden"></i>
                        <i class="ppdb-preview-spinner fa-solid fa-spinner fa-spin text-indigo-600 text-xl hidden"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="ppdb-file-name text-xs font-bold text-slate-800 truncate">Nama File</div>
                        <div class="ppdb-file-meta text-[11px] text-slate-500 flex items-center gap-2 flex-wrap">
                            <span class="ppdb-file-size text-indigo-700 font-semibold">-</span>
                            <span class="ppdb-file-status text-emerald-600 font-bold hidden"><i class="fa-solid fa-circle-check"></i> Siap kirim</span>
                        </div>
                    </div>
                </div>
                <button type="button" class="ppdb-remove-file shrink-0 px-2.5 py-1.5 text-xs text-rose-600 hover:text-rose-700 hover:bg-rose-50 rounded-lg font-bold transition">
                    <i class="fa-solid fa-xmark mr-1"></i> Ganti
                </button>
            </div>

            @if($key === 'payment_proof')
                <p class="text-[11px] text-slate-700 font-semibold mt-2 flex items-center gap-1.5">
                    <i class="fa-solid fa-receipt text-indigo-700"></i>
                    <span>Rekening Resmi {{ $formSettings['bank_name'] ?? 'BSI' }}: <strong class="text-slate-900 font-black">{{ $formSettings['bank_account'] ?? '7011304251' }}</strong> a.n. <strong class="text-slate-900 font-black">{{ $formSettings['bank_holder'] ?? 'YL. Fatmawati' }}</strong></span>
                </p>
            @else
                <p class="text-[11px] text-slate-600 font-medium mt-2 flex items-center gap-1.5">
                    <i class="fa-solid fa-file-pdf text-[#da251c]"></i>
                    <span>Format yang didukung: PDF, JPG, PNG, WebP (Maksimal 10 MB)</span>
                </p>
            @endif
        </div>
        <p class="ppdb-field-error text-red-500 text-[11px] mt-1 hidden"></p>
        @error($key) <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

@elseif($type === 'number')
    <div>
        <label for="{{ $key }}" class="block font-bold text-slate-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @else
                <span class="text-slate-400 font-normal text-[11px]">(Opsional)</span>
            @endif
        </label>
        <input type="number" name="{{ $key }}" id="{{ $key }}" value="{{ old($key) }}" {{ $required ? 'required' : '' }} placeholder="{{ $placeholder }}" class="w-full bg-white text-xs rounded-xl px-4 py-2.5 border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
        @error($key) <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

@elseif($type === 'date')
    <div>
        <label for="{{ $key }}" class="block font-bold text-slate-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @else
                <span class="text-slate-400 font-normal text-[11px]">(Opsional)</span>
            @endif
        </label>
        <input type="date" name="{{ $key }}" id="{{ $key }}" value="{{ old($key) }}" {{ $required ? 'required' : '' }} class="w-full bg-white text-xs rounded-xl px-4 py-2.5 border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
        @error($key) <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

@elseif($type === 'tel')
    <div>
        <label for="{{ $key }}" class="block font-bold text-slate-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @else
                <span class="text-slate-400 font-normal text-[11px]">(Opsional)</span>
            @endif
        </label>
        <input type="tel" name="{{ $key }}" id="{{ $key }}" value="{{ old($key) }}" {{ $required ? 'required' : '' }} placeholder="{{ $placeholder ?: '08xxxxxxxxxx' }}" class="w-full bg-white text-xs rounded-xl px-4 py-2.5 border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
        @error($key) <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>

@else
    <div>
        <label for="{{ $key }}" class="block font-bold text-slate-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @else
                <span class="text-slate-400 font-normal text-[11px]">(Opsional)</span>
            @endif
        </label>
        <input type="text" name="{{ $key }}" id="{{ $key }}" value="{{ old($key) }}" {{ $required ? 'required' : '' }} placeholder="{{ $placeholder }}" class="w-full bg-white text-xs rounded-xl px-4 py-2.5 border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
        @error($key) <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>
@endif
