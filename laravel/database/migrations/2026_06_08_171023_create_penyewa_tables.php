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
        // Kita gunakan Schema::create jika belum ada, atau Schema::table untuk memastikan tidak bentrok
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->enum('role', ['pemilik', 'penghuni', 'calon_penyewa'])->default('calon_penyewa');
                $table->string('no_hp', 20)->nullable();
                $table->string('no_kamar', 50)->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jangan drop keras agar data cewek-cewek kosan yang tadi kita input tidak hilang lagi
    }
};