@extends('layouts.admin')

@section('title', 'Agenda & Info')
@section('header_title', 'Agenda & Info')

@section('content')
<div class="space-y-8" x-data="{
    editAgendaModal: false,
    currentAgenda: { id: '', title: '', event_date: '', location: '', status: 'upcoming', content: '' },
    openEditAgenda(item) {
        this.currentAgenda = {
            id: item.id,
            title: item.title,
            event_date: item.event_date ? item.event_date.substring(0, 10) : '',
            location: item.location || '',
            status: item.status || 'upcoming',
            content: item.content || ''
        };
        this.editAgendaModal = true;
    },
    editPengumumanModal: false,
    currentPengumuman: { id: '', title: '', status: 'publish', content: '' },
    openEditPengumuman(item) {
        this.currentPengumuman = {
            id: item.id,
            title: item.title,
            status: item.status || 'publish',
            content: item.content || ''
        };
        this.editPengumumanModal = true;
    }
}">
    
    {{-- BAGIAN 1: AGENDA KEGIATAN --}}
    <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
                <h2 class="text-lg font-black text-slate-800">Agenda Kegiatan Sekolah</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola jadwal ujian, wisuda tahfidz, seminar, dan kalender akademik sekolah.</p>
            </div>
        </div>

        {{-- Form Tambah Agenda --}}
        <form action="{{ route('admin.agenda.store') }}" method="POST" class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 space-y-4">
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
                        <option value="upcoming">Akan Datang</option>
                        <option value="ongoing">Sedang Berlangsung</option>
                        <option value="completed">Selesai</option>
                    </select>
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
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($agendas as $agenda)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                <div>{{ $agenda->title }}</div>
                                @if(!empty($agenda->content))
                                    <div class="text-[11px] text-slate-400 font-normal mt-0.5 line-clamp-1">{{ $agenda->content }}</div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 whitespace-nowrap">
                                {{ $agenda->event_date ? $agenda->event_date->format('d M Y') : '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-500">{{ $agenda->location }}</td>
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
                                        content: @json($agenda->content ?? "")
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
                            <td colspan="5" class="py-6 text-center text-slate-400">Belum ada agenda kegiatan.</td>
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
                <p class="text-xs text-slate-500 mt-0.5">Terbitkan pengumuman resmi bagi siswa, wali murid, guru, dan publik.</p>
            </div>
        </div>

        {{-- Form Tambah Pengumuman --}}
        <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 space-y-4">
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
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengumumen as $p)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                <div>{{ $p->title }}</div>
                                <div class="text-[11px] text-slate-400 font-normal mt-0.5 line-clamp-1">{{ $p->content }}</div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-500 whitespace-nowrap">{{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}</td>
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
                                        content: @json($p->content)
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
                            <td colspan="4" class="py-6 text-center text-slate-400">Belum ada pengumuman resmi.</td>
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
        <div @click.away="editAgendaModal = false" class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-5 border border-slate-100">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center space-x-2.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm sm:text-base">Edit Agenda Kegiatan</h3>
                        <p class="text-[11px] text-slate-400">Perbarui rincian jadwal atau lokasi kegiatan.</p>
                    </div>
                </div>
                <button type="button" @click="editAgendaModal = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form :action="'{{ url('/admin/agenda') }}/' + currentAgenda.id" method="POST" class="space-y-4">
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
                            <option value="upcoming">Akan Datang</option>
                            <option value="ongoing">Sedang Berlangsung</option>
                            <option value="completed">Selesai</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Lokasi Tempat *</label>
                    <input type="text" name="location" required x-model="currentAgenda.location" class="w-full bg-slate-50 text-xs font-semibold text-slate-800 rounded-xl px-4 py-2.5 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
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
        <div @click.away="editPengumumanModal = false" class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-5 border border-slate-100">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center space-x-2.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm sm:text-base">Edit Pengumuman Resmi</h3>
                        <p class="text-[11px] text-slate-400">Perbarui judul atau isi siaran pengumuman.</p>
                    </div>
                </div>
                <button type="button" @click="editPengumumanModal = false" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form :action="'{{ url('/admin/pengumuman') }}/' + currentPengumuman.id" method="POST" class="space-y-4">
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
