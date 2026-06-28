<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('hero_images')->nullable();
            $table->string('banner_produk')->nullable();
            $table->string('banner_proyek')->nullable();
            $table->string('banner_tentang')->nullable();
            $table->string('banner_blog')->nullable();
            $table->string('banner_kontak')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_images',
                'banner_produk',
                'banner_proyek',
                'banner_tentang',
                'banner_blog',
                'banner_kontak'
            ]);
        });
    }
};
