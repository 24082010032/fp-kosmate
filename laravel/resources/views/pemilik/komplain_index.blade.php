@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top left, rgba(239,68,68,0.06), transparent 35%), radial-gradient(circle at bottom right, rgba(245,158,11,0.06), transparent 30%);">
  <div class="mx-auto max-w-6xl px-6">
    
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
      <div class="mb-6 rounded-2xl bg-emerald-50 p-4 text-sm font-semibold text-emerald-800 border border-emerald-200 shadow-sm flex items-center justify-between">
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">✕</button>
      </div>
    @endif

    <div class="rounded-4xl border border-white/80 bg-white/95 p-8 shadow-2xl shadow-rose-200/20">
      
      <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-rose-600">Laporan Penghuni</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Daftar Komplain Masuk</h1>
          <p class="mt-3 text-slate-600">Berikut adalah seluruh daftar keluhan fasilitas yang dilaporkan oleh penghuni kos Anda.</p>
        </div>
        <a href="{{ route('pemilik.dashboard') }}" class="rounded-3xl bg-amber-100 px-5 py-3 font-semibold text-amber-900 shadow-lg shadow-amber-200/50 text-sm">Dashboard Pemilik</a>
      </div>

      <div class="mt-10 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-lg">
        <table class="w-full border-collapse text-left text-sm text-slate-500">
          <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-600 border-b border-slate-100">
            <tr>
              <th scope="col" class="px-6 py-4">No</th>
              <th scope="col" class="px-6 py-4">Nama Penghuni</th>
              <th scope="col" class="px-6 py-4">Isi Komplain / Keluhan</th>
              <th scope="col" class="px-6 py-4 text-center">Tanggal Lapor</th>
              <th scope="col" class="px-6 py-4 text-center">Status / Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 border-t border-slate-100">
            @forelse($komplains as $index => $k)
              <tr class="hover:bg-slate-50/80 transition">
                <td class="px-6 py-4 font-medium text-slate-900">{{ $index + 1 }}</td>
                <td class="px-6 py-4 font-semibold text-slate-700">{{ $k->user_name ?? ($k->user->name ?? 'Penghuni Kos') }}</td>
                <td class="px-6 py-4 text-slate-600 font-medium whitespace-pre-line">{{ $k->isi_komplain ?? $k->deskripsi }}</td>
                <td class="px-6 py-4 text-center text-slate-400 text-xs">
                  {{ isset($k->created_at) ? \Carbon\Carbon::parse($k->created_at)->format('d M Y H:i') : '-' }}
                </td>
                <td class="px-6 py-4 text-center">
                  {{-- Logika Pengecekan Status Komplain --}}
                  @if(isset($k->status) && strtolower($k->status) === 'selesai')
                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 border border-emerald-200">
                      ● Selesai
                    </span>
                  @else
                    <form action="{{ route('pemilik.komplains.selesai', $k->id) }}" method="POST" class="inline">
                      @csrf
                      <button type="submit" class="inline-flex items-center rounded-xl bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-600 border border-rose-200 hover:bg-rose-100 transition shadow-sm">
                        Tandai Selesai
                      </button>
                    </form>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-10 text-center text-slate-400">
                  <p class="text-base font-semibold">Aman terkendali!</p>
                  <p class="text-sm">Saat ini belum ada komplain yang masuk dari penghuni.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection