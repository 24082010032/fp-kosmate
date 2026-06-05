<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe_kamar', ['Reguler', 'Deluxe', 'VIP']);
            $table->integer('harga');
            $table->enum('status', ['Tersedia', 'Terisi'])->default('Tersedia');
            $table->text('fasilitas')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
