<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->string('vergi_no')->unique();
            $table->string('vergi_dairesi');
            $table->string('adres');
            $table->string('telefon');
            $table->string('eposta');
            $table->timestamp('kurulum_tarihi')->useCurrent();
            $table->boolean('aktif_mi')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
}; 