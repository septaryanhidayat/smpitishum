{{-- TOP MINI BAR (Elegan: Kontak Telepon & Email Resmi SMPS IT Ishlahul Ummah Prabumulih) --}}
<div class="bg-[#0f172a] text-slate-200 text-xs py-2 border-b border-indigo-900/60 overflow-hidden">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 flex justify-center sm:justify-start items-center space-x-2 sm:space-x-6 text-center flex-wrap">
        <a href="tel:{{ $siteSettings['contact_phone'] ?? '0852-6990-8696' }}" class="flex items-center text-slate-200 hover:text-amber-300 transition py-0.5 text-[11px] sm:text-xs font-semibold whitespace-nowrap" aria-label="Hubungi Telepon {{ $siteSettings['contact_phone'] ?? '0852-6990-8696' }}">
            <i class="fa-solid fa-phone mr-1.5 text-amber-400" aria-hidden="true"></i>
            <span>{{ $siteSettings['contact_phone'] ?? '0852-6990-8696' }}</span>
        </a>
        <span class="text-indigo-900 hidden sm:inline" aria-hidden="true">|</span>
        <a href="mailto:{{ $siteSettings['contact_email'] ?? 'smpitishlahulummah.2015@yahoo.com' }}" class="hidden sm:flex items-center text-slate-200 hover:text-amber-300 transition py-0.5 text-[11px] sm:text-xs font-semibold truncate max-w-xs" aria-label="Kirim Email ke {{ $siteSettings['contact_email'] ?? 'smpitishlahulummah.2015@yahoo.com' }}">
            <i class="fa-solid fa-envelope mr-1.5 text-amber-400" aria-hidden="true"></i>
            <span class="truncate">{{ $siteSettings['contact_email'] ?? 'smpitishlahulummah.2015@yahoo.com' }}</span>
        </a>
        <span class="hidden md:inline text-indigo-900" aria-hidden="true">|</span>
        <span class="hidden md:flex items-center text-slate-300 text-xs">
            <i class="fa-solid fa-location-dot mr-1.5 text-amber-400"></i>
            <span>Prabumulih Timur, Sumatera Selatan</span>
        </span>
    </div>
</div>

