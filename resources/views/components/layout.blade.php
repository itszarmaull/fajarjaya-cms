@php
    $path = '/' . request()->path();
    if ($path !== '/') {
        $path = rtrim($path, '/');
    }
    $seo = \App\Models\SeoMeta::where('url', $path)->first();
    if (!$seo && request()->is('/')) {
        $seo = \App\Models\SeoMeta::where('url', '/')->first();
    }
    $settings = \App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    @if($settings && $settings->site_logo)
        <link rel="icon" type="image/png" href="{{ Storage::url($settings->site_logo) }}">
    @endif
    <title>{{ $title ?? ($seo->title ?? 'Jasa Pasang Kusen Aluminium & Kaca Tangerang Selatan | Fajar Jaya') }}</title>
    <meta name="description" content="{{ $description ?? ($seo->description ?? 'Spesialis pasang kusen aluminium, pintu lipat, jendela, dan partisi kaca di Tangerang Selatan, BSD, & Bintaro. Harga murah, bergaransi, dan pengerjaan rapi. Hubungi 0858-1355-6864.') }}">
    <meta name="keywords" content="{{ $keywords ?? ($seo->keywords ?? 'kusen aluminium tangerang selatan, jasa pasang aluminium bsd, pintu aluminium serpong, tukang kaca bintaro, harga kusen alexindo tangerang, fajar jaya aluminium') }}">
    
    @if(isset($image) && $image)
    <meta property="og:image" content="{{ Storage::url($image) }}" />
    @elseif($seo && $seo->og_image)
    <meta property="og:image" content="{{ Storage::url($seo->og_image) }}" />
    @endif

    <meta name="geo.region" content="ID-BT" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Cloudflare Turnstile -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: { sans: ["Inter", "sans-serif"] },
            colors: {
              brand: { blue: "#1A56DB", dark: "#0F172A", gray: "#64748B", light: "#F8FAFC" },
            },
            animation: { "slow-zoom": "zoom 20s infinite alternate" },
            keyframes: { zoom: { "0%": { transform: "scale(1)" }, "100%": { transform: "scale(1.1)" } } },
          },
        },
      };
    </script>
