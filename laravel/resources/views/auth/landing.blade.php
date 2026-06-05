@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top, rgba(236,72,153,0.15), transparent 35%), radial-gradient(circle at bottom right, rgba(16,185,129,0.15), transparent 30%);">
  <div class="mx-auto max-w-6xl px-6">
    <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
      <div class="space-y-6">
        <span class="inline-flex rounded-full bg-pink-100 px-4 py-2 text-sm font-semibold text-pink-700">Kosmate Auth Center</span>
        <h1 class="text-5xl font-extrabold tracking-tight text-slate-900">Login / Daftar dulu sebelum masuk ke dashboard masing-masing role.</h1>
        <p class="max-w-xl text-lg text-slate-600 leading-relaxed">Pilih alur login atau daftar untuk Calon Penyewa, Penghuni, dan Pemilik. Setiap peran akan langsung diarahkan ke dashboardnya.</p>
        <div class="flex flex-wrap gap-4">
          <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-8 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/10 transition hover:bg-slate-800">Login</a>
          <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-emerald-500 px-8 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-400/30 transition hover:bg-emerald-600">Daftar Calon Penyewa</a>
        </div>
      </div>
      <div class="rounded-4xl border border-white/80 bg-white/90 p-8 shadow-2xl shadow-slate-200/80">
        <h2 class="text-2xl font-bold text-slate-900">Role di Kosmate</h2>
        <div class="mt-6 space-y-4">
          <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
            <h3 class="font-semibold text-slate-900">Calon Penyewa</h3>
            <p class="mt-1 text-sm text-slate-600">Daftar dulu, lalu lihat kamar tersedia, ajukan pemesanan, dan cek tagihan.</p>
          </div>
          <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
            <h3 class="font-semibold text-slate-900">Penghuni</h3>
            <p class="mt-1 text-sm text-slate-600">Login dengan akun penghuni untuk akses komplain, tagihan, dan status kos.</p>
          </div>
          <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
            <h3 class="font-semibold text-slate-900">Pemilik</h3>
            <p class="mt-1 text-sm text-slate-600">Kelola kamar, lihat penghuni, dan pantau keuangan operasional.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection