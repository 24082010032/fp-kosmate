@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    <div class="bg-white rounded-3xl shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        
        <!-- Header Kamar -->
        <div class="bg-slate-50 p-8 border-b border-slate-100">
            <h1 class="text-4xl font-extrabold text-slate-800">Kamar {{ $kamar->tipe_kamar }}</h1>
            <p class="text-emerald-600 font-semibold mt-2 text-lg">Status: {{ $kamar->status }}</p>
        </div>

        <!-- Konten Detail -->
        <div class="p-8 space-y-6">
            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-slate-400">Harga</h3>
                <p class="text-3xl font-bold text-slate-900 mt-1">Rp{{ number_format($kamar->harga, 0, ',', '.') }} <span class="text-sm text-slate-500 font-normal">/ bulan</span></p>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-slate-400">Fasilitas Lengkap</h3>
                <div class="mt-3 p-4 bg-slate-50 rounded-2xl border border-slate-100 text-slate-700 leading-relaxed">
                    {{ $kamar->fasilitas ?? 'Tidak ada fasilitas tambahan yang dicantumkan.' }}
                </div>
            </div>
        </div>

        <!-- Footer Tombol -->
        <div class="p-8 bg-slate-50 flex items-center justify-between border-t border-slate-100">
            <a href="{{ route('calon-penyewa.katalog') }}" class="text-slate-500 hover:text-slate-800 font-semibold transition">
                &larr; Kembali ke Katalog
            </a>
            
            <form action="{{ route('calon-penyewa.booking', $kamar->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl font-bold shadow-lg shadow-blue-500/30 transition transform hover:scale-105">
                    Booking Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection