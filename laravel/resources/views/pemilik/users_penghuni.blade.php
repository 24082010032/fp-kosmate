@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top left, rgba(16,185,129,0.08), transparent 35%), radial-gradient(circle at bottom right, rgba(59,130,246,0.08), transparent 30%);">
  <div class="mx-auto max-w-6xl px-6">
    <div class="rounded-4xl border border-white/80 bg-white/95 p-8 shadow-2xl shadow-emerald-200/20">
      
      <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-600">Pemilik Kos</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Daftar Penghuni Kos</h1>
          <p class="mt-3 text-slate-600">Pantau kamar, status tagihan, dan verifikasi bukti transfer penghuni.</p>
        </div>
      </div>

      {{-- Notifikasi --}}
      @if(session('success'))
        <div class="mt-6 rounded-2xl bg-emerald-50 p-4 text-sm font-medium text-emerald-700 border border-emerald-200">
          {{ session('success') }}
        </div>
      @endif

      <div class="mt-10 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-lg">
        <table class="w-full text-left text-sm text-slate-500">
          <thead class="bg-slate-50 text-xs font-semibold uppercase text-slate-600">
            <tr>
              <th class="px-6 py-4">Nama</th>
              <th class="px-6 py-4 text-center">No Kamar</th>
              <th class="px-6 py-4 text-center">Status</th>
              <th class="px-6 py-4 text-center">Aksi Verifikasi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @forelse($users as $u)
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 font-semibold text-slate-700">{{ $u->name }}</td>
                <td class="px-6 py-4 text-center">{{ $u->no_kamar ?? '-' }}</td>
                <td class="px-6 py-4 text-center">
                  @if($u->status_tagihan == 'lunas')
                    <span class="bg-sky-100 text-sky-700 px-3 py-1 rounded-full text-xs font-bold">LUNAS</span>
                  @elseif($u->status_tagihan == 'menunggu_konfirmasi')
                    <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold animate-pulse">MENUNGGU KONFIRMASI</span>
                  @else
                    <span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-bold">BELUM BAYAR</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-center">
                  @if($u->status_tagihan == 'menunggu_konfirmasi')
                    <button type="button"
                            data-img="{{ asset('storage/'.$u->bukti_transfer) }}"
                            data-url="{{ route('pemilik.users.konfirmasi_lunas', $u->id) }}"
                            class="open-bukti-modal bg-amber-500 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-amber-600">
                        Cek Bukti & Setujui
                    </button>
                  @elseif($u->status_tagihan == 'lunas')
                    <span class="text-emerald-600 font-semibold text-xs">✓ Terverifikasi</span>
                  @else
                    <span class="text-slate-400 text-xs italic">Menunggu pembayaran</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr><td colspan="4" class="text-center py-10">Belum ada penghuni.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- MODAL --}}
<div id="buktiModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
  <div class="w-full max-w-sm bg-white p-6 rounded-3xl shadow-2xl">
    <h3 class="font-bold text-lg">Bukti Transfer</h3>
    <div class="mt-4 border rounded-2xl bg-slate-100 p-2">
      <img id="modalImage" src="" class="w-full h-auto rounded-lg">
    </div>
    <div class="mt-6 flex gap-3">
      <button onclick="closeModal()" class="w-1/2 py-3 bg-slate-100 rounded-2xl font-bold">Tutup</button>
      <form id="modalForm" method="POST" class="w-1/2">
        @csrf
        <button type="submit" class="w-full py-3 bg-emerald-600 text-white rounded-2xl font-bold">Konfirmasi Lunas</button>
      </form>
    </div>
  </div>
</div>

<script>
  function openModal(img, url) {
    document.getElementById('modalImage').src = img;
    document.getElementById('modalForm').action = url;
    document.getElementById('buktiModal').classList.remove('hidden');
  }
  function closeModal() {
    document.getElementById('buktiModal').classList.add('hidden');
  }

  document.addEventListener('click', function(event) {
    const button = event.target.closest('.open-bukti-modal');
    if (!button) return;
    openModal(button.dataset.img, button.dataset.url);
  });
</script>
@endsection