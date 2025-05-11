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
        Schema::create('teklifs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tarife_id')->constrained('tarifeler')->onDelete('cascade');
            $table->foreignId('kampanya_id')->nullable()->constrained('kampanyalar')->onDelete('set null');
            $table->string('ad_soyad');
            $table->string('telefon');
            $table->string('email');
            $table->string('adres')->nullable();
            $table->text('notlar')->nullable();
            $table->enum('durum', ['beklemede', 'onaylandi', 'reddedildi'])->default('beklemede');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teklifs');
    }
};
