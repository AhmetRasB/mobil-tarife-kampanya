<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bildirim_id')->constrained('notifications')->onDelete('cascade');
            $table->foreignId('atanan_kullanici_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('atayan_kullanici_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('atanma_tarihi')->useCurrent();
            $table->boolean('durum')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_assignments');
    }
}; 