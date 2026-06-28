<x-layout>
@php
    $settings = \App\Models\Setting::first();
    $bannerUrl = $settings && $settings->banner_blog ? Storage::url($settings->banner_blog) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=2070&auto=format&fit=crop';
@endphp
    <!-- Header Section -->
    <section class="relative bg-slate-900 pt-36 pb-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $bannerUrl }}" alt="Blog Hero" class="w-full h-full object-cover brightness-[0.2]">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 via-slate-900/90 to-slate-950"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 md:px-8 text-center text-white">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6 text-sm font-medium tracking-wide text-blue-300">
                <i class="ph-bold ph-newspaper text-lg"></i>
                Blog & Artikel
            </span>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight">Kanal Informasi Fajar Jaya</h1>
            <p class="text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Temukan tips, inspirasi desain, panduan material aluminium & kaca, serta kabar proyek terbaru dari tim kami.
            </p>
        </div>
    </section>

    <!-- Blog Content Section -->
    <section class="py-16 bg-slate-50 min-h-screen">
        <div class="container mx-auto px-4 md:px-8">
            
            <!-- Search & Filters -->
            <div class="mb-12 max-w-5xl mx-auto flex flex-col md:flex-row gap-4 items-center justify-between">
                <!-- Search bar -->
                <form action="{{ route('blog') }}" method="GET" class="w-full md:w-96 flex bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm focus-within:border-brand-blue focus-within:ring-2 focus-within:ring-blue-100 transition">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..." class="w-full px-4 py-3 outline-none text-slate-700 placeholder-slate-400">
                    <button type="submit" class="px-5 bg-brand-blue text-white hover:bg-blue-700 transition">
                        <i class="ph-bold ph-magnifying-glass text-lg"></i>
                    </button>
                </form>

                <!-- Category pills -->
                <div class="flex flex-wrap gap-2 w-full md:w-auto justify-start md:justify-end overflow-x-auto py-1">
                    <a href="{{ route('blog', request()->only(['search'])) }}" 
                       class="px-4 py-2 rounded-xl text-sm font-medium transition {{ !request('category') ? 'bg-brand-blue text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                        Semua Kategori
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('blog', array_merge(request()->only(['search']), ['category' => $category])) }}" 
                           class="px-4 py-2 rounded-xl text-sm font-medium transition {{ request('category') === $category ? 'bg-brand-blue text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                @forelse($posts as $post)
                    <article class="group bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col h-full">
                        <!-- Featured Image -->
                        <div class="h-56 overflow-hidden bg-slate-100 relative">
                            @if($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300">
                                    <i class="ph ph-image text-6xl"></i>
                                </div>
                            @endif
                            @if($post->category)
                                <span class="absolute top-4 left-4 bg-brand-blue text-white text-xs font-extrabold uppercase px-3 py-1.5 rounded-lg tracking-wider">
                                    {{ $post->category }}
                                </span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 md:p-8 flex flex-col justify-between flex-grow">
                            <div>
                                <div class="flex items-center gap-4 text-xs text-slate-400 mb-3">
                                    <span class="flex items-center gap-1">
                                        <i class="ph-bold ph-calendar-blank"></i>
                                        {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="ph-bold ph-eye"></i>
                                        {{ $post->views_count }} dibaca
                                    </span>
                                </div>

                                <h3 class="text-xl font-bold text-slate-900 mb-3 leading-snug group-hover:text-brand-blue transition">
                                    <a href="{{ route('blog.detail', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3">
                                    {{ $post->excerpt ?? strip_tags($post->content) }}
                                </p>
                            </div>

                            <a href="{{ route('blog.detail', $post->slug) }}" class="inline-flex items-center gap-2 text-brand-blue font-bold text-sm hover:gap-3 transition-all mt-auto">
                                Selengkapnya <i class="ph-bold ph-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-dashed border-slate-200">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4 text-slate-400">
                            <i class="ph-bold ph-article-ny-times"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Belum Ada Artikel</h3>
                        <p class="text-slate-500 max-w-sm mx-auto text-sm">
                            Tidak ada artikel yang dipublikasikan saat ini. Silakan kunjungi kembali nanti atau ubah filter pencarian Anda.
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16 max-w-5xl mx-auto flex justify-center">
                {{ $posts->links() }}
            </div>

        </div>
    </section>
</x-layout>
