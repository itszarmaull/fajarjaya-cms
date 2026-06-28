<x-layout>
    <main class="min-h-screen pt-28 pb-20 bg-white">
      <div class="container mx-auto px-4 md:px-8 max-w-6xl">

        <!-- Breadcrumbs -->
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-8 font-medium">
          <a href="/" class="hover:text-brand-blue transition-colors">Beranda</a>
          <span>/</span>
          <a href="{{ route('projects') }}" class="hover:text-brand-blue transition-colors">Proyek</a>
          <span>/</span>
          <span class="text-brand-blue font-bold">{{ $project->title }}</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">

          <!-- Image Section -->
          <div class="w-full lg:w-1/2">
            <div class="rounded-3xl overflow-hidden bg-slate-100 relative aspect-[4/3] shadow-md border border-slate-100">
              @if($project->image)
                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover" />
              @else
                <div class="w-full h-full flex flex-col items-center justify-center gap-3">
                  <i class="ph ph-briefcase text-8xl text-slate-300"></i>
                  <span class="text-slate-400 text-sm">Foto tidak tersedia</span>
                </div>
              @endif

              <!-- Floating Category Badge -->
              @if($project->category)
              <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-bold text-brand-blue shadow-sm">
                {{ $project->category }}
              </div>
              @endif

              <!-- Floating Badges Bottom -->
              <div class="absolute bottom-6 left-6 flex gap-3">
                <div class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg shadow-sm border border-white/50 flex items-center gap-2">
                  <i class="ph-bold ph-check-circle text-brand-blue"></i>
                  <span class="text-sm font-bold text-slate-700">Proyek Selesai</span>
                </div>
                <div class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg shadow-sm border border-white/50 flex items-center gap-2">
                  <i class="ph-bold ph-star text-yellow-500"></i>
                  <span class="text-sm font-bold text-slate-700">Klien Puas</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Detail Section -->
          <div class="w-full lg:w-1/2 flex flex-col">

            @if($project->category)
            <div class="mb-4">
              <span class="inline-block px-3 py-1 bg-blue-50 text-brand-blue text-xs font-bold uppercase tracking-wider rounded-md">
                {{ $project->category }}
              </span>
            </div>
            @endif

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-4 leading-tight">{{ $project->title }}</h1>

            @if($project->client_name)
            <div class="flex items-center gap-2 mb-4 text-slate-500 text-sm">
              <i class="ph-bold ph-user-circle text-brand-blue text-lg"></i>
              <span>Klien: <strong class="text-slate-700">{{ $project->client_name }}</strong></span>
            </div>
            @endif

            @if($project->location)
            <div class="flex items-center gap-2 mb-4 text-slate-500 text-sm">
              <i class="ph-bold ph-map-pin text-brand-blue text-lg"></i>
              <span>Lokasi: <strong class="text-slate-700">{{ $project->location }}</strong></span>
            </div>
            @endif

            @if($project->year)
            <div class="flex items-center gap-2 mb-6 text-slate-500 text-sm">
              <i class="ph-bold ph-calendar text-brand-blue text-lg"></i>
              <span>Tahun: <strong class="text-slate-700">{{ $project->year }}</strong></span>
            </div>
            @endif

            <p class="text-slate-600 leading-relaxed text-lg mb-8">
              {{ $project->description }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 mb-10">
              <a href="https://wa.me/6285813556864?text=Halo,%20saya%20tertarik%20dengan%20proyek%20{{ urlencode($project->title) }},%20apakah%20bisa%20dikerjakan%20di%20tempat%20saya?" target="_blank" class="bg-brand-blue hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold text-center flex items-center justify-center gap-2 transition-all shadow-lg shadow-blue-500/20">
                <i class="ph-fill ph-whatsapp-logo text-xl"></i> Konsultasi Proyek Serupa
              </a>
              <a href="{{ route('projects') }}" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-8 py-3 rounded-xl font-bold text-center flex items-center justify-center gap-2 transition-all">
                <i class="ph-bold ph-arrow-left text-xl"></i> Lihat Proyek Lain
              </a>
            </div>

          </div>
        </div>

        <!-- Related Projects -->
        @if(isset($relatedProjects) && $relatedProjects->count() > 0)
        <div class="mt-24">
          <h2 class="text-2xl font-bold text-slate-900 mb-8">Proyek Serupa</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relatedProjects as $related)
            <a href="{{ route('project.detail', $related->slug) }}" class="group border border-slate-200 rounded-2xl p-4 bg-white hover:shadow-xl transition-all duration-300 block">
              <div class="h-48 rounded-xl overflow-hidden mb-4 relative bg-slate-100 flex items-center justify-center">
                @if($related->image)
                  <img src="{{ Storage::url($related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                @else
                  <i class="ph ph-briefcase text-5xl text-slate-300"></i>
                @endif
              </div>
              <h3 class="text-lg font-bold text-slate-900 mb-1 group-hover:text-brand-blue transition-colors">{{ $related->title }}</h3>
              <p class="text-slate-500 text-sm line-clamp-2">{{ Str::limit($related->description, 80) }}</p>
            </a>
            @endforeach
          </div>
        </div>
        @endif

      </div>
    </main>
</x-layout>
