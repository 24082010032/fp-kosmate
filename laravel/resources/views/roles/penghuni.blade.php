@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top left, rgba(16,185,129,0.08), transparent 35%), radial-gradient(circle at bottom right, rgba(59,130,246,0.08), transparent 30%);">
  <div class="mx-auto max-w-5xl px-6">
    <div class="rounded-4xl border border-white/80 bg-white/95 p-8 shadow-2xl shadow-slate-200/20">
      <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-pink-500">Selamat Datang 👋</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">{{ $user->name ?? 'Penghuni Kos' }}</h1>
          <p class="mt-3 text-slate-600">Cek tagihan, ajukan komplain, dan pantau kontrak kos Anda.</p>
        </div>
        <a href="{{ route('welcome') }}" class="rounded-3xl bg-slate-900 px-5 py-3 font-semibold text-white shadow-lg shadow-slate-500/20">Beranda</a>
      </div>

      <div class="mt-10 grid gap-6 md:grid-cols-3">
        <!-- DETAIL TAGIHAN AKTIF DINAMIS -->
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
          <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Tagihan Aktif</p>
          <h2 class="mt-3 text-3xl font-bold text-slate-900">{{ $totalTagihan ?? 0 }}</h2>
          <p class="mt-2 text-sm text-slate-600">Periksa tagihan terbaru dan status pembayaran.</p>
        </div>

        <!-- DETAIL KAMAR FIX SINKRON DATABASMU (no_kamar) -->
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
          <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Kamar Kos</p>
          <h2 class="mt-3 text-2xl font-bold text-emerald-600">
            {{ $user->no_kamar ?? 'Belum Pilih Kamar' }}
          </h2>
          <p class="mt-2 text-sm text-slate-600">Status Penyewaan: <span class="font-semibold text-slate-900">Aktif</span></p>
        </div>

        <!-- DETAIL KOMPLAIN TERAKHIR DINAMIS -->
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
          <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Komplain Terakhir</p>
          <h2 class="mt-3 text-3xl font-bold text-slate-900">{{ $totalKomplain ?? 0 }}</h2>
          <p class="mt-2 text-sm text-slate-600">Monitor status penanganan komplain Anda.</p>
        </div>
      </div>

      <div class="mt-10 grid gap-6 md:grid-cols-2">
        <a href="{{ route('penghuni.komplain.index') }}" class="rounded-3xl bg-blue-600 px-6 py-6 text-white shadow-lg shadow-blue-300/30 transition hover:bg-blue-700">
          <h3 class="font-semibold text-xl">Ajukan Komplain</h3>
          <p class="mt-2 text-sm text-white/80">Sampaikan masalah kos Anda langsung ke pemilik.</p>
        </a>
        <a href="{{ route('penghuni.tagihan.index') }}" class="rounded-3xl bg-violet-600 px-6 py-6 text-white shadow-lg shadow-violet-300/30 transition hover:bg-violet-700">
          <h3 class="font-semibold text-xl">Lihat Tagihan</h3>
          <p class="mt-2 text-sm text-white/80">Cek tagihan bulanan dan status pembayaran.</p>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection