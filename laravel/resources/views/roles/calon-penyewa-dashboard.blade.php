@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top left, rgba(59,130,246,0.08), transparent 35%), radial-gradient(circle at bottom right, rgba(16,185,129,0.08), transparent 30%);">
  <div class="mx-auto max-w-4xl px-6">
    
    {{-- Header Dashboard --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Halo, {{ auth()->user()->name }}!</h1>
        <p class="text-slate-600 mt-2">Selamat datang di dashboard calon penyewa.</p>
    </div>

    {{-- Status Tracking Card --}}
    <div class="bg-white/95 rounded-4xl p-8 shadow-2xl shadow-blue-200/20 border border-white/80">
        <h2 class="text-xl font-bold text-slate-800">Status Pengajuan Anda</h2>
        
        <div class="mt-6">
            @if(auth()->user()->role === 'penghuni')
                <div class="p-5 bg-emerald-50 text-emerald-800 rounded-2xl border border-emerald-200 flex items-center gap-3">
                    <span class="text-2xl">✓</span>
                    <div>
                        <p class="font-bold">Status: Diterima</p>
                        <p class="text-sm">Selamat! Pengajuan Anda telah disetujui. Anda sekarang adalah penghuni resmi.</p>
                    </div>
                </div>
            @elseif(auth()->user()->no_kamar)
                <div class="p-5 bg-amber-50 text-amber-800 rounded-2xl border border-amber-200 flex items-center gap-3">
                    <span class="text-2xl">⏳</span>
                    <div>
                        <p class="font-bold">Status: Menunggu Konfirmasi</p>
                        <p class="text-sm">Pengajuan Anda untuk <strong>Kamar {{ auth()->user()->no_kamar }}</strong> sedang diproses. Mohon menunggu pemilik menyetujui data Anda.</p>
                    </div>
                </div>
            @else
                <div class="p-5 bg-slate-50 text-slate-600 rounded-2xl border border-slate-200">
                    <p>Anda belum memilih kamar saat ini.</p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('calon-penyewa.katalog') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">
                        Lihat Katalog Kamar
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Info Tambahan --}}
    <div class="mt-8 text-center text-sm text-slate-400">
        <p>Jika ada kendala, silakan hubungi pemilik kos melalui kontak yang tersedia.</p>
    </div>
  </div>
</div>
@endsection