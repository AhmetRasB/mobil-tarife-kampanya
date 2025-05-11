<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logout_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kullanici_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('cikis_tarihi')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logout_logs');
    }
}; 