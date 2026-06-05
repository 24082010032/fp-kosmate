<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kosmate - Tambah Kamar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: radial-gradient(circle at top, #fff9eb, #f2fff1 35%, #f7f1e6 100%); }
  </style>
</head>
<body class="min-h-screen px-6 py-8 text-slate-900">
  <div class="mx-auto max-w-4xl">
    <header class="mb-10 rounded-[2rem] border border-white/80 bg-white/80 p-8 shadow-2xl shadow-amber-200/30">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Tambah Kamar</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Buat Kamar Baru</h1>
        </div>
        <a href="{{ route('pemilik.kamar.index') }}" class="rounded-3xl bg-emerald-100 px-5 py-3 font-semibold text-emerald-900 shadow-lg shadow-emerald-200/50">Kembali ke Daftar</a>
      </div>
    </header>

    <form action="{{ route('pemilik.kamar.store') }}" method="POST" class="space-y-6 rounded-3xl bg-white border border-white/80 p-8 shadow-lg shadow-slate-200/80">
      @csrf
      <div>
        <label class="font-semibold text-slate-700">Nama Kamar</label>
        <input name="name" type="text" placeholder="Contoh: Sweet Blossom" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-pink-400" />
      </div>
      <div>
        <label class="font-semibold text-slate-700">Harga</label>
        <input name="price" type="text" placeholder="Rp 1.200.000" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-emerald-400" />
      </div>
      <div>
        <label class="font-semibold text-slate-700">Status</label>
        <select name="status" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-amber-400">
          <option value="Tersedia">Tersedia</option>
          <option value="Terisi">Terisi</option>
        </select>
      </div>
      <div>
        <label class="font-semibold text-slate-700">Deskripsi</label>
        <textarea name="description" rows="4" placeholder="Deskripsi singkat kamar" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-pink-400"></textarea>
      </div>
      <button type="submit" class="w-full rounded-3xl bg-emerald-500 px-6 py-3 text-white font-semibold shadow-lg shadow-emerald-300/40">Simpan Kamar</button>
    </form>
  </div>
</body>
</html>
