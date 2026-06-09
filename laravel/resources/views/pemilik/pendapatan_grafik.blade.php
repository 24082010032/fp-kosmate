@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] py-16 bg-slate-50">
  <div class="mx-auto max-w-4xl px-6">
    
    <div class="flex items-center justify-between mb-8">
      <div>
        <h1 class="text-3xl font-bold text-slate-900">Grafik Tren Pendapatan</h1>
        <p class="text-sm text-slate-500 mt-1">Visualisasi total pemasukan bulanan kos secara real-time.</p>
      </div>
      <a href="{{ route('pemilik.dashboard') }}" class="rounded-3xl bg-slate-200 px-4 py-2 font-semibold text-slate-700 text-xs hover:bg-slate-300 transition">✕ Kembali</a>
    </div>

    <div class="bg-amber-500 text-white p-6 rounded-3xl shadow-md mb-8">
      <span class="text-xs uppercase tracking-wider font-semibold opacity-80 block">Estimasi Pendapatan Bulan Ini</span>
      <span class="text-3xl font-black block mt-1">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
      <canvas id="incomeChart" height="150"></canvas>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('incomeChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
      datasets: [{
        label: 'Pemasukan Kos (Rp)',
        data: [0, 0, 0, 0, 0, {{ $totalPemasukan }}], // Menampilkan total pendapatan riil di bulan berjalan (Juni)
        backgroundColor: 'rgba(245, 158, 11, 0.8)',
        borderColor: 'rgba(245, 158, 11, 1)',
        borderWidth: 2,
        borderRadius: 12
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endsection