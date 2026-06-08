@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top, rgba(245,158,11,0.12), transparent 35%), radial-gradient(circle at bottom right, rgba(236,72,153,0.10), transparent 30%);">
  <div class="mx-auto max-w-6xl px-6">
    <div class="rounded-4xl border border-white/80 bg-white/95 p-8 shadow-2xl shadow-amber-200/20">
      
      {{-- HEADER DASHBOARD --}}
      <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-600">Pemilik Kos</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Dashboard Pemilik</h1>
          <p class="mt-3 text-slate-600">Kelola kamar, daftar penghuni, dan pantau operasional kos secara lengkap.</p>
        </div>
      </div>

      {{-- CARD STATISTIK DINAMIS --}}
      <div class="mt-10 grid gap-6 xl:grid-cols-3">
        
        {{-- Card 1: Kamar Tersedia --}}
        <a href="{{ route('pemilik.kamar.monitoring') }}" class="group block bg-white p-6 rounded-3xl border border-slate-200 shadow-sm transition-all duration-300 hover:border-amber-300 hover:bg-amber-50/20 hover:shadow-md text-left">
            <p class="text-sm font-semibold uppercase tracking-wider text-slate-400 group-hover:text-amber-600 transition">KAMAR TERSEDIA</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $kamarTersedia }}</p>
            <p class="mt-2 text-sm text-slate-600">
                Lihat denah pemantauan sisa kapasitas kamar. <span class="text-amber-600 font-medium inline-block transition-transform group-hover:translate-x-1">→</span>
            </p>
        </a>

        {{-- Card 2: Penghuni Aktif --}}
        <a href="{{ route('pemilik.users.penghuni') }}" class="group block bg-white p-6 rounded-3xl border border-slate-200 shadow-sm transition-all duration-300 hover:border-emerald-300 hover:bg-emerald-50/20 hover:shadow-md text-left">
          <p class="text-sm font-semibold uppercase tracking-wider text-slate-400 group-hover:text-emerald-600 transition">Penghuni Aktif</p>
          <h2 class="mt-2 text-3xl font-bold text-slate-900 group-hover:text-emerald-700 transition">{{ $penghuniAktif }}</h2>
          <p class="mt-2 text-sm text-slate-600">Lihat penghuni aktif dan tagihan yang berjalan. <span class="text-emerald-600 font-medium inline-block transition-transform group-hover:translate-x-1">→</span></p>
        </a>

        {{-- Card 3: Komplain Baru --}}
        <a href="{{ route('pemilik.komplains.index') }}" class="group block bg-white p-6 rounded-3xl border border-slate-200 shadow-sm transition-all duration-300 hover:border-rose-300 hover:bg-rose-50/20 hover:shadow-md text-left">
          <p class="text-sm font-semibold uppercase tracking-wider text-slate-400 group-hover:text-rose-600 transition">Komplain</p>
          <h2 class="mt-2 text-3xl font-bold text-slate-900 group-hover:text-rose-700 transition">{{ $komplainBaru }}</h2>
          <p class="mt-2 text-sm text-slate-600">Tindak lanjuti komplain agar penghuni tetap nyaman. <span class="text-rose-600 font-medium inline-block transition-transform group-hover:translate-x-1">→</span></p>
        </a>

      </div>

      {{-- SEKSYEN BARU: PANEL KEUANGAN INTERAKTIF --}}
      <div class="mt-6 rounded-3xl border border-indigo-100 bg-gradient-to-r from-indigo-50/40 via-purple-50/20 to-white p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-indigo-600">Manajemen Finansial & Pembukuan</p>
            <h3 class="mt-1 text-xl font-bold text-slate-900">Rekapitulasi Keuangan Kos</h3>
            <p class="text-sm text-slate-600 mt-0.5">Analisis tren omzet masuk dan cetak dokumen laporan fisik operasional hunian.</p>
          </div>
          <div class="flex flex-wrap gap-3">
            {{-- Tombol Lihat Grafik --}}
            <a href="{{ route('pemilik.pendapatan.grafik') }}" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-200 transition hover:bg-indigo-700">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
              </svg>
              Visualisasi Grafik
            </a>
            {{-- Tombol Cetak Laporan --}}
            <a href="{{ route('pemilik.laporan.cetak') }}" target="_blank" class="inline-flex items-center gap-2 rounded-2xl bg-white border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:text-slate-900">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 text-slate-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.617 0-1.11-.51-1.07-1.122L6.34 18m11.32 0h-11.32M9 11V9c0-1.657 1.343-3 3-3s3 1.343 3 3v2m-9 3h12" />
              </svg>
              Cetak Laporan (.PDF)
            </a>
          </div>
        </div>
      </div>

      {{-- TOMBOL NAVIGASI MENU UTAMA --}}
      <div class="mt-6 grid gap-6 md:grid-cols-2">
        {{-- Tombol Kelola Kamar --}}
        <a href="{{ route('pemilik.kamar.index') }}" class="group rounded-3xl bg-amber-500 px-6 py-6 text-white shadow-lg shadow-amber-300/40 transition-all duration-300 hover:bg-amber-600 hover:shadow-xl">
          <h3 class="font-semibold text-xl flex items-center gap-2">
            Kelola Kamar
            <span class="transition-transform group-hover:translate-x-1">→</span>
          </h3>
          <p class="mt-2 text-sm text-white/80">Tambah, edit, dan hapus data ketersediaan kamar kos.</p>
        </a>
        
        {{-- Tombol List Calon Penyewa --}}
        <a href="{{ route('pemilik.users.calon_penyewa') }}" class="group rounded-3xl bg-slate-900 px-6 py-6 text-white shadow-lg shadow-slate-900/30 transition-all duration-300 hover:bg-slate-800 hover:shadow-xl">
          <h3 class="font-semibold text-xl flex items-center gap-2">
            List Calon Penyewa
            <span class="transition-transform group-hover:translate-x-1">→</span>
          </h3>
          <p class="mt-2 text-sm text-white/80">Cek berkas data pendaftar baru dan kelola status persetujuan.</p>
        </a>
      </div>

    </div>
  </div>
</div>
@endsection