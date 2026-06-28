<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <title>404 - Halaman Tidak Ditemukan | Fajar Jaya</title>
    <meta name="description" content="Halaman yang Anda cari tidak tersedia.">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: { sans: ["Inter", "sans-serif"] },
            colors: {
              brand: { blue: "#1A56DB", dark: "#0F172A", gray: "#64748B", light: "#F8FAFC" },
            },
            animation: {
              'float': 'float 6s ease-in-out infinite',
              'float-delayed': 'float 6s ease-in-out 2s infinite',
              'float-slow': 'float 8s ease-in-out 1s infinite',
              'pulse-slow': 'pulse 4s ease-in-out infinite',
            },
            keyframes: {
              float: {
                '0%, 100%': { transform: 'translateY(0px)' },
                '50%': { transform: 'translateY(-20px)' },
              }
            },
          },
        },
      };
    </script>
    <style>
      body { font-family: 'Inter', sans-serif; }
      .grid-bg {
        background-image: linear-gradient(rgba(26, 86, 219, 0.04) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(26, 86, 219, 0.04) 1px, transparent 1px);
        background-size: 50px 50px;
      }
      .glow-blue {
        box-shadow: 0 0 80px rgba(26, 86, 219, 0.15), 0 0 160px rgba(26, 86, 219, 0.08);
      }
    </style>
</head>
<body class="bg-slate-950 text-white overflow-x-hidden">

    <!-- Background decorations -->
    <div class="fixed inset-0 grid-bg"></div>
    <div class="fixed top-1/4 left-1/4 w-96 h-96 bg-brand-blue/10 rounded-full blur-3xl animate-pulse-slow"></div>
    <div class="fixed bottom-1/4 right-1/4 w-64 h-64 bg-blue-400/8 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>

    <!-- Navigation -->
    <nav class="relative z-10 py-6 px-4 md:px-8">
      <div class="container mx-auto flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group">
          <div class="w-10 h-10 bg-brand-blue rounded-xl flex items-center justify-center text-white font-bold text-lg group-hover:bg-blue-500 transition">
            F
          </div>
          <span class="font-bold text-xl tracking-tight text-white">Fajar Jaya</span>
        </a>
        <a href="/" class="text-slate-400 hover:text-white flex items-center gap-2 text-sm font-medium transition-colors">
          <i class="ph-bold ph-arrow-left"></i> Kembali ke Beranda
        </a>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="relative z-10 min-h-screen flex items-center justify-center px-4 py-20">
      <div class="text-center max-w-2xl mx-auto">

        <!-- 404 Large Number -->
        <div class="relative mb-8 inline-block">
          <!-- Floating elements around the 404 -->
          <div class="absolute -top-8 -left-12 w-12 h-12 bg-brand-blue/20 rounded-xl border border-brand-blue/30 flex items-center justify-center animate-float">
            <i class="ph-fill ph-wrench text-brand-blue text-xl"></i>
          </div>
          <div class="absolute -top-4 -right-14 w-10 h-10 bg-slate-800 rounded-lg border border-slate-700 flex items-center justify-center animate-float-delayed">
            <i class="ph-fill ph-house text-slate-400"></i>
          </div>
          <div class="absolute -bottom-6 -left-8 w-8 h-8 bg-blue-500/20 rounded-full border border-blue-500/30 animate-float-slow"></div>
          <div class="absolute -bottom-2 -right-10 w-6 h-6 bg-slate-700 rounded-full animate-float"></div>

          <div class="glow-blue rounded-3xl bg-slate-900/80 border border-slate-800/60 backdrop-blur-sm px-12 py-8">
            <span class="text-[9rem] md:text-[12rem] font-black leading-none tracking-tighter text-transparent bg-clip-text bg-gradient-to-b from-white via-slate-300 to-slate-600 select-none">
              404
            </span>
          </div>
        </div>

        <!-- Broken window icon -->
        <div class="flex justify-center mb-6">
          <div class="w-16 h-16 bg-blue-500/10 border border-blue-500/20 rounded-2xl flex items-center justify-center animate-float-delayed">
            <i class="ph-fill ph-warning text-brand-blue text-3xl"></i>
          </div>
        </div>

        <!-- Error message -->
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
          Halaman Tidak Ditemukan
        </h1>
        <p class="text-slate-400 text-lg leading-relaxed mb-10">
          Sepertinya halaman yang Anda cari sudah dipindahkan, dihapus,<br class="hidden md:block">
          atau mungkin URL-nya salah ketik.
        </p>

        <!-- Action buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
          <a href="/" class="group flex items-center gap-3 bg-brand-blue hover:bg-blue-500 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 shadow-lg shadow-brand-blue/30 hover:shadow-brand-blue/50 hover:-translate-y-0.5">
            <i class="ph-bold ph-house text-xl group-hover:scale-110 transition-transform"></i>
            Kembali ke Beranda
          </a>
          <a href="/kontak" class="flex items-center gap-3 bg-slate-800 hover:bg-slate-700 text-white border border-slate-700 px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:-translate-y-0.5">
            <i class="ph-bold ph-chat-circle-dots text-xl"></i>
            Hubungi Kami
          </a>
        </div>

        <!-- Quick Links -->
        <div class="border-t border-slate-800 pt-10">
          <p class="text-slate-500 text-sm mb-6 font-medium uppercase tracking-wider">Halaman yang Mungkin Anda Cari</p>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <a href="/produk" class="group bg-slate-900 hover:bg-slate-800 border border-slate-800 hover:border-brand-blue/50 rounded-xl p-4 text-center transition-all duration-200 hover:-translate-y-0.5">
              <i class="ph-fill ph-cube text-brand-blue text-2xl mb-2 block group-hover:scale-110 transition-transform"></i>
              <span class="text-slate-300 text-sm font-medium">Produk</span>
            </a>
            <a href="/proyek" class="group bg-slate-900 hover:bg-slate-800 border border-slate-800 hover:border-brand-blue/50 rounded-xl p-4 text-center transition-all duration-200 hover:-translate-y-0.5">
              <i class="ph-fill ph-briefcase text-brand-blue text-2xl mb-2 block group-hover:scale-110 transition-transform"></i>
              <span class="text-slate-300 text-sm font-medium">Proyek</span>
            </a>
            <a href="/blog" class="group bg-slate-900 hover:bg-slate-800 border border-slate-800 hover:border-brand-blue/50 rounded-xl p-4 text-center transition-all duration-200 hover:-translate-y-0.5">
              <i class="ph-fill ph-article text-brand-blue text-2xl mb-2 block group-hover:scale-110 transition-transform"></i>
              <span class="text-slate-300 text-sm font-medium">Blog</span>
            </a>
            <a href="/kontak" class="group bg-slate-900 hover:bg-slate-800 border border-slate-800 hover:border-brand-blue/50 rounded-xl p-4 text-center transition-all duration-200 hover:-translate-y-0.5">
              <i class="ph-fill ph-phone text-brand-blue text-2xl mb-2 block group-hover:scale-110 transition-transform"></i>
              <span class="text-slate-300 text-sm font-medium">Kontak</span>
            </a>
          </div>
        </div>

      </div>
    </main>

</body>
</html>
