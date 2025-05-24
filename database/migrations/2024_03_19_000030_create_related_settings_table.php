<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('related_settings', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->string('deger');
            $table->string('aciklama')->nullable();
            $table->timestamp('guncelleme_tarihi')->useCurrent();
            $table->boolean('aktif_mi')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('related_settings');
    }
}; 