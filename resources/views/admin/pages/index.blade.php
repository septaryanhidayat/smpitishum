@extends('layouts.admin')

@section('title', 'Kelola Halaman Statis Profil')
@section('header_title', 'Kelola Halaman Statis Profil')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xs border border-slate-200/80">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
                <h2 class="text-lg font-black text-slate-800">Daftar Halaman Profil & Informasi</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola seluruh konten halaman profil sekolah (visi misi, sambutan, sejarah, struktur, profil), kebijakan privasi, serta halaman informasi lainnya.</p>
            </div>
            <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center space-x-2 bg-[#da251c] hover:bg-[#b91c1c] text-white text-xs font-bold px-5 py-2.5 rounded-xl shadow-sm transition">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Halaman Baru</span>
            </a>
        </div>

        <div class="overflow-x-auto mt-6">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200/80">
                    <tr>
                        <th class="py-3.5 px-4">Judul Halaman</th>
                        <th class="py-3.5 px-4">Slug URL</th>
                        <th class="py-3.5 px-4">Terakhir Diperbarui</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php
                        $protectedSlugs = ['visi-dan-misi', 'tentang-kami', 'sambutan-kepala-sekolah', 'sejarah', 'struktur-organisasi'];
                    @endphp
                    @forelse($pages as $page)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-4 font-bold text-slate-900 text-sm">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-lg bg-red-100 text-[#da251c] flex items-center justify-center text-xs shrink-0">
                                        <i class="fa-solid fa-file-lines"></i>
                                    </div>
                                    <div>
                                        <span class="block text-slate-800">{{ $page->title }}</span>
                                        @if(in_array($page->slug, $protectedSlugs))
                                            <span class="inline-block mt-0.5 px-2 py-0.5 text-[10px] font-bold text-amber-700 bg-amber-50 rounded border border-amber-200/60">
                                                <i class="fa-solid fa-shield-halved mr-1"></i>Menu Profil Inti
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-slate-500 font-mono text-xs">
                                /{{ $page->slug }}
                            </td>
                            <td class="py-4 px-4 text-slate-400">
                                {{ $page->updated_at ? $page->updated_at->format('d M Y H:i') : '-' }}
                            </td>
                            <td class="py-4 px-4 text-center">
                                <div class="inline-flex items-center space-x-1.5">
                                    <a href="{{ url($page->slug) }}" target="_blank" rel="noopener" title="Lihat di Website" class="inline-flex items-center space-x-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-2.5 py-1.5 rounded-xl transition text-xs">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        <span class="hidden md:inline">Lihat</span>
                                    </a>
                                    <a href="{{ route('admin.pages.edit', $page) }}" title="Edit Konten" class="inline-flex items-center space-x-1.5 bg-[#da251c] hover:bg-[#b91c1c] text-white font-bold px-3 py-1.5 rounded-xl shadow-xs transition text-xs">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span>Edit</span>
                                    </a>
                                    @if(!in_array($page->slug, $protectedSlugs))
                                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus halaman \'{{ $page->title }}\'?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus Halaman" class="inline-flex items-center text-red-500 hover:text-red-700 hover:bg-red-50 p-1.5 rounded-xl transition cursor-pointer">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-xs text-slate-400">Tidak ada halaman yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $pages->links() }}
        </div>
    </div>
</div>
@endsection
