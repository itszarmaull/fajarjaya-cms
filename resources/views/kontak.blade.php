<x-layout>
@php
    $settings = \App\Models\Setting::first();
@endphp
    <main class="min-h-screen pt-28 pb-20">
      @php
          $bannerUrl = $settings && $settings->banner_kontak ? Storage::url($settings->banner_kontak) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop';
      @endphp
      <div class="container mx-auto px-4 md:px-8 mb-12">
        <div class="relative rounded-3xl overflow-hidden h-64 md:h-80 bg-slate-900">
          <img src="{{ $bannerUrl }}" alt="Banner Halaman Kontak" class="absolute inset-0 w-full h-full object-cover brightness-[0.35]">
          <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 via-slate-900/85 to-slate-950"></div>
          <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6">
            <span class="text-blue-400 font-bold tracking-wider text-sm uppercase mb-2">Kontak</span>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">Hubungi Kami</h1>
          </div>
        </div>
      </div>

      <div class="container mx-auto px-4 md:px-8 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            
            <!-- Contact Info -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Mari Berdiskusi Tentang Proyek Anda!</h2>
                    <p class="text-slate-600 text-lg">Jangan ragu untuk menghubungi tim ahli kami. Kami siap memberikan konsultasi gratis dan penawaran terbaik untuk kebutuhan aluminium & kaca Anda.</p>
                </div>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-brand-blue flex items-center justify-center shrink-0">
                            <i class="ph-bold ph-phone text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 mb-1">WhatsApp / Telepon</h3>
                            <p class="text-slate-600">{{ $settings->company_whatsapp ?? '0858-1355-6864' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-brand-blue flex items-center justify-center shrink-0">
                            <i class="ph-bold ph-envelope text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 mb-1">Email</h3>
                            <p class="text-slate-600">{{ $settings->company_email ?? 'info@fajarjaya.com' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-brand-blue flex items-center justify-center shrink-0">
                            <i class="ph-bold ph-map-pin text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 mb-1">Lokasi Workshop</h3>
                            <p class="text-slate-600">{{ $settings->company_address ?? 'Tangerang Selatan, Banten' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-slate-100">
                <h3 class="text-2xl font-bold text-slate-900 mb-6">Kirim Pesan Langsung</h3>
                
                @if(session('success'))
                    <div class="p-4 mb-6 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap *</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue transition bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">No. WhatsApp / Email *</label>
                        <input type="text" name="contact_info" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue transition bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Subjek / Topik *</label>
                        <input type="text" name="subject" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue transition bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Isi Pesan *</label>
                        <textarea name="message" rows="4" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue transition bg-slate-50"></textarea>
                    </div>

                    @error('captcha')
                        <div class="p-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="cf-turnstile my-2" data-sitekey="{{ config('services.turnstile.key') }}" data-theme="light"></div>

                    <button type="submit" class="w-full py-4 bg-brand-blue text-white rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                        Kirim Pesan Sekarang
                    </button>
                </form>
            </div>

        </div>
      </div>
    </main>
</x-layout>
