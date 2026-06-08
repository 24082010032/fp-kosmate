@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top left, rgba(59,130,246,0.08), transparent 35%), radial-gradient(circle at bottom right, rgba(16,185,129,0.08), transparent 30%);">
  <div class="mx-auto max-w-6xl px-6">
    <div class="rounded-4xl border border-white/80 bg-white/95 p-8 shadow-2xl shadow-blue-200/20">
      
      <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Administrator</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Daftar Pemilik Kos</h1>
          <p class="mt-3 text-slate-600">Berikut adalah daftar seluruh pengguna yang terdaftar sebagai Pemilik Kos di dalam sistem Kosmate.</p>
        </div>
        <a href="{{ route('pemilik.dashboard') }}" class="rounded-3xl bg-amber-100 px-5 py-3 font-semibold text-amber-900 shadow-lg shadow-amber-200/50">Dashboard Utama</a>
      </div>

      <div class="mt-10 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-lg">
        <table class="w-full border-collapse text-left text-sm text-slate-500">
          <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-600 border-b border-slate-100">
            <tr>
              <th scope="col" class="px-6 py-4">No</th>
              <th scope="col" class="px-6 py-4">Nama</th>
              <th scope="col" class="px-6 py-4">Email</th>
              <th scope="col" class="px-6 py-4">No HP</th>
              <th scope="col" class="px-6 py-4 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 border-t border-slate-100">
            @forelse($users as $index => $u)
              <tr class="hover:bg-slate-50/80 transition">
                <td class="px-6 py-4 font-medium text-slate-900">{{ $index + 1 }}</td>
                <td class="px-6 py-4 font-semibold text-slate-700">{{ $u->name }}</td>
                <td class="px-6 py-4">{{ $u->email }}</td>
                <td class="px-6 py-4">
                  {{ $u->no_hp ?? '-' }}
                </td>
                <td class="px-6 py-4 text-center text-slate-400">
                  -
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-10 text-center text-slate-400">
                  <p class="text-base font-semibold">Belum ada data pemilik</p>
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