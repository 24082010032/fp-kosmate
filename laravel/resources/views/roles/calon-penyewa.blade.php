@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top left, rgba(236,72,153,0.08), transparent 35%), radial-gradient(circle at bottom right, rgba(16,185,129,0.08), transparent 30%);">
  <div class="mx-auto max-w-6xl px-6">
    <div class="rounded-4xl border border-white/80 bg-white/95 p-8 shadow-2xl shadow-pink-200/20">
      <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-600">Pemilik Kos</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Daftar Calon Penyewa</h1>
          <p class="mt-3 text-slate-600">Berikut adalah daftar pengguna yang mendaftar dengan akun calon penyewa di sistem.</p>
        </div>
        <a href="{{ route('pemilik.dashboard') }}" class="rounded-3xl bg-amber-100 px-5 py-3 font-semibold text-amber-900 shadow-lg shadow-amber-200/50">Dashboard Pemilik</a>
      </div>

      {{-- Flash Message / Notifikasi Berhasil --}}
      @if(session('message'))
        <div class="mt-6 rounded-2xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800 text-sm font-medium shadow-sm transition-all animate-fade-in">
            {{ session('message') }}
        </div>
      @endif

      <div class="mt-10 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-lg">
        <table class="w-full border-collapse text-left text-sm text-slate-500">
          <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-600 border-b border-slate-100">
            <tr>
              <th scope="col" class="px-6 py-4">No</th>
              <th scope="col" class="px-6 py-4">Nama Lengkap</th>
              <th scope="col" class="px-6 py-4">Email</th>
              <th scope="col" class="px-6 py-4">Role</th>
              <th scope="col" class="px-6 py-4 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 border-t border-slate-100">
            @forelse($users ?? [] as $index => $user)
              <tr class="hover:bg-slate-50/80 transition">
                <td class="px-6 py-4 font-medium text-slate-900">{{ $index + 1 }}</td>
                <td class="px-6 py-4 font-semibold text-slate-700">{{ $user->name }}</td>
                <td class="px-6 py-4">{{ $user->email }}</td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center rounded-full bg-pink-50 px-2.5 py-1 text-xs font-medium text-pink-700 ring-1 ring-inset ring-pink-600/10 uppercase">
                    {{ str_replace('_', ' ', $user->role) }}
                  </span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center justify-center gap-3">
                    
                    {{-- Form Tombol Terima --}}
                    <form action="{{ route('pemilik.users.terima', $user->id) }}" method="POST">
                      @csrf
                      <button type="submit" onclick="return confirm('Terima {{ $user->name }} sebagai penghuni resmi?')" class="rounded-2xl bg-emerald-500 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-200/50 hover:bg-emerald-600 transition">
                        Terima
                      </button>
                    </form>

                    {{-- Form Tombol Tolak --}}
                    <form action="{{ route('pemilik.users.tolak', $user->id) }}" method="POST">
                      @csrf
                      <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menolak pendaftaran {{ $user->name }}?')" class="rounded-2xl bg-rose-500 px-4 py-2 text-xs font-bold text-white shadow-md shadow-rose-200/50 hover:bg-rose-600 transition">
                        Tolak
                      </button>
                    </form>

                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-10 text-center text-slate-400">
                  <p class="text-base font-semibold">Belum ada calon penyewa</p>
                  <p class="text-sm">Tidak ada data pengguna dengan role calon penyewa saat ini.</p>
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