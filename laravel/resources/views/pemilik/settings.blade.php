@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Pengaturan Pemilik</h1>
  <div class="grid grid-cols-1 gap-6">
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="font-semibold mb-3">Buat Akun (Pemilik / Penghuni)</h2>
      <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-3">
          <input name="name" placeholder="Nama" class="border p-2 rounded" required />
          <input name="email" placeholder="Email" type="email" class="border p-2 rounded" required />
          <input name="password" placeholder="Password" type="password" class="border p-2 rounded" required />
          <input name="password_confirmation" placeholder="Konfirmasi Password" type="password" class="border p-2 rounded" required />
          <select name="role" class="border p-2 rounded">
            <option value="pemilik">Pemilik</option>
            <option value="penghuni">Penghuni</option>
          </select>
          <input name="no_hp" placeholder="No HP" class="border p-2 rounded" />
          <button class="bg-emerald-600 text-white px-4 py-2 rounded">Buat Akun</button>
        </div>
      </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="font-semibold mb-3">Manajemen Cepat</h2>
      <div class="space-x-3">
        <a href="{{ route('pemilik.users.pemilik') }}" class="px-4 py-2 rounded bg-sky-100">Daftar Pemilik</a>
        <a href="{{ route('pemilik.users.penghuni') }}" class="px-4 py-2 rounded bg-sky-100">Daftar Penghuni</a>
        <a href="{{ route('pemilik.users.calon_penyewa') }}" class="px-4 py-2 rounded bg-sky-100">Daftar Calon Penyewa</a>
      </div>
    </div>
  </div>
</div>
@endsection
