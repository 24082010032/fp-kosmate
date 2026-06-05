<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kosmate - Welcome</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap');
    body {
      background: radial-gradient(circle at top, #fff1f3, #f7f1e6 40%, #e8f0e5 100%);
      font-family: 'Fredoka', sans-serif;
    }
  </style>
</head>
<body class="min-h-screen px-6 py-8 text-slate-800">
  <div class="mx-auto max-w-7xl space-y-8">
    
    <!-- NAVBAR & HERO SECTION -->
    <header class="rounded-[2rem] border border-white/80 bg-white/75 p-8 shadow-xl shadow-pink-100/40 backdrop-blur-xl">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
        <div class="space-y-4">
          <div class="text-3xl font-black text-pink-500 tracking-wide">
            🏠 Kosmate.
          </div>
          <h1 class="text-4xl font-extrabold tracking-tight text-slate-900">
            Cari & Kelola Kosan Jadi Lebih <span class="text-pink-500">Happy! ✨</span>
          </h1>
          <p class="max-w-xl text-base text-slate-500 leading-relaxed">
            Sistem manajemen kos modern yang dirancang khusus untuk kemudahan Calon Penyewa, Penghuni Kos, dan Pemilik Kos.
          </p>
        </div>
        
        <!-- NAVIGASI ROLE UTAMA -->
        <div class="grid gap-3 sm:grid-cols-3 lg:w-7/12">
          <a href="{{ route('calon-penyewa') }}" class="flex items-center justify-center rounded-3xl bg-pink-100 px-5 py-4 text-center font-bold text-pink-800 border-b-4 border-pink-200 shadow-md transition hover:-translate-y-1">
            🌸 Calon Penyewa
          </a>
          <a href="{{ route('penghuni') }}" class="flex items-center justify-center rounded-3xl bg-emerald-100 px-5 py-4 text-center font-bold text-emerald-800 border-b-4 border-emerald-200 shadow-md transition hover:-translate-y-1">
            🍵 Penghuni Kos
          </a>
          <a href="{{ route('pemilik.home') }}" class="flex items-center justify-center rounded-3xl bg-amber-100 px-5 py-4 text-center font-bold text-amber-800 border-b-4 border-amber-200 shadow-md transition hover:-translate-y-1">
            👑 Pemilik Kos
          </a>
        </div>
      </div>
    </header>

    <!-- CONTENT SECTION -->
    <main class="space-y-8">
      <div class="rounded-[2rem] border border-white/80 bg-white/75 p-8 shadow-xl shadow-emerald-100/20 backdrop-blur-xl">
        <div class="border-b border-dashed border-slate-200 pb-5">
          <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-2">🛏️ Pilihan Kamar Populer</h2>
          <p class="mt-1 text-sm text-slate-400">Status ketersediaan kamar kos secara real-time.</p>
        </div>

        <!-- GRID KARTU KAMAR -->
        <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          
          <!-- KAMAR 1 -->
          <article class="rounded-3xl border border-white/80 bg-white p-5 shadow-md hover:shadow-lg transition-all flex flex-col justify-between">
            <div>
              <div class="bg-pink-100/60 h-40 rounded-2xl flex items-center justify-center text-5xl mb-4 shadow-inner">🌸</div>
              <div class="flex items-start justify-between gap-2">
                <h3 class="text-xl font-bold text-slate-800">Sweet Blossom</h3>
                <span class="rounded-xl bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-800 border border-emerald-200">Tersedia</span>
              </div>
              <p class="mt-2 text-sm text-slate-500">Kamar pink cozy lengkap dengan AC & WiFi, cocok untuk suasana hangat.</p>
            </div>
            <div class="mt-5 pt-3 border-t border-dashed border-slate-100 flex items-center justify-between">
              <span class="text-lg font-extrabold text-pink-500">Rp 1.200.000<span class="text-xs text-slate-400 font-normal">/bln</span></span>
              <a href="{{ route('calon-penyewa') }}" class="rounded-xl bg-pink-500 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-pink-600 transition">Pesan</a>
            </div>
          </article>

          <!-- KAMAR 2 -->
          <article class="rounded-3xl border border-white/80 bg-white p-5 shadow-md hover:shadow-lg transition-all flex flex-col justify-between">
            <div>
              <div class="bg-emerald-100/60 h-40 rounded-2xl flex items-center justify-center text-5xl mb-4 shadow-inner">🍵</div>
              <div class="flex items-start justify-between gap-2">
                <h3 class="text-xl font-bold text-slate-800">Matcha Cozy</h3>
                <span class="rounded-xl bg-pink-100 px-2.5 py-1 text-xs font-bold text-pink-700 border border-pink-200">Terisi</span>
              </div>
              <p class="mt-2 text-sm text-slate-500">Sentuhan hijau kalem, sirkulasi udara bagus, jendela besar & balkon mini.</p>
            </div>
            <div class="mt-5 pt-3 border-t border-dashed border-slate-100 flex items-center justify-between">
              <span class="text-lg font-extrabold text-slate-400">Rp 1.350.000<span class="text-xs text-slate-400 font-normal">/bln</span></span>
              <span class="text-xs font-bold bg-slate-50 px-3 py-1.5 rounded-xl border border-slate-100 text-slate-400">Sudah Dihuni</span>
            </div>
          </article>

          <!-- KAMAR 3 -->
          <article class="rounded-3xl border border-white/80 bg-white p-5 shadow-md hover:shadow-lg transition-all flex flex-col justify-between">
            <div>
              <div class="bg-amber-100/60 h-40 rounded-2xl flex items-center justify-center text-5xl mb-4 shadow-inner">☁️</div>
              <div class="flex items-start justify-between gap-2">
                <h3 class="text-xl font-bold text-slate-800">Cream Cloud</h3>
                <span class="rounded-xl bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-800 border border-emerald-200">Tersedia</span>
              </div>
              <p class="mt-2 text-sm text-slate-500">Nuansa kayu estetik, dekat area ruang santai bersama dan laundry friendly.</p>
            </div>
            <div class="mt-5 pt-3 border-t border-dashed border-slate-100 flex items-center justify-between">
              <span class="text-lg font-extrabold text-pink-500">Rp 1.150.000<span class="text-xs text-slate-400 font-normal">/bln</span></span>
              <a href="{{ route('calon-penyewa') }}" class="rounded-xl bg-pink-500 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-pink-600 transition">Pesan</a>
            </div>
          </article>

        </div>
      </div>

      <!-- SHORTCUT MENU UNTUK ALUR KERJA ROLE -->
      <div class="grid gap-6 md:grid-cols-3">
        <div class="rounded-3xl border border-white/80 bg-pink-50/80 p-6 shadow-md flex flex-col justify-between">
          <div>
            <h3 class="text-lg font-bold text-pink-900">🌸 Portal Calon Penyewa</h3>
            <p class="mt-2 text-sm text-slate-500 leading-relaxed">Cari info ketersediaan kamar secara realtime, filter harga, dan lakukan pemesanan instan.</p>
          </div>
          <a href="{{ route('calon-penyewa') }}" class="mt-4 text-xs font-bold text-pink-700 hover:underline inline-block">Buka Portal Penyewa →</a>
        </div>
        
        <div class="rounded-3xl border border-white/80 bg-emerald-50/80 p-6 shadow-md flex flex-col justify-between">
          <div>
            <h3 class="text-lg font-bold text-emerald-900">🍵 Dashboard Penghuni Kos</h3>
            <p class="mt-2 text-sm text-slate-500 leading-relaxed">Kirim laporan komplain fasilitas rusak, cek tagihan bulanan berjalan, dan konfirmasi pembayaran.</p>
          </div>
          <a href="{{ route('penghuni') }}" class="mt-4 text-xs font-bold text-emerald-700 hover:underline inline-block">Masuk Ke Kamarmu →</a>
        </div>

        <div class="rounded-3xl border border-white/80 bg-amber-50/80 p-6 shadow-md flex flex-col justify-between">
          <div>
            <h3 class="text-lg font-bold text-amber-900">👑 Panel Pemilik Kos</h3>
            <p class="mt-2 text-sm text-slate-500 leading-relaxed">Kelola operasional kamar kos lewat sistem CRUD, pantau data penyewa aktif, serta rekap keuangan bulanan.</p>
          </div>
          <a href="{{ route('pemilik.home') }}" class="mt-4 text-xs font-bold text-amber-700 hover:underline inline-block">Kelola Kosan →</a>
        </div>
      </div>
    </main>

  </div>
</body>
</html>