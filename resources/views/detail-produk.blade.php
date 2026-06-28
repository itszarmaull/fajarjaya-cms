<x-layout>
    <main class="min-h-screen pt-28 pb-20 bg-white">
      <div class="container mx-auto px-4 md:px-8 max-w-6xl">
        
        <!-- Breadcrumbs -->
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-8 font-medium">
          <a href="/" class="hover:text-brand-blue transition-colors">Beranda</a>
          <span>/</span>
          <a href="{{ route('products') }}" class="hover:text-brand-blue transition-colors">Produk</a>
          <span>/</span>
          <span class="text-brand-blue font-bold">{{ $product->name }}</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
          
          <!-- Image Section -->
          <div class="w-full lg:w-1/2">
            <div class="rounded-3xl overflow-hidden bg-slate-100 relative aspect-[4/3] shadow-md border border-slate-100">
              @if($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
              @else
                <div class="w-full h-full flex items-center justify-center"><i class="ph ph-image text-8xl text-slate-300"></i></div>
              @endif

              <!-- Floating Badges -->
              <div class="absolute bottom-6 left-6 flex gap-3">
                <div class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg shadow-sm border border-white/50 flex items-center gap-2">
                  <i class="ph-bold ph-check-circle text-brand-blue"></i>
                  <span class="text-sm font-bold text-slate-700">Premium Quality</span>
                </div>
                <div class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg shadow-sm border border-white/50 flex items-center gap-2">
                  <i class="ph-bold ph-star text-brand-blue"></i>
                  <span class="text-sm font-bold text-slate-700">Garansi Produk</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Detail Section -->
          <div class="w-full lg:w-1/2 flex flex-col">
            
            @if($product->category)
            <div class="mb-4">
              <span class="inline-block px-3 py-1 bg-blue-50 text-brand-blue text-xs font-bold uppercase tracking-wider rounded-md">
                {{ $product->category }}
              </span>
            </div>
            @endif

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-4 leading-tight">{{ $product->name }}</h1>
            
            <p class="text-slate-600 leading-relaxed text-lg mb-8">
              {{ $product->description }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 mb-10">
              <a href="https://wa.me/6285813556864?text=Halo,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}" target="_blank" class="bg-brand-blue hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold text-center flex items-center justify-center gap-2 transition-all shadow-lg shadow-blue-500/20">
                <i class="ph-fill ph-whatsapp-logo text-xl"></i> Pesan Sekarang
              </a>
              <a href="https://wa.me/6285813556864?text=Halo,%20boleh%20minta%20katalog%20produk%20{{ urlencode($product->name) }}?" target="_blank" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-8 py-3 rounded-xl font-bold text-center flex items-center justify-center gap-2 transition-all">
                <i class="ph-bold ph-file-text text-xl"></i> Minta Katalog
              </a>
            </div>

            <!-- Specifications Table -->
            @if($product->specifications && is_array($product->specifications) && count($product->specifications) > 0)
            <div class="bg-slate-50/50 rounded-2xl border border-slate-100 p-6">
              <h3 class="font-bold text-slate-900 mb-4 text-lg">Spesifikasi Teknis</h3>
              <div class="divide-y divide-slate-100">
                @foreach($product->specifications as $key => $val)
                <div class="py-3 flex justify-between items-center text-sm">
                  <span class="text-slate-500">{{ $key }}</span>
                  <span class="font-bold text-slate-900 text-right">{{ $val }}</span>
                </div>
                @endforeach
              </div>
            </div>
            @endif

          </div>
        </div>

        <!-- Features Section -->
        @if($product->features && is_array($product->features) && count($product->features) > 0)
        <div class="mt-24 mb-10">
          <h2 class="text-2xl font-bold text-center text-slate-900 mb-10">Keunggulan Produk Ini</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($product->features as $feature)
            @if(is_array($feature))
            <div class="bg-white border border-slate-100 rounded-3xl p-8 text-center shadow-sm hover:shadow-xl transition-all duration-300">
              <div class="w-14 h-14 bg-blue-50 text-brand-blue rounded-full flex items-center justify-center text-2xl mx-auto mb-6">
                <i class="{{ $feature['icon'] ?? 'ph-fill ph-check-circle' }}"></i>
              </div>
              <h3 class="font-bold text-slate-900 mb-3 text-lg">{{ $feature['title'] ?? '' }}</h3>
              <p class="text-sm text-slate-500 leading-relaxed">{{ $feature['description'] ?? '' }}</p>
            </div>
            @else
            <!-- Fallback for old features array -->
            <div class="bg-white border border-slate-100 rounded-3xl p-8 text-center shadow-sm hover:shadow-xl transition-all duration-300">
              <div class="w-14 h-14 bg-blue-50 text-brand-blue rounded-full flex items-center justify-center text-2xl mx-auto mb-6">
                <i class="ph-fill ph-check-circle"></i>
              </div>
              <h3 class="font-bold text-slate-900 mb-3 text-lg">{{ $feature }}</h3>
            </div>
            @endif
            @endforeach
          </div>
        </div>
        @endif

      </div>
    </main>
</x-layout>
