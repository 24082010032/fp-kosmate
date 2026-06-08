<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan Kosmate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; color: black; padding: 0; }
            .print-card { border: none; shadow: none; max-w: 100%; width: 100%; padding: 0; }
        }
    </style>
</head>
<body class="bg-slate-50 py-12 px-8">

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-slate-100 print-card">
        
        {{-- PANEL NAVIGASI ATAS (DISEMBUNYIKAN SAAT DI-PRINT) --}}
        <div class="no-print flex justify-between items-center mb-8 bg-slate-100 p-4 rounded-xl">
            <span class="text-sm font-medium text-slate-600">Pratinjau Dokumen Laporan Ekspor</span>
            <div class="flex gap-2">
                <a href="{{ route('pemilik.dashboard') }}" class="bg-slate-500 hover:bg-slate-600 text-white px-4 py-2 rounded-xl text-xs font-bold transition">✕ Batalkan</a>
                <button onclick="window.print()" class="bg-amber-500 text-white px-4 py-2 rounded-xl text-xs font-bold shadow-sm hover:bg-amber-600 transition">🖨️ Cetak / Simpan Ke PDF</button>
            </div>
        </div>

        {{-- KOP SURAT / HEADER LAPORAN --}}
        <div class="border-b-2 border-slate-900 pb-6 mb-6 text-center">
            <h1 class="text-3xl font-black uppercase tracking-wide text-slate-800">Laporan Bulanan Unit Kosmate</h1>
            <p class="text-sm text-slate-500 mt-1">Surabaya, Jawa Timur • Sistem Informasi Manajemen Operasional Kos</p>
        </div>

        {{-- SEKSYEN I: RINGKASAN KEUANGAN --}}
        <div class="mb-6 bg-amber-50/40 p-4 rounded-2xl border border-amber-100">
            <h3 class="text-lg font-bold text-slate-800 mb-1">I. Ringkasan Keuangan</h3>
            <p class="text-xs text-slate-600 mb-2">Total Pendapatan Terbaca Aktif Bulan Ini (Kamar Terisi):</p>
            <div class="text-2xl font-black text-amber-600">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
        </div>

        {{-- SEKSYEN II: TABEL OKUPANSI KAMAR --}}
        <div>
            <h3 class="text-lg font-bold text-slate-800 mb-3">II. Status Okupansi Kamar</h3>
            <table class="w-full text-left text-sm border-collapse border border-slate-200">
                <thead>
                    <tr class="bg-slate-100 text-slate-700">
                        <th class="border border-slate-200 p-3">Tipe Kamar</th>
                        <th class="border border-slate-200 p-3">Harga Sewa</th>
                        <th class="border border-slate-200 p-3">Status Hunian</th>
                        <th class="border border-slate-200 p-3">Nama Penghuni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kamars as $kamar)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="border border-slate-200 p-3 font-semibold text-slate-800">{{ $kamar->tipe_kamar }}</td>
                        <td class="border border-slate-200 p-3 text-slate-700">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</td>
                        <td class="border border-slate-200 p-3">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $kamar->status === 'Terisi' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $kamar->status }}
                            </span>
                        </td>
                        {{-- FIX REVISI: Menggunakan variabel flat dari gabungan Query string LIKE di Controller --}}
                        <td class="border border-slate-200 p-3 text-slate-800 font-medium">
                            @if($kamar->status === 'Terisi' && !empty($kamar->nama_penghuni))
                                {{ $kamar->nama_penghuni }}
                            @else
                                <span class="text-slate-400 font-normal">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- FOOTER TIMESTAMP OTOMATIS --}}
        <div class="mt-12 text-right text-xs text-slate-400">
            <p>Dicetak otomatis melalui Sistem Manajemen Kosmate pada {{ date('d-m-Y H:i') }} WIB</p>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
        });
    </script>
</body>
</html>