<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monitor_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['up', 'down'])->index();
            $table->string('monitor_name')->default('Website Utama');
            $table->string('monitor_url')->default('https://www.fajarjaya.my.id');
            $table->integer('response_time')->nullable()->comment('Response time in ms');
            $table->text('alert_details')->nullable();
            $table->boolean('notified_telegram')->default(false);
            $table->string('source')->default('cloudflare-worker')->comment('uptimerobot | cloudflare-worker | manual');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitor_logs');
    }
};
