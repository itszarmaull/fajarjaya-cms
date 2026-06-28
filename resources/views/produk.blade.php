<x-layout>
@php
    $settings = \App\Models\Setting::first();
    $bannerUrl = $settings && $settings->banner_produk ? Storage::url($settings->banner_produk) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop';
@endphp
    <main class="min-h-screen pt-28 pb-20">
      <div class="container mx-auto px-4 md:px-8 mb-12">
        <div class="relative rounded-3xl overflow-hidden h-64 md:h-80 bg-slate-900">
          <img src="{{ $bannerUrl }}" alt="Banner Halaman Produk" class="absolute inset-0 w-full h-full object-cover brightness-[0.35]">
          <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 via-slate-900/85 to-slate-950"></div>
          <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6">
            <span class="text-blue-400 font-bold tracking-wider text-sm uppercase mb-2">Katalog Produk</span>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Solusi Aluminium & Kaca</h1>
            <p class="text-slate-200 max-w-xl mx-auto">Pilihan profil aluminium terbaik dan sistem kaca modern.</p>
          </div>
        </div>
      </div>

      <div x-data="productFilter" class="container mx-auto px-4 md:px-8">
        
        <!-- Category Filter Buttons -->
        @if($categories->count() > 0)
        <div class="flex flex-wrap justify-center gap-2 mb-12 bg-slate-50 p-2 rounded-2xl max-w-2xl mx-auto border border-slate-100 shadow-sm">
            <button @click="activeCategory = 'Semua'" 
                    :class="activeCategory === 'Semua' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'text-slate-600 hover:text-slate-950 hover:bg-slate-100'"
                    class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap">
                Semua
            </button>
            @foreach($categories as $category)
                <button @click="activeCategory = '{{ $category }}'" 
                        :class="activeCategory === '{{ $category }}' ? 'bg-brand-blue text-white shadow-lg shadow-blue-500/20' : 'text-slate-600 hover:text-slate-950 hover:bg-slate-100'"
                        class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap">
                    {{ $category }}
                </button>
            @endforeach
        </div>
        @endif

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
            <!-- Alpine dynamic loop -->
            <template x-for="product in filteredProducts" :key="product.id">
                <div class="group border border-slate-200 rounded-2xl p-4 bg-white hover:shadow-xl transition-all duration-300 flex flex-col justify-between h-full">
                    <div class="flex-grow flex flex-col">
                        <div class="aspect-[4/3] w-full rounded-xl overflow-hidden mb-4 relative bg-slate-100 flex items-center justify-center">
                            <template x-if="product.image_url">
                                <img :src="product.image_url" :alt="product.name" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            </template>
                            <template x-if="!product.image_url">
                                <i class="ph ph-image text-5xl text-slate-300"></i>
                            </template>
                        </div>
                        <div class="mb-6 px-1">
                            <template x-if="product.category">
                                <span class="text-[10px] uppercase font-bold tracking-wider text-brand-blue bg-blue-50 px-2.5 py-1 rounded-full mb-3 inline-block" x-text="product.category"></span>
                            </template>
                            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-brand-blue transition-colors" x-text="product.name"></h3>
                            <p class="text-slate-500 text-sm line-clamp-3 leading-relaxed" x-text="product.description"></p>
                        </div>
                    </div>
                    <div class="px-1">
                        <a :href="'/produk/' + product.slug" class="flex items-center justify-center gap-2 w-full py-3.5 border border-slate-200 rounded-xl text-brand-blue font-semibold hover:bg-brand-blue hover:text-white transition-all group-hover:border-brand-blue active:scale-[0.98]">
                            Lihat Detail <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </template>

            <!-- Empty State -->
            <div x-show="filteredProducts.length === 0" class="col-span-full text-center py-20 bg-slate-50 rounded-2xl border border-dashed border-slate-200" style="display: none;">
                <i class="ph ph-cube text-6xl text-slate-300 mb-4 block"></i>
                <h3 class="text-xl font-semibold text-slate-600">Belum ada produk di kategori ini</h3>
                <p class="text-slate-500">Coba pilih kategori produk lainnya.</p>
            </div>
        </div>
      </div>
    </main>
    <script>
        const registerProductFilter = () => {
            if (window.Alpine && !window.registeredProductFilter) {
                window.registeredProductFilter = true;
                Alpine.data('productFilter', () => ({
                    activeCategory: 'Semua',
                    products: @json($products),
                    get filteredProducts() {
                        if (this.activeCategory === 'Semua') {
                            return this.products;
                        }
                        // Gunakan filter dengan function callback biasa (tanpa arrow function '=>') agar 100% aman
                        var activeCat = this.activeCategory;
                        return this.products.filter(function(p) {
                            return p.category === activeCat;
                        });
                    }
                }));
            }
        };

        if (window.Alpine) {
            registerProductFilter();
        } else {
            document.addEventListener('alpine:init', registerProductFilter);
        }
    </script>
</x-layout>
