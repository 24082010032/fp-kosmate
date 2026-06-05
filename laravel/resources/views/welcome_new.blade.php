<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kosmate - Welcome</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: radial-gradient(circle at top, #fff1f3, #f7f1e6 30%, #d8e8d1 100%);
    }
  </style>
</head>
<body class="min-h-screen px-6 py-8 text-slate-900">
  <div class="mx-auto max-w-7xl">
    <header class="rounded-[2rem] border border-white/80 bg-white/80 p-8 shadow-2xl shadow-pink-200/40 backdrop-blur-xl">
      <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
        <div class="space-y-5">
          <div class="inline-flex items-center gap-3 rounded-full bg-pink-100 px-4 py-2 text-sm font-semibold text-pink-700 shadow-sm">
            <span class="text-2xl">🌸</span>
            Kosmate - Web Manajemen Kos Imut
          </div>
          <h1 class="text-5xl font-extrabold tracking-tight text-slate-900">Selamat datang di Kosmate</h1>
          <p class="max-w-2xl text-lg text-slate-600">
            Halaman depan kos yang super lucu dan imut, khusus dibuat untuk Calon Penyewa, Penghuni Kos, dan Pemilik Kos.
          </p>
          <div class="grid gap-4 sm:grid-cols-3">
            <a href="{{ route('calon-penyewa') }}" class="rounded-3xl bg-pink-200 px-5 py-4 text-center font-semibold text-pink-900 shadow-lg shadow-pink-200/50 transition hover:-translate-y-1">
              Calon Penyewa
            </a>
            <a href="{{ route('penghuni') }}" class="rounded-3xl bg-emerald-100 px-5 py-4 text-center font-semibold text-emerald-900 shadow-lg shadow-emerald-200/50 transition hover:-translate-y-1">
              Penghuni Kos
            </a>
            <a href="{{ route('pemilik.home') }}" class="rounded-3xl bg-amber-100 px-5 py-4 text-center font-semibold text-amber-900 shadow-lg shadow-amber-200/50 transition hover:-translate-y-1">
              Pemilik Kos
            </a>
          </div>
        </div>
        <div class="rounded-[2.5rem] bg-gradient-to-br from-pink-100 via-cream-50 to-emerald-100 p-6 text-center shadow-xl shadow-pink-200/30">
          <p class="text-sm font-semibold uppercase tracking-[0.25em] text-pink-700">Tema</p>
          <p class="mt-4 text-4xl font-extrabold text-slate-900">Cute Pastel</p>
          <p class="mt-3 text-slate-600">Soft pink, matcha green, cream & rounded-3xl untuk tampilan manis.</p>
        </div>
      </div>
    </header>

    <section class="space-y-8">
      <div class="rounded-[2rem] border border-white/80 bg-white/80 p-8 shadow-2xl shadow-emerald-100/30">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
          <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Preview kamar</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900">Kamar Kos Gema si Cute</h2>
            <p class="mt-2 max-w-xl text-slate-600">Intip daftar kamar imut dengan status dan harga dalam desain yang memanjakan mata.</p>
          </div>
          <div class="rounded-3xl bg-pink-50 p-5 text-center shadow-lg shadow-pink-200/20">
            <p class="text-xs uppercase tracking-[0.35em] text-pink-700">Manajemen cepat</p>
            <p class="mt-3 text-3xl font-bold text-pink-900">3 Role</p>
            <p class="mt-2 text-slate-600">Terhubung dengan fitur setiap pengguna.</p>
          </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-3">
          <article class="rounded-3xl border border-white/80 bg-pink-50 p-6 shadow-[0_20px_60px_-20px_rgba(236,72,153,0.35)]">
            <div class="flex items-center justify-between gap-3">
              <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-pink-700">Sweet Blossom</p>
                <h3 class="mt-2 text-2xl font-bold text-slate-900">Tersedia</h3>
              </div>
              <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-800">Rp 1.200.000</span>
            </div>
            <p class="mt-4 text-slate-600">Kamar pink cozy lengkap AC & WiFi, cocok buat yang ingin suasana hangat.</p>
          </article>
          <article class="rounded-3xl border border-white/80 bg-emerald-50 p-6 shadow-[0_20px_60px_-20px_rgba(34,197,94,0.35)]">
            <div class="flex items-center justify-between gap-3">
              <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Matcha Cozy</p>
                <h3 class="mt-2 text-2xl font-bold text-slate-900">Terisi</h3>
              </div>
              <span class="rounded-full bg-pink-100 px-3 py-1 text-sm font-semibold text-pink-700">Rp 1.350.000</span>
            </div>
            <p class="mt-4 text-slate-600">Sentuhan hijau calm, balkon mini, dan suasana yang tenang.</p>
          </article>
          <article class="rounded-3xl border border-white/80 bg-amber-50 p-6 shadow-[0_20px_60px_-20px_rgba(251,191,36,0.35)]">
            <div class="flex items-center justify-between gap-3">
              <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-700">Cream Cloud</p>
                <h3 class="mt-2 text-2xl font-bold text-slate-900">Tersedia</h3>
              </div>
              <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-800">Rp 1.150.000</span>
            </div>
            <p class="mt-4 text-slate-600">Nuansa lembut dengan dapur bersama dan laundry friendly.</p>
          </article>
        </div>
      </div>

      <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-3xl border border-white/80 bg-pink-100 p-8 shadow-lg shadow-pink-200/20">
          <h3 class="text-xl font-bold text-slate-900">Calon Penyewa</h3>
          <p class="mt-3 text-slate-600">Lihat daftar kamar gemas, status kos, dan pesan ruangan favoritmu.</p>
        </div>
        <div class="rounded-3xl border border-white/80 bg-emerald-100 p-8 shadow-lg shadow-emerald-200/20">
          <h3 class="text-xl font-bold text-slate-900">Penghuni Kos</h3>
          <p class="mt-3 text-slate-600">Akses komplain, tagihan bulanan, dan lihat status pembayaran dengan mudah.</p>
        </div>
        <div class="rounded-3xl border border-white/80 bg-amber-100 p-8 shadow-lg shadow-amber-200/20">
          <h3 class="text-xl font-bold text-slate-900">Pemilik Kos</h3>
          <p class="mt-3 text-slate-600">Kelola kamar, tambah edit hapus data kamar, dan cek daftar penghuni.</p>
        </div>
      </div>
    </section>
  </div>
</body>
</html>
