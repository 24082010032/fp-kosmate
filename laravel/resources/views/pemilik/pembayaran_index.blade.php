@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top left, rgba(59,130,246,0.08), transparent 35%), radial-gradient(circle at bottom right, rgba(16,185,129,0.08), transparent 30%);">
  <div class="mx-auto max-w-6xl px-6">
    <div class="rounded-4xl border border-white/80 bg-white/95 p-8 shadow-2xl shadow-blue-200/20">
      
      <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Verifikasi</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Konfirmasi Pembayaran</h1>
          <p class="mt-3 text-slate-600">Pantau dan verifikasi bukti transfer dari penghuni kos.</p>
        </div>
      </div>

      <div class="mt-10 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-lg">
        <table class="w-full border-collapse text-left text-sm text-slate-500">
          <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-600 border-b border-slate-100">
            <tr>
              <th scope="col" class="px-6 py-4">Nama Penghuni</th>
              <th scope="col" class="px-6 py-4">Nomor Kamar</th>
              <th scope="col" class="px-6 py-4">Jumlah</th>
              <th scope="col" class="px-6 py-4">Bukti</th>
              <th scope="col" class="px-6 py-4 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 border-t border-slate-100">
            @forelse($pembayarans as $p)
              <tr class="hover:bg-slate-50/80 transition">
                <td class="px-6 py-4 font-semibold text-slate-700">{{ $p->user->name ?? 'User Hilang' }}</td>
                <td class="px-6 py-4">{{ $p->nomor_kamar }}</td>
                <td class="px-6 py-4">Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                <td class="px-6 py-4"><a href="{{ asset('storage/'.$p->bukti_transfer) }}" target="_blank" class="text-blue-600 underline">Lihat</a></td>
                <td class="px-6 py-4 text-center">
                  @if($p->status == 'pending')
                    <form action="{{ route('pemilik.konfirmasiPembayaran', $p->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded-lg">Konfirmasi</button>
                    </form>
                  @else
                    <span class="text-green-600 font-bold">LUNAS</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-10 text-center text-slate-400">Belum ada pembayaran masuk</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection