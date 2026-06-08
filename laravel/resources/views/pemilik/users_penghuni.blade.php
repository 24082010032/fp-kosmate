@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16" style="background: radial-gradient(circle at top left, rgba(16,185,129,0.08), transparent 35%), radial-gradient(circle at bottom right, rgba(59,130,246,0.08), transparent 30%);">
  <div class="mx-auto max-w-6xl px-6">
    <div class="rounded-4xl border border-white/80 bg-white/95 p-8 shadow-2xl shadow-emerald-200/20">
      
      <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-600">Pemilik Kos</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Daftar Penghuni Kos</h1>
          <p class="mt-3 text-slate-600">Pantau kamar, status tagihan bulanan, dan verifikasi bukti transfer pembayaran penghuni.</p>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('pemilik.dashboard') }}" class="rounded-3xl bg-amber-100 px-6 py-3 font-semibold text-amber-900 shadow-lg shadow-amber-200/50 text-sm hover:bg-amber-200 transition">
            Dashboard Pemilik
          </a>
        </div>
      </div>

      {{-- Notifikasi Sukses --}}
      @if(session('success'))
        <div class="mt-6 rounded-2xl bg-emerald-50 p-4 text-sm font-medium text-emerald-700 ring-1 ring-emerald-600/10">
          {{ session('success') }}
        </div>
      @endif

      <div class="mt-10 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-lg">
        <table class="w-full border-collapse text-left text-sm text-slate-500">
          <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-600 border-b border-slate-100">
            <tr>
              <th scope="col" class="px-6 py-4">No</th>
              <th scope="col" class="px-6 py-4">Nama Lengkap</th>
              <th scope="col" class="px-6 py-4 text-center">No Kamar</th>
              <th scope="col" class="px-6 py-4 text-center">Status Tagihan</th>
              <th scope="col" class="px-6 py-4 text-center">Aksi Verifikasi</th>
              <th scope="col" class="px-6 py-4 text-center">Aksi Lain</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 border-t border-slate-100">
            @forelse($users as $index => $u)
              <tr class="hover:bg-slate-50/80 transition">
                <td class="px-6 py-4 font-medium text-slate-900">{{ $index + 1 }}</td>
                <td class="px-6 py-4">
                  <div class="font-semibold text-slate-700">{{ $u->name }}</div>
                  <div class="text-xs text-slate-400">{{ $u->email }}</div>
                </td>
                <td class="px-6 py-4 text-center">
                  @if(isset($u->no_kamar) && $u->no_kamar)
                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/10 uppercase">
                      Kamar {{ $u->no_kamar }}
                    </span>
                  @else
                    <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-600/10 italic">
                      Belum Diatur
                    </span>
                  @endif
                </td>
                <td class="px-6 py-4 text-center">
                  @if(isset($u->status_tagihan) && $u->status_tagihan === 'lunas')
                    <span class="inline-flex items-center rounded-full bg-sky-50 px-2.5 py-1 text-xs font-bold text-sky-700 ring-1 ring-inset ring-sky-600/20">LUNAS</span>
                  @elseif(isset($u->status_tagihan) && $u->status_tagihan === 'menunggu_konfirmasi')
                    <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-600/20 animate-pulse">MENUNGGU KONFIRMASI</span>
                  @else
                    <span class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-1 text-xs font-bold text-rose-700 ring-1 ring-inset ring-rose-600/20">BELUM BAYAR</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-center">
                  @if(isset($u->status_tagihan) && $u->status_tagihan === 'menunggu_konfirmasi')
                    <button onclick="openModal('{{ asset('storage/' . $u->bukti_transfer) }}', '{{ route('pemilik.users.konfirmasi_lunas', $u->id) }}')" class="rounded-2xl bg-amber-500 px-4 py-2 text-xs font-bold text-white shadow-md shadow-amber-500/20 hover:bg-amber-600 transition">
                      Cek Bukti & Setujui
                    </button>
                  @elseif(isset($u->status_tagihan) && $u->status_tagihan === 'lunas')
                    <span class="text-xs text-emerald-600 font-semibold">✓ Terverifikasi</span>
                  @else
                    <span class="text-xs text-slate-400 italic">Menunggu penghuni bayar</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-center">
                  <form action="{{ route('pemilik.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan sewa untuk penghuni ini? Kamar akan kembali tersedia.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs text-rose-500 font-bold hover:text-rose-700 hover:underline transition">
                      Batalkan Sewa
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-6 py-10 text-center text-slate-400">
                  <p class="text-base font-semibold">Belum ada penghuni aktif</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

{{-- MODAL POPUP PREVIEW BUKTI TRANSFER --}}
<div id="buktiModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 animate-fade-in">
  <div class="w-full max-w-md rounded-4xl bg-white p-6 shadow-2xl border border-slate-100">
    <h3 class="text-lg font-bold text-slate-900">Verifikasi Pembayaran</h3>
    <p class="text-xs text-slate-500 mt-1">Pastikan nominal transfer di bawah ini sudah sesuai dengan harga kamar di mutasi bank Anda.</p>
    
    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-100 bg-slate-50 flex items-center justify-center min-h-[250px]">
      <img id="modalImage" src="" alt="Bukti Transfer" class="max-h-[350px] object-contain">
    </div>

    <div class="mt-6 flex gap-3">
      <button onclick="closeModal()" class="w-1/2 rounded-3xl bg-slate-100 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-200 transition">Tutup</button>
      <form id="modalForm" method="POST" class="w-1/2">
        @csrf
        <button type="submit" class="w-full rounded-3xl bg-emerald-600 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 transition">Konfirmasi Lunas</button>
      </form>
    </div>
  </div>
</div>

<script>
  function openModal(imageSrc, actionUrl) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalForm').action = actionUrl;
    document.getElementById('buktiModal').classList.remove('hidden');
  }
  function closeModal() {
    document.getElementById('buktiModal').classList.add('hidden');
  }
</script>
@endsection