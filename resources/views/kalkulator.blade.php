<x-layout>
    @php
        $settings = \App\Models\Setting::first();
        $whatsappNumber = $settings->company_whatsapp ?? '6285813556864';
        $companyName = $settings->company_name ?? 'Fajar Jaya';
    @endphp

    <!-- Hero Section -->
    <section class="relative bg-slate-900 pt-36 pb-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop" alt="Hero Background" class="w-full h-full object-cover brightness-[0.2]">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 via-slate-900/90 to-slate-950"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 md:px-8 text-center text-white">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6 text-sm font-medium tracking-wide text-blue-300">
                <i class="ph-bold ph-calculator text-lg"></i>
                Kalkulator Estimasi Instan
            </span>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight">Hitung Estimasi Biaya Anda</h1>
            <p class="text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Dapatkan perkiraan biaya untuk kusen, kaca, pintu, atau jendela aluminium Anda secara transparan. Sesuaikan dengan dimensi dan spesifikasi yang Anda butuhkan.
            </p>
        </div>
    </section>

    <!-- Calculator Section -->
    <section class="py-16 bg-slate-950 text-slate-100 min-h-screen relative z-10 -mt-10" 
             x-data="calculator">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-6xl mx-auto bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
                <div class="grid grid-cols-1 lg:grid-cols-12">
                    
                    <!-- Left Column: Inputs -->
                    <div class="lg:col-span-7 p-6 md:p-10 border-b lg:border-b-0 lg:border-r border-slate-800">
                        <!-- Custom Tab Navigation -->
                        <div class="flex flex-wrap gap-2 p-1 bg-slate-950/80 rounded-2xl mb-8 border border-slate-800">
                            <button @click="activeTab = 'kusen'" 
                                    :class="activeTab === 'kusen' ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400 hover:text-slate-200'"
                                    class="flex-1 py-3 px-4 rounded-xl font-semibold transition text-sm flex items-center justify-center gap-2">
                                <i class="ph-bold ph-frame-corners text-lg"></i>
                                Kusen Aluminium
                            </button>
                            <button @click="activeTab = 'kaca'" 
                                    :class="activeTab === 'kaca' ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400 hover:text-slate-200'"
                                    class="flex-1 py-3 px-4 rounded-xl font-semibold transition text-sm flex items-center justify-center gap-2">
                                <i class="ph-bold ph-square text-lg"></i>
                                Pemasangan Kaca
                            </button>
                            <button @click="activeTab = 'unit'" 
                                    :class="activeTab === 'unit' ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400 hover:text-slate-200'"
                                    class="flex-1 py-3 px-4 rounded-xl font-semibold transition text-sm flex items-center justify-center gap-2">
                                <i class="ph-bold ph-door text-lg"></i>
                                Pintu & Jendela
                            </button>
                        </div>

                        <!-- Tab 1: Kusen Aluminium -->
                        <div x-show="activeTab === 'kusen'" x-transition:enter="transition ease-out duration-300" class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Pilih Merk & Spesifikasi Profil</label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <template x-for="brandData in kusenBrands" :key="brandData.id">
                                        <div @click="kusenBrand = brandData.id" 
                                             :class="kusenBrand === brandData.id ? 'border-blue-500 bg-blue-500/10' : 'border-slate-800 bg-slate-950/40 hover:border-slate-700'"
                                             class="border-2 rounded-2xl p-4 cursor-pointer transition text-center flex flex-col justify-between">
                                            <span class="font-bold text-slate-100 block text-sm" x-text="brandData.name"></span>
                                            <span class="text-xs text-blue-400 font-medium mt-2" x-text="formatCurrency(brandData.price) + ' / m'"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2 flex justify-between">
                                    <span>Panjang Kusen (Total Meter Lari)</span>
                                    <span class="text-blue-400 font-bold" x-text="kusenLength + ' Meter'"></span>
                                </label>
                                <input type="range" min="1" max="100" x-model="kusenLength" 
                                       class="w-full h-2 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-blue-600">
                                <div class="flex justify-between text-xs text-slate-500 mt-1">
                                    <span>1m</span>
                                    <span>50m</span>
                                    <span>100m</span>
                                </div>
                                <div class="mt-3">
                                    <input type="number" min="1" x-model.number="kusenLength" 
                                           class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 focus:outline-none focus:border-blue-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Pilihan Warna Finishing</label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <template x-for="colorData in kusenColors" :key="colorData.id">
                                        <button @click="kusenColor = colorData.id" 
                                                :class="kusenColor === colorData.id ? 'border-blue-500 bg-blue-500/10' : 'border-slate-800 bg-slate-950/40 hover:border-slate-700'"
                                                class="border-2 rounded-xl py-3 text-sm font-medium transition flex flex-col items-center justify-center">
                                            <span x-text="colorData.name"></span>
                                            <span class="text-[10px] text-blue-400 font-semibold" 
                                                  x-show="parseFloat(colorData.price) > 0"
                                                  x-text="'+' + formatCurrency(colorData.price) + ' / m'"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: Pemasangan Kaca -->
                        <div x-show="activeTab === 'kaca'" x-transition:enter="transition ease-out duration-300" class="space-y-6" style="display: none;">
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Pilih Tipe Kaca</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <template x-for="kacaData in kacaTypes" :key="kacaData.id">
                                        <div @click="kacaType = kacaData.id" 
                                             :class="kacaType === kacaData.id ? 'border-blue-500 bg-blue-500/10' : 'border-slate-800 bg-slate-950/40 hover:border-slate-700'"
                                             class="border-2 rounded-2xl p-4 cursor-pointer transition flex flex-col justify-between">
                                            <span class="font-bold text-slate-100 block text-sm" x-text="kacaData.name"></span>
                                            <span class="text-xs text-blue-400 font-medium mt-2" x-text="formatCurrency(kacaData.price) + ' / m²'"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-300 mb-2">Lebar Bidang (Meter)</label>
                                    <input type="number" step="0.1" min="0.1" x-model.number="kacaWidth" 
                                           class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 focus:outline-none focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-300 mb-2">Tinggi Bidang (Meter)</label>
                                    <input type="number" step="0.1" min="0.1" x-model.number="kacaHeight" 
                                           class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 focus:outline-none focus:border-blue-500">
                                </div>
                            </div>

                            <div class="p-4 bg-slate-950/60 rounded-2xl border border-slate-800 flex justify-between items-center">
                                <span class="text-sm text-slate-400">Total Luas Kaca:</span>
                                <span class="font-bold text-slate-200" x-text="(parseFloat(kacaWidth || 0) * parseFloat(kacaHeight || 0)).toFixed(2) + ' m²'"></span>
                            </div>
                        </div>

                        <!-- Tab 3: Pintu & Jendela -->
                        <div x-show="activeTab === 'unit'" x-transition:enter="transition ease-out duration-300" class="space-y-6" style="display: none;">
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Pilih Jenis Unit</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <template x-for="unitData in unitTypes" :key="unitData.id">
                                        <div @click="unitType = unitData.id" 
                                             :class="unitType === unitData.id ? 'border-blue-500 bg-blue-500/10' : 'border-slate-800 bg-slate-950/40 hover:border-slate-700'"
                                             class="border-2 rounded-2xl p-4 cursor-pointer transition flex flex-col justify-between">
                                            <span class="font-bold text-slate-100 block text-sm" x-text="unitData.name"></span>
                                            <span class="text-xs text-blue-400 font-medium mt-2" x-text="formatCurrency(unitData.price) + ' / unit'"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Jumlah Unit (Pcs)</label>
                                <input type="number" min="1" x-model.number="unitQuantity" 
                                       class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 focus:outline-none focus:border-blue-500">
                            </div>
                        </div>

                        <!-- Installation Checkbox -->
                        <div class="mt-8 pt-8 border-t border-slate-800">
                            <label class="flex items-start gap-3 cursor-pointer group">
                                <input type="checkbox" x-model="includeInstallation" 
                                       class="mt-1 w-5 h-5 rounded border-slate-800 bg-slate-950 text-blue-600 focus:ring-blue-500/30">
                                <div>
                                    <span class="font-semibold text-slate-200 group-hover:text-slate-100 transition block">Sertakan Jasa Pasang & Aksesoris (+15%)</span>
                                    <span class="text-xs text-slate-500 block mt-0.5">Sudah termasuk engsel, kunci, sealant, karet peredam, dan pemasangan rapi di lokasi oleh teknisi kami.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Right Column: Live Summary -->
                    <div class="lg:col-span-5 p-6 md:p-10 bg-slate-950/40 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-200 mb-6 flex items-center gap-2">
                                <i class="ph-bold ph-receipt text-blue-400 text-xl"></i>
                                Ringkasan Estimasi
                            </h3>

                            <div class="space-y-4 text-sm mb-8">
                                <!-- Dynamic items based on tab -->
                                <div x-show="activeTab === 'kusen'" class="space-y-3">
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Pekerjaan:</span>
                                        <span class="font-semibold text-slate-200">Kusen Aluminium</span>
                                    </div>
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Merk Profil:</span>
                                        <span class="font-semibold text-slate-200" x-text="kusenBrands.find(b => b.id === kusenBrand)?.name || ''"></span>
                                    </div>
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Panjang Total:</span>
                                        <span class="font-semibold text-slate-200" x-text="kusenLength + ' meter'"></span>
                                    </div>
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Warna Finishing:</span>
                                        <span class="font-semibold text-slate-200 text-capitalize" x-text="kusenColors.find(c => c.id === kusenColor)?.name || ''"></span>
                                    </div>
                                </div>

                                <div x-show="activeTab === 'kaca'" class="space-y-3" style="display: none;">
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Pekerjaan:</span>
                                        <span class="font-semibold text-slate-200">Pemasangan Kaca</span>
                                    </div>
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Tipe Kaca:</span>
                                        <span class="font-semibold text-slate-200" x-text="kacaTypes.find(k => k.id === kacaType)?.name || ''"></span>
                                    </div>
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Dimensi Bidang:</span>
                                        <span class="font-semibold text-slate-200" x-text="kacaWidth + 'm x ' + kacaHeight + 'm'"></span>
                                    </div>
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Total Luas:</span>
                                        <span class="font-semibold text-slate-200" x-text="(kacaWidth * kacaHeight).toFixed(2) + ' m²'"></span>
                                    </div>
                                </div>

                                <div x-show="activeTab === 'unit'" class="space-y-3" style="display: none;">
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Pekerjaan:</span>
                                        <span class="font-semibold text-slate-200">Katalog Unit</span>
                                    </div>
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Tipe Unit:</span>
                                        <span class="font-semibold text-slate-200" x-text="unitTypes.find(u => u.id === unitType)?.name || ''"></span>
                                    </div>
                                    <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                        <span class="text-slate-400">Jumlah:</span>
                                        <span class="font-semibold text-slate-200" x-text="unitQuantity + ' unit'"></span>
                                    </div>
                                </div>

                                <div class="flex justify-between border-b border-slate-800/60 pb-2">
                                    <span class="text-slate-400">Jasa Pasang:</span>
                                    <span class="font-semibold text-slate-200" x-text="includeInstallation ? 'Termasuk (+15%)' : 'Tidak Termasuk'"></span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="bg-slate-950 p-6 rounded-2xl border border-slate-800/80 mb-6">
                                <span class="text-slate-500 text-xs font-semibold uppercase tracking-wider block mb-1">Total Estimasi Biaya</span>
                                <span class="text-3xl font-extrabold text-blue-400 block" x-text="formatCurrency(getTotal())"></span>
                                <span class="text-[10px] text-slate-500 block mt-2">*Harga estimasi kotor, penawaran resmi dapat berubah setelah survey lokasi.</span>
                            </div>

                            <button @click="sendToWhatsApp('{{ $whatsappNumber }}')" 
                                    class="w-full flex items-center justify-center gap-2 bg-[#25D366] text-white py-4 rounded-xl font-bold hover:bg-green-600 transition shadow-lg shadow-green-500/10 hover:-translate-y-0.5">
                                <i class="ph-fill ph-whatsapp-logo text-2xl"></i>
                                Kirim Rincian ke WhatsApp
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Disclaimer / Info Section -->
    <section class="py-16 bg-slate-950 text-slate-400 border-t border-slate-900">
        <div class="container mx-auto px-4 md:px-8 max-w-4xl">
            <h3 class="text-slate-200 font-bold text-lg mb-4 flex items-center gap-2"><i class="ph-bold ph-info text-blue-500 text-xl"></i> Informasi Penting</h3>
            <ul class="space-y-3 text-sm leading-relaxed">
                <li>1. Survey Lokasi Gratis: Untuk area Tangerang Selatan, BSD, Bintaro, dan Serpong, kami menyediakan jasa survey pengukuran lokasi secara cuma-cuma sebelum pembuatan penawaran resmi.</li>
                <li>2. Kustomisasi: Jika Anda memiliki gambar kerja/spesifikasi khusus dari arsitek, silakan langsung mengirimkannya ke WhatsApp kami untuk perhitungan manual yang presisi.</li>
                <li>3. Garansi Kebocoran : Setiap pemasangan pintu, jendela, dan fasad kaca oleh tim Fajar Jaya dilengkapi garansi kebocoran karet & sealant selama 3 bulan.</li>
            </ul>
        </div>
    </section>

    <script>
        const registerCalculator = () => {
            if (window.Alpine && !window.registeredCalculator) {
                window.registeredCalculator = true;
                Alpine.data('calculator', () => ({
                    activeTab: 'kusen',
                    
                    // Kusen state
                    kusenBrand: null,
                    kusenLength: 10,
                    kusenColor: null,
                    kusenBrands: @json($kusenBrands),
                    kusenColors: @json($kusenColors),
                    
                    // Kaca state
                    kacaType: null,
                    kacaWidth: 2,
                    kacaHeight: 1.5,
                    kacaTypes: @json($kacaTypes),

                    // Pintu/Jendela state
                    unitType: null,
                    unitQuantity: 2,
                    unitTypes: @json($unitTypes),

                    // Installation fee toggle
                    includeInstallation: true,

                    init() {
                        // Set default selected values from loaded arrays
                        if (this.kusenBrands.length > 0) this.kusenBrand = this.kusenBrands[0].id;
                        if (this.kusenColors.length > 0) this.kusenColor = this.kusenColors[0].id;
                        if (this.kacaTypes.length > 0) this.kacaType = this.kacaTypes[0].id;
                        if (this.unitTypes.length > 0) this.unitType = this.unitTypes[0].id;
                    },

                    calculateKusen() {
                        let selectedBrand = this.kusenBrands.find(b => b.id === this.kusenBrand);
                        let brandPrice = selectedBrand ? parseFloat(selectedBrand.price) : 0;
                        
                        let selectedColor = this.kusenColors.find(c => c.id === this.kusenColor);
                        let colorPremium = selectedColor ? parseFloat(selectedColor.price) : 0;
                        
                        return (brandPrice + colorPremium) * parseFloat(this.kusenLength || 0);
                    },

                    calculateKaca() {
                        let selectedKaca = this.kacaTypes.find(k => k.id === this.kacaType);
                        let typePrice = selectedKaca ? parseFloat(selectedKaca.price) : 0;
                        let area = parseFloat(this.kacaWidth || 0) * parseFloat(this.kacaHeight || 0);
                        return typePrice * area;
                    },

                    calculateUnit() {
                        let selectedUnit = this.unitTypes.find(u => u.id === this.unitType);
                        let typePrice = selectedUnit ? parseFloat(selectedUnit.price) : 0;
                        return typePrice * parseInt(this.unitQuantity || 0);
                    },

                    getTotal() {
                        let subtotal = 0;
                        if (this.activeTab === 'kusen') subtotal = this.calculateKusen();
                        else if (this.activeTab === 'kaca') subtotal = this.calculateKaca();
                        else if (this.activeTab === 'unit') subtotal = this.calculateUnit();
                        
                        if (this.includeInstallation) {
                            subtotal += subtotal * 0.15; // 15% installation and accessories
                        }
                        return Math.round(subtotal);
                    },

                    formatCurrency(val) {
                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
                    },

                    sendToWhatsApp(companyWhatsapp) {
                        let text = 'Halo {{ $companyName }}, saya ingin berkonsultasi tentang estimasi biaya pemesanan:\n\n';
                        if (this.activeTab === 'kusen') {
                            let brand = this.kusenBrands.find(b => b.id === this.kusenBrand)?.name || '';
                            let color = this.kusenColors.find(c => c.id === this.kusenColor)?.name || '';
                            text += `Jenis: Pasang Kusen Aluminium\n`;
                            text += `Merk/Tipe: ${brand}\n`;
                            text += `Panjang: ${this.kusenLength} meter\n`;
                            text += `Pilihan Warna: ${color.toUpperCase()}\n`;
                        } else if (this.activeTab === 'kaca') {
                            let type = this.kacaTypes.find(k => k.id === this.kacaType)?.name || '';
                            text += `Jenis: Pemasangan Kaca\n`;
                            text += `Tipe Kaca: ${type}\n`;
                            text += `Dimensi: ${this.kacaWidth}m x ${this.kacaHeight}m (Luas: ${(this.kacaWidth * this.kacaHeight).toFixed(2)} m²)\n`;
                        } else if (this.activeTab === 'unit') {
                            let type = this.unitTypes.find(u => u.id === this.unitType)?.name || '';
                            text += `Jenis: Pembuatan Pintu/Jendela\n`;
                            text += `Tipe Unit: ${type}\n`;
                            text += `Jumlah: ${this.unitQuantity} unit\n`;
                        }

                        text += `Termasuk Jasa Pasang & Aksesoris: ${this.includeInstallation ? 'Ya (Estimasi +15%)' : 'Tidak (Material Saja)'}\n`;
                        text += `Total Estimasi Biaya: ${this.formatCurrency(this.getTotal())}\n\n`;
                        text += `Apakah bisa dibantu untuk survey lokasi dan pembuatan penawaran resmi? Terima kasih.`;

                        let url = `https://wa.me/${companyWhatsapp}?text=${encodeURIComponent(text)}`;
                        window.open(url, '_blank');
                    }
                }));
            }
        };

        if (window.Alpine) {
            registerCalculator();
        } else {
            document.addEventListener('alpine:init', registerCalculator);
        }
    </script>
</x-layout>
