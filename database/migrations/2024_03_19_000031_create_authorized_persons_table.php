<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authorized_persons', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->string('unvan');
            $table->string('telefon');
            $table->string('eposta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authorized_persons');
    }
}; 