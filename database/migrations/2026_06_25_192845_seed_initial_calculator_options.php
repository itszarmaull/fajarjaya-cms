<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        \App\Models\CalculatorOption::insert([
            // Kusen Brands
            ['type' => 'kusen', 'name' => 'Alexindo 3 Inch', 'price' => 95000, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'kusen', 'name' => 'YKK AP 3 Inch', 'price' => 180000, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'kusen', 'name' => 'Inkalum 3 Inch', 'price' => 75000, 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            
            // Finishing Colors (Warna)
            ['type' => 'warna', 'name' => 'Silver / Mill', 'price' => 0, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'warna', 'name' => 'Hitam / Coklat', 'price' => 15000, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'warna', 'name' => 'Serat Kayu', 'price' => 35000, 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            
            // Kaca Types
            ['type' => 'kaca', 'name' => 'Kaca Polos 5mm', 'price' => 165000, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'kaca', 'name' => 'Kaca Panasap (Rayban) 5mm', 'price' => 195000, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'kaca', 'name' => 'Kaca Tempered 8mm', 'price' => 650000, 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'kaca', 'name' => 'Kaca Tempered 10mm', 'price' => 850000, 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
            
            // Unit Types
            ['type' => 'unit', 'name' => 'Jendela Casement Aluminium', 'price' => 850000, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'unit', 'name' => 'Pintu Swing Aluminium Standard', 'price' => 2200000, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'unit', 'name' => 'Pintu Geser (Sliding) Aluminium', 'price' => 2500000, 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'unit', 'name' => 'Pintu Lipat (Folding) per daun', 'price' => 3000000, 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\CalculatorOption::truncate();
    }
};
