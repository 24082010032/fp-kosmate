@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top, rgba(245,158,11,0.12), transparent 35%), radial-gradient(circle at bottom right, rgba(236,72,153,0.10), transparent 30%);">
  <div class="mx-auto max-w-6xl px-6">
    <div class="rounded-4xl border border-white/80 bg-white/95 p-8 shadow-2xl shadow-amber-200/20">
      <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-600">Pemilik Kos</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Dashboard Pemilik</h1>
          <p class="mt-3 text-slate-600">Kelola kamar, daftar penghuni, dan pantau operasional kos secara lengkap.</p>
        </div>
        <a href="{{ route('pemilik.settings') }}" class="rounded-3xl bg-amber-100 px-5 py-3 font-semibold text-amber-900 shadow-lg shadow-amber-200/50">Pengaturan</a>
      </div>

      <div class="mt-10 grid gap-6 xl:grid-cols-3">
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
          <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Kamar Tersedia</p>
          <h2 class="mt-3 text-3xl font-bold text-slate-900">12</h2>
          <p class="mt-2 text-sm text-slate-600">Kelola semua kamar yang tersedia dan statusnya.</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
          <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Penghuni Aktif</p>
          <h2 class="mt-3 text-3xl font-bold text-slate-900">34</h2>
          <p class="mt-2 text-sm text-slate-600">Lihat penghuni aktif dan tagihan yang berjalan.</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
          <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Komplain Baru</p>
          <h2 class="mt-3 text-3xl font-bold text-slate-900">3</h2>
          <p class="mt-2 text-sm text-slate-600">Tindak lanjuti komplain agar penghuni tetap nyaman.</p>
        </div>
      </div>

      <div class="mt-10 grid gap-6 md:grid-cols-2">
        <a href="{{ route('pemilik.kamar.index') }}" class="rounded-3xl bg-amber-500 px-6 py-6 text-white shadow-lg shadow-amber-300/40 transition hover:bg-amber-600">
          <h3 class="font-semibold text-xl">Kelola Kamar</h3>
          <p class="mt-2 text-sm text-white/80">Tambah, edit, dan hapus data kamar kos.</p>
        </a>
        <a href="{{ route('pemilik.users.calon_penyewa') }}" class="rounded-3xl bg-slate-900 px-6 py-6 text-white shadow-lg shadow-slate-900/30 transition hover:bg-slate-800">
          <h3 class="font-semibold text-xl">List Calon Penyewa</h3>
          <p class="mt-2 text-sm text-white/80">Cek data pendaftar baru dan status proses.</p>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