{{-- MAIN STICKY NAVBAR (Royal Indigo & Electric Blue #4338ca / #2563eb / Radiant Gold #f59e0b) --}}
<header class="sticky top-0 z-50 bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 shadow-xl border-b border-indigo-500/20 transition-all duration-300 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-20">
            
            {{-- LOGO RESMI SMPS IT ISHLAHUL UMMAH PRABUMULIH --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group flex-shrink-0" aria-label="Beranda SMPS IT Ishlahul Ummah Prabumulih">
                <div class="h-14 sm:h-16 flex items-center py-1">
                    <img src="/uploads/logo-ishum.png" alt="Logo SMPS IT Ishlahul Ummah Prabumulih" class="max-h-11 sm:max-h-16 w-auto object-contain transform group-hover:scale-105 transition duration-300 drop-shadow-md" onerror="this.src='/uploads/logo-ishum-square.png'">
                </div>
            </a>

            {{-- DESKTOP NAVIGATION (Ringkas, Rapi & Elegan) --}}
            <nav class="hidden lg:flex items-center space-x-1.5 font-bold text-sm text-white" aria-label="Navigasi Utama">
                
                {{-- 1. Beranda --}}
                <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-xl hover:bg-white/15 transition {{ request()->routeIs('home') ? 'bg-white/20 text-white shadow-inner' : '' }}">
                    Beranda
                </a>

                {{-- 2. Profil Dropdown --}}
                <div class="relative group py-2" id="nav-dropdown-profil">
                    <button type="button" aria-haspopup="true" aria-expanded="false" aria-label="Buka Menu Profil" class="px-3.5 py-2 rounded-xl inline-flex items-center hover:bg-white/15 transition {{ request()->is('sambutan*', 'tentang*', 'visi*', 'sejarah*', 'anggota*', 'struktur*', 'bidang*', 'dpc*', 'dewan*') ? 'bg-white/20 text-white shadow-inner' : '' }}">
                        <span>Profil</span>
                        <i class="fa-solid fa-chevron-down text-[10px] ml-1.5 transition-transform duration-200 group-hover:rotate-180" aria-hidden="true"></i>
                    </button>
                    {{-- Safe Hover Bridge Container --}}
                    <div class="absolute left-0 top-full pt-1 w-64 hidden group-hover:block transition-all duration-150 z-50">
                        <div class="bg-white rounded-2xl shadow-2xl border border-indigo-100 py-2.5 text-gray-800 animate-fadeIn">
                            <a href="{{ route('page.sambutan') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-user-tie w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Sambutan Kepala Sekolah
                            </a>
                            <a href="{{ route('page.tentang-kami') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-school w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Profil Singkat Sekolah
                            </a>
                            <a href="{{ route('page.visi-misi') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-compass w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Visi dan Misi
                            </a>
                            <a href="{{ route('page.sejarah') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-landmark w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Sejarah Sekolah
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="{{ route('dewan.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-chalkboard-user w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Dewan Guru &amp; GTK
                            </a>
                            <a href="{{ route('page.struktur') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-sitemap w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Struktur Organisasi
                            </a>
                            <a href="{{ route('bidang.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-layer-group w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Fasilitas &amp; Sarana
                            </a>
                            <a href="{{ route('dpc.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-star-and-crescent w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Program Unggulan
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 3. Kabar & Galeri Dropdown --}}
                <div class="relative group py-2" id="nav-dropdown-kabar">
                    <button type="button" aria-haspopup="true" aria-expanded="false" aria-label="Buka Menu Kabar & Galeri" class="px-3.5 py-2 rounded-xl inline-flex items-center hover:bg-white/15 transition {{ request()->is('artikel*', 'agenda*', 'pengumuman*', 'galeri*', 'video*', 'testimonial*') ? 'bg-white/20 text-white shadow-inner' : '' }}">
                        <span>Kabar &amp; Galeri</span>
                        <i class="fa-solid fa-chevron-down text-[10px] ml-1.5 transition-transform duration-200 group-hover:rotate-180" aria-hidden="true"></i>
                    </button>
                    {{-- Safe Hover Bridge Container --}}
                    <div class="absolute left-0 top-full pt-1 w-60 hidden group-hover:block transition-all duration-150 z-50">
                        <div class="bg-white rounded-2xl shadow-2xl border border-indigo-100 py-2.5 text-gray-800 animate-fadeIn">
                            <a href="{{ route('artikel.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-newspaper w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Berita &amp; Prestasi Santri
                            </a>
                            <a href="{{ route('galeri.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-images w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Galeri Foto Kegiatan
                            </a>
                            <a href="{{ route('video.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-brands fa-youtube w-5 text-red-600 mr-2 text-sm" aria-hidden="true"></i> Video Kegiatan &amp; Dokumentasi
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="{{ route('agenda.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-calendar-days w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Agenda Akademik
                            </a>
                            <a href="{{ route('pengumuman.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-bullhorn w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Pengumuman Sekolah
                            </a>
                            <a href="{{ route('testimonial.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-comment-dots w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Testimoni Wali &amp; Alumni
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 4. Download Dropdown --}}
                <div class="relative group py-2" id="nav-dropdown-download">
                    <button type="button" aria-haspopup="true" aria-expanded="false" aria-label="Buka Menu Download" class="px-3.5 py-2 rounded-xl inline-flex items-center hover:bg-white/15 transition {{ request()->is('download*', 'e-book*', 'hymne*', 'logo*') ? 'bg-white/20 text-white shadow-inner' : '' }}">
                        <span>Download</span>
                        <i class="fa-solid fa-chevron-down text-[10px] ml-1.5 transition-transform duration-200 group-hover:rotate-180" aria-hidden="true"></i>
                    </button>
                    {{-- Safe Hover Bridge Container --}}
                    <div class="absolute left-0 top-full pt-1 w-56 hidden group-hover:block transition-all duration-150 z-50">
                        <div class="bg-white rounded-2xl shadow-2xl border border-indigo-100 py-2.5 text-gray-800 animate-fadeIn">
                            <a href="{{ route('download.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-folder-open w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Semua Berkas Publik
                            </a>
                            <a href="{{ route('download.ebook') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-book-open w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> E-Book &amp; Modul Siswa
                            </a>
                            <a href="{{ route('download.hymne-mars') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-music w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Mars JSIT Indonesia
                            </a>
                            <a href="{{ route('download.logo') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-image w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Logo Resmi Sekolah
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 5. Layanan Publik Dropdown --}}
                <div class="relative group py-2" id="nav-dropdown-layanan">
                    <button type="button" aria-haspopup="true" aria-expanded="false" aria-label="Buka Menu Layanan Publik" class="px-3.5 py-2 rounded-xl inline-flex items-center hover:bg-white/15 transition {{ request()->is('layanan*', 'izin-sekolah*', 'permohonan-kerja-sama*', 'sewa-barang*') ? 'bg-white/20 text-white font-bold shadow-inner' : '' }}">
                        <span>Layanan</span>
                        <i class="fa-solid fa-chevron-down text-[10px] ml-1.5 transition-transform duration-200 group-hover:rotate-180" aria-hidden="true"></i>
                    </button>
                    {{-- Safe Hover Bridge Container --}}
                    <div class="absolute left-0 top-full pt-1 w-64 hidden group-hover:block transition-all duration-150 z-50">
                        <div class="bg-white rounded-2xl shadow-2xl border border-indigo-100 py-2.5 text-gray-800 animate-fadeIn">
                            <a href="{{ route('layanan.index') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-handshake-angle w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Portal Layanan Terpadu
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="{{ route('layanan.izin') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-id-card-clip w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Permohonan Izin Kunjungan
                            </a>
                            <a href="{{ route('layanan.kerjasama') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-handshake w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Permohonan Kerja Sama
                            </a>
                            <a href="{{ route('layanan.sewa') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition flex items-center">
                                <i class="fa-solid fa-building-user w-5 text-indigo-600 mr-2 text-sm" aria-hidden="true"></i> Permohonan Sewa Barang
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 6. Kontak --}}
                <a href="{{ route('hubungi') }}" class="px-3.5 py-2 rounded-xl hover:bg-white/15 transition {{ request()->routeIs('hubungi') ? 'bg-white/20 text-white shadow-inner' : '' }}">
                    Kontak
                </a>
            </nav>

            {{-- TOMBOL AKSI: DAFTAR SPMB (WARNA GOLD/AMBER RADIANT) & LOGIN --}}
            <div class="hidden lg:flex items-center space-x-3">
                <a href="{{ route('ppdb.index') }}" class="bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 hover:from-amber-500 hover:to-amber-700 text-slate-950 px-5 py-2.5 rounded-full text-xs font-black shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40 transition flex items-center space-x-2 transform hover:scale-105" aria-label="Pendaftaran SPMB Online SMPS IT Ishlahul Ummah Prabumulih">
                    <i class="fa-solid fa-graduation-cap text-xs text-slate-950" aria-hidden="true"></i>
                    <span>Daftar SPMB</span>
                </a>
                <a href="/login" class="text-white hover:text-amber-300 px-3 py-2 text-xs font-bold transition flex items-center space-x-1 rounded-xl hover:bg-white/10" aria-label="Login Admin">
                    <i class="fa-solid fa-lock text-[11px]" aria-hidden="true"></i>
                    <span>Login</span>
                </a>
            </div>

            {{-- MOBILE TOP RIGHT: Tombol SPMB & Hamburger --}}
            <div class="flex lg:hidden items-center space-x-2">
                <a href="{{ route('ppdb.index') }}" class="bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 px-3.5 py-2 rounded-full text-xs font-black shadow transition min-h-[44px] flex items-center">
                    SPMB
                </a>
                <button id="mobile-menu-toggle" type="button" class="text-white hover:text-amber-200 p-2 rounded-lg focus:outline-none min-w-[44px] min-h-[44px] flex items-center justify-center" aria-label="Buka Menu Navigasi">
                    <i class="fa-solid fa-bars text-2xl" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- MOBILE MENU DRAWER (Struktur Rapi & Terorganisir) --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-white text-gray-800 border-t-4 border-indigo-600 px-5 pt-4 pb-6 space-y-3 shadow-2xl max-h-[85vh] overflow-y-auto">
        <form action="{{ route('artikel.index') }}" method="GET" class="relative mb-3">
            <input type="text" name="q" placeholder="Cari info & artikel sekolah..." aria-label="Cari artikel sekolah" value="{{ request('q') }}" class="w-full bg-gray-100 text-xs text-gray-800 rounded-full pl-9 pr-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-600">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-gray-400 text-xs" aria-hidden="true"></i>
        </form>

        <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg font-bold text-gray-900 hover:bg-indigo-50 hover:text-indigo-700 transition {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-700' : '' }}">
            <i class="fa-solid fa-house mr-2 text-indigo-600"></i> Beranda
        </a>
        
        {{-- Mobile Profil Submenu --}}
        <div class="border-t border-gray-100 pt-2">
            <div class="font-extrabold text-xs text-indigo-900 uppercase tracking-wider px-3 mb-1 flex items-center">
                <i class="fa-solid fa-school mr-2 text-amber-500"></i> Profil Sekolah
            </div>
            <a href="{{ route('page.sambutan') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Sambutan Kepala Sekolah</a>
            <a href="{{ route('page.tentang-kami') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Profil Singkat Sekolah</a>
            <a href="{{ route('page.visi-misi') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Visi dan Misi</a>
            <a href="{{ route('page.sejarah') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Sejarah Sekolah</a>
            <a href="{{ route('dewan.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Dewan Guru &amp; GTK</a>
            <a href="{{ route('page.struktur') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Struktur Organisasi</a>
            <a href="{{ route('bidang.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Fasilitas &amp; Sarana Prasarana</a>
            <a href="{{ route('dpc.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Program Unggulan</a>
        </div>

        {{-- Mobile Kabar & Galeri Submenu --}}
        <div class="border-t border-gray-100 pt-2">
            <div class="font-extrabold text-xs text-indigo-900 uppercase tracking-wider px-3 mb-1 flex items-center">
                <i class="fa-solid fa-newspaper mr-2 text-amber-500"></i> Kabar &amp; Galeri
            </div>
            <a href="{{ route('artikel.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Berita &amp; Prestasi Santri</a>
            <a href="{{ route('galeri.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Galeri Foto Kegiatan</a>
            <a href="{{ route('video.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Video Kegiatan</a>
            <a href="{{ route('agenda.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Agenda Akademik</a>
            <a href="{{ route('pengumuman.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Pengumuman</a>
            <a href="{{ route('testimonial.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Testimoni</a>
        </div>

        {{-- Mobile Download Submenu --}}
        <div class="border-t border-gray-100 pt-2">
            <div class="font-extrabold text-xs text-indigo-900 uppercase tracking-wider px-3 mb-1 flex items-center">
                <i class="fa-solid fa-download mr-2 text-amber-500"></i> Download Berkas
            </div>
            <a href="{{ route('download.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Semua Berkas Publik</a>
            <a href="{{ route('download.ebook') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">E-Library &amp; Modul Siswa</a>
            <a href="{{ route('download.hymne-mars') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Mars JSIT Indonesia</a>
            <a href="{{ route('download.logo') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Logo Resmi Sekolah</a>
        </div>

        {{-- Mobile Layanan Publik Submenu --}}
        <div class="border-t border-gray-100 pt-2">
            <div class="font-extrabold text-xs text-indigo-900 uppercase tracking-wider px-3 mb-1 flex items-center">
                <i class="fa-solid fa-handshake-angle mr-2 text-amber-500"></i> Layanan Publik
            </div>
            <a href="{{ route('layanan.index') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Portal Layanan Terpadu</a>
            <a href="{{ route('layanan.izin') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Permohonan Izin Kunjungan</a>
            <a href="{{ route('layanan.kerjasama') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Permohonan Kerja Sama</a>
            <a href="{{ route('layanan.sewa') }}" class="block px-4 py-1.5 text-xs text-gray-700 hover:text-indigo-700">Permohonan Sewa Barang</a>
        </div>

        <div class="border-t border-gray-100 pt-2 space-y-1">
            <a href="{{ route('hubungi') }}" class="block px-3 py-2 rounded-lg font-bold text-gray-900 hover:bg-indigo-50 hover:text-indigo-700 transition">
                <i class="fa-solid fa-phone mr-2 text-indigo-600"></i> Hubungi Kami
            </a>
            <a href="{{ route('donasi') }}" class="block px-3 py-2 rounded-lg font-extrabold text-indigo-700 hover:bg-indigo-50">
                <i class="fa-solid fa-hand-holding-heart mr-2 text-amber-500"></i> Infaq Ishlahul Ummah
            </a>
        </div>

        <div class="pt-3 space-y-2">
            <a href="{{ route('ppdb.index') }}" class="block w-full text-center bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 py-3 rounded-xl text-xs font-black shadow-md transition">
                <i class="fa-solid fa-graduation-cap mr-1.5" aria-hidden="true"></i> Pendaftaran SPMB Online
            </a>
            <a href="/login" class="block w-full text-center bg-slate-900 hover:bg-slate-950 text-white py-2.5 rounded-xl text-xs font-bold transition shadow-sm">
                <i class="fa-solid fa-lock mr-1.5 text-amber-400" aria-hidden="true"></i> Login SIAKAD / Admin
            </a>
        </div>
    </div>
</header>
