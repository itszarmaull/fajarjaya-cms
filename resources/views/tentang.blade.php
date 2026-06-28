<x-layout>
@php
    $settings = \App\Models\Setting::first();
    $bannerUrl = $settings && $settings->banner_tentang ? Storage::url($settings->banner_tentang) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2000';
@endphp
    <main>
      <section class="pt-32 pb-24 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
          <img src="{{ $bannerUrl }}" class="w-full h-full object-cover" alt="Tentang Fajar Jaya"/>
        </div>

        <div class="container mx-auto px-4 md:px-8 relative z-10">
          <div class="max-w-3xl" data-aos="fade-right">
            <span class="text-blue-400 font-bold tracking-wider text-sm uppercase mb-3 block">Profil Perusahaan</span>
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
              Dedikasi pada <br /><span class="text-brand-blue">Presisi dan Kualitas</span>
            </h1>
            <p class="text-slate-300 text-lg leading-relaxed mb-8">
              Membangun kepercayaan melalui keunggulan arsitektural aluminium dan kaca sejak 2005. Kami menggabungkan seni dan teknologi untuk mewujudkan visi Anda.
            </p>
          </div>
        </div>
      </section>

      <section class="py-20 -mt-16 relative z-20">
        <div class="container mx-auto px-4 md:px-8">
          <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white p-10 rounded-3xl shadow-xl border-t-4 border-brand-blue" data-aos="fade-up">
              <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-brand-blue text-2xl mb-6">
                <i class="ph-fill ph-eye"></i>
              </div>
              <h3 class="text-2xl font-bold text-slate-900 mb-4">Visi Kami</h3>
              <p class="text-slate-500 leading-relaxed">
                Menjadi pemimpin pasar utama dalam industri solusi fasad dan interior aluminium di Indonesia yang diakui secara internasional atas inovasi, kualitas presisi, dan komitmen terhadap keberlanjutan arsitektur modern.
              </p>
            </div>
            <div class="bg-white p-10 rounded-3xl shadow-xl border-t-4 border-slate-800" data-aos="fade-up" data-aos-delay="100">
              <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-800 text-2xl mb-6">
                <i class="ph-fill ph-flag"></i>
              </div>
              <h3 class="text-2xl font-bold text-slate-900 mb-4">Misi Kami</h3>
              <ul class="space-y-3 text-slate-500">
                <li class="flex gap-3">
                  <i class="ph-bold ph-check text-brand-blue mt-1"></i>
                  Memberikan produk aluminium berkualitas tinggi dengan standar kepatuhan internasional.
                </li>
                <li class="flex gap-3">
                  <i class="ph-bold ph-check text-brand-blue mt-1"></i>
                  Menghadirkan inovasi teknologi terbaru untuk efisiensi dan estetika bangunan.
                </li>
                <li class="flex gap-3">
                  <i class="ph-bold ph-check text-brand-blue mt-1"></i>
                  Membangun hubungan jangka panjang dengan klien melalui layanan purnajual yang unggul.
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-4 md:px-8">
          <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-slate-900">Jejak Langkah Kami</h2>
            <p class="text-slate-500 mt-2">Perjalanan Fajar Jaya Aluminium dalam membentuk lanskap arsitektur Indonesia</p>
          </div>

          <div class="relative max-w-4xl mx-auto">
            <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-slate-200 -ml-[1px]"></div>

            <div class="relative pl-12 md:pl-0 mb-12 md:flex justify-between items-center group">
              <div class="md:w-[45%] md:text-right md:pr-12" data-aos="fade-right">
                <h3 class="text-2xl font-bold text-brand-blue">2005</h3>
                <h4 class="text-lg font-bold text-slate-900">Awal Pendirian</h4>
                <p class="text-slate-500 text-sm mt-2">
                  Dimulai sebagai bengkel fabrikasi kecil di Jakarta Barat dengan visi besar untuk menyediakan jendela dan pintu aluminium berkualitas.
                </p>
              </div>
              <div class="absolute left-4 md:left-1/2 w-4 h-4 bg-white border-4 border-brand-blue rounded-full -translate-x-2 z-10"></div>
              <div class="hidden md:block md:w-[45%] md:pl-12">
                <i class="ph-duotone ph-storefront text-4xl text-slate-300"></i>
              </div>
            </div>

            <div class="relative pl-12 md:pl-0 mb-12 md:flex justify-between items-center flex-row-reverse group">
              <div class="md:w-[45%] md:pl-12" data-aos="fade-left">
                <h3 class="text-2xl font-bold text-brand-blue">2012</h3>
                <h4 class="text-lg font-bold text-slate-900">Ekspansi Teknologi</h4>
                <p class="text-slate-500 text-sm mt-2">
                  Investasi pada mesin CNC presisi tinggi dari Jerman untuk meningkatkan kapasitas produksi dan akurasi potongan profil.
                </p>
              </div>
              <div class="absolute left-4 md:left-1/2 w-4 h-4 bg-white border-4 border-slate-300 group-hover:border-brand-blue rounded-full -translate-x-2 z-10 transition-colors"></div>
              <div class="hidden md:block md:w-[45%] md:text-right md:pr-12">
                <i class="ph-duotone ph-robot text-4xl text-slate-300"></i>
              </div>
            </div>

            <div class="relative pl-12 md:pl-0 mb-12 md:flex justify-between items-center group">
              <div class="md:w-[45%] md:text-right md:pr-12" data-aos="fade-right">
                <h3 class="text-2xl font-bold text-brand-blue">2018</h3>
                <h4 class="text-lg font-bold text-slate-900">Fokus High-Rise</h4>
                <p class="text-slate-500 text-sm mt-2">
                  Dipercaya menangani proyek gedung bertingkat pertama, menandai era baru dalam kemampuan pemasangan fasad skala besar.
                </p>
              </div>
              <div class="absolute left-4 md:left-1/2 w-4 h-4 bg-white border-4 border-slate-300 group-hover:border-brand-blue rounded-full -translate-x-2 z-10 transition-colors"></div>
              <div class="hidden md:block md:w-[45%] md:pl-12">
                <i class="ph-duotone ph-buildings text-4xl text-slate-300"></i>
              </div>
            </div>

            <div class="relative pl-12 md:pl-0 md:flex justify-between items-center flex-row-reverse group">
              <div class="md:w-[45%] md:pl-12" data-aos="fade-left">
                <h3 class="text-2xl font-bold text-brand-blue">2024</h3>
                <h4 class="text-lg font-bold text-slate-900">Inovasi Berkelanjutan</h4>
                <p class="text-slate-500 text-sm mt-2">
                  Mengadopsi sistem green building dan material ramah lingkungan untuk masa depan arsitektur yang lebih baik.
                </p>
              </div>
              <div class="absolute left-4 md:left-1/2 w-4 h-4 bg-white border-4 border-brand-blue rounded-full -translate-x-2 z-10 animate-pulse"></div>
              <div class="hidden md:block md:w-[45%] md:text-right md:pr-12">
                <i class="ph-duotone ph-leaf text-4xl text-slate-300"></i>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="py-24 bg-white">
        <div class="container mx-auto px-4 md:px-8 text-center mb-12">
          <h2 class="text-3xl font-bold text-slate-900 mb-4">Mengapa Memilih Fajar Jaya?</h2>
          <p class="text-slate-500 max-w-xl mx-auto">
            Komitmen kami terhadap kualitas dan kepuasan pelanggan adalah pondasi dari setiap proyek yang kami kerjakan.
          </p>
        </div>

        <div class="container mx-auto px-4 md:px-8">
          <div class="grid md:grid-cols-4 gap-8">
            <div class="bg-slate-50 p-8 rounded-2xl text-center group hover:bg-brand-blue transition-colors duration-300" data-aos="fade-up" data-aos-delay="0">
              <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-brand-blue mx-auto mb-4 shadow-sm">
                <i class="ph-fill ph-diamond text-2xl"></i>
              </div>
              <h4 class="font-bold text-slate-900 mb-2 group-hover:text-white transition-colors">Material Premium</h4>
              <p class="text-xs text-slate-500 leading-relaxed group-hover:text-blue-100 transition-colors">
                Hanya menggunakan aluminium alloy dan kaca terbaik dengan standar ISO untuk ketahanan maksimal.
              </p>
            </div>
            <div class="bg-slate-50 p-8 rounded-2xl text-center group hover:bg-brand-blue transition-colors duration-300" data-aos="fade-up" data-aos-delay="100">
              <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-brand-blue mx-auto mb-4 shadow-sm">
                <i class="ph-fill ph-users-three text-2xl"></i>
              </div>
              <h4 class="font-bold text-slate-900 mb-2 group-hover:text-white transition-colors">Tim Berpengalaman</h4>
              <p class="text-xs text-slate-500 leading-relaxed group-hover:text-blue-100 transition-colors">
                Didukung oleh hanya teknisi ahli bersertifikasi dengan pengalaman puluhan tahun di industri.
              </p>
            </div>
            <div class="bg-slate-50 p-8 rounded-2xl text-center group hover:bg-brand-blue transition-colors duration-300" data-aos="fade-up" data-aos-delay="200">
              <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-brand-blue mx-auto mb-4 shadow-sm">
                <i class="ph-fill ph-gear-fine text-2xl"></i>
              </div>
              <h4 class="font-bold text-slate-900 mb-2 group-hover:text-white transition-colors">Teknologi Terkini</h4>
              <p class="text-xs text-slate-500 leading-relaxed group-hover:text-blue-100 transition-colors">
                Peralatan fabrikasi modern menjamin presisi milimeter dalam setiap potongan dan sambungan.
              </p>
            </div>
            <div class="bg-slate-50 p-8 rounded-2xl text-center group hover:bg-brand-blue transition-colors duration-300" data-aos="fade-up" data-aos-delay="300">
              <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-brand-blue mx-auto mb-4 shadow-sm">
                <i class="ph-fill ph-handshake text-2xl"></i>
              </div>
              <h4 class="font-bold text-slate-900 mb-2 group-hover:text-white transition-colors">Layanan Purnajual</h4>
              <p class="text-xs text-slate-500 leading-relaxed group-hover:text-blue-100 transition-colors">
                Komitmen kami berlanjut setelah instalasi dengan layanan maintenance dan garansi terpercaya.
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>
</x-layout>
