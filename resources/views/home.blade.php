<x-layout>
@php
    $setting = \App\Models\Setting::first();
    $slides = [];
    if ($setting && $setting->hero_images && is_array($setting->hero_images)) {
        foreach ($setting->hero_images as $img) {
            $slides[] = Storage::url($img);
        }
    }
    if (empty($slides)) {
        if ($setting && $setting->hero_image) {
            $slides[] = Storage::url($setting->hero_image);
        } else {
            $slides[] = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop';
            $slides[] = 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=2069&auto=format&fit=crop';
            $slides[] = 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop';
        }
    }
@endphp
      <section class="relative min-h-[90vh] flex items-center pt-20 overflow-hidden bg-slate-900"
               x-data="heroSlider">
        <!-- Background Images Slider -->
        <div class="absolute inset-0 z-0">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index"
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 scale-105"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-1000"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute inset-0 w-full h-full">
                    <img :src="slide" alt="Hero Background" class="w-full h-full object-cover brightness-[0.35] animate-slow-zoom">
                </div>
            </template>
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/95 via-slate-900/80 to-transparent"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 text-center text-white mt-16">
          <div data-aos="fade-down" data-aos-duration="1000" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6 hover:bg-white/20 transition-colors cursor-default">
            <span class="w-2 h-2 rounded-full bg-brand-blue animate-pulse"></span>
            <span class="text-sm font-medium tracking-wide">Solusi Aluminium & Kaca Premium</span>
          </div>

          <h1 data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000" class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight tracking-tight">
            {{ $setting->hero_title ?? 'Estetika Modern, Ketahanan Maksimal' }}
          </h1>

          <p data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto mb-10 leading-relaxed">
            {{ $setting->hero_subtitle ?? 'Mitra terpercaya untuk solusi pintu, jendela, dan fasad aluminium berkualitas tinggi yang menggabungkan keindahan desain dengan kekuatan material.' }}
          </p>

          <div data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000" class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8">
            <a href="#produk" class="w-full sm:w-auto px-6 py-3 bg-brand-blue hover:bg-blue-600 text-white rounded-xl font-medium transition-all shadow-lg shadow-blue-500/30 hover:-translate-y-1">Lihat Produk</a>
            <a href="/kontak" class="w-full sm:w-auto px-6 py-3 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white rounded-xl font-medium transition-all hover:-translate-y-1">Hubungi Kami</a>
          </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce text-white/50 hidden md:block">
          <i class="ph ph-arrow-down text-3xl"></i>
        </div>
      </section>

      <section class="bg-white border-b border-slate-100 relative z-20 -mt-8 mx-4 md:mx-auto md:max-w-5xl rounded-2xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-2 md:grid-cols-4">
          <div class="p-4 md:p-6 text-center bg-white hover:bg-slate-50 transition-colors border-b border-r border-slate-100 md:border-b-0"><h3 class="text-2xl md:text-3xl font-bold text-brand-blue mb-1">15+</h3><p class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wide">Tahun Pengalaman</p></div>
          <div class="p-4 md:p-6 text-center bg-white hover:bg-slate-50 transition-colors border-b border-slate-100 md:border-b-0 md:border-r"><h3 class="text-2xl md:text-3xl font-bold text-brand-blue mb-1">500+</h3><p class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wide">Proyek Selesai</p></div>
          <div class="p-4 md:p-6 text-center bg-white hover:bg-slate-50 transition-colors border-r border-slate-100 md:border-r"><h3 class="text-2xl md:text-3xl font-bold text-brand-blue mb-1">100%</h3><p class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wide">Garansi Kualitas</p></div>
          <div class="p-4 md:p-6 text-center bg-white hover:bg-slate-50 transition-colors"><h3 class="text-2xl md:text-3xl font-bold text-brand-blue mb-1">24/7</h3><p class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wide">Layanan Pelanggan</p></div>
        </div>
      </section>

      <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-4 md:px-8">
          <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-brand-blue font-bold tracking-wider text-sm uppercase mb-2 block">Kenapa Memilih Kami?</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Keunggulan Fajar Jaya</h2>
            <p class="text-slate-500 max-w-xl mx-auto text-lg">Standar kualitas terbaik untuk kebutuhan arsitektur Anda. Detail dalam setiap milimeter.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
              <div class="w-14 h-14 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center text-3xl mb-6"><i class="ph-fill ph-ruler-precision"></i></div>
              <h3 class="text-xl font-bold text-slate-900 mb-3">Presisi Tinggi</h3>
              <p class="text-slate-500 leading-relaxed text-sm md:text-base">Fabrikasi kustom yang disesuaikan dengan pengukuran tepat di lapangan, meminimalisir celah dan kesalahan pasang.</p>
            </div>
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
              <div class="w-14 h-14 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center text-3xl mb-6"><i class="ph-fill ph-shield-check"></i></div>
              <h3 class="text-xl font-bold text-slate-900 mb-3">Material Premium</h3>
              <p class="text-slate-500 leading-relaxed text-sm md:text-base">Menggunakan aluminium alloy kualitas terbaik yang anti karat, tahan cuaca ekstrim, dan warna yang awet bertahun-tahun.</p>
            </div>
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
              <div class="w-14 h-14 bg-blue-50 text-brand-blue rounded-xl flex items-center justify-center text-3xl mb-6"><i class="ph-fill ph-paint-brush-broad"></i></div>
              <h3 class="text-xl font-bold text-slate-900 mb-3">Desain Modern</h3>
              <p class="text-slate-500 leading-relaxed text-sm md:text-base">Profil ramping dan minimalis yang mendukung arsitektur kontemporer, memberikan kesan luas dan elegan.</p>
            </div>
          </div>
        </div>
      </section>

      <section id="produk" class="py-24 bg-white">
        <div class="container mx-auto px-4 md:px-8">
          <div class="flex flex-col md:flex-row justify-center md:justify-between items-center md:items-end mb-12 gap-6 text-center md:text-left">
            <div>
              <span class="text-brand-blue font-bold tracking-wider text-sm uppercase mb-2 block">Katalog Kami</span>
              <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-2">Kategori Pilihan</h2>
            </div>
            <div class="flex gap-2 bg-slate-50 p-1.5 rounded-xl overflow-x-auto max-w-full">
              <a href="{{ route('products') }}" class="px-6 py-2.5 bg-white text-brand-blue text-sm font-bold rounded-lg shadow-sm whitespace-nowrap">Lihat Semua</a>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse($products as $product)
            <div class="group border border-slate-100 rounded-2xl md:rounded-3xl p-4 md:p-6 hover:shadow-2xl transition-all duration-500 hover:border-blue-100 bg-white flex flex-col justify-between h-full">
              <div class="flex-grow flex flex-col">
                <div class="aspect-[4/3] w-full rounded-xl md:rounded-2xl overflow-hidden mb-4 md:mb-6 relative bg-slate-100 flex items-center justify-center">
                  @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                  @else
                    <i class="ph ph-image text-5xl text-slate-300"></i>
                  @endif
                </div>
                <div class="px-2 mb-6">
                  @if($product->category)
                    <span class="text-[10px] uppercase font-bold tracking-wider text-brand-blue bg-blue-50 px-2.5 py-1 rounded-full mb-3 inline-block">{{ $product->category }}</span>
                  @endif
                  <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-2 group-hover:text-brand-blue transition-colors">{{ $product->name }}</h3>
                  <p class="text-slate-500 text-sm leading-relaxed line-clamp-3">{{ $product->description }}</p>
                </div>
              </div>
              <div class="px-2">
                <a href="/produk/{{ $product->slug }}" class="flex items-center justify-center gap-2 w-full py-3.5 border border-slate-200 rounded-xl text-brand-blue font-semibold hover:bg-brand-blue hover:text-white transition-all hover:shadow-lg hover:shadow-blue-500/10 group-hover:border-brand-blue transform active:scale-95">
                  Detail Produk <i class="ph-bold ph-arrow-right"></i>
                </a>
              </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-12 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                <i class="ph ph-package text-4xl text-slate-400 mb-2"></i>
                <h3 class="text-lg font-bold text-slate-700">Belum Ada Produk</h3>
                <p class="text-slate-500 mb-4">Tambahkan produk pertama Anda melalui halaman Admin.</p>
                <a href="/admin/products" class="inline-flex items-center gap-2 bg-brand-blue text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">Buka Panel Admin <i class="ph-bold ph-arrow-right"></i></a>
            </div>
            @endforelse
          </div>
        </div>
      </section>

      <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-4 md:px-8">
          <div class="flex flex-col md:flex-row justify-center md:justify-between items-center mb-12 text-center md:text-left">
            <div>
              <span class="text-brand-blue font-bold tracking-wider text-sm uppercase mb-2 block">Portofolio</span>
              <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Proyek Terbaru</h2>
            </div>
            <a href="{{ route('projects') }}" class="mt-4 md:mt-0 flex items-center gap-2 text-brand-blue font-bold hover:gap-4 transition-all">
              Lihat Semua Proyek <i class="ph-bold ph-arrow-right"></i>
            </a>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse($projects as $project)
            <div class="group relative h-64 sm:h-72 md:h-96 rounded-2xl overflow-hidden cursor-pointer shadow-lg bg-slate-200 flex items-center justify-center">
                @if($project->image)
                  <img src="{{ Storage::url($project->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                @else
                  <i class="ph ph-image text-5xl text-slate-400"></i>
                @endif
              <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent flex flex-col justify-end p-8 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                <span class="text-brand-blue text-xs font-bold uppercase tracking-wider mb-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">{{ $project->category ?? 'Proyek' }}</span>
                <h3 class="text-white text-2xl font-bold group-hover:text-blue-200 transition-colors">{{ $project->title }}</h3>
              </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-slate-500">Belum ada proyek yang ditambahkan.</p>
            </div>
            @endforelse
          </div>
        </div>
      </section>

      <!-- Testimonials Section -->
      <section class="py-24 bg-white border-b border-slate-100">
        <div class="container mx-auto px-4 md:px-8">
          <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-brand-blue font-bold tracking-wider text-sm uppercase mb-2 block">Testimonial</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Ulasan Pelanggan Kami</h2>
            <p class="text-slate-500 max-w-xl mx-auto text-base">Kepuasan Anda adalah prioritas utama kami. Berikut adalah apa yang mereka katakan tentang hasil kerja kami.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials as $testimonial)
              <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-lg hover:-translate-y-1 transition duration-300">
                <div>
                  <div class="flex items-center gap-1 text-yellow-500 mb-6">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                      <i class="ph-fill ph-star"></i>
                    @endfor
                  </div>
                  <p class="text-slate-600 italic leading-relaxed mb-8">"{{ $testimonial->content }}"</p>
                </div>
                <div class="flex items-center gap-4">
                  @if($testimonial->avatar)
                    <img src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover">
                  @else
                    <div class="w-12 h-12 rounded-full bg-blue-100 text-brand-blue flex items-center justify-center font-bold text-lg">
                      {{ substr($testimonial->name, 0, 1) }}
                    </div>
                  @endif
                  <div>
                    <h4 class="font-bold text-slate-900 text-sm">{{ $testimonial->name }}</h4>
                    <p class="text-xs text-slate-400">{{ $testimonial->company }}</p>
                  </div>
                </div>
              </div>
            @empty
              <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                  <div class="flex items-center gap-1 text-yellow-500 mb-6">
                    <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
                  </div>
                  <p class="text-slate-600 italic leading-relaxed mb-8">"Pekerjaan sangat rapi, presisi, dan selesai tepat waktu. Kusen aluminium yang dipasang kokoh dan membuat rumah terlihat jauh lebih modern."</p>
                </div>
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 rounded-full bg-blue-100 text-brand-blue flex items-center justify-center font-bold text-lg">H</div>
                  <div>
                    <h4 class="font-bold text-slate-900 text-sm">Hendra Wijaya</h4>
                    <p class="text-xs text-slate-400">Pemilik Rumah, BSD</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                  <div class="flex items-center gap-1 text-yellow-500 mb-6">
                    <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
                  </div>
                  <p class="text-slate-600 italic leading-relaxed mb-8">"Sangat merekomendasikan Fajar Jaya. Harganya kompetitif dibandingkan dengan kontraktor lain, dan pelayanannya sangat komunikatif."</p>
                </div>
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 rounded-full bg-blue-100 text-brand-blue flex items-center justify-center font-bold text-lg">S</div>
                  <div>
                    <h4 class="font-bold text-slate-900 text-sm">Santi Rahayu</h4>
                    <p class="text-xs text-slate-400">Kontraktor Interior, Bintaro</p>
                  </div>
                </div>
              </div>

              <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                  <div class="flex items-center gap-1 text-yellow-500 mb-6">
                    <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
                  </div>
                  <p class="text-slate-600 italic leading-relaxed mb-8">"Pintu geser aluminiumnya sangat presisi. Gerakan meluncur halus sekali. Terima kasih atas pengerjaan yang sangat profesional."</p>
                </div>
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 rounded-full bg-blue-100 text-brand-blue flex items-center justify-center font-bold text-lg">A</div>
                  <div>
                    <h4 class="font-bold text-slate-900 text-sm">Aris Pratama</h4>
                    <p class="text-xs text-slate-400">Manager Proyek Ruko, Serpong</p>
                  </div>
                </div>
              </div>
            @endforelse
          </div>
        </div>
      </section>

      <!-- FAQ Section -->
      <section class="py-24 bg-slate-50 border-b border-slate-100" x-data="{ activeFaq: null }">
        <div class="container mx-auto px-4 md:px-8 max-w-4xl">
          <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-brand-blue font-bold tracking-wider text-sm uppercase mb-2 block">Tanya Jawab</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-slate-500 max-w-xl mx-auto text-base">Temukan jawaban atas beberapa pertanyaan umum seputar pemasangan kusen dan kaca di Fajar Jaya.</p>
          </div>

          <div class="space-y-4">
            @forelse($faqs as $index => $faq)
              <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm transition-all duration-300">
                <button @click="activeFaq === {{ $index }} ? activeFaq = null : activeFaq = {{ $index }}" 
                        class="w-full text-left px-6 py-5 font-bold text-slate-950 flex justify-between items-center hover:text-brand-blue transition focus:outline-none">
                  <span class="pr-4 leading-snug">{{ $faq->question }}</span>
                  <i class="ph-bold text-lg transition-transform duration-300" 
                     :class="activeFaq === {{ $index }} ? 'ph-minus text-brand-blue rotate-180' : 'ph-plus text-slate-400'"></i>
                </button>
                <div x-show="activeFaq === {{ $index }}" 
                     x-collapse 
                     class="px-6 pb-6 text-slate-500 leading-relaxed text-sm md:text-base border-t border-slate-50 pt-4"
                     style="display: none;">
                  {{ $faq->answer }}
                </div>
              </div>
            @empty
              <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                <button @click="activeFaq === 0 ? activeFaq = null : activeFaq = 0" 
                        class="w-full text-left px-6 py-5 font-bold text-slate-950 flex justify-between items-center hover:text-brand-blue transition focus:outline-none">
                  <span>Apakah melayani survey lokasi gratis?</span>
                  <i class="ph-bold text-lg transition-transform duration-300" :class="activeFaq === 0 ? 'ph-minus text-brand-blue rotate-180' : 'ph-plus text-slate-400'"></i>
                </button>
                <div x-show="activeFaq === 0" class="px-6 pb-6 text-slate-500 leading-relaxed text-sm pt-4 border-t border-slate-50" style="display: none;">
                  Ya, kami melayani survey lokasi gratis dan pengukuran bidang untuk seluruh area Tangerang Selatan, BSD, Serpong, dan Bintaro.
                </div>
              </div>

              <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                <button @click="activeFaq === 1 ? activeFaq = null : activeFaq = 1" 
                        class="w-full text-left px-6 py-5 font-bold text-slate-950 flex justify-between items-center hover:text-brand-blue transition focus:outline-none">
                  <span>Merk aluminium apa saja yang disediakan?</span>
                  <i class="ph-bold text-lg transition-transform duration-300" :class="activeFaq === 1 ? 'ph-minus text-brand-blue rotate-180' : 'ph-plus text-slate-400'"></i>
                </button>
                <div x-show="activeFaq === 1" class="px-6 pb-6 text-slate-500 leading-relaxed text-sm pt-4 border-t border-slate-50" style="display: none;">
                  Kami menyediakan berbagai pilihan merk profil aluminium berkualitas mulai dari YKK AP (Premium), Alexindo (Standard Berkualitas), hingga Inkalum/Dacon (Ekonomis).
                </div>
              </div>

              <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                <button @click="activeFaq === 2 ? activeFaq = null : activeFaq = 2" 
                        class="w-full text-left px-6 py-5 font-bold text-slate-950 flex justify-between items-center hover:text-brand-blue transition focus:outline-none">
                  <span>Berapa lama proses fabrikasi dan pemasangan?</span>
                  <i class="ph-bold text-lg transition-transform duration-300" :class="activeFaq === 2 ? 'ph-minus text-brand-blue rotate-180' : 'ph-plus text-slate-400'"></i>
                </button>
                <div x-show="activeFaq === 2" class="px-6 pb-6 text-slate-500 leading-relaxed text-sm pt-4 border-t border-slate-50" style="display: none;">
                  Lama pengerjaan bergantung pada volume proyek. Untuk perumahan standar, proses fabrikasi di workshop kami berkisar antara 3-5 hari kerja, dilanjutkan pemasangan di lokasi selama 1-2 hari kerja.
                </div>
              </div>
            @endforelse
          </div>
        </div>
      </section>

      <section class="py-24 bg-brand-blue text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse delay-700"></div>

        <div class="container mx-auto px-4 text-center relative z-10" data-aos="zoom-in">
          <h2 class="text-3xl md:text-5xl font-bold mb-6">Butuh spesifikasi khusus?</h2>
          <p class="text-blue-100 text-base md:text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
            Kami melayani fabrikasi kustom sesuai desain arsitek Anda. Diskusikan kebutuhan proyek Anda dengan tim teknis kami.
          </p>
          <a href="/kontak" class="inline-block bg-white text-brand-blue px-10 py-4 rounded-xl font-bold text-base md:text-lg hover:bg-slate-100 transition-all hover:-translate-y-1 shadow-2xl hover:shadow-white/20">
            Hubungi Kami Sekarang
          </a>
        </div>
      </section>
      <script>
          const registerHeroSlider = () => {
              if (window.Alpine && !window.registeredHeroSlider) {
                  window.registeredHeroSlider = true;
                  Alpine.data('heroSlider', () => ({
                      activeSlide: 0,
                      slides: @json($slides),
                      init() {
                          setInterval(() => {
                              this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                          }, 5000);
                      }
                  }));
              }
          };

          if (window.Alpine) {
              registerHeroSlider();
          } else {
              document.addEventListener('alpine:init', registerHeroSlider);
          }
      </script>
</x-layout>
