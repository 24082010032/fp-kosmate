@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16 bg-slate-50">
  <div class="mx-auto max-w-6xl px-6">
    
    <!-- Header -->
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between mb-10">
      <div>
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-600">Status Okupansi</p>
        <h1 class="mt-2 text-4xl font-bold text-slate-900">Monitoring Denah Kamar</h1>
        <p class="mt-2 text-slate-600">Pantau detail pengisian slot hunian kamar kos Anda secara real-time.</p>
      </div>
      <a href="{{ route('pemilik.dashboard') }}" class="rounded-3xl bg-slate-200 px-5 py-3 font-semibold text-slate-700 shadow-sm hover:bg-slate-300 transition text-sm">✕ Kembali ke Dashboard</a>
    </div>

    <!-- Informasi Ringkasan Sisa Kamar Kosong -->
    <div class="mb-8 rounded-3xl border border-amber-100 bg-amber-50 p-6 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
      <div>
        <h2 class="text-lg font-bold text-amber-900">Informasi Ketersediaan Unit</h2>
        <p class="text-sm text-amber-700 mt-1">Sistem membaca otomatis kapasitas kamar berdasarkan pembaruan data hunian.</p>
      </div>
      <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-amber-200 text-center">
        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Sisa Kamar Kosong</span>
        <span class="text-3xl font-black text-amber-600">{{ $sisaKosong }}</span>
        <span class="text-sm font-bold text-slate-500"> / dari {{ $totalKamar }} Total Kamar</span>
      </div>
    </div>

    <!-- Grid Denah Kamar -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($allKamars as $kamar)
        @php
          $isTerisi = strtolower($kamar->status) === 'terisi';
        @endphp
        
        <div class="rounded-3xl border p-6 bg-white transition shadow-sm {{ $isTerisi ? 'border-rose-100' : 'border-emerald-100' }}">
          
          <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
            <div>
              <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Tipe Kamar</span>
              <h3 class="text-xl font-bold text-slate-800 mt-0.5">{{ $kamar->tipe_kamar }}</h3>
            </div>
            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold border {{ $isTerisi ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-emerald-50 text-emerald-700 border-emerald-200' }}">
              ● {{ $kamar->status }}
            </span>
          </div>

          <div class="space-y-3">
            <div>
              <span class="text-xs font-semibold text-slate-400 block">Ditempati Oleh:</span>
              @if($isTerisi)
                <p class="text-base font-bold text-slate-800 mt-0.5">
                  👤 {{ $kamar->penghuni->name ?? 'Penghuni Aktif' }}
                </p>
                <p class="text-xs text-slate-400">Kontak: {{ $kamar->penghuni->no_hp ?? '-' }}</p>
              @else
                <p class="text-sm font-medium text-emerald-600 italic mt-0.5">
                  ✨ Kosong (Siap Menerima Penghuni)
                </p>
              @endif
            </div>

            <div class="pt-2 border-t border-slate-100 flex justify-between items-center text-xs text-slate-400">
              <span>Tarif Sewa:</span>
              <span class="font-bold text-slate-700 text-sm">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
            </div>
          </div>

        </div>
      @empty
        <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-slate-100 text-slate-400">
          <p class="text-lg font-bold">Belum Ada Data Kamar di Database</p>
        </div>
      @endforelse
    </div>

  </div>
</div>
@endsection