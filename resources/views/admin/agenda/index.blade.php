@extends('layouts.admin')

@section('title', 'Agenda & Info')
@section('header_title', 'Agenda & Info')

@section('content')
<div class="space-y-8" x-data="{
    editAgendaModal: false,
    currentAgenda: { id: '', title: '', event_date: '', location: '', status: 'upcoming', content: '', featured_image: '', file_attachment: '' },
    openEditAgenda(item) {
        this.currentAgenda = {
            id: item.id,
            title: item.title,
            event_date: item.event_date ? item.event_date.substring(0, 10) : '',
            location: item.location || '',
            status: item.status || 'upcoming',
            content: item.content || '',
            featured_image: item.featured_image || '',
            file_attachment: item.file_attachment || ''
        };
        this.editAgendaModal = true;
    },
    editPengumumanModal: false,
    currentPengumuman: { id: '', title: '', status: 'publish', content: '', featured_image: '', file_attachment: '' },
    openEditPengumuman(item) {
        this.currentPengumuman = {
            id: item.id,
            title: item.title,
            status: item.status || 'publish',
            content: item.content || '',
            featured_image: item.featured_image || '',
            file_attachment: item.file_attachment || ''
        };
        this.editPengumumanModal = true;
    }
}">
    
    {{-- BAGIAN 1: AGENDA KEGIATAN --}}
    <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
                <h2 class="text-lg font-black text-slate-800">Agenda Kegiatan Sekolah</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola jadwal ujian, wisuda tahfidz, seminar, foto kegiatan, dan berkas lampiran.</p>
            </div>
        </div>

        {{-- Form Tambah Agenda --}}
        <form action="{{ route('admin.agenda.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Nama Agenda Kegiatan *</label>
                    <input type="text" name="title" required placeholder="Contoh: Wisuda Tahfidz Angkatan X" class="w-full bg-white text-xs text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Tanggal Pelaksanaan *</label>
                    <input type="date" name="event_date" required class="w-full bg-white text-xs text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Lokasi Tempat *</label>
                    <input type="text" name="location" required placeholder="Aula Utama Kampus Ishum" class="w-full bg-white text-xs text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Status Agenda</label>
                    <select name="status" class="w-full bg-white text-xs text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <option value="upcoming">Akan Datang (Tampil di Web)</option>
                        <option value="ongoing">Sedang Berlangsung (Tampil di Web)</option>
                        <option value="completed">Selesai (Tampil di Web)</option>
                        <option value="publish">Publikasi / Aktif (Tampil di Web)</option>
                        <option value="draft">Draft (Disembunyikan dari Web)</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">
                        <i class="fa-solid fa-image text-indigo-500 mr-1"></i> Upload Foto / Poster Agenda (Opsional)
                    </label>
                    <input type="file" name="featured_image" accept="image/*" class="w-full bg-white text-xs text-slate-600 rounded-xl px-3 py-2 border border-slate-200 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <span class="text-[10px] text-slate-400 mt-0.5 block">Format: JPG, PNG, WEBP (Maksimal 5MB, otomatis dikonversi ke WebP)</span>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">
                        <i class="fa-solid fa-file-arrow-up text-amber-500 mr-1"></i> Upload File / Dokumen Pendukung (Opsional)
                    </label>
                    <input type="file" name="file_attachment" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar,image/*" class="w-full bg-white text-xs text-slate-600 rounded-xl px-3 py-2 border border-slate-200 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100">
                    <span class="text-[10px] text-slate-400 mt-0.5 block">Format: PDF, Word, Excel, ZIP (Maksimal 20MB)</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2">
                <input type="text" name="content" placeholder="Keterangan tambahan atau catatan kegiatan (opsional)..." class="w-full sm:w-3/4 bg-white text-xs text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                <button type="submit" class="w-full sm:w-auto bg-[#da251c] hover:bg-[#b91c1c] text-white font-bold text-xs px-5 py-2.5 rounded-xl shadow-md transition flex items-center justify-center space-x-2 cursor-pointer">
                    <i class="fa-solid fa-calendar-plus"></i>
                    <span>Tambah Agenda</span>
                </button>
            </div>
        </form>

        {{-- Tabel Agenda --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-3 px-4">Nama Kegiatan</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Lokasi</th>
                        <th class="py-3 px-4">Berkas/Media</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($agendas as $agenda)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                <div class="flex items-center space-x-3">
                                    @if($agenda->featured_image)
                                        <img src="{{ $agenda->featured_image }}" alt="Foto {{ $agenda->title }}" class="w-10 h-10 rounded-lg object-cover shadow-xs border border-slate-200 shrink-0">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-bold border border-indigo-100 shrink-0">
                                            <i class="fa-solid fa-calendar-day"></i>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="truncate max-w-xs">{{ $agenda->title }}</div>
                                        @if(!empty($agenda->content))
                                            <div class="text-[11px] text-slate-400 font-normal mt-0.5 line-clamp-1">{{ $agenda->content }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 whitespace-nowrap">
                                {{ $agenda->event_date ? $agenda->event_date->format('d M Y') : '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-500">{{ $agenda->location }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    @if($agenda->featured_image)
                                        <a href="{{ $agenda->featured_image }}" target="_blank" class="inline-flex items-center text-[11px] font-semibold text-indigo-600 hover:text-indigo-800 bg-indigo-50 px-2 py-0.5 rounded-md" title="Lihat Foto">
                                            <i class="fa-solid fa-image mr-1"></i> Foto
                                        </a>
                                    @endif
                                    @if($agenda->file_attachment)
                                        <a href="{{ $agenda->file_attachment }}" target="_blank" class="inline-flex items-center text-[11px] font-semibold text-emerald-700 hover:text-emerald-900 bg-emerald-50 px-2 py-0.5 rounded-md" title="Unduh Dokumen">
                                            <i class="fa-solid fa-paperclip mr-1"></i> File
                                        </a>
                                    @endif
                                    @if(!$agenda->featured_image && !$agenda->file_attachment)
                                        <span class="text-slate-400 text-[11px]">-</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $agenda->status === 'completed' ? 'bg-slate-100 text-slate-600' : ($agenda->status === 'ongoing' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800') }}">
                                    {{ ucfirst($agenda->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div class="inline-flex items-center space-x-1.5">
                                    <button type="button" @click='openEditAgenda({
                                        id: {{ $agenda->id }},
                                        title: @json($agenda->title),
                                        event_date: @json($agenda->event_date ? $agenda->event_date->format('Y-m-d') : ''),
                                        location: @json($agenda->location),
                                        status: @json($agenda->status),
                                        content: @json($agenda->content ?? ""),
                                        featured_image: @json($agenda->featured_image ?? ""),
                                        file_attachment: @json($agenda->file_attachment ?? "")
                                    })' class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition cursor-pointer" title="Edit Agenda">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('admin.agenda.destroy', $agenda) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus agenda ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition cursor-pointer" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-slate-400">Belum ada agenda kegiatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($agendas->hasPages())
            <div class="pt-2">
                {{ $agendas->links() }}
            </div>
        @endif
    </div>

    {{-- BAGIAN 2: PENGUMUMAN RESMI --}}
    <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
                <h2 class="text-lg font-black text-slate-800">Pengumuman &amp; Siaran Resmi</h2>
                <p class="text-xs text-slate-500 mt-0.5">Terbitkan pengumuman resmi lengkap dengan foto banner dan lampiran dokumen PDF/surat edaran.</p>
            </div>
        </div>

        {{-- Form Tambah Pengumuman --}}
        <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Judul Pengumuman *</label>
                    <input type="text" name="title" required placeholder="Contoh: Pengumuman Seleksi Penerimaan Siswa Baru (PPDB)" class="w-full bg-white text-xs text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Status Publikasi</label>
                    <select name="status" class="w-full bg-white text-xs text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <option value="publish">Publikasikan Langsung</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">
                        <i class="fa-solid fa-image text-indigo-500 mr-1"></i> Upload Foto / Poster Pengumuman (Opsional)
                    </label>
                    <input type="file" name="featured_image" accept="image/*" class="w-full bg-white text-xs text-slate-600 rounded-xl px-3 py-2 border border-slate-200 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <span class="text-[10px] text-slate-400 mt-0.5 block">Format: JPG, PNG, WEBP (Maksimal 5MB, otomatis dikonversi ke WebP)</span>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">
                        <i class="fa-solid fa-file-pdf text-rose-500 mr-1"></i> Upload File / Dokumen Surat Edaran (Opsional)
                    </label>
                    <input type="file" name="file_attachment" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar,image/*" class="w-full bg-white text-xs text-slate-600 rounded-xl px-3 py-2 border border-slate-200 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100">
                    <span class="text-[10px] text-slate-400 mt-0.5 block">Format: PDF, Word, Dokumen (Maksimal 20MB)</span>
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Isi Pesan Pengumuman *</label>
                <textarea name="content" required rows="3" placeholder="Tuliskan detail rincian pengumuman di sini..." class="w-full bg-white text-xs text-slate-800 rounded-xl p-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs px-5 py-2.5 rounded-xl shadow-md transition flex items-center space-x-2 cursor-pointer">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span>Terbitkan Pengumuman</span>
                </button>
            </div>
        </form>

        {{-- Tabel Pengumuman --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-3 px-4">Judul Pengumuman</th>
                        <th class="py-3 px-4">Tanggal Terbit</th>
                        <th class="py-3 px-4">Berkas/Media</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengumumen as $p)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                <div class="flex items-center space-x-3">
                                    @if($p->featured_image)
                                        <img src="{{ $p->featured_image }}" alt="Foto {{ $p->title }}" class="w-10 h-10 rounded-lg object-cover shadow-xs border border-slate-200 shrink-0">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center text-sm font-bold border border-orange-100 shrink-0">
                                            <i class="fa-solid fa-bullhorn"></i>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="truncate max-w-xs">{{ $p->title }}</div>
                                        <div class="text-[11px] text-slate-400 font-normal mt-0.5 line-clamp-1">{{ $p->content }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-500 whitespace-nowrap">{{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    @if($p->featured_image)
                                        <a href="{{ $p->featured_image }}" target="_blank" class="inline-flex items-center text-[11px] font-semibold text-indigo-600 hover:text-indigo-800 bg-indigo-50 px-2 py-0.5 rounded-md" title="Lihat Foto">
                                            <i class="fa-solid fa-image mr-1"></i> Foto
                                        </a>
                                    @endif
                                    @if($p->file_attachment)
                                        <a href="{{ $p->file_attachment }}" target="_blank" class="inline-flex items-center text-[11px] font-semibold text-rose-700 hover:text-rose-900 bg-rose-50 px-2 py-0.5 rounded-md" title="Unduh Berkas Lampiran">
                                            <i class="fa-solid fa-file-pdf mr-1"></i> Lampiran
                                        </a>
                                    @endif
                                    @if(!$p->featured_image && !$p->file_attachment)
                                        <span class="text-slate-400 text-[11px]">-</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $p->status === 'publish' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div class="inline-flex items-center space-x-1.5">
                                    <button type="button" @click='openEditPengumuman({
                                        id: {{ $p->id }},
                                        title: @json($p->title),
                                        status: @json($p->status),
                                        content: @json($p->content),
                                        featured_image: @json($p->featured_image ?? ""),
                                        file_attachment: @json($p->file_attachment ?? "")
                                    })' class="p-1.5 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition cursor-pointer" title="Edit Pengumuman">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('admin.pengumuman.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition cursor-pointer" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-slate-400">Belum ada pengumuman resmi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pengumumen->hasPages())
            <div class="pt-2">
                {{ $pengumumen->links() }}
            </div>
        @endif
    </div>

    {{-- MODAL EDIT AGENDA --}}
    <div x-show="editAgendaModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs" x-cloak>
        <div @click.away="editAgendaModal = false" class="bg-white rounded-3xl p-6 sm:p-8 max-w-xl w-full shadow-2xl space-y-5 border border-slate-100 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center space-x-2.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm sm:text-base">Edit Agenda Kegiatan</h3>
                        <p class="text-[11px] text-slate-400">Perbarui rincian jadwal, lokasi, foto, atau file lampiran.</p>
                    </div>
                </div>
                <button type="button" @click="editAgendaModal = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form :action="'{{ url('/admin/agenda') }}/' + currentAgenda.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Nama Kegiatan *</label>
                    <input type="text" name="title" required x-model="currentAgenda.title" class="w-full bg-slate-50 text-xs font-semibold text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Tanggal Pelaksanaan *</label>
                        <input type="date" name="event_date" required x-model="currentAgenda.event_date" class="w-full bg-slate-50 text-xs font-semibold text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Status Kegiatan</label>
                        <select name="status" x-model="currentAgenda.status" class="w-full bg-slate-50 text-xs font-semibold text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="upcoming">Akan Datang (Tampil di Web)</option>
                            <option value="ongoing">Sedang Berlangsung (Tampil di Web)</option>
                            <option value="completed">Selesai (Tampil di Web)</option>
                            <option value="publish">Publikasi / Aktif (Tampil di Web)</option>
                            <option value="draft">Draft (Disembunyikan dari Web)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Lokasi Tempat *</label>
                    <input type="text" name="location" required x-model="currentAgenda.location" class="w-full bg-slate-50 text-xs font-semibold text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>

                {{-- Update Foto Agenda --}}
                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
                    <label class="block text-[11px] font-bold text-slate-700">
                        <i class="fa-solid fa-image text-indigo-500 mr-1"></i> Foto / Poster Agenda
                    </label>
                    <template x-if="currentAgenda.featured_image">
                        <div class="flex items-center space-x-3 mb-2 p-2 bg-white rounded-xl border border-slate-200">
                            <img :src="currentAgenda.featured_image" alt="Foto Agenda" class="w-12 h-12 rounded-lg object-cover">
                            <div class="flex-1 min-w-0">
                                <span class="text-xs font-semibold text-slate-700 block truncate">Foto Terpasang</span>
                                <a :href="currentAgenda.featured_image" target="_blank" class="text-[10px] text-indigo-600 hover:underline">Lihat Gambar</a>
                            </div>
                            <label class="flex items-center space-x-1.5 text-[11px] text-red-600 font-semibold cursor-pointer">
                                <input type="checkbox" name="remove_featured_image" value="1" class="rounded text-red-600">
                                <span>Hapus</span>
                            </label>
                        </div>
                    </template>
                    <input type="file" name="featured_image" accept="image/*" class="w-full bg-white text-xs text-slate-600 rounded-xl px-3 py-2 border border-slate-200 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <span class="text-[10px] text-slate-400 block">Pilih file baru jika ingin mengganti foto saat ini.</span>
                </div>

                {{-- Update File Attachment Agenda --}}
                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
                    <label class="block text-[11px] font-bold text-slate-700">
                        <i class="fa-solid fa-paperclip text-amber-500 mr-1"></i> File / Dokumen Pendukung
                    </label>
                    <template x-if="currentAgenda.file_attachment">
                        <div class="flex items-center space-x-3 mb-2 p-2 bg-white rounded-xl border border-slate-200">
                            <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold shrink-0">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="text-xs font-semibold text-slate-700 block truncate">Dokumen Terlampir</span>
                                <a :href="currentAgenda.file_attachment" target="_blank" class="text-[10px] text-indigo-600 hover:underline">Unduh Berkas</a>
                            </div>
                            <label class="flex items-center space-x-1.5 text-[11px] text-red-600 font-semibold cursor-pointer">
                                <input type="checkbox" name="remove_file_attachment" value="1" class="rounded text-red-600">
                                <span>Hapus</span>
                            </label>
                        </div>
                    </template>
                    <input type="file" name="file_attachment" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar,image/*" class="w-full bg-white text-xs text-slate-600 rounded-xl px-3 py-2 border border-slate-200 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100">
                    <span class="text-[10px] text-slate-400 block">Pilih file baru untuk mengganti lampiran saat ini.</span>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Keterangan Tambahan (Opsional)</label>
                    <textarea name="content" rows="3" x-model="currentAgenda.content" class="w-full bg-slate-50 text-xs text-slate-800 rounded-xl p-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600"></textarea>
                </div>

                <div class="flex items-center justify-end space-x-2 pt-2 border-t border-slate-100">
                    <button type="button" @click="editAgendaModal = false" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-100 transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-indigo-600 hover:bg-indigo-700 text-white shadow-md transition cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT PENGUMUMAN --}}
    <div x-show="editPengumumanModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs" x-cloak>
        <div @click.away="editPengumumanModal = false" class="bg-white rounded-3xl p-6 sm:p-8 max-w-xl w-full shadow-2xl space-y-5 border border-slate-100 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center space-x-2.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm sm:text-base">Edit Pengumuman Resmi</h3>
                        <p class="text-[11px] text-slate-400">Perbarui judul, isi siaran, foto banner, atau file edaran.</p>
                    </div>
                </div>
                <button type="button" @click="editPengumumanModal = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form :action="'{{ url('/admin/pengumuman') }}/' + currentPengumuman.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Judul Pengumuman *</label>
                    <input type="text" name="title" required x-model="currentPengumuman.title" class="w-full bg-slate-50 text-xs font-semibold text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Status Publikasi</label>
                    <select name="status" x-model="currentPengumuman.status" class="w-full bg-slate-50 text-xs font-semibold text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <option value="publish">Publikasikan Langsung</option>
                        <option value="draft">Draft (Disembunyikan)</option>
                    </select>
                </div>

                {{-- Update Foto Pengumuman --}}
                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
                    <label class="block text-[11px] font-bold text-slate-700">
                        <i class="fa-solid fa-image text-indigo-500 mr-1"></i> Foto / Banner Pengumuman
                    </label>
                    <template x-if="currentPengumuman.featured_image">
                        <div class="flex items-center space-x-3 mb-2 p-2 bg-white rounded-xl border border-slate-200">
                            <img :src="currentPengumuman.featured_image" alt="Foto Pengumuman" class="w-12 h-12 rounded-lg object-cover">
                            <div class="flex-1 min-w-0">
                                <span class="text-xs font-semibold text-slate-700 block truncate">Banner Terpasang</span>
                                <a :href="currentPengumuman.featured_image" target="_blank" class="text-[10px] text-indigo-600 hover:underline">Lihat Gambar</a>
                            </div>
                            <label class="flex items-center space-x-1.5 text-[11px] text-red-600 font-semibold cursor-pointer">
                                <input type="checkbox" name="remove_featured_image" value="1" class="rounded text-red-600">
                                <span>Hapus</span>
                            </label>
                        </div>
                    </template>
                    <input type="file" name="featured_image" accept="image/*" class="w-full bg-white text-xs text-slate-600 rounded-xl px-3 py-2 border border-slate-200 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <span class="text-[10px] text-slate-400 block">Pilih file baru jika ingin mengganti banner pengumuman.</span>
                </div>

                {{-- Update File Attachment Pengumuman --}}
                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
                    <label class="block text-[11px] font-bold text-slate-700">
                        <i class="fa-solid fa-file-pdf text-rose-500 mr-1"></i> File / Surat Edaran Terlampir
                    </label>
                    <template x-if="currentPengumuman.file_attachment">
                        <div class="flex items-center space-x-3 mb-2 p-2 bg-white rounded-xl border border-slate-200">
                            <div class="w-9 h-9 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-sm font-bold shrink-0">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="text-xs font-semibold text-slate-700 block truncate">Surat Edaran Terlampir</span>
                                <a :href="currentPengumuman.file_attachment" target="_blank" class="text-[10px] text-indigo-600 hover:underline">Unduh Berkas</a>
                            </div>
                            <label class="flex items-center space-x-1.5 text-[11px] text-red-600 font-semibold cursor-pointer">
                                <input type="checkbox" name="remove_file_attachment" value="1" class="rounded text-red-600">
                                <span>Hapus</span>
                            </label>
                        </div>
                    </template>
                    <input type="file" name="file_attachment" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar,image/*" class="w-full bg-white text-xs text-slate-600 rounded-xl px-3 py-2 border border-slate-200 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100">
                    <span class="text-[10px] text-slate-400 block">Pilih file baru untuk mengganti surat edaran/lampiran saat ini.</span>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Isi Pesan Pengumuman *</label>
                    <textarea name="content" required rows="4" x-model="currentPengumuman.content" class="w-full bg-slate-50 text-xs text-slate-800 rounded-xl p-3 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600"></textarea>
                </div>

                <div class="flex items-center justify-end space-x-2 pt-2 border-t border-slate-100">
                    <button type="button" @click="editPengumumanModal = false" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-100 transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-indigo-600 hover:bg-indigo-700 text-white shadow-md transition cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
