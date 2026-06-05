<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kosmate - Kelola Kamar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: radial-gradient(circle at top, #fff1f3, #f7f1e6 30%, #d8e8d1 100%); }
  </style>
</head>
<body class="min-h-screen px-6 py-8 text-slate-900">
  <div class="mx-auto max-w-6xl">
    <header class="mb-10 rounded-[2rem] border border-white/80 bg-white/80 p-8 shadow-2xl shadow-pink-200/30">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Pemilik Kos</p>
          <h1 class="mt-3 text-4xl font-bold text-slate-900">Kelola Data Kamar</h1>
          <p class="mt-3 text-slate-600">CRUD dasar untuk menambah, edit, dan hapus kamar kos.</p>
        </div>
        <div class="flex flex-wrap gap-3">
          <a href="{{ route('pemilik.home') }}" class="rounded-3xl bg-amber-100 px-5 py-3 font-semibold text-amber-900 shadow-lg shadow-amber-200/50">Dashboard Pemilik</a>
          <a href="{{ route('pemilik.kamar.create') }}" class="rounded-3xl bg-emerald-500 px-5 py-3 font-semibold text-white shadow-lg shadow-emerald-300/40">Tambah Kamar</a>
        </div>
      </div>
    </header>

    @if(session('message'))
      <div class="mb-6 rounded-3xl bg-emerald-100 border border-emerald-200 p-4 text-emerald-900 shadow-sm">
        {{ session('message') }}
      </div>
    @endif

    <div class="grid gap-6">
      @foreach($kamar as $item)
        <article class="rounded-3xl border border-white/80 bg-white p-6 shadow-lg shadow-slate-200/80">
          <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
              <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">{{ $item->nama }}</p>
              <h2 class="mt-2 text-2xl font-bold text-slate-900">{{ $item->harga }}</h2>
              <p class="mt-3 text-slate-600">{{ $item->fasilitas }}</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
              <span class="rounded-full bg-{{ $item->status === 'Tersedia' ? 'emerald' : 'rose' }}-100 px-3 py-2 text-sm font-semibold text-{{ $item->status === 'Tersedia' ? 'emerald' : 'rose' }}-800">{{ $item->status }}</span>
              <a href="{{ route('pemilik.kamar.edit', $item->id) }}" class="rounded-3xl bg-pink-100 px-4 py-2 font-semibold text-pink-700">Edit</a>
              <form action="{{ route('pemilik.kamar.destroy', $item->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-3xl bg-slate-200 px-4 py-2 font-semibold text-slate-700">Hapus</button>
              </form>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</body>
</html>
