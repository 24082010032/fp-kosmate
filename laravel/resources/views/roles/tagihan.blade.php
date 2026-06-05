@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Tagihan Kos Anda 💰</h1>
    <a href="{{ route('penghuni.dashboard') }}" class="text-sm bg-slate-900 text-white px-4 py-2 rounded-xl">Kembali ke Dashboard</a>
  </div>

  @if(session('message'))
    <div class="p-3 bg-green-100 text-green-800 rounded mb-4">{{ session('message') }}</div>
  @endif

  <div class="bg-white p-6 rounded-3xl shadow border border-slate-100">
    <table class="w-full text-left border-collapse">
      <thead>
        <tr class="border-b border-slate-200 text-slate-500 text-sm font-semibold">
          <th class="py-3 px-4">ID Tagihan</th>
          <th class="py-3 px-4">Total Tagihan</th>
          <th class="py-3 px-4">Status</th>
          <th class="py-3 px-4">Tanggal Dibuat</th>
        </tr>
      </thead>
      <tbody>
        <!-- Karena controllernya belum lengkap, kita buat pengaman ambil data langsung atau kosongan dulu -->
        @php
          $tagihanUser = \Illuminate\Support\Facades\DB::table('tagihans')->where('user_id', auth()->id())->get();
        @endphp

        @forelse($tagihanUser as $t)
          <tr class="border-b border-slate-100 text-slate-700 hover:bg-slate-50">
            <td class="py-4 px-4 font-medium">#{{ $t->id }}</td>
            <td class="py-4 px-4 font-semibold text-slate-900">Rp {{ number_format($t->total_tagihan, 0, ',', '.') }}</td>
            <td class="py-4 px-4">
              <span class="px-3 py-1 rounded-full text-xs font-bold {{ $t->status === 'Lunas' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                {{ $t->status }}
              </span>
            </td>
            <td class="py-4 px-4 text-sm text-slate-500">{{ date('d M Y', strtotime($t->created_at)) }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="py-8 text-center text-slate-400">Tidak ada data tagihan aktif.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection