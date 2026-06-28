<x-layout 
    :title="$post->title . ' | Fajar Jaya'" 
    :description="$post->excerpt ?? Str::limit(strip_tags($post->content), 150)" 
    :image="$post->featured_image"
>
    <!-- Article Container -->
    <article class="pt-32 pb-24 bg-white">
        <div class="container mx-auto px-4 md:px-8 max-w-4xl">
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
                <a href="/" class="hover:text-brand-blue transition">Beranda</a>
                <i class="ph ph-caret-right text-xs"></i>
                <a href="/blog" class="hover:text-brand-blue transition">Blog</a>
                <i class="ph ph-caret-right text-xs"></i>
                <span class="text-slate-600 truncate">{{ $post->title }}</span>
            </div>

            <!-- Meta details -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 mb-6 border-b border-slate-100 pb-6">
                @if($post->category)
                    <span class="bg-blue-50 text-brand-blue text-xs font-bold uppercase px-3 py-1.5 rounded-lg">
                        {{ $post->category }}
                    </span>
                @endif
                <span class="flex items-center gap-1.5">
                    <i class="ph ph-calendar-blank text-lg"></i>
                    {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                </span>
                <span class="flex items-center gap-1.5">
                    <i class="ph ph-eye text-lg"></i>
                    {{ $post->views_count }} Kali dibaca
                </span>
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-5xl font-black text-slate-900 mb-8 leading-tight">
                {{ $post->title }}
            </h1>

            <!-- Cover Image -->
            @if($post->featured_image)
                <div class="h-64 sm:h-96 md:h-[450px] w-full rounded-3xl overflow-hidden shadow-lg mb-12 bg-slate-100">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Main Content Area -->
            <div class="prose max-w-none text-slate-700 leading-relaxed text-base md:text-lg space-y-6">
                {!! $post->content !!}
            </div>

            <!-- Share Buttons & WhatsApp CTA -->
            <div class="mt-16 pt-8 border-t border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <!-- Social Share -->
                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-slate-500">Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-[#1877F2] hover:text-white transition">
                        <i class="ph-bold ph-facebook-logo text-xl"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-[#25D366] hover:text-white transition">
                        <i class="ph-bold ph-whatsapp-logo text-xl"></i>
                    </a>
                </div>

                <!-- CTA Button -->
                <div>
                    <a href="https://wa.me/{{ $settings->company_whatsapp ?? '6285813556864' }}?text=Halo%20Fajar%20Jaya,%20saya%20tertarik%20dengan%20layanan%20Anda%20setelah%20membaca%20artikel:%20{{ urlencode($post->title) }}" target="_blank" class="inline-flex items-center gap-2 bg-brand-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition">
                        <i class="ph-fill ph-chat-circle text-lg"></i>
                        Konsultasi Mengenai Artikel Ini
                    </a>
                </div>
            </div>
        </div>
    </article>

    <!-- Related Articles Section -->
    @if($relatedPosts->count() > 0)
        <section class="py-20 bg-slate-50 border-t border-slate-100">
            <div class="container mx-auto px-4 md:px-8 max-w-6xl">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-10 text-center md:text-left">
                    Artikel Terkait
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relPost)
                        <div class="group bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-lg transition flex flex-col h-full">
                            <div class="h-48 overflow-hidden bg-slate-100">
                                @if($relPost->featured_image)
                                    <img src="{{ Storage::url($relPost->featured_image) }}" alt="{{ $relPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100">
                                        <i class="ph ph-image text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6 flex flex-col justify-between flex-grow">
                                <div>
                                    <span class="text-xs text-slate-400 block mb-2">{{ $relPost->created_at->format('d M Y') }}</span>
                                    <h3 class="font-bold text-slate-900 mb-4 line-clamp-2 group-hover:text-brand-blue transition">
                                        <a href="{{ route('blog.detail', $relPost->slug) }}">
                                            {{ $relPost->title }}
                                        </a>
                                    </h3>
                                </div>
                                <a href="{{ route('blog.detail', $relPost->slug) }}" class="inline-flex items-center gap-1.5 text-brand-blue font-bold text-xs hover:gap-2.5 transition-all">
                                    Baca Selengkapnya <i class="ph-bold ph-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layout>
