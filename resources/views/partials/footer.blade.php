{{-- FOOTER RESMI SMPS IT ISHLAHUL UMMAH PRABUMULIH --}}
<footer class="bg-[#0b1120] text-white pt-8 sm:pt-10 pb-8 font-['Poppins',sans-serif] border-t border-indigo-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 1. NEWSLETTER SUBSCRIBE BAR (Palette Flyer: Royal Indigo & Electric Blue + Gold Button) --}}
        <div class="bg-gradient-to-r from-indigo-950 via-indigo-900 to-blue-950 rounded-[22px] sm:rounded-[26px] px-6 sm:px-10 py-5 sm:py-6 mb-10 sm:mb-12 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-5 text-center md:text-left border border-indigo-700/40">
            <div>
                <span class="text-xs uppercase tracking-wider text-amber-300 font-bold block mb-1">Buletin &amp; Kabar Sekolah</span>
                <h2 class="text-xl sm:text-2xl font-bold text-white tracking-tight">Dapatkan Info &amp; Pengumuman Terupdate</h2>
            </div>
            <form action="{{ route('hubungi') }}" method="GET" class="w-full md:w-auto flex flex-col sm:flex-row items-center gap-2.5 sm:gap-3 max-w-lg">
                <input type="email" name="subscribe_email" placeholder="Masukkan Email Anda" aria-label="Masukkan Email Anda untuk Berlangganan" class="bg-white/95 text-xs sm:text-sm text-gray-800 placeholder-gray-500 px-5 py-2.5 sm:py-3 rounded-full focus:outline-none focus:ring-2 focus:ring-amber-400 w-full shadow-inner font-light" required>
                <button type="submit" aria-label="Kirim Langganan Info Terupdate" class="bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 hover:from-amber-500 hover:to-amber-700 text-slate-950 font-black text-xs sm:text-sm px-6 py-2.5 sm:py-3 rounded-full shadow-lg transition flex items-center justify-center space-x-2 flex-shrink-0 cursor-pointer min-h-[44px] w-full sm:w-auto">
                    <i class="fa-solid fa-paper-plane text-xs" aria-hidden="true"></i>
                    <span>LANGGANAN</span>
                </button>
            </form>
        </div>

        {{-- 2. MAIN FOOTER CONTENT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-8 items-start text-center md:text-left">
            
            {{-- KOLOM 1: LOGO ASLI SEKOLAH --}}
            <div class="lg:col-span-3 flex justify-center md:justify-start">
                <div class="bg-white p-3.5 rounded-2xl shadow-lg inline-block border border-indigo-200/50">
                    <img src="/uploads/logo-ishum-square.png" alt="Logo Resmi SMPS IT Ishlahul Ummah Prabumulih" class="w-28 sm:w-32 h-auto object-contain block mx-auto md:mx-0" onerror="this.src='/uploads/logo-ishum.png'">
                </div>
            </div>

            {{-- KOLOM 2: ALAMAT SEKOLAH & KONTAK --}}
            <div class="lg:col-span-4 space-y-3 footer-address-col text-center md:text-left flex flex-col items-center md:items-start">
                <h3 class="w-full font-bold text-amber-400 text-base sm:text-lg tracking-wide uppercase text-center md:text-left">
                    Alamat Kampus
                </h3>
                <p class="w-full text-sm sm:text-[15px] text-slate-200 font-normal leading-relaxed text-center md:text-left pr-0 md:pr-4">
                    {{ $siteSettings['contact_address'] ?? 'Jalan Sadewa No. 45 RT 01 RW 04 Kelurahan Karang Raja, Kecamatan Prabumulih Timur, Kota Prabumulih, Sumatera Selatan 31113' }}
                </p>
                <div class="w-full space-y-2 pt-1 text-sm sm:text-[15px] text-slate-200 flex flex-col items-center md:items-start">
                    <div class="w-full flex items-center justify-center md:justify-start space-x-3">
                        <i class="fa-solid fa-phone text-amber-400 w-4 text-center text-sm flex-shrink-0" aria-hidden="true"></i>
                        <a href="tel:{{ $siteSettings['contact_phone'] ?? '0852-6990-8696' }}" class="text-slate-200 hover:text-amber-300 transition py-0.5" aria-label="Telepon Sekolah">{{ $siteSettings['contact_phone'] ?? '0852-6990-8696' }}</a>
                    </div>
                    <div class="w-full flex items-center justify-center md:justify-start space-x-3">
                        <i class="fa-solid fa-phone-volume text-amber-400 w-4 text-center text-sm flex-shrink-0" aria-hidden="true"></i>
                        <a href="tel:{{ $siteSettings['contact_phone_alt'] ?? '0853-7897-4396' }}" class="text-slate-200 hover:text-amber-300 transition py-0.5" aria-label="Telepon Alternatif">{{ $siteSettings['contact_phone_alt'] ?? '0853-7897-4396' }}</a>
                    </div>
                    <div class="w-full flex items-center justify-center md:justify-start space-x-3">
                        <i class="fa-solid fa-envelope text-amber-400 w-4 text-center text-sm flex-shrink-0" aria-hidden="true"></i>
                        <a href="mailto:{{ $siteSettings['contact_email'] ?? 'smpitishlahulummah.2015@yahoo.com' }}" class="text-slate-200 hover:text-amber-300 transition py-0.5" aria-label="Email Sekolah">{{ $siteSettings['contact_email'] ?? 'smpitishlahulummah.2015@yahoo.com' }}</a>
                    </div>
                </div>
            </div>

            {{-- KOLOM 3: SOSIAL MEDIA & TAUTAN WEB RESMI --}}
            <div class="lg:col-span-3 space-y-2 text-center md:text-left flex flex-col items-center md:items-start">
                <h3 class="font-bold text-amber-400 text-base sm:text-lg tracking-wide uppercase text-center md:text-left">
                    Media Sosial
                </h3>
                <p class="text-base sm:text-[16px] font-bold text-white mb-2 text-center md:text-left">
                    SMPS IT Ishlahul Ummah
                </p>
                
                {{-- Ikon Bulat Putih --}}
                <div class="flex items-center justify-center md:justify-start space-x-2 pt-1 pb-3">
                    <a href="{{ $siteSettings['social_facebook'] ?? 'https://www.facebook.com/smpitishlahulummah.prabumulih?locale=sw_KE' }}" target="_blank" class="w-11 h-11 rounded-full bg-white flex items-center justify-center text-indigo-700 hover:text-amber-500 hover:scale-110 transition shadow" aria-label="Kunjungi Facebook SMPS IT Ishlahul Ummah Prabumulih">
                        <i class="fa-brands fa-facebook-f text-base" aria-hidden="true"></i>
                    </a>
                    <a href="{{ $siteSettings['social_instagram'] ?? 'https://www.instagram.com/smpitishlahulummahprabumulih/' }}" target="_blank" class="w-11 h-11 rounded-full bg-white flex items-center justify-center text-indigo-700 hover:text-pink-600 hover:scale-110 transition shadow" aria-label="Kunjungi Instagram SMPS IT Ishlahul Ummah Prabumulih">
                        <i class="fa-brands fa-instagram text-base" aria-hidden="true"></i>
                    </a>
                    <a href="{{ $siteSettings['social_youtube'] ?? 'https://www.youtube.com/@smpitishlahulummahprabumul6398' }}" target="_blank" class="w-11 h-11 rounded-full bg-white flex items-center justify-center text-indigo-700 hover:text-red-600 hover:scale-110 transition shadow" aria-label="Kunjungi YouTube SMPS IT Ishlahul Ummah Prabumulih">
                        <i class="fa-brands fa-youtube text-base" aria-hidden="true"></i>
                    </a>
                    <a href="https://wa.me/6285269908696" target="_blank" class="w-11 h-11 rounded-full bg-white flex items-center justify-center text-indigo-700 hover:text-indigo-600 hover:scale-110 transition shadow" aria-label="Hubungi WhatsApp SMPS IT Ishlahul Ummah Prabumulih">
                        <i class="fa-brands fa-whatsapp text-base" aria-hidden="true"></i>
                    </a>
                </div>

                {{-- Tautan Web Resmi dengan Ikon Globe --}}
                <div class="w-full space-y-1.5 text-sm sm:text-[15px] text-slate-200 pt-1 flex flex-col items-center md:items-start">
                    <div class="flex items-center justify-center md:justify-start space-x-3">
                        <i class="fa-solid fa-globe text-amber-400 w-4 text-center text-sm flex-shrink-0" aria-hidden="true"></i>
                        <a href="https://smpitishum.sch.id" target="_blank" class="text-slate-200 hover:text-amber-300 transition py-0.5 font-medium">smpitishum.sch.id</a>
                    </div>
                </div>
            </div>

            {{-- KOLOM 4: PENGUNJUNG --}}
            <div class="lg:col-span-2 space-y-2 text-center md:text-left flex flex-col items-center md:items-start justify-start">
                <h3 class="font-bold text-amber-400 text-base sm:text-lg tracking-wide uppercase flex items-center justify-center md:justify-start gap-2">
                    <span>Pengunjung</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-900 text-white border border-indigo-500">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping mr-1"></span> Live
                    </span>
                </h3>
                <div class="text-3xl sm:text-4xl lg:text-4xl font-bold text-white tracking-normal font-sans leading-tight pt-1 flex items-center justify-center md:justify-start" style="font-family: Arial, sans-serif;">
                    <span id="footer-visitor-counter" data-target="{{ $rawVisitorHits ?? (int) str_replace(['.', ','], '', $visitorHits ?? '53512') }}">
                        {{ $visitorHits ?? '53.512' }}
                    </span>
                </div>
                <p class="text-xs text-slate-400 font-light text-center md:text-left">Kunjungan ke website resmi sekolah</p>
                <div class="pt-2 flex items-center justify-center md:justify-start gap-2 text-xs text-slate-400 text-center md:text-left">
                    <a href="{{ route('page.privacy-policy') }}" class="hover:text-white transition">Kebijakan Privasi</a>
                    <span>&bull;</span>
                    <a href="{{ route('hubungi') }}" class="hover:text-white transition">Kontak</a>
                </div>
            </div>

        </div>

        {{-- 3. GARIS PEMISAH HORIZONTAL --}}
        <div class="mt-12 mb-6 space-y-1">
            <div class="border-t border-slate-800"></div>
        </div>

        {{-- 4. BOTTOM COPYRIGHT & WATERMARK --}}
        <div class="flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400 gap-3 text-center sm:text-left">
            <div>
                Copyright &copy; {{ date('Y') }} SMPS IT Ishlahul Ummah Prabumulih. All Rights Reserved.
            </div>

            <div class="text-[11px] text-slate-500">
                <a href="https://berandadigital.net" target="_blank" rel="noopener" class="hover:text-slate-300 transition">
                    Beranda Teknologi Digital
                </a>
            </div>
        </div>

    </div>

    {{-- Script Animasi Hitung Visitor Counter --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counterEl = document.getElementById('footer-visitor-counter');
            if (!counterEl) return;

            const targetVal = parseInt(counterEl.getAttribute('data-target') || '53512', 10);
            let hasRun = false;

            const runCounterAnimation = () => {
                if (hasRun) return;
                hasRun = true;

                const duration = 2000;
                const startTime = performance.now();
                const startVal = Math.max(0, targetVal - 2500);

                const formatNum = (num) => {
                    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                };

                const frame = (now) => {
                    const elapsed = now - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const ease = 1 - Math.pow(1 - progress, 4);
                    const current = Math.floor(startVal + (targetVal - startVal) * ease);

                    counterEl.textContent = formatNum(current);

                    if (progress < 1) {
                        requestAnimationFrame(frame);
                    } else {
                        counterEl.textContent = formatNum(targetVal);
                    }
                };

                requestAnimationFrame(frame);
            };

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            runCounterAnimation();
                            observer.unobserve(counterEl);
                        }
                    });
                }, { threshold: 0.1 });
                observer.observe(counterEl);
            } else {
                runCounterAnimation();
            }
        });
    </script>
</footer>
