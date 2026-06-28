<x-layout>
@php
    $settings = \App\Models\Setting::first();
    $bannerUrl = $settings && $settings->banner_proyek ? Storage::url($settings->banner_proyek) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop';
@endphp
    <main class="min-h-screen pt-28 pb-20">
      <div class="container mx-auto px-4 md:px-8 mb-12">
        <div class="relative rounded-3xl overflow-hidden h-64 md:h-80 bg-slate-900">
          <img src="{{ $bannerUrl }}" alt="Banner Halaman Proyek" class="absolute inset-0 w-full h-full object-cover brightness-[0.35]">
          <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 via-slate-900/85 to-slate-950"></div>
          <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6">
            <span class="text-blue-400 font-bold tracking-wider text-sm uppercase mb-2">Portofolio</span>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Proyek Selesai</h1>
            <p class="text-slate-250 max-w-xl mx-auto">Karya terbaik kami yang telah dipercaya oleh berbagai klien.</p>
          </div>
        </div>
      </div>

      <div class="container mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
          @forelse($projects as $project)
          <div class="product-item group border border-slate-200 rounded-2xl p-4 bg-white hover:shadow-xl transition-all duration-300">
            <div class="h-56 rounded-xl overflow-hidden mb-4 relative bg-slate-100 flex items-center justify-center">
              @if($project->image)
                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
              @else
                <i class="ph ph-briefcase text-5xl text-slate-300"></i>
              @endif
              @if($project->category)
              <div class="absolute top-2 left-2 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-brand-blue">
                {{ $project->category }}
              </div>
              @endif
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $project->title }}</h3>
            <p class="text-slate-500 text-sm line-clamp-2 mb-2">{{ Str::limit($project->description, 60) }}</p>
          </div>
          @empty
          <div class="col-span-full text-center py-20">
            <i class="ph ph-briefcase text-6xl text-slate-300 mb-4 block"></i>
            <h3 class="text-xl font-semibold text-slate-600">Belum ada proyek</h3>
            <p class="text-slate-500">Data proyek yang ditambahkan melalui panel admin akan muncul di sini.</p>
          </div>
          @endforelse
        </div>
        
        <div class="mt-12">
            {{ $projects->links() }}
        </div>
      </div>
    </main>
</x-layout>
