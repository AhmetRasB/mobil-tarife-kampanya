<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fax_logs', function (Blueprint $table) {
            $table->id();
            $table->string('gonderen');
            $table->string('alici');
            $table->string('dosya_yolu');
            $table->timestamp('gonderim_tarihi')->useCurrent();
            $table->string('durum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fax_logs');
    }
}; 