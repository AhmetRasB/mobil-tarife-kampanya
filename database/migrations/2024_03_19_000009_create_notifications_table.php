<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->text('detay');
            $table->integer('gecikme_suresi')->nullable();
            $table->timestamp('olusturma_tarihi')->useCurrent();
            $table->boolean('aktif_mi')->default(true);
            $table->foreignId('bildirim_turu_id')->constrained('notification_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
}; 