</head>
<body class="text-slate-600 bg-white overflow-x-hidden">

    <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md border-b border-slate-100 transition-all duration-300" id="navbar">
      <div class="container mx-auto px-4 md:px-8 py-4 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group">
          @if($settings && $settings->site_logo)
            <div class="w-11 h-11 rounded-xl overflow-hidden shadow-sm border border-slate-100 flex items-center justify-center bg-slate-50 group-hover:scale-105 group-hover:shadow-md transition-all duration-300">
              <img src="{{ Storage::url($settings->site_logo) }}" alt="{{ $settings->company_name ?? 'Fajar Jaya' }}" class="w-full h-full object-cover">
            </div>
          @else
            <div class="w-11 h-11 bg-brand-blue rounded-xl flex items-center justify-center text-white font-bold text-xl group-hover:bg-blue-700 transition">
              F
            </div>
          @endif
          <span class="font-bold text-xl tracking-tight text-slate-900 group-hover:text-brand-blue transition-colors">{{ $settings->company_name ?? 'Fajar Jaya' }}</span>
        </a>

        <div class="hidden lg:flex items-center gap-8 font-medium text-slate-600">
          <a href="/" class="hover:text-brand-blue transition-colors">Beranda</a>
          <a href="/produk" class="hover:text-brand-blue transition-colors">Produk</a>
          <a href="/proyek" class="hover:text-brand-blue transition-colors">Proyek</a>
          <a href="/kalkulator" class="hover:text-brand-blue transition-colors">Hitung Biaya</a>
          <a href="/blog" class="hover:text-brand-blue transition-colors">Blog</a>
          <a href="/tentang" class="hover:text-brand-blue transition-colors">Tentang Kami</a>
          <a href="/kontak" class="hover:text-brand-blue transition-colors">Kontak</a>
        </div>

        <a href="{{ $settings ? 'https://wa.me/'.$settings->company_whatsapp : '#' }}" target="_blank" class="hidden lg:flex items-center gap-2 bg-brand-blue text-white px-5 py-2.5 rounded-full font-semibold hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-500/30 transition transform hover:-translate-y-0.5">
          <i class="ph-bold ph-whatsapp text-xl"></i>
          Konsultasi Gratis
        </a>

        <button onclick="toggleMenu()" class="lg:hidden p-2 text-slate-900 z-50 focus:outline-none hover:bg-slate-100 rounded-lg transition-colors">
          <svg id="iconOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg id="iconClose" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <div id="mobileMenu" class="fixed inset-0 bg-white z-40 transform translate-x-full transition-transform duration-300 ease-in-out lg:hidden flex flex-col pt-28 px-6 gap-6 h-screen w-full overflow-y-auto">
        <a href="/" class="text-xl font-medium text-slate-900 border-b border-slate-100 pb-4">Beranda</a>
        <a href="/produk" class="text-xl font-medium text-slate-900 border-b border-slate-100 pb-4">Produk</a>
        <a href="/proyek" class="text-xl font-medium text-slate-900 border-b border-slate-100 pb-4">Proyek</a>
        <a href="/kalkulator" class="text-xl font-medium text-slate-900 border-b border-slate-100 pb-4">Hitung Biaya</a>
        <a href="/blog" class="text-xl font-medium text-slate-900 border-b border-slate-100 pb-4">Blog</a>
        <a href="/tentang" class="text-xl font-medium text-slate-900 border-b border-slate-100 pb-4">Tentang Kami</a>
        <a href="/kontak" class="text-xl font-medium text-slate-900 border-b border-slate-100 pb-4 mb-2">Kontak</a>
        <a href="{{ $settings ? 'https://wa.me/'.$settings->company_whatsapp : '#' }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-[#25D366] text-white py-4 rounded-full font-bold hover:bg-green-600 transition shadow-lg shadow-green-500/10">
          <i class="ph-bold ph-whatsapp text-2xl"></i>
          Konsultasi Gratis
        </a>
      </div>
    </nav>

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-slate-100 pt-20 pb-10">
      <div class="container mx-auto px-4 md:px-8 pt-16 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
          <div class="lg:col-span-1">
            <a href="/" class="flex items-center gap-3 mb-6 group">
              @if($settings && $settings->site_logo)
                <div class="w-11 h-11 rounded-xl overflow-hidden shadow-sm border border-slate-100 flex items-center justify-center bg-slate-50 group-hover:scale-105 group-hover:shadow-md transition-all duration-300">
                  <img src="{{ Storage::url($settings->site_logo) }}" alt="{{ $settings->company_name ?? 'Fajar Jaya' }}" class="w-full h-full object-cover">
                </div>
              @else
                <div class="w-11 h-11 bg-brand-blue rounded-xl flex items-center justify-center text-white font-bold text-xl">
                  F
                </div>
              @endif
              <span class="font-bold text-xl tracking-tight text-slate-900 group-hover:text-brand-blue transition-colors">{{ $settings->company_name ?? 'Fajar Jaya' }}</span>
            </a>
            <p class="text-slate-500 mb-6 leading-relaxed">Spesialis pemasangan kusen aluminium dan kaca dengan pengalaman puluhan tahun. Kualitas terjamin, harga bersahabat.</p>
            <div class="flex items-center gap-4">
              @if($settings && $settings->social_facebook)
              <a href="{{ $settings->social_facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-brand-blue hover:text-white transition">
                <i class="ph-fill ph-facebook-logo text-xl"></i>
              </a>
              @endif
              @if($settings && $settings->social_instagram)
              <a href="{{ $settings->social_instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-brand-blue hover:text-white transition">
                <i class="ph-fill ph-instagram-logo text-xl"></i>
              </a>
              @endif
            </div>
          </div>

          <div>
            <h4 class="font-bold text-slate-900 mb-6 text-lg">Navigasi</h4>
            <ul class="space-y-3 text-slate-500">
              <li><a href="/" class="hover:text-brand-blue transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Beranda</a></li>
              <li><a href="/produk" class="hover:text-brand-blue transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Produk</a></li>
              <li><a href="/proyek" class="hover:text-brand-blue transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Portofolio</a></li>
              <li><a href="/kalkulator" class="hover:text-brand-blue transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Hitung Biaya</a></li>
              <li><a href="/blog" class="hover:text-brand-blue transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Blog & Tips</a></li>
              <li><a href="/kontak" class="hover:text-brand-blue transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Kontak</a></li>
            </ul>
          </div>

          <div>
            <h4 class="font-bold text-slate-900 mb-6 text-lg">Produk</h4>
            <ul class="space-y-3 text-slate-500">
              <li><a href="#" class="hover:text-brand-blue transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Kusen Aluminium</a></li>
              <li><a href="/produk" class="hover:text-brand-blue transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Pintu Lipat</a></li>
              <li><a href="#" class="hover:text-brand-blue transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Jendela Casement</a></li>
              <li><a href="#" class="hover:text-brand-blue transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-xs"></i> Partisi Kaca</a></li>
            </ul>
          </div>

          <div>
            <h4 class="font-bold text-slate-900 mb-6 text-lg">Hubungi Kami</h4>
            <ul class="space-y-4">
              <li class="flex items-start gap-3 text-slate-500">
                <i class="ph-bold ph-map-pin mt-1 text-brand-blue"></i>
                <span>{{ $settings->company_address ?? 'Tangerang Selatan, Banten' }}</span>
              </li>
              <li class="flex items-center gap-3 text-slate-500">
                <i class="ph-bold ph-phone text-brand-blue"></i>
                <span>{{ $settings->company_whatsapp ?? '0858-1355-6864' }}</span>
              </li>
              <li class="flex items-center gap-3 text-slate-500">
                <i class="ph-bold ph-envelope text-brand-blue"></i>
                <a href="mailto:sales@fajarjaya.my.id" class="hover:text-brand-blue transition">sales@fajarjaya.my.id</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="pt-8 border-t border-slate-200 flex flex-col md:flex-row items-center justify-between gap-4">
          <p class="text-slate-500 text-sm">© {{ date('Y') }} {{ $settings->company_name ?? 'Fajar Jaya Aluminium' }}. All rights reserved<a href="/admin/login" class="cursor-default text-slate-500 hover:text-slate-500">.</a></p>
        </div>
      </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init({ once: true, offset: 50, duration: 800, easing: "ease-out-cubic" });
      function toggleMenu() {
        const menu = document.getElementById("mobileMenu");
        const iconOpen = document.getElementById("iconOpen");
        const iconClose = document.getElementById("iconClose");
        const body = document.body;
        if (menu.classList.contains("translate-x-full")) {
          menu.classList.remove("translate-x-full");
          iconOpen.classList.add("hidden"); iconClose.classList.remove("hidden");
          body.classList.add("overflow-hidden");
        } else {
          menu.classList.add("translate-x-full");
          iconOpen.classList.remove("hidden"); iconClose.classList.add("hidden");
          body.classList.remove("overflow-hidden");
        }
      }
    </script>
    <a href="https://wa.me/{{ $settings->company_whatsapp ?? '6285813556864' }}?text=Halo%20{{ urlencode(($settings->company_name ?? 'Fajar Jaya') . ', saya ingin konsultasi tentang produk aluminium') }}" target="_blank" class="fixed bottom-6 right-6 z-50 group">
      <div class="absolute bottom-16 right-0 w-48 bg-white p-4 rounded-xl shadow-xl mb-2 hidden group-hover:block transition-all transform origin-bottom-right border border-slate-100" data-aos="fade-up">
        <p class="text-xs text-slate-500 mb-1">Butuh respon cepat?</p>
        <p class="text-sm font-bold text-slate-900 flex items-center gap-1">Chat Admin Kami <i class="ph-bold ph-arrow-right text-brand-blue"></i></p>
        <div class="absolute -bottom-2 right-6 w-4 h-4 bg-white rotate-45 border-b border-r border-slate-100"></div>
      </div>
      <div class="relative">
        <span class="absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75 animate-ping"></span>
        <div class="relative w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-lg hover:shadow-green-500/50 hover:-translate-y-1 transition-all duration-300">
          <i class="ph-fill ph-whatsapp-logo text-3xl text-white"></i>
        </div>
        <span class="absolute top-0 right-0 flex h-4 w-4">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500 border-2 border-white"></span>
        </span>
      </div>
    </a>
</body>
</html>
