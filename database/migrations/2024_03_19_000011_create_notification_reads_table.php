<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bildirim_id')->constrained('notifications')->onDelete('cascade');
            $table->foreignId('kullanici_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('okunma_tarihi')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_reads');
    }
}; 