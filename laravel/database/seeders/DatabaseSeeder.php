<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kamar;
use App\Models\Komplain;
use App\Models\Tagihan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Users (Teks polos aja Din, otomatis di-hash sama Model User.php)
        $pemilik = User::create([
            'name' => 'Pemilik Kos',
            'email' => 'pemilikkos@gmail.com',
            'password' => '12345',
            'role' => 'pemilik',
            'no_hp' => '081234567890',
        ]);

        $reva = User::create([
            'name' => 'Reva Ruvaida',
            'email' => 'reva@gmail.com',
            'password' => '12345',
            'role' => 'penghuni',
            'no_hp' => '081234567891',
            'no_kamar' => 'VIP-01',
        ]);

        $hwasa = User::create([
            'name' => 'Hwasa',
            'email' => 'hwasa@gmail.com',
            'password' => '12345',
            'role' => 'penghuni',
            'no_hp' => '087363873688',
            'no_kamar' => 'Regular-01',
        ]);

        $lalisa = User::create([
            'name' => 'Lalisa Manoban',
            'email' => 'lalisa@gmail.com',
            'password' => '12345',
            'role' => 'calon_penyewa',
            'no_hp' => '081234567892',
        ]);

        // Buat Kamars
        Kamar::create([
            'tipe_kamar' => 'Reguler',
            'harga' => 1200000,
            'status' => 'Terisi',
            'fasilitas' => 'Kamar mandi dalam, Kasur, Lemari, Kipas Angin, WiFi',
            'foto' => 'reguler.jpg',
        ]);

        Kamar::create([
            'tipe_kamar' => 'Deluxe',
            'harga' => 1500000,
            'status' => 'Tersedia',
            'fasilitas' => 'Kamar mandi dalam, AC, Kasur, Lemari, Meja Kerja, WiFi',
            'foto' => 'deluxe.jpg',
        ]);

        Kamar::create([
            'tipe_kamar' => 'VIP',
            'harga' => 2000000,
            'status' => 'Terisi',
            'fasilitas' => 'Kamar mandi dalam (Water Heater), AC, Smart TV, Kulkas Mini, Balkon',
            'foto' => 'vip.jpg',
        ]);

        // Buat Komplain
        Komplain::create([
            'user_id' => $reva->id,
            'isi_komplain' => 'AC di kamar VIP-01 kurang dingin, tolong panggilkan tukang service lewat pemilik kos.',
            'status' => 'Pending',
        ]);

        // Buat Tagihan
        Tagihan::create([
            'user_id' => $reva->id,
            'total_tagihan' => 2000000,
            'status' => 'Belum Bayar',
        ]);
    }
}