<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kosmate - Manajemen Kos</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      color-scheme: light;
    }
    body {
      background: radial-gradient(circle at top, #fff1f3, #f7f1e6 35%, #d8e8d1 100%);
    }
  </style>
</head>
<body class="min-h-screen px-6 py-8 text-slate-800">
  <div class="mx-auto max-w-6xl">
    <header class="mb-10 rounded-[2rem] border border-white/70 bg-white/80 p-8 shadow-2xl shadow-pink-200/30 backdrop-blur-xl">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
        <div class="space-y-4">
          <div class="inline-flex items-center gap-3 rounded-full bg-pink-100 px-4 py-2 text-sm font-semibold text-pink-700 shadow-sm">
            <span class="text-2xl">🌸</span>
            Kosmate - Tempat kosmu jadi lebih imut
          </div>
          <h1 class="text-5xl font-extrabold tracking-tight text-slate-900">Selamat datang di Kosmate</h1>
          <p class="max-w-2xl text-lg text-slate-600">
            Kelola kos dengan gaya lucu dan estetik. Pilih ruangan favoritmu, cek status kamar, dan jalankan manajemen kos yang hangat seperti matcha latte.
          </p>
        </div>
        <div class="rounded-[2rem] bg-cream-50 border border-green-100/80 p-6 text-center shadow-xl shadow-emerald-200/20">
          <p class="text-sm font-medium uppercase tracking-[0.25em] text-green-700">Pilihan hari ini</p>
          <p class="mt-4 text-4xl font-bold text-pink-600">12 Kamar</p>
          <p class="mt-2 text-slate-600">Tersedia dengan suasana cozy dan nyaman.</p>
        </div>
      </div>
    </header>

    <section class="mb-10">
      <div class="grid gap-4 sm:grid-cols-3">
        <button class="rounded-3xl bg-pink-200 px-5 py-4 text-center font-semibold text-pink-900 shadow-lg shadow-pink-200/50 transition hover:-translate-y-1">
          Calon Penghuni
        </button>
        <button class="rounded-3xl bg-emerald-100 px-5 py-4 text-center font-semibold text-emerald-900 shadow-lg shadow-emerald-200/50 transition hover:-translate-y-1">
          Anak Kos
        </button>
        <button class="rounded-3xl bg-amber-100 px-5 py-4 text-center font-semibold text-amber-900 shadow-lg shadow-amber-200/50 transition hover:-translate-y-1">
          Pemilik Kos
        </button>
      </div>
    </section>

    <section class="space-y-8">
      <div class="flex flex-wrap items-center justify-between gap-4 rounded-[2rem] border border-white/70 bg-white/80 p-6 shadow-2xl shadow-green-100/40">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Highlight kamar</p>
          <h2 class="mt-3 text-3xl font-bold text-slate-900">Kartu Info Kamar Kos</h2>
          <p class="mt-3 max-w-xl text-slate-600">
            Temukan kamar gemas untuk calon penghuni, cek status tersedianya, dan lihat tampilan ruang yang estetik. Semuanya dirancang untuk membuat manajemen kos jadi mudah dan menyenangkan.
          </p>
        </div>
        <div class="rounded-3xl bg-gradient-to-br from-pink-100 via-cream-50 to-emerald-100 p-5 text-center shadow-xl shadow-pink-200/40">
          <p class="text-sm font-medium uppercase tracking-[0.25em] text-pink-700">Mood board</p>
          <p class="mt-4 text-4xl font-extrabold text-slate-900">Cute & Pastel</p>
        </div>
      </div>

      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <article class="rounded-3xl border border-white/80 bg-pink-50 p-6 shadow-[0_20px_60px_-20px_rgba(236,72,153,0.35)]">
          <div class="mb-5 flex items-center justify-between">
            <div class="space-y-1">
              <p class="text-sm font-semibold uppercase tracking-[0.2em] text-pink-700">Kamar 101</p>
              <h3 class="text-2xl font-bold text-slate-900">Sweet Blossom</h3>
            </div>
            <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-800">Tersedia</span>
          </div>
          <p class="text-slate-600">Ukuran 3x4 m, jendela besar, dan dekorasi pink lembut. Cocok untuk mereka yang suka suasana hangat dan cozy.</p>
          <div class="mt-6 flex justify-between">
            <span class="rounded-full bg-white/80 px-3 py-2 text-sm font-medium text-slate-700">AC & WiFi</span>
            <span class="rounded-full bg-white/80 px-3 py-2 text-sm font-medium text-slate-700">Rp 1.200.000</span>
          </div>
        </article>

        <article class="rounded-3xl border border-white/80 bg-emerald-50 p-6 shadow-[0_20px_60px_-20px_rgba(34,197,94,0.35)]">
          <div class="mb-5 flex items-center justify-between">
            <div class="space-y-1">
              <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Kamar 202</p>
              <h3 class="text-2xl font-bold text-slate-900">Matcha Cozy</h3>
            </div>
            <span class="rounded-full bg-pink-100 px-3 py-1 text-sm font-semibold text-pink-700">Terisi</span>
          </div>
          <p class="text-slate-600">Sentuhan hijau calm dengan meja kecil dan rak buku. Ideal untuk anak kos yang suka ruang tenang.</p>
          <div class="mt-6 flex justify-between">
            <span class="rounded-full bg-white/80 px-3 py-2 text-sm font-medium text-slate-700">Hotspot</span>
            <span class="rounded-full bg-white/80 px-3 py-2 text-sm font-medium text-slate-700">Rp 1.350.000</span>
          </div>
        </article>

        <article class="rounded-3xl border border-white/80 bg-amber-50 p-6 shadow-[0_20px_60px_-20px_rgba(251,191,36,0.35)]">
          <div class="mb-5 flex items-center justify-between">
            <div class="space-y-1">
              <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-700">Kamar 303</p>
              <h3 class="text-2xl font-bold text-slate-900">Cream Cloud</h3>
            </div>
            <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-800">Tersedia</span>
          </div>
          <p class="text-slate-600">Nuansa cream hangat dengan lampu tidur lucu dan akses dapur bersama. Pas untuk penghuni yang nyaman dengan desain soft.</p>
          <div class="mt-6 flex justify-between">
            <span class="rounded-full bg-white/80 px-3 py-2 text-sm font-medium text-slate-700">Laundry</span>
            <span class="rounded-full bg-white/80 px-3 py-2 text-sm font-medium text-slate-700">Rp 1.150.000</span>
          </div>
        </article>
      </div>
    </section>
  </div>
</body>
</html>
