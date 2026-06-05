@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top left, rgba(236,72,153,0.08), transparent 35%), radial-gradient(circle at bottom right, rgba(16,185,129,0.08), transparent 30%);">
  <div class="mx-auto max-w-6xl px-6">
    <div class="rounded-4xl border border-white/80 bg-white/95 p-8 shadow-2xl shadow-pink-200/20">
      <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Calon Penyewa</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Jelajahi Kamar Kos Terbaik</h1>
          <p class="mt-3 text-slate-600">Pilih kamar dengan status jelas dan ajukan permohonan sewa langsung.</p>
        </div>
        <a href="{{ route('welcome') }}" class="rounded-3xl bg-pink-200 px-5 py-3 font-semibold text-pink-900 shadow-lg shadow-pink-200/50">Beranda</a>
      </div>

      <div class="mt-10 grid gap-6 lg:grid-cols-3">
        @foreach($kamars ?? [] as $kamar)
          <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
            <div class="flex items-start justify-between gap-4">
              <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">{{ $kamar->nama }}</p>
                <h2 class="mt-3 text-2xl font-bold text-slate-900">Rp {{ number_format($kamar->harga,0,',','.') }}</h2>
              </div>
              <span class="rounded-full px-3 py-1 text-sm font-semibold {{ $kamar->status === 'Tersedia' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">{{ $kamar->status }}</span>
            </div>
            <p class="mt-5 text-slate-600">{{ Str::limit($kamar->fasilitas, 120) }}</p>
            <form method="POST" action="#" class="mt-6">
              @csrf
              <button type="button" class="w-full rounded-3xl bg-pink-500 px-4 py-3 text-white transition hover:bg-pink-600">Pesan Kamar</button>
            </form>
          </article>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